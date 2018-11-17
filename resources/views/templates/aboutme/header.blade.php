<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>It's Me - Ninh Văn Nghĩa</title>
    <!-- Bootstrap -->
    <link href="{{$publicUrl}}/assets/external/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--favicon-->
    <link rel="apple-touch-icon" href="{{asset('storage/app/media/files/myinfo/'.$objItemIntro->avatar)}}">
    <link rel="shortcut icon" href="{{asset('storage/app/media/files/myinfo/'.$objItemIntro->avatar)}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Sarala:400,700%7COpen+Sans:400,300' rel='stylesheet' type='text/css'>

    <!-- Theme Style -->
    <link href="{{$publicUrl}}/assets/theme/css/style.css" rel="stylesheet" type="text/css">
    <link href="{{$publicUrl}}/assets/theme/css/fb.css" rel="stylesheet" type="text/css">
    <!-- Your custom css -->
    <link href="{{$publicUrl}}/assets/theme/css/theme-custom.css" rel="stylesheet">
    <link href="{{$publicUrl}}/assets/theme/css/theme-custom.css" rel="stylesheet">

    <!-- Font Icons -->
    <link href="{{$publicUrl}}/assets/external/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Captcha -->
    <link href="{{$publicUrl}}/assets/external/simpleCaptcha/jquery.simpleCaptcha.css" rel="stylesheet">
    <!-- lightbox -->
    <link href="{{$publicUrl}}/assets/external/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    {{-- <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'> --}}
    <link href="{{$publicUrl}}/assets/theme/css/sweetalert.css" rel="stylesheet">
    @yield('css')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- add-->
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">

  </head>
  <body >
    <div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=xxx";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</body>