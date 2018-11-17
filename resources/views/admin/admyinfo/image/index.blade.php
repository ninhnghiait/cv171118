@extends('templates.admin.master')
@section('css')
<style>
.a-edit {
  background-color: #ddd;
}
</style>
@endsection
@section('content')
<form id="delall" action="{{ route('img_admin.delall') }}" method="post" class="form-horizontal form-label-left">
{{ csrf_field() }}
</form>
  <div class="page-title">
    <div class="title_left">
      <h3>Gallery <small>List</small></h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Media Gallery <small><a href="{{route('img_admin.create')}}">Add Gallery</a></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a>
                </li>
                <li><a href="#">Settings 2</a>
                </li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        @if (Session::has('msg')) 
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <strong>{{ Session::get('msg') }}</strong>
        </div>
        @endif
        <div class="x_content">

          <div class="row">
            @foreach($arGlr as $v)
              <p><b>{{$v['name']}}</b> </p>
              <div>
                <a class="btn a-edit" href="{{route('img_admin.add_pic',$v['gallery_id'])}}"> Add Picture</a>
                <a class="btn a-edit" href="{{route('img_admin.edit',$v['gallery_id'])}}"> Edit Gallery</a>
                <form action="{{route('img_admin.destroy',$v['gallery_id'])}}" method="post" style="display: inline;">
                  @csrf
                  @method('delete')
                  <input type="submit" class="btn" value="Delete">
                </form>
              </div>
              @foreach($v['img'] as $v2)
              <div class="col-md-55">
                <div class="thumbnail">
                  <div class="image view view-first" style="width: 100%;height:100% ">
                    <img style="width: 100%; display: block;" src="{{asset('storage/app/media/files/gallery/'.$v2['image'])}}" alt="image" />
                  </div>
                  <div class="captionn" style="position: relative; top: -20px; z-index: 999;left: 161px;">
                   <input type="checkbox" form="delall" class="flat" name="img[]" value="{{$v2['img_id']}}">
                  </div>
                </div>
              </div>
              @endforeach
            @endforeach



          </div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <button form="delall" type="submit" name="del" class="btn btn-success" onclick="return confirm('Bạn thực sự muốn xóa các bản ghi đã chọn?')">Xóa</button>
      </div>
    </div>
  </div>
@endsection
