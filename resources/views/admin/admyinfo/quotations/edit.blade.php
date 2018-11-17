@extends('templates.admin.master')
@section('css')
<style>
  .picture-project {
    width: 200px;
    border-radius: 7px;
    border: 2px solid #5580aa;
  }
</style>
@endsection
@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Danh ngôn <small>Sửa</small></h3>
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
            <form action="{{ route('quotations_admin.update', $objItem->id_quo) }}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
              @csrf
              @method('put')
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="name" value="{{ old('name', $objItem->name) }}" class="form-control" placeholder="Nhập tên" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Job</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="job" value="{{ old('job', $objItem->job) }}" class="form-control" placeholder="job" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nội dung</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea name="content" id="ckeditor" class="form-control col-md-13" required="">{{ old('name', $objItem->content) }}</textarea>
                </div>
              </div>
              @if ($objItem->picture != '') 
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Hình ảnh</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <img src="{{ Storage::url('app/media/files/quotations/'.$objItem->picture) }}" class="picture-project" alt="">
                </div>
              </div>
              @endif
               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ngôn ngữ</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="form-control" name="language_code">
                    @php
                      $sllang = old('language_code',$objItem->language_code) != 'vi' ? 'selected' : '';
                    @endphp
                    <option value="vi">Việt Nam</option>
                    <option value="en" {{$sllang}}>English</option>
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