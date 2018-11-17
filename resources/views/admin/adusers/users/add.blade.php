@extends('templates.admin.master')
@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Người dùng <small>Thêm</small></h3>
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
          @if (Request::has('msg'))
          <div class="alert alert-danger">
              <ul>
                  <li>{{ Request::get('msg') }}</li>
              </ul>
          </div>
          @endif

          <div class="x_content">
            <br>
            <form action="{{ route('users_admin.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
              @csrf
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Username</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="username" value="{{ old('username')}}" class="form-control" placeholder="Nhập tên người dùng" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="password" name="password" value="" class="form-control" placeholder="Nhập mật khẩu" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nhóm người dùng</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select name="vgroup[]" size="4" multiple="multiple" class="form-control">
                    <option value="0">--Nhóm người dùng--</option>
                    @foreach ($objItemsGroup as $objGroup)
                        @if (old('vgroup'))
                            @if (in_array($objGroup->id_group, old('vgroup')))
                                <option value="{{ $objGroup->id_group }}" selected="selected">{{ $objGroup->name }}</option>
                            @else
                                <option value="{{ $objGroup->id_group }}">{{ $objGroup->name }}</option>
                            @endif
                        @else
                            <option value="{{ $objGroup->id_group }}">{{ $objGroup->name }}</option>
                        @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Họ và tên</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="fullname" value="{{ old('fullname')}}" class="form-control" placeholder="Nhập họ và tên" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="email" value="{{ old('email')}}" class="form-control" placeholder="Nhập email" required="">
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                  <button type="submit" name="submit" class="btn btn-success">Thực hiện</button>
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