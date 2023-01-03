@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Màu Sản Phẩm
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
                                <form role="form" action="{{URL::to('/save-color-product')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Màu</label>
                                    <input type="text" name="color_product_name" required class="form-control" id="exampleInputEmail1" placeholder="Tên màu">
                                </div>
                    
                                <div class="form-group">
                                 <label for="exampleInputPassword1">Hiển Thị</label>
                                    <select name="color_product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                        
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_color_product" class="btn btn-info">Thêm Màu</button>
                            </form>
                            </div>

                        </div>
                    </section>
            </div>
    </div>
@endsection