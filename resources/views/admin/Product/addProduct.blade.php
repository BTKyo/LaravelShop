@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Sản Phẩm
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
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                    <input type="text" name="product_name" class="form-control"
                                    required
                                     id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Sản Phẩm</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="product_desc" 
                                    id="ckeditor" placeholder="Mô tả danh mục"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội Dung Sản Phẩm</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="product_content"
                                     id="ckeditor1" placeholder="Nội dung danh mục"></textarea>
                                </div>

                                <div class="form-group">
                                 <label for="exampleInputPassword1">Danh Mục Sản Phẩm</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                 <label for="exampleInputPassword1">Thương Hiệu</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                                    <input type="text" data-validation="number" data-validation-error-msg="Làm ơn điền số tiền và điền bằng số"
                                     name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                
                                <div class="form-group">
                                 <label for="exampleInputPassword1">Màu Sắc</label>
                                    <select name="product_color" class="form-control input-sm m-bot15">
                                        @foreach($color_product as $key => $color)
                                        <option value="{{$color->color_id}}">{{$color->color_name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>

                                <div class="form-group">
                                 <label for="exampleInputPassword1">Size</label>
                                    <select name="product_size" class="form-control input-sm m-bot15">
                                        @foreach($size_product as $key => $size)
                                        <option value="{{$size->size_id}}">{{$size->size_name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình Ảnh Sản Phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                </div>
                               
                                <div class="form-group">
                                 <label for="exampleInputPassword1">Hiển Thị</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                        
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_product" class="btn btn-info">Thêm Sản Phẩm</button>
                            </form>
                            </div>

                        </div>
                    </section>
            </div>
    </div>
@endsection