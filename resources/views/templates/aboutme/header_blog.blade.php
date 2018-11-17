<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="NinhNghiaIt">
        <meta name="author" content="NinhNghiaIt">
        <meta name="keyword" content="html5, css3, php, laravel">
        <!-- Shareable -->
        <meta property="og:title" content="NinhNghiaIt" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="{{route('aboutme.abmnews.index')}}" />
        <meta property="og:image" content="/templates/blog/images/logo.png" />
        <title>NinhNghiaIt &mdash; Blog</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="/templates/blog/scripts/bootstrap/bootstrap.min.css">
        <!-- IonIcons -->
        <link rel="stylesheet" href="/templates/blog/scripts/ionicons/css/ionicons.min.css">
        <!-- Toast -->
        <link rel="stylesheet" href="/templates/blog/scripts/toast/jquery.toast.min.css">
        <!-- OwlCarousel -->
        <link rel="stylesheet" href="/templates/blog/scripts/owlcarousel/dist/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="/templates/blog/scripts/owlcarousel/dist/assets/owl.theme.default.min.css">
        <!-- Magnific Popup -->
        <link rel="stylesheet" href="/templates/blog/scripts/magnific-popup/dist/magnific-popup.css">
        <link rel="stylesheet" href="/templates/blog/scripts/sweetalert/dist/sweetalert.css">
        <!-- Custom style -->
        <link rel="stylesheet" href="/templates/blog/css/style.css">
        <link rel="stylesheet" href="/templates/blog/css/skins/all.css">
        <link rel="stylesheet" href="/templates/blog/css/demo.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        @yield('css')
    </head>

    <body class="skin-orange">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=xxx";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <header class="primary">
            <div class="firstbar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="brand">
                                <a href="{{route('aboutme.abmnews.index')}}">
                                    <img src="/templates/blog/images/logo.png" alt="NinhNghiaIt">
                                </a>
                            </div>                      
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <form class="search" autocomplete="off" action="{{route('aboutme.abmnews.search')}}" method="GET">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="q" class="form-control" placeholder="Type something here" value="{{isset($text) ? $text : ''}}">                                 
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="ion-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>                             
                        </div>
                    </div>
                </div>
            </div>

            <!-- Start nav -->
            <nav class="menu">
                <div class="container">
                    <div class="brand">
                        <a href="{{route('aboutme.abmnews.index')}}">
                            <img src="/templates/blog/images/logo.png" alt="NinhNghiaIt">
                        </a>
                    </div>
                    <div class="mobile-toggle">
                        <a href="#" data-toggle="menu" data-target="#menu-list"><i class="ion-navicon-round"></i></a>
                    </div>
                    <div class="mobile-toggle">
                        <a href="#" data-toggle="sidebar" data-target="#sidebar"><i class="ion-ios-arrow-left"></i></a>
                    </div>
                    <div id="menu-list">
                        <ul class="nav-list">
                            <li class="for-tablet nav-title"><a>Menu</a></li>
                            @foreach ($objItemsCat as $vc)
                            <li class="dropdown magz-dropdown magz-dropdown-megamenu"><a href="{{route('aboutme.abmnews.cat',[ 'slug' => str_slug($vc['name']) , 'id' => $vc['id_cat'] ])}}">{{$vc['name']}}</a>
                                @if (!empty($vc['child']))
                                <div class="dropdown-menu megamenu">
                                    <div class="megamenu-inner">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h2 class="megamenu-title">{{$vc['name']}}</h2>
                                                    </div>
                                                </div>
                                                <ul class="vertical-menu">
                                                    @foreach ($vc['child'] as $vcc)
                                                    <li><a href="{{route('aboutme.abmnews.cat',[ 'slug' => str_slug($vcc['name']) , 'id' => $vcc['id_cat'] ])}}"><i class="ion-ios-circle-outline"></i> {{$vcc['name']}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h2 class="megamenu-title">Hot</h2>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    @foreach($vc['news_through'] as $vcn)
                                                    <article class="article col-md-4 mini">
                                                        <div class="inner">
                                                            <figure>
                                                                <a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($vcn['name']) , 'id' => $vcn['id_news'] ])}}">
                                                                    <img src="{{asset('storage/app/media/files/news/'.$vcn['picture'])}}" alt="{{$vcn['name']}}">
                                                                </a>
                                                            </figure>
                                                            <div class="padding">
                                                                <div class="detail">
                                                                    <div class="time">{{date('d/m/Y',strtotime($vcn['created_at']))}}</div>
                                                                    <div class="category"><a href="#">{{$vc['name']}}</a></div>
                                                                </div>
                                                                <h2><a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($vcn['name']) , 'id' => $vcn['id_news'] ])}}">{{$vcn['name']}}</a></h2>
                                                            </div>
                                                        </div>
                                                    </article>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>                              
                                    </div>
                                </div>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End nav -->
        </header>