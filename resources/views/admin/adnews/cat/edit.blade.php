@extends('templates.admin.master')
@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Intro <small>Sửa</small></h3>
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
            <form action="{{ route('cat_admin.update', $objItem->id_cat) }}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
              @csrf
              @method('put')
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="name" value="{{ old('name', $objItem->name) }}" class="form-control" placeholder="Nhập tên" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Danh mục cha</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select name="parent_id" class="form-control" >
                    <option value="0">Không</option>
                    @foreach ($arItems as $v)
                      @php
                      $active = old('parent_id',$objItem->parent_id) == $v['id_cat'] ? 'selected' : '';
                      @endphp
                      @if ( $v['id_cat'] != $objItem->id_cat)
                      <option value="{{ $v['id_cat'] }}" {{$active}}>{{ $v['name'] }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sort</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="number" name="sort" value="{{ old('sort',$objItem->sort) }}" class="form-control" placeholder="" required="">
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