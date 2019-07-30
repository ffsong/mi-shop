<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestException;
use App\Product;
use App\ProductSku;
use http\Env\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $builder = Product::query()->where('on_sale',true);

        // 判断是否有提交 search 参数，如果有就赋值给 $search 变量
        // search 参数用来模糊搜索商品
        if ($search = $request->input('search', '')) {
            $like = '%'.$search.'%';
            // 模糊搜索商品标题、商品详情、SKU 标题、SKU描述
            $builder->where(function ($query) use ($like) {
                $query->where('title', 'like', $like)
                    ->orWhere('description', 'like', $like)
                    ->orWhereHas('skus', function ($query) use ($like) {
                        $query->where('title', 'like', $like)
                            ->orWhere('description', 'like', $like);
                    });
            });
        }

        if($order = $request->input('order','')) {
            // 是否是以 _asc 或者 _desc 结尾
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
                // 如果字符串的开头是这 3 个字符串之一，说明是一个合法的排序值
                if (in_array($m[1], ['price', 'sold_count', 'rating'])) {
                    // 根据传入的排序值来构造排序参数
                    $builder->orderBy($m[1], $m[2]);
                }
            }
        }
        $products = $builder->paginate(16);

        return view('products.index', [
            'products' => $products,
            'filters'  => [
                'search' => $search,
                'order'  => $order,
            ],
        ]);
    }

    public function show(Product $product)
    {
        // 判断商品是否已经上架，如果没有上架则抛出异常。
        if (!$product->on_sale) {
            throw new InvalidRequestException('商品未上架');
        }

        $product['skus'] = $product->getSkusAll();

        return view('products.show',['product' =>$product]);
    }

    //获取商品价格和库存
    public function getPrice(ProductSku $productSku, Request $request)
    {
        $arr = $request->input('list');

        if (count($arr)){
            $productSku = $productSku->checkSku($arr);

            if(count($productSku) == 1){
                return response()->json(['msg'=> 'ok','data' => $productSku[0]]);
            }
        }

        return json_encode(['msg'=> 'error','data' => '商品存在']);
    }


}