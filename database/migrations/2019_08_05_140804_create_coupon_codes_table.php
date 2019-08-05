<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('优惠券名称');
            $table->string('code')->unique()->comment('优惠码');
            $table->string('type')->comment('类型');
            $table->decimal('value',10,2)->comment('折扣值，不同类型含义不同');
            $table->unsignedInteger('total')->comment('全站可兑换数量');
            $table->unsignedInteger('used')->default(0)->comment('已兑换的数量');
            $table->decimal('min_amount')->default(0)->comment('使用优惠券的最低金额');
            $table->dateTime('not_before')->nullable();
            $table->dateTime('not_after')->nullable();
            $table->tinyInteger('enabled')->default(0)->comment('是否生效');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_codes');
    }
}
