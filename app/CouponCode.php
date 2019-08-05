<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CouponCode extends Model
{

    // 优惠券类型
    const TYPE_FIXED = 'fixed';
    const TYPE_PERCENT = 'percent';

    public static $typeMap = [
        self::TYPE_FIXED   => '固定金额',
        self::TYPE_PERCENT => '比例',
    ];

    protected $fillable = [
        'name',
        'code',
        'type',
        'value',
        'total',
        'used',
        'min_amount',
        'not_before',
        'not_after',
        'enabled',
        ];

    protected $appends = ['description'];

    // 指明类型 -- 内部是用的获取器和修改器实现
    protected $casts = [
        'enabled' => 'boolean',
    ];

    // 指明日期类型
    protected $date = ['not_before', 'not_after'];

    public function getDescriptionAttribute()
    {
        switch ($this->type){
            case self::TYPE_FIXED:
                return '满 '.$this->min_amount.' 减 '.str_replace('.00', '', $this->value).' 元';
                break;
            case self::TYPE_PERCENT:
                return '优惠 '. str_replace('.00', '', $this->value).'%';
                break;
            default:
                return '更多优惠尽情期待';
        }

    }

    // 生成优惠码
    public static function findAvailableCode($length = 16)
    {
        do {
            // 生成一个指定长度的随机字符串，并转成大写
            $code = strtoupper(Str::random($length));
            // 如果生成的码已存在就继续循环
        } while (self::query()->where('code', $code)->exists());

        return $code;
    }

}
