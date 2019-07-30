<?php

namespace App\Admin\Controllers;

use App\Product;
use App\ProductSkuAttribute;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class ProductAttributeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '商品属性';

    /**
     * Make a gr
     *
     * id builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product);

        $grid->column('id');
        $grid->column('title','商品id');

        // 商品一对多 sku 名称
        $grid->column('skuAttributes', 'suk 分类')->display(function ($skuattribute) {
            if (count($skuattribute)){
                return implode('--', array_column($skuattribute, 'name')) ;
            }
            return '没有sku 属性名称';
        });

        $grid->disableCreateButton();

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);
        $form->text('title','商品名称')->disable();

        //laravel-admin bug skuAttributes 不能使用 只能改为小写
        $form->hasMany('skuattributes', 'SKU 分类', function (Form\NestedForm $form) {
            $form->text('name','名称')->rules('required');
        });

        return $form;
    }

    //商品数据
    public function product(Request $request)
    {
        $q = $request->get('q');

        return Product::where('title', 'like', "%$q%")->paginate(null, ['id', 'title as text']);
    }
}
