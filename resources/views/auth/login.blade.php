@extends('templates.auth.master')
@section('content')

<a class="hiddenanchor" id="signup"></a>
<a class="hiddenanchor" id="signin"></a>

<div class="login_wrapper">
  <div class="animate form login_form">
    <section class="login_content">
      <form action="{{ route('login') }}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
        {{ csrf_field() }}
        <h1>Đăng nhập</h1>
        <div>
          <input type="text" id="email" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus />
              @if ($errors->has('username'))
				  
              <span class="invalid-feedback">
                <strong>{{ $errors->first('username') }}</strong>
              </span>
              @endif
        </div>
        <div>
          <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required />
            @if ($errors->has('password'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
        <div>
          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
          <a class="reset_pass" href="{{ route('password.request') }}">Forgot your password?</a>
        </div>

        <div>
          @if (Session::has('msg'))
          {{ Session::get('msg') }}
          @endif
          <br>
          <br>
          <button class="btn btn-default submit" type="submit">Đăng nhập</button>
          <a class="reset_pass" href="{{ route('register') }}">Đăng kí</a>
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