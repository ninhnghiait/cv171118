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
            <form action="{{ route('intro_admin.update', $objItem->id_if) }}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
              @csrf
              @method('put')
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ngôn ngữ</label>
                <label class="control-label col-md-3 col-sm-3 col-xs-12">{{$objItem->language_code}}</label>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="name" value="{{ old('name', $objItem->name) }}" class="form-control" placeholder="Nhập tên" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="email" name="email" value="{{ old('email', $objItem->email) }}" class="form-control" placeholder="Nhập email" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-6 col-xs-12">Ngày sinh</label>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <input type="date" name="birthday" value="{{old('birthday', $objItem->birthday) }}" class="form-control" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Địa chỉ</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="address" value="{{ old('address', $objItem->address) }}" class="form-control" placeholder="Nhập địa chỉ" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Số điện thoại</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="phone" value="{{ old('phone', $objItem->phone) }}" class="form-control" placeholder="Nhập số điện thoại" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Facebook</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="url" name="fb" value="{{ old('phone', $objItem->fb) }}" class="form-control" placeholder="Nhập Facebook url" >
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Twitter</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="url" name="tt" value="{{ old('phone', $objItem->tt) }}" class="form-control" placeholder="Nhập Twitter" >
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Google +</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="url" name="gg" value="{{ old('phone', $objItem->gg) }}" class="form-control" placeholder="Nhập google +" >
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Instagram</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="url" name="ig" value="{{ old('phone', $objItem->ig) }}" class="form-control" placeholder="Nhập Instagram" >
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nội dung</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea name="content" class="form-control col-md-13" required="">{{ old('content', $objItem->content) }}</textarea>
                </div>
              </div>
               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Avatar</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                 <input type="file" name="avatar" class="form-control" >
                 @if(!empty($objItem->avatar) && !is_null($objItem->avatar))
                 <img width="150px" src="{{asset('/storage/app/media/files/myinfo')}}/{{$objItem->avatar}}" alt=""/>
                 @endif
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Picture</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                 <input type="file" name="picture" class="form-control" >
                  @if(!empty($objItem->picture) && !is_null($objItem->picture))
                 <img width="150px" src="{{asset('/storage/app/media/files/myinfo')}}/{{$objItem->picture}}" alt=""/>
                 @endif
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