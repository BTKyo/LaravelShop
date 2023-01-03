@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập Nhật Sản Phẩm
                        </header>
                        <?php
                        use Illuminate\Support\Facades\Session;

                            $message = Session::get('message');
                            if($message)
                            {
                                echo $message;
                                Session::put('message',null);
                            }
                        ?>
                        <div class="panel-body">
                            <div class="position-center">
                                @foreach($edit_product as $key => $pro)
                                <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Tên Sản Phẩm</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{$pro->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label>Mô Tả Sản Phẩm</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="product_desc" 
                                    id="ckeditor2">{{$pro->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Nội Dung Sản Phẩm</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="product_content" 
                                    id="ckeditor3">{{$pro->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                 <label>Danh Mục Sản Phẩm</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                            @if($cate->category_id == $pro->category_id)
                                            <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @else
                                            <option  value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @endif
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                 <label>Thương Hiệu</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                            @if($brand->brand_id == $pro->brand_id)
                                             <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @else
                                            <option  value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @endif
                                        @endforeach
                                        
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                 <label>Màu Sắc</label>
                                    <select name="product_color" class="form-control input-sm m-bot15">
                                        @foreach($color_product as $key => $color)
                                            @if($color->color_id == $pro->product_color)
                                                <option selected value="{{$color->color_id}}">{{$color->color_name}}</option>
                                             @else
                                                <option value="{{$color->color_id}}">{{$color->color_name}}</option>
                                            @endif
                                        @endforeach
                                        
                                    </select>
                                </div>

                                <div class="form-group">
                                 <label>Size</label>
                                    <select name="product_size" class="form-control input-sm m-bot15">
                                        @foreach($size_product as $key => $size)
                                        @if($size->size_id == $pro->product_size)
                                            <option selected value="{{$size->size_id}}">{{$size->size_name}}</option>
                                        @else
                                            <option value="{{$size->size_id}}">{{$size->size_name}}</option>
                                        @endif
                                        @endforeach
                                        
                                    </select>
                                </div>
                                    
                                <div class="form-group">
                                    <label>Hình Ảnh Sản Phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/upload/products/'.$pro->product_image)}}" height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label>Giá Sản Phẩm</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" value="{{$pro->product_price}}">
                                </div>
                                <div class="form-group">
                                 <label>Hiển Thị</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                        
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_product" class="btn btn-info">Cập Nhật Sản Phẩm</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>
            </div>
    </div>
@endsection