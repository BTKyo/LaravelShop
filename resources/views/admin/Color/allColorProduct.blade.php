@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Màu Sản Phẩm
    </div>
   <div><a href="{{URL::to('/add-color-product')}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-sharp fa-solid fa-plus text-active"></i> Thêm Màu Sản Phẩm</a></div>
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
            <th>Tên Màu</th>
            <th>Hiển Thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_color_product as $key => $color_pro)
          <tr>
            <td>{{ $color_pro->color_name }}</td>
            <td><span class="text-ellipsis">
                <?php
                if($color_pro->color_status==1)
                {
                ?>
                <a href="{{URL::to('/unactive-color-product/'.$color_pro->color_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                     }
                     else
                     {
                ?>
                    <a href="{{URL::to('/active-color-product/'.$color_pro->color_id)}}"><span class="fa-thumbs-styling fa fa-thumbs-down "></span></a>
                <?php
                }
                ?>

            </span></td>
            <td>
            

              <a href="{{URL::to('/edit-color-product/'.$color_pro->color_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
            <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này không? Đã xóa sẽ không khôi phục!!!')" href="{{URL::to('/delete-color-product/'.$color_pro->color_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
@endsection