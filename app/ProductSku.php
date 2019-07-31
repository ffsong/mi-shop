<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    protected $fillable = [
        'product_id', 'attributes', 'price', 'stock'
    ];

    // 类似获取器  返回的 attributes 为json类型
    protected $casts = [
        'attributes' => 'json', // 声明json类型
    ];

    protected $appens = ['sku_info'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getSkuInfoAttribute()
    {
        return implode(' | ', array_column(json_decode($this->attributes['attributes'],true), 'value')) ;
    }

    // 查询是否存在当前单品
    public function checkSku($arr = [])
    {
        foreach ($arr as $key => $value) {
            if($value){
                $data[] = [
                    'id' => $key,
                    'value' => $value
                ];
            }
        }

        $param = json_encode($data, JSON_UNESCAPED_UNICODE);

        $sql = "JSON_CONTAINS(`attributes`, '".$param."')";

        return ProductSku::query()->whereRaw($sql)->get();
    }

}
