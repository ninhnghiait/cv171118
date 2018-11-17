@extends('templates.admin.master')
@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Kinh nghiệm <small>Sửa</small></h3>
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
            <form action="{{ route('experiences_admin.update', $objItem->id_exp) }}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
              @csrf
              @method('put')
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="name" value="{{ old('name', $objItem->name) }}" class="form-control" placeholder="Nhập tên" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nội dung</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="content" value="{{ old('name', $objItem->content) }}" class="form-control" placeholder="Nhập nội dung" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Thời gian bắt đầu</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="date" name="date_create" value="{{ old('value', $objItem->date_create) }}" class="form-control" placeholder="giá trị">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Loại</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select name="type" class="form-control">
                    @if ($objItem->type != 'education')
                      @php
                      $select = 'selected';
                      @endphp
                    @else
                      @php
                      $select = '';
                      @endphp
                    @endif
                    <option value="education">Học tập</option>
                    <option value="work" {{ $select }}>Kinh nghiệm</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ngôn ngữ</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select name="language_code" class="form-control">
                    @php
                    $sllang = $objItem->language_code != 'vi' ? 'selected' : '';
                    @endphp
                    <option value="vi">Việt Nam</option>
                    <option value="en" {{$sllang}}>English</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Địa điểm</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="address" value="{{old('address',$objItem->address)}}" class="form-control" placeholder="Nhập địa điểm" required>
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