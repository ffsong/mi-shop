<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('分类名称');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->boolean('is_directory')->default(false)->comment('是否拥有子目录');
            $table->unsignedInteger('level')->default(0)->comment('当前类目层级');
            $table->string('path')->comment('该类目所有父类目 id');
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
        Schema::dropIfExists('categories');
    }
}
