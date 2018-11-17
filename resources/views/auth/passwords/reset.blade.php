@extends('templates.auth.master')
@section('content')

<a class="hiddenanchor" id="signup"></a>
<a class="hiddenanchor" id="signin"></a>

<div class="login_wrapper">
  <div class="animate form login_form">
    <section class="login_content">
      <form action="{{ route('password.request') }}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
        {{ csrf_field() }}
        <h1>Reset Password</h1>
        <input type="hidden" name="token" value="{{ $token }}">
        <div>
          <input type="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="email" value="{{ old('email') }}" required />
              @if ($errors->has('email'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
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
          <input type="password" id="password-confirm" name="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="Nhập lại Password" required />
            @if ($errors->has('password_confirmation'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>
        <div>
          @if (Session::has('msg'))
          {{ Session::get('msg') }}
          @endif
          <br>
          <br>
          <button class="btn btn-default submit" type="submit">Reset password</button>
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