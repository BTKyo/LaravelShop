@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Size Sản Phẩm
    </div>
    <div class="col-md-12">
      <a href="{{URL::to('/add-size-product')}}" class="active styling-edit">
                <i class="fa fa-sharp fa-solid fa-plus text-active "></i> Thêm Size Sản Phẩm</a>
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
            <th>Tên Size</th>
            <th>Hiển Thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_size_product as $key => $size_pro)
          <tr>
           
            <td>{{ $size_pro->size_name }}</td>
            <td><span class="text-ellipsis">
                <?php
                if($size_pro->size_status==1)
                {
                ?>
                <a href="{{URL::to('/unactive-size-product/'.$size_pro->size_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                     }
                     else
                     {
                ?>
                    <a href="{{URL::to('/active-size-product/'.$size_pro->size_id)}}"><span class="fa-thumbs-styling fa fa-thumbs-down "></span></a>
                <?php
                }
                ?>

            </span></td>
            <td>
              <a href="{{URL::to('/edit-size-product/'.$size_pro->size_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
            <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này không? Đã xóa sẽ không khôi phục!!!')" href="{{URL::to('/delete-size-product/'.$size_pro->size_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
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