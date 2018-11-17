@extends('templates.admin.master')
@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Danh ngôn <small>Thêm</small></h3>
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
            <form action="{{ route('quotations_admin.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
              {{ csrf_field() }}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Nhập tên" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Job</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="job" value="{{ old('job') }}" class="form-control" placeholder="job" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nội dung</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea name="content" id="ckeditor" class="form-control col-md-13" required="">{{ old('content') }}</textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Hình ảnh</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="file" name="picture" class="form-control col-md-10">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ngôn ngữ</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="form-control" name="language_code">
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