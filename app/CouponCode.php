<?php

namespace App;

use App\Exceptions\CouponCodeUnavailableException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CouponCode extends Model
{
    use SoftDeletes;

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

    protected $appends = ['description','used_total'];

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

    public function getUsedTotalAttribute()
    {
        return $this->used.'/'.$this->total;
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

    // 检查优惠券是否可用
    public function checkAvailable(User $user, $orderAmount = null)
    {
        if (!$this->enabled) {
            throw new CouponCodeUnavailableException('优惠券不存在');
        }

        if ($this->total - $this->used <= 0) {
            throw new CouponCodeUnavailableException('该优惠券已被兑完');
        }

        if ($this->not_before && $this->not_before->gt(Carbon::now())) {
            throw new CouponCodeUnavailableException('该优惠券现在还不能使用');
        }

        if ($this->not_after && $this->not_after->lt(Carbon::now())) {
            throw new CouponCodeUnavailableException('该优惠券已过期');
        }

        if (!is_null($orderAmount) && $orderAmount < $this->min_amount) {
            throw new CouponCodeUnavailableException('订单金额不满足该优惠券最低金额');
        }

        //一张优惠券一个用户只能使用一次 - 未付款且未关闭订单或者已付款且未退款成功订单
        $re = Order::query()->where('user_id', $user->id)
            ->where('coupon_code_id', $this->id)
            ->where(function ($query){
                 $query->where(function($query){
                    $query->whereNull('paid_at')
                        ->where('closed', false);
                })->orWhere(function ($query){
                    $query->whereNotNull('paid_at')
                        ->where('refund_status', '<>', Order::REFUND_STATUS_SUCCESS);
                });
            })->exists();

        if ($re){
            throw new CouponCodeUnavailableException('你已经使用过这张优惠券了');
        }
    }

    // 使用优惠券后金额
    public function getAdjustedPrice($orderAmount)
    {
        // 固定金额
        if ($this->type === self::TYPE_FIXED) {
            // 为了保证系统健壮性，我们需要订单金额最少为 0.01 元
            return max(0.01, $orderAmount - $this->value);
        }

        return number_format($orderAmount * (100 - $this->value) / 100, 2, '.', '');
    }

    // 优惠券用量  true 代表新增用量，否则是减少用量
    public function changeUsed($increment = true)
    {
        if($increment)
        {
            // 这里需要检查当前用量是否已经超过总量
            return self::query()->where('id', $this->id)->where('used', '<', $this->total)->increment('used');
        }else{
            return self::query()->where('id', $this->id)->decrement('used');
        }
    }

}
