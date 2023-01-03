@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Sản Phẩm
    </div>
   <div><a href="{{URL::to('/add-product')}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-sharp fa-solid fa-plus text-active"></i> Thêm Sản Phẩm</a></div>
    <div class="table-responsive">
                    <?php
                        use Illuminate\Support\Facades\Session;

                            $message = Session::get('message');
                            if($message)
                            {
                                echo $message;
                                Session::put('message',null);
                            }
                        ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên Sản Phẩm</th>
            <th>Danh Mục</th>
            <th>Thương Hiệu</th>
            <th>Giá</th>
            <th>Hình Ảnh</th>
            <th>Size</th>
            <th>Màu</th>
            <th>Hiển Thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_product as $key => $pro)
          <tr>
            <td>{{ $pro->product_name }}</td>
            <td>{{ $pro->category_name }}</td>
            <td>{{ $pro->brand_name }}</td>
            <td>{{ $pro->product_price }}</td>
            <td><img src = "public/upload/products/{{ $pro->product_image }}" height="100" width="100"></td>
            <td>{{ $pro->size_name }}</td>
            <td>{{ $pro->color_name }}</td>
            <td><span class="text-ellipsis">
                <?php
                if($pro->product_status==1)
                {
                ?>
                <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                     }
                     else
                     {
                ?>
                    <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span class="fa-thumbs-styling fa fa-thumbs-down "></span></a>
                <?php
                }
                ?>

            </span></td>
            <td>
              <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
            <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không? Đã xóa sẽ không khôi phục!!!')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
      <div class = "col-md-12 m-3" >
					{{$all_product->links()}}
			</div>
      </div>
    </footer>
  </div>
@endsection