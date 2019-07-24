<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('短标题');
            $table->string('long_title')->comment('长标题');
            $table->text('description')->comment('商品详情');
            $table->string('image')->comment('封面图片');
            $table->tinyInteger('on_sale')->comment('商品是否正在售卖');
            $table->float('rating')->comment('商品平均评分');
            $table->unsignedInteger('sold_count')->comment('销量');
            $table->unsignedInteger('review_count')->comment('评论数量');
            $table->decimal('price',10, 2)->comment('sku 最低价格');
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
        Schema::dropIfExists('products');
    }
}
