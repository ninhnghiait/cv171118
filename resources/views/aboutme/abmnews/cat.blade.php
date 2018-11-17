@extends('templates.aboutme.master_blog')
@section('content')
    <section class="category">
      <div class="container">
        <div class="row">
          <div class="col-md-8 text-left">
            <div class="row">
              <div class="col-md-12">        
                <ol class="breadcrumb">
                  <li><a href="{{route('aboutme.abmnews.index')}}">Home</a></li>
                  <li class="active">{{$objCatCr->name}}</li>
                </ol>
              </div>
            </div>
            <div class="line"></div>
            @if($arNews->first())
            <div class="row">
              @foreach($arNews as $vnn)
              @php
              $id_news = $vnn->id_news;
              $nname = $vnn->name;
              $picture = $vnn->picture;
              $preview_text = str_limit($vnn->preview_text, $limit = 100, $end = '...');
              $created_at = date('d/m/Y', strtotime($vnn->created_at));
              @endphp
              <article class="col-md-12 article-list">
                <div class="inner">
                  <figure>
                    <a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($nname) , 'id' => $id_news ])}}">
                      <img src="{{asset('storage/app/media/files/news/'.$picture)}}">
                    </a>
                  </figure>
                  <div class="details">
                    <div class="detail">
                      <div class="time">{{$created_at}}</div>
                    </div>
                    <h1><a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($nname) , 'id' => $id_news ])}}">{{$nname}}</a></h1>
                    <p>
                      {{$preview_text}}
                    </p>
                    <footer>
                      <a class="btn btn-primary more" href="{{route('aboutme.abmnews.detail',['slug' => str_slug($nname) , 'id' => $id_news ])}}">
                        <div>More</div>
                        <div><i class="ion-ios-arrow-thin-right"></i></div>
                      </a>
                    </footer>
                  </div>
                </div>
              </article>
              @endforeach
              <div class="col-md-12 text-center">
              {{ $arNews->links() }}
              </div>
            </div>
            @else
            <div class="row">
              Không có bài viết nào!
            </div>
            @endif
          </div>
          @include('templates.aboutme.sidebar_blog')
        </div>
      </div>
    </section>

@endsection