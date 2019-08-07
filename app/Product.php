<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{

    protected $fillable = [
        'title','long_title','description', 'image', 'on_sale',
        'rating', 'sold_count', 'review_count', 'price'
    ];

    protected $casts = [
        'on_sale' => 'boolean', // 声明 on_sale 是一个布尔类型的字段
    ];

    // sku 属性
    public function skuAttributes()
    {
        return $this->hasMany(ProductSkuAttribute::class);
    }

    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function categorys()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute()
    {
        // 如果 image 字段本身就已经是完整的 url 就直接返回
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return \Storage::disk('admin')->url($this->attributes['image']);
    }

    //商品规格拼接
    public function getSkusAll()
    {
        $skuAttributes = $this->skuAttributes;
        $skus = $this->skus;

        if( count($skuAttributes) && count($skus) )
        {
            $skuAttributes = collect($skuAttributes)->toArray();

            foreach ($skuAttributes as $key => $skuAttribute)
            {
                $skuAttributes[$key]['list'] = [];

                foreach ($skus as $k => $sku){
                    foreach ($sku['attributes'] as $key1 => $attribute){
                        if($skuAttribute['id'] == $attribute['id']){

                            $skuAttributes[$key]['list'][] = $attribute;
                        }
                    }
                }

                $skuAttributes[$key]['list'] = array_unique($skuAttributes[$key]['list'], SORT_REGULAR);
            }

            return $skuAttributes;
        }
        return [];
    }

    public function getPrice()
    {


    }

}
