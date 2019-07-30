@extends('layouts.app')
@section('title', $product->title)

@section('content')
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-body product-info">
                    <div class="row">
                        <div class="col-5">
                            <img class="cover" src="{{ $product->image_url }}" alt="">
                        </div>
                        <div class="col-7">
                            <div class="title">{{ $product->title }}</div>
                            <div class="price"><label>价格</label><em>￥</em><span>{{ $product->price }}</span></div>
                            <div class="sales_and_reviews">
                                <div class="sold_count">累计销量 <span class="count">{{ $product->sold_count }}</span></div>
                                <div class="review_count">累计评价 <span class="count">{{ $product->review_count }}</span></div>
                                <div class="rating" title="评分 {{ $product->rating }}">评分 <span class="count">{{ str_repeat('★', floor($product->rating)) }}{{ str_repeat('☆', 5 - floor($product->rating)) }}</span></div>
                            </div>

                            @foreach($product->skus as $sku)
                            <div class="skus">
                                <label>{{ $sku['name'] }}</label>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    @foreach($sku['list'] as $list )
                                        <label class="btn sku-btn"
                                               data-top = "{{ $sku['name']  }}"
                                               data-value="{{ $list['value'] }}"
                                               data-id="{{ $list['id'] }}"
                                               title="{{ $list['value'] }}" >
                                                <input type="radio" name="{{ $sku['name']  }}" autocomplete="off"
                                                       value="{{ $list['id'] }}"> {{ $list['value'] }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach

                            <div class="cart_amount"><label>数量</label><input type="text" class="form-control form-control-sm" value="1"><span>件</span><span class="stock"></span></div>
                            <div class="buttons">
                                <button class="btn btn-success btn-favor">❤ 收藏</button>
                                <button class="btn btn-primary btn-add-to-cart">加入购物车</button>
                            </div>
                        </div>
                    </div>
                    <div class="product-detail">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#product-detail-tab" aria-controls="product-detail-tab" role="tab" data-toggle="tab" aria-selected="true">商品详情</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#product-reviews-tab" aria-controls="product-reviews-tab" role="tab" data-toggle="tab" aria-selected="false">用户评价</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="product-detail-tab">
                                {!! $product->description !!}
                            </div>
                            <div role="tabpanel" class="tab-pane" id="product-reviews-tab">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptsAfterJs')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip({trigger: 'hover'});

            var list = {};
            $('.sku-btn').click(function () {

                 var id = $(this).data('id');
                 var value = $(this).data('value');

                list[id] = value;

                $.post('{{ route('products.price')}}',{list, "_token": '{{ csrf_token() }}'},function (data) {
                    if (data.msg == 'ok') {
                        $('.product-info .price span').text(data.data.price);
                        $('.product-info .stock').text('库存：' + data.data.stock + '件');
                        return true;
                    }
                    console.log('商品不存在')

                    $('.product-info .price span').text({{ $product->price }}+ '.00');
                    $('.product-info .stock').text('库存：' + 0 + '件');
                });
            });
        });
    </script>

@endsection