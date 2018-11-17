@extends('templates.admin.master')
@section('css')
<style>
  .picture-project {
    width: 200px;
    border: 1px solid #5580aa;
    transition: transform .2s;
  }
  .picture-project:hover {
    transform: scale(2.5);
}
</style>
@endsection
@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Dự án <small>Sửa</small></h3>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="x_panel">
          @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif

          <div class="x_content">
            <br>
            <form action="{{ route('project_admin.update', $objItem->id_prj) }}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
              @csrf
              @method('put')
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên dự án</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="name" value="{{ old('name', $objItem->name) }}" class="form-control" placeholder="Nhập tên dựa án" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Link</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="link" name="link" value="{{ old('value', $objItem->link) }}" class="form-control" placeholder="Nhập link" required="">
                </div>
              </div>
              @if ($objItem->picture != '') 
              @php
               $arPic = explode('|', $objItem->picture);
              @endphp
                
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Hình ảnh</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  @foreach ($arPic as $key => $v)
                  @if ($v != '')
                  <img src="{{ Storage::url('app/media/files/project/'.$v) }}" class="picture-project" alt="">
                  @endif
                  @endforeach
                </div>
              </div>
              @endif
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Hình ảnh</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="file" name="picture[]" class="form-control col-md-10" multiple="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ngôn ngữ</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select name="lang" id="" class="form-control">
                    <option value="vi">Việt Nam</option>
                    <option value="en" {{$objItem->lang == 'en' ? 'selected' : ''}}>English</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sort</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="number" name="sort" class="form-control col-md-10" value="{{old('sort',$objItem->sort)}}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tùy chọn</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select name="status" id="" class="form-control">
                    <option value="edit">Edit</option>
                    <option value="add">Add</option>
                  </select>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success">Thực hiện</button>
                  <a href="{{ url()->previous() }}" class="btn btn-primary">Quay lại</a>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>

    </div>
</div>
@endsection