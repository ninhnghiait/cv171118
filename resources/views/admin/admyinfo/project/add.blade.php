@extends('templates.admin.master')
@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Dự án <small>Thêm</small></h3>
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
            <form action="{{ route('project_admin.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
              @csrf
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên dự án</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Nhập tên dự án" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Link</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="url" name="link" value="{{ old('link') }}" class="form-control" placeholder="link" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Hình ảnh</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="file" name="picture[]" class="form-control col-md-10" multiple="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sort</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="number" name="sort" class="form-control col-md-10" value="{{old('sort',500)}}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ngôn ngữ</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select name="lang" id="" class="form-control">
                    <option value="vi">Việt Nam</option>
                    <option value="en">English</option>
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