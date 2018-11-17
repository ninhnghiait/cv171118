@extends('templates.admin.master')
@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Tin tức<small>Thêm</small></h3>
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
            <form action="{{ route('news_admin.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
              @csrf
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Nhập tên tin tức" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Danh mục</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select name="id_cat" class="form-control" >
                    @foreach ($arItems as $v)
                    <option value="{{ $v['id_cat'] }}">{{  $v['name'] }}</option>
                      @foreach ($v['child'] as $vc)
                      <option value="{{ $vc['id_cat'] }}"> &nbsp;&nbsp;&nbsp;&nbsp;{{  $vc['name'] }}</option>
                      @endforeach
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Hình ảnh</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="file" name="picture" class="form-control col-md-10">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Miêu tả</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="preview_text" value="{{ old('preview_text') }}" class="form-control" placeholder="Nhập miêu tả" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tags</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="select2_multiple form-control" multiple="multiple" size="{{count($arAllTags)}}" name="tag[]">
                    @foreach($arAllTags as $vat)
                    <option value="{{$vat['id_tag']}}">{{$vat['name']}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Chi tiết</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea name="detail_text" id="ckeditor" class="form-control col-md-13" required="">{{ old('detail_text') }}</textarea>
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
@section('js')
<script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
  CKEDITOR.replace('ckeditor', options);
</script>
@stop