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
        <h3>Tin tức <small>Sửa</small></h3>
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
            <form action="{{ route('news_admin.update', [$objItem->id_news]) }}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
              @csrf
              @method('put')
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="name" value="{{ old('name', $objItem->name) }}" class="form-control" placeholder="Nhập tên" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Danh mục</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select name="id_cat" class="form-control" >
                    @foreach ($arItems as $v)
                      @php
                      $active = $v['id_cat'] == $objItem->id_cat ? 'selected' : '';
                      @endphp
                      <option {{$active}} value="{{ $v['id_cat'] }}">{{ $v['name'] }}</option>
                      @foreach ($v['child'] as $vc)
                        @php
                        $activec = $vc['id_cat'] == $objItem->id_cat ? 'selected' : '';
                        @endphp
                        <option {{$activec}} value="{{ $vc['id_cat'] }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $vc['name'] }}</option>
                      @endforeach
                    @endforeach
                  </select>
                </div>
              </div>
              @if ($objItem->picture != '') 
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Hình ảnh</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <img src="{{ Storage::url('app/media/files/news/'.$objItem->picture) }}" class="picture-project" alt="">
                </div>
              </div>
              @endif
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Hình ảnh</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="file" name="picture" class="form-control col-md-10">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Miêu tả</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="preview_text" value="{{ old('preview_text', $objItem->preview_text) }}" class="form-control" placeholder="Nhập miêu tả" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tags</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="select2_multiple form-control" multiple="multiple" size="{{count($arAllTags)}}" name="tag[]">
                    @php
                    $arSelect = [];
                    @endphp
                    @foreach($objItem->tags as $tag)
                      @php
                      $arSelect[] = $tag->id_tag;
                      @endphp
                    @endforeach
                    @foreach($arAllTags as $vat)
                    <option value="{{$vat['id_tag']}}" {{in_array($vat['id_tag'],$arSelect) ? 'selected' : ''}}>{{$vat['name']}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Chi tiết</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea name="detail_text" id="ckeditor" class="form-control col-md-13" required="">{{ old('detail_text', $objItem->detail_text) }}</textarea>
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