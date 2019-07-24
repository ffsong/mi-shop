<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    protected $fillable = [
        'attributes', 'price', 'stock'
    ];

    // 类似获取器  返回的 attributes 为json类型
    protected $casts = [
        'attributes' => 'json', // 声明json类型
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
