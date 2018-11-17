@extends('templates.aboutme.master')

@section('css')
<style>
  /*.main-footer {
    width: 80% !important;
  }
  .over-fly-area {width: 80%;left: 20%;}*/
</style>
@endsection
@section('content')
    <!-- Page Loader -->
    {{-- <div class="page-loader">
      <div class="v-align-center">
        <div class="middle-content">
          <div class="img-p-area"> <img src="assets/theme/img/profile-thumb.jpg" alt="" class="img-thumbnail no-radius"></div>
          <span class="itsme" >it's me</span>
          <h4>Fr. Jhone Doe</h4>
          <p>please wait</p>
          <div class="anim-pg">
            <span ></span>
          </div>
          <div class="force-pg"><button type="button" id='force-close-pg' class="btn">Skip This &rarr;</button></div>
        </div>
      </div>
    </div> --}}<!-- End Page Loader -->
    <!-- body-area -->
    <div class="body-area">
      <!-- Header -->
      <header class="main-header">
        <div class="nav-main">
          <a href="#search-ovefly" class="toogle-overfly"><i class="fa fa-search open-t"></i> <i class="fa fa-times close-t"></i></a>
          <a href="#share-ovefly" class="toogle-overfly"><i class="fa fa-plus open-t"></i> <i class="fa fa-times close-t"></i></a>
        </div>

       
        <div class="over-fly-area" id="search-ovefly">
          <div class="inner-overfly">
            <div class="middle-overfly">
              <h2 class="title-over">Find My Articles</h2>
              <form class="from-search">
                <div class="form-group">
                  <input type="search" name="s" class="form-control input-lg input-search" placeholder="Input Text Here !" >
                </div>
                <div class="form-group">
                  <button  class="btn btnc2"><span>Search</span></button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="over-fly-area" id="share-ovefly">
          <div class="inner-overfly">
            <div class="middle-overfly">
              <h2 class="title-over">Share This Page</h2>
              <!-- You MUST change the URL definition in these links to share YOUR page - simply change the URL -->
              <div class="social-share">
              @php
              $doimain = Request::root();
              @endphp
                <a href="https://plus.google.com/share?url={{$doimain}}" target="_blank"  data-toggle="tooltip" data-placement="bottom" title="Google Plus"><i class="fa fa-google-plus"></i></a>
                <a href="http://pinterest.com/pin/create/button/?url={{$doimain}}" target="_blank"  data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                <a href="http://www.facebook.com/share.php?u={{$doimain}}" target="_blank"  data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                <a href="http://twitter.com/home?status={{$doimain}}" target="_blank"  data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
              </div>
            </div>
          </div>
        </div>

        <!-- hero  -->
        @include('templates.aboutme.hero1')
        <!-- hero -->
      </header>
      <!--end HEader -->
      <!-- Content body -->
      <div class="content-body">
        <div class="section-padd br-t " >
          @if(!is_null($firstItem))
          <div class="container-body clearfix">
            <!-- blog featured -->
            <div class="blog-post-item">
              <div class="post-header" style="text-align: left">
                <span class="cat"><a href="{{route('aboutme.abmnews.cat',['slug' => str_slug($firstItem['cname']) , 'id' => $firstItem['id_cat'] ])}}" style="letter-spacing: 1px;">{{$firstItem['cname']}}</a><span class="post-date" style="margin-left: 10px">{{date('H:i:s d/m/Y',strtotime($firstItem['created_at']))}}</span></span>
                <h2><a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($firstItem['name']) , 'id' => $firstItem['id_news'] ])}}">{{$firstItem['name']}}</a></h2>
              </div>
              <div class="post-img">
                <a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($firstItem['name']) , 'id' => $firstItem['id_news'] ])}}" class="open-link"><img src="{{asset('storage/app/media/files/news/'.$firstItem['picture'])}}" class="img-full" alt=""></a>
              </div>
              <div class="post-entry">
                <p>{{$firstItem['preview_text']}}</p>
                <p> <a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($firstItem['name']) , 'id' => $firstItem['id_news'] ])}}" class="open-link more-link">Chi tiết<span class="more-line"></span></a></p>
              </div>

              <div class="post-share clearfix">
                <div class="post-share-box share-author col-sm-4">
                  <span>By</span> <a href="#" title="Posts by solopine" rel="author">{{$firstItem['fullname']}}</a>   
                </div>

                <div class="post-share-box share-links col-sm-4">
                 <a target="_blank" href="http://www.facebook.com/share.php?u={{route('aboutme.abmnews.detail',['slug' => str_slug($firstItem['name']) , 'id' => $firstItem['id_news'] ])}}"><i class="fa fa-facebook"></i></a>
                  <a target="_blank" href="http://twitter.com/home?status={{route('aboutme.abmnews.detail',['slug' => str_slug($firstItem['name']) , 'id' => $firstItem['id_news'] ])}}"><i class="fa fa-twitter"></i></a>
                  <a data-pin-do="skipLink" target="_blank" href="http://pinterest.com/pin/create/button/?url={{route('aboutme.abmnews.detail',['slug' => str_slug($firstItem['name']) , 'id' => $firstItem['id_news'] ])}}"><i class="fa fa-pinterest"></i></a>
                  <a target="_blank" href="https://plus.google.com/share?url={{route('aboutme.abmnews.detail',['slug' => str_slug($firstItem['name']) , 'id' => $firstItem['id_news'] ])}}"><i class="fa fa-google-plus"></i></a>
                </div>
                <div class="post-share-box share-comments col-sm-4">
                  <a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($firstItem['name']) , 'id' => $firstItem['id_news'] ])}}"><span>{{$countCmt}}</span> Comments</a>   
                </div>
              </div>
            </div><!-- end blog featured -->

            <!-- Grid blog -->
            <div class="white-space-10"></div>
            <div id="more-post" class="row grid-inline">
               @foreach($arNews as $vn)
               <div class="col-sm-4 grid-inline-box">
                <div class="blog-post-item">
                  <div class="post-img">
                    <a href="{{route('aboutme.abmnews.detail',[ 'slug' => str_slug($vn['name']), 'id' => $vn['id_news'] ])}}" class="open-link"><img src="{{asset('storage/app/media/files/news/'.$vn['picture'])}}" class="img-full" alt=""></a>
                  </div>
                  <div class="post-header text-left" >
                    <h3 class="title-2"><span><a href="{{route('aboutme.abmnews.detail',[ 'slug' => str_slug($vn['name']), 'id' => $vn['id_news'] ])}}" class="open-link">{{$vn['name']}}</a></span></h3>
                  </div>
                  <div class="post-entry">
                    <p>{{$vn['preview_text']}}</p>
                  </div>
                  <span class="post-date">{{date('H:i:s d/m/Y',strtotime($vn['created_at']))}}</span>
                </div>
              </div>
              @endforeach

            </div><!-- end  Grid blog -->

            <hr/>

            <!-- pager-->
            <nav>
              <ul class="pager">
                <li class="next"><a href="#">Newer <span class="hidden-sm hidden-xs">Posts</span> <span aria-hidden="true">&rarr;</span></a></li>
              </ul>
            </nav><!-- end pager-->
          </div>
          @endif
        </div>

      </div><!-- end Content body -->
@endsection
@section('js')
<script>
  {{'var totalnews = '.$totalNews.';'}}
  {{'var cr = '.$cr.';'}}
  {{'var id = '.$firstItem['id_cat'].';'}}
  //
  $('.next a').click(function(e) {
    e.preventDefault();
    (cr + 1 < totalnews) && $.ajax({
        url: "{{ route('ajax.news.postcat') }}",
        type: 'GET',
        cache: false,
        data: {cr:cr,id:id},
        success: function(data){
          $('#more-post').append(data);
        },
        error: function (){
          alert('fail');
        }
      });
    return false;
  });
</script>
@endsection