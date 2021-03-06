<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillbale = ['name', 'is_directory', 'level', 'path'];
    protected $casts = [
        'is_directory' => 'boolean',
    ];
    
    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected static function boot()
    {
        parent::boot();
        // 监听 Category 的创建事件，用于初始化 path 和 level 字段值
        static::creating(function (Category $category) {
            // 如果创建的是根类目
            if(is_null($category->parent_id)){
                $category->level = 0;
                $category->path = '-';
            }else{
                // 非根类目
                $category->level = $category->parent->level + 1;
                // 将 path 值设为父类目的 path 追加父类目 ID 以及最后跟上一个 - 分隔符
                $category->path = $category->parent->path."{$category->parent_id}-";
            }
        });
    }

    // 获取所有祖先类目的 ID 值
    public function getPathIdsAttribute()
    {
        return array_filter(explode('-', $this->path));
    }

    // 获取所有祖先类目并按层级排序
    public function getAncestorsAttribute()
    {
        return self::query()
            ->whereIn('id', $this->path_ids)
            ->orderBy('level')
            ->get();
    }

    // 获取以 - 为分隔的所有祖先类目名称以及当前类目的名称
    public function getFullNameAttribute()
    {
        return $this->ancestors  // 获取所有祖先类目
            ->pluck('name') // 取出所有祖先类目的 name 字段作为一个数组
            ->push($this->name) // 将当前类目的 name 字段值加到数组的末尾
            ->implode(' - '); // 用 - 符号将数组的值组装成一个字符串
    }
}
