<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
