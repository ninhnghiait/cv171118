@extends('templates.admin.master')
@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Intro <small>Thêm</small></h3>
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
            <form action="{{ route('admin.admyinfo.intro.add') }}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
              {{ csrf_field() }}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Nhập tên" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="email" name="email" value="{{ old('name') }}" class="form-control" placeholder="Nhập email" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-6 col-xs-12">Ngày sinh</label>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <input type="date" name="birthday" value="{{old('birthday') }}" class="form-control" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Địa chỉ</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="Nhập địa chỉ" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Số điện thoại</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Nhập số điện thoại" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nội dung</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea name="content" class="form-control col-md-13" required="">{{ old('content') }}</textarea>
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