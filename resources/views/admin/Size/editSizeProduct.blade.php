@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập Nhật Size Sản Phẩm
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
                            @foreach($edit_size_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-size-product/'.$edit_value->size_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Danh Mục</label>
                                    <input type="text" value="{{$edit_value->size_name}}" name="size_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                
                                <button type="submit" name="add_size_product" class="btn btn-info">Cập Nhật Size</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
            </div>
    </div>
@endsection