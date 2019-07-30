
@if(!$id)
    <form action="/admin/product-skus" method="post">
    @else
    <form action="{{ route('product-skus.update',['id'=>$id]) }}" method="post">
        <input type="hidden" name="_method" value="put">
@endif

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">编辑</h3>
                </div>

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                @endif


                <div class="form-horizontal">
                    <div class="box-body">
                        @if(count($sku_attributes))

                            <div class="form-group">
                                <label for="text1" class="col-sm-2 control-label">商品名称</label>
                                <div class="col-sm-4">
                                    <input type="text" disabled class="form-control" value="{{ $sku_attributes[0]->product->title }}"/>
                                </div>
                            </div>

                            @foreach($sku_attributes as $key => $sku_attribute)
                                <div class="form-group">
                                    <label for="text1" class="col-sm-2 control-label">{{ $sku_attribute->name }}</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control"
                                               placeholder="{{ $sku_attribute->name }}" name="attributes[{{ $sku_attribute->id }}]" value="">
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label for="text1" class="col-sm-2 control-label">价格</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control"
                                           placeholder="0.00" name="price"  required="required"
                                           pattern = "^(\d+)|(\d+.\d\d)$" title="金额只能为整数或者2位小数">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="text1" class="col-sm-2 control-label">库存</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control"
                                           placeholder="0" name="stock" value="0" required="required" pattern ="^[0-9]+$" title="库存只能为数字">
                                </div>
                            </div>

                        @endif

                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-info pull-right">保存</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
        </div>
    </div>

</form>