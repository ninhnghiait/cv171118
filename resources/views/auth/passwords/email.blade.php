@extends('templates.auth.master')
@section('content')

<a class="hiddenanchor" id="signup"></a>
<a class="hiddenanchor" id="signin"></a>

<div class="login_wrapper">
  <div class="animate form login_form">
    <section class="login_content">
      <form action="{{ route('password.email') }}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
        {{ csrf_field() }}
        <h1>Forgot Password</h1>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <div>
          <input type="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="email" value="{{ old('email') }}" required autofocus />
              @if ($errors->has('email'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
        </div>
        <div>
          <br>
          <button class="btn btn-default submit" type="submit">Gửi mail reset password </button>
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