@extends('templates.auth.master')
@section('content')

<a class="hiddenanchor" id="signup"></a>
<a class="hiddenanchor" id="signin"></a>

<div class="login_wrapper">
  <div class="animate form login_form">
    <section class="login_content">
      <form action="{{ route('register') }}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
        {{ csrf_field() }}
        <h1>Đăng kí</h1>
        <div>
          <input type="text" id="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus />
            @if ($errors->has('username'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('username') }}</strong>
            </span>
            <br>
            @endif
        </div>
        <div>
          <input type="email" name="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="Email" required />
            @if ($errors->has('email'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            <br>
            @endif
        </div>
        <div>
          <input type="text" name="fullname" id="fullname" class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" value="{{ old('fullname') }}" placeholder="Fullname" required />
            @if ($errors->has('fullname'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('fullname') }}</strong>
            </span>
            <br>
            @endif
        </div>
        <div>
          <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required />
            @if ($errors->has('password'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            <br>
            @endif
        </div>
        <div>
          <input type="password" id="password-confirm" name="password_confirmation" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Nhập lại password" required />
            @if ($errors->has('password'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            <br>
            @endif
        </div>
        <div>
          @if (Session::has('msg'))
          {{ Session::get('msg') }}
          @endif
          <br>
          <br>
          <button type="submit" class="btn btn-default submit">Đăng kí</button> <br>
          Mã kích hoạt tài khoản sẽ được gửi sau khi hoàn tất đăng kí. Vui lòng kiểm tra email của bạn
        </div>

        <div class="clearfix"></div>

        <div class="separator">
          <div>
            <h1><i class="fa fa-newspaper-o"></i> VinaEnter</h1>
            <p>©2013-2018 All Rights Reserved. VinaEnter Team</p>
          </div>
        </div>
      </form>
    </section>
  </div>
</div>
@endsection