<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductSku;
use App\ProductSkuAttribute;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;

class ProductSkuController extends Controller
{

    protected $title = '单品';

    public function index(Content $content)
    {
        return $content
            ->title($this->title)
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($this->grid());
    }

    protected function grid()
    {
        $grid = new Grid(new Product);

        $grid->column('id', __('Id'));
        $grid->column('title', '商品名称');
        $grid->column('attributes', 'sku');
        $grid->column('price','单价');
        $grid->column('stock', '库存');
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->disableCreateButton();

        return $grid;
    }

    public function edit($id, Content $content)
    {

        $sku_attributes = ProductSkuAttribute::query()->where('product_id',$id)->get();

        session()->flash('key',123);

        return $content
            ->title($this->title)
            ->body(view('admin_product_sku.create_edit', ['id' => $id,'sku_attributes'=> $sku_attributes])->render());
    }

    public function update(ProductSku $productSku, Request $request ,$id)
    {
       $arr = $request->input('attributes');

        $re = $productSku->checkSku($arr);

        if( count($re) ) {
            return redirect()->back()->withErrors('sku 已存在');
        }

        $data = [];
        foreach ($arr as $key => $value) {
            if($value){
                $data[] = [
                    'id' => $key,
                    'value' => $value
                ];
            }
        }

       $data = [
           'product_id' => $id,
           'price' => $request->input('price',0),
           'stock' => $request->input('stock',0),
           'attributes' => $data,
       ];
        ProductSku::query()->create($data);

        return redirect()->route('product-skus.index');
    }

}
