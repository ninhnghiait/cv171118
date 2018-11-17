@extends('templates.aboutme.master_blog')
@section('content')
   <section class="home">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="headline">
              <div class="nav" id="headline-nav">
                <a class="left carousel-control" role="button" data-slide="prev">
                  <span class="ion-ios-arrow-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" role="button" data-slide="next">
                  <span class="ion-ios-arrow-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
              <div class="owl-carousel owl-theme" id="headline">              
                <div class="item">
                  <a href="#"><div class="badge">Author!</div> {{$firstItem['fullname']}}</a>
                </div>
                <div class="item">
                  <a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($firstItem['name']) , 'id' => $firstItem['id_news'] ])}}">{{$firstItem['name']}}</a>
                </div>
              </div>
            </div>
            <div class="owl-carousel owl-theme slide" id="featured">
              <div class="item">
                <article class="featured">
                  <div class="overlay"></div>
                  <figure>
                    <img src="{{asset('storage/app/media/files/news/'.$firstItem['picture'])}}" alt="{{$firstItem['name']}}">
                  </figure>
                  <div class="details">
                    <div class="category">
                      <a href="{{route('aboutme.abmnews.cat',['slug' => str_slug($firstItem['cname']) , 'id' => $firstItem['id_cat'] ])}}">{{$firstItem['cname']}}</a>
                    </div>
                    <h1>
                      <a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($firstItem['name']) , 'id' => $firstItem['id_news'] ])}}">{{$firstItem['name']}}</a>
                    </h1>
                    <div class="time">{{date('d/m/Y',strtotime($firstItem['created_at']))}}</div>
                  </div>
                </article>
              </div>
            </div>
            <div class="line">
              <div>Lastest</div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="row">
                  @foreach($arNews as $vn)
                  <article class="article col-md-12">
                    <div class="inner">
                      <figure>
                        <a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($vn['name']) , 'id' => $vn['id_news'] ])}}">
                          <img src="{{asset('storage/app/media/files/news/'.$vn['picture'])}}" alt="{{$vn['name']}}">
                        </a>
                      </figure>
                      <div class="padding">
                        <div class="detail">
                          <div class="time">{{date('d/m/Y',strtotime($vn['created_at']))}}</div>
                          <div class="category"><a href="{{route('aboutme.abmnews.cat',['slug' => str_slug($vn['cname']) , 'id' => $vn['id_cat'] ])}}">{{$vn['cname']}}</a></div>
                        </div>
                        <h2><a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($vn['name']) , 'id' => $vn['id_news'] ])}}">{{$vn['name']}}</a>
                        </h2>
                        <p>{{$vn['preview_text']}}</p>
                        <footer>
                          <a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>1263</div></a>
                          <a class="btn btn-primary more" href="{{route('aboutme.abmnews.detail',['slug' => str_slug($vn['name']) , 'id' => $vn['id_news'] ])}}">
                            <div>More</div>
                            <div><i class="ion-ios-arrow-thin-right"></i></div>
                          </a>
                        </footer>
                      </div>
                    </div>
                  </article>
                  @endforeach
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="row">
                  @foreach($arNewssc as $vn)
                  <article class="article col-md-12">
                    <div class="inner">
                      <figure>
                        <a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($vn['name']) , 'id' => $vn['id_news'] ])}}">
                          <img src="{{asset('storage/app/media/files/news/'.$vn['picture'])}}" alt="{{$vn['name']}}">
                        </a>
                      </figure>
                      <div class="padding">
                        <div class="detail">
                          <div class="time">{{date('d/m/Y',strtotime($vn['created_at']))}}</div>
                          <div class="category"><a href="{{route('aboutme.abmnews.cat',['slug' => str_slug($vn['cname']) , 'id' => $vn['id_cat'] ])}}">{{$vn['cname']}}</a></div>
                        </div>
                        <h2><a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($vn['name']) , 'id' => $vn['id_news'] ])}}">{{$vn['name']}}</a>
                        </h2>
                        <p>{{$vn['preview_text']}}</p>
                        <footer>
                          <a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>1263</div></a>
                          <a class="btn btn-primary more" href="{{route('aboutme.abmnews.detail',['slug' => str_slug($vn['name']) , 'id' => $vn['id_news'] ])}}">
                            <div>More</div>
                            <div><i class="ion-ios-arrow-thin-right"></i></div>
                          </a>
                        </footer>
                      </div>
                    </div>
                  </article>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="banner">
              <a href="#">
                <img src="/templates/blog/images/ads.png" alt="Sample Article">
              </a>
            </div>
            <div class="line transparent little"></div>
          </div>
          @include('templates.aboutme.sidebar_blog')
        </div>
      </div>
    </section>

    <section class="best-of-the-week">
      <div class="container">
        <h1><div class="text">More</div>
          <div class="carousel-nav" id="best-of-the-week-nav">
            <div class="prev">
              <i class="ion-ios-arrow-left"></i>
            </div>
            <div class="next">
              <i class="ion-ios-arrow-right"></i>
            </div>
          </div>
        </h1>
        <div class="owl-carousel owl-theme carousel-1">
          @foreach($arNewsAll as $news)
          <article class="article">
            <div class="inner">
              <figure>
                <a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($news['name']) , 'id' => $news['id_news'] ])}}">
                  <img src="{{asset('storage/app/media/files/news/'.$news['picture'])}}" alt="{{$news['name']}}">
                </a>
              </figure>
              <div class="padding">
                <div class="detail">
                    <div class="time">{{ date('d/m/Y', strtotime($news['created_at']))}}</div>
                    <div class="category"><a href="{{route('aboutme.abmnews.cat',['slug' => str_slug($news['cname']) , 'id' => $news['id_cat'] ])}}">{{$news['cname']}}</a></div>
                </div>
                <h2><a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($news['name']) , 'id' => $news['id_news'] ])}}">{{$news['name']}}</a></h2>
                <p>{{str_limit($news['preview_text'], $limit = 150, $end = '...')}}</p>
              </div>
            </div>
          </article>
          @endforeach
        </div>
      </div>
    </section>

@endsection