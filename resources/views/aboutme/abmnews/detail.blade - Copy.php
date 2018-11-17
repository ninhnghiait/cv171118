@extends('templates.aboutme.master')

@section('css')
<style>
 /* .main-footer {
    width: 80% !important;
  }
  .over-fly-area {width: 80%;left: 20%;}*/
  .post-comment div h3 a{
      font-weight: bold;
  }
  .post-comment .namert {
     font-weight: normal;
  }
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
          {{-- <span class="itsme">it's me </span> --}}
          <a href="#menu-ovefly" class="toogle-overfly"><i class="fa fa-bars open-t"></i> <i class="fa fa-times close-t"></i></a>
          <a href="#search-ovefly" class="toogle-overfly"><i class="fa fa-search open-t"></i> <i class="fa fa-times close-t"></i></a>
          <a href="#share-ovefly" class="toogle-overfly"><i class="fa fa-plus open-t"></i> <i class="fa fa-times close-t"></i></a>
        </div>

        <div class="over-fly-area" id="menu-ovefly">
          <div class="inner-overfly">
            <div class="middle-overfly">
              <h2 class="title-over">Menu</h2>
              <nav class="main-nav" id="menu">
                <ul class="nav">
                  <li ><a href="index.html#aboutme" class="open-link" data-text="About Me"><span>About Me</span></a></li>
                  <li><a href="index.html#resume" class="open-link" data-text="My Resume"><span>Resume</span></a></li>
                  <li><a href="index.html#portfolio" class="open-link" data-text="My Portfolio"><span>Portfolio</span></a></li>
                  <li class="active"><a href="#" ><span>Blog</span></a>
                    <ul>
                      <li><a href="blog-list-posts.html"  class="open-link" >List Posts</a></li>
                      <li><a href="blog-single-post.html"  class="open-link">Single Post</a></li>
                      <li><a href="#modal-example" data-toggle="modal" >Extra Pages</a></li>
                    </ul>
                  </li>
                  <li><a href="index.html#contact" class="open-link"  data-text="Contact Me"><span>Contact</span></a></li>
                </ul>
              </nav>
            </div>
          </div>
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
                <a href="https://plus.google.com/share?url=http://www.yourwebsite.com" target="_blank"  data-toggle="tooltip" data-placement="bottom" title="Google Plus"><i class="fa fa-google-plus"></i></a>
                <a href="http://pinterest.com/pin/create/button/?url=http://www.yourwebsite.com" target="_blank"  data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                <a href="http://www.facebook.com/share.php?u=http://www.yourwebsite.com" target="_blank"  data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                <a href="http://twitter.com/home?status=http://www.yourwebsite.com" target="_blank"  data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
              </div>
            </div>
          </div>
        </div>

        <!-- hero  -->
        @include('templates.aboutme.hero1')
        <!-- hero -->
      </header>
      <!-- end HEader -->
      <!-- Content body -->
      <div class="content-body">
        <div class="section-padd br-t " >
          <div class="container-body clearfix">
            <!-- blog post -->
              <div class="post-header" style="text-align: left">
                <span class="cat"><a href="{{route('aboutme.abmnews.cat',['slug' => str_slug($objItem->cname) , 'id' => $objItem->id_cat])}}" >{{$objItem->cname}}</a><span class="post-date" style="margin-left: 10px">{{date('H:i:s d/m/Y', strtotime($objItem->created_at))}}</span></span>
                <h2><a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($objItem->name) , 'id' => $objItem->id_news])}}">{{$objItem->name}}</a></h2>
              </div>
            <div class="blog-post-item">
              <div class="post-img">
                <a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($objItem->name) , 'id' => $objItem->id_news])}}" class="open-link"><img src="{{asset('storage/app/media/files/news/'.$objItem->picture)}}" class="img-full" alt=""></a>
              </div>
              <div class="post-entry">
                <div class="post-entry">
                  <blockquote><p>{{$objItem->preview_text}}</p></blockquote>
                  {!!$objItem->detail_text!!}
                  @if ($objItem->keyword)
                  <div class="post-tags">
                    @php
                      $arKeyword = explode(',', $objItem->keyword);
                    @endphp
                    @foreach($arKeyword as $vk)
                    <a href="#" rel="tag">{{$vk}}</a>
                    @endforeach
                  </div>
                  @endif
                </div>
              </div>
              <div class="post-share clearfix">
                <div class="post-share-box share-author col-sm-4">
                  <span>By</span> <a href="#" title="Posts by solopine" rel="author">{{$objItem->fullname}}</a>   
                </div>

                <div class="post-share-box share-links col-sm-4">
                  <a target="_blank" href="http://www.facebook.com/share.php?u={{route('aboutme.abmnews.detail',['slug' => str_slug($objItem->name) , 'id' => $objItem->id_news ])}}"><i class="fa fa-facebook"></i></a>
                  <a target="_blank" href="http://twitter.com/home?status={{route('aboutme.abmnews.detail',['slug' => str_slug($objItem->name) , 'id' => $objItem->id_news ])}}"><i class="fa fa-twitter"></i></a>
                  <a data-pin-do="skipLink" target="_blank" href="http://pinterest.com/pin/create/button/?url={{route('aboutme.abmnews.detail',['slug' => str_slug($objItem->name) , 'id' => $objItem->id_news ])}}"><i class="fa fa-pinterest"></i></a>
                  <a target="_blank" href="https://plus.google.com/share?url={{route('aboutme.abmnews.detail',['slug' => str_slug($objItem->name) , 'id' => $objItem->id_news ])}}"><i class="fa fa-google-plus"></i></a>

                </div>
                <div class="post-share-box share-comments col-sm-4">
                  <a href="#"><span>{{$totalCmt}}</span> Comments</a>   
                </div>
              </div>
            </div> <!--end blog post -->

            <div class="white-space-10"></div>
            <!-- blog author -->
            <div class="blog-author">
              @php
                $urlAvatar = asset('storage/app/media/files/myinfo/'.$objItemIntro->avatar);
              @endphp
              <img src="{{$urlAvatar}}" class="img-thumbnail img-circle" alt=""> 
              <div class="desc">
                <h3><a href="#">{{$userInfo['fullname']}}</a></h3>
                <p>Never Give Up</p>
               {{--  <p class="author-socials">
                  <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                  <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                  <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                  <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                </p> --}}
              </div>
            </div><!-- end blog author -->
            @if ($ar3Items)
            <div class="white-space-30"></div>
            <h3 class="title"><span>Liên quan</span></h3>
            <div class="white-space-10"></div>

            <div class="row grid-inline">
              
                @foreach ($ar3Items as $v3)
                <div class="col-sm-4 grid-inline-box">
                  <div class="blog-post-item">
                    <div class="post-img">
                      <a href="{{route('aboutme.abmnews.detail',[ 'slug' => str_slug($v3['name']), 'id' => $v3['id_news'] ])}}" class="open-link"><img src="{{asset('storage/app/media/files/news/'.$v3['picture'])}}" class="img-full" alt=""></a>
                    </div>
                    <div class="post-header text-left" >
                      <h3 class="title-2"><span><a href="{{route('aboutme.abmnews.detail',[ 'slug' => str_slug($v3['name']), 'id' => $v3['id_news'] ])}}" class="open-link">{{$v3['name']}}</a></span></h3>
                    </div>
                    <div class="post-entry">
                      <p>{{$v3['preview_text']}}</p>
                    </div>
                    <span class="post-date">{{date('H:i:s d/m/Y', strtotime($v3['created_at']))}}</span>
                  </div>
                </div>
                @endforeach
              
            </div>
            @endif
            <!-- end  Grid blog -->

            <div class="white-space-10"></div>
            <h3 class="title"><span>Bình luận ({{$totalCmt}})</span></h3>
            <div class="white-space-10"></div>

            <!-- blog comments -->
            <ul id="commentsn" class="comments">

              @foreach ($arCmt as $vc)
                @php
                $id_cmt = $vc['id_cmt'];
                $userCmt = $vc['id'] ? $vc['fullname'] : $vc['name'];
                $avatar = $vc['avatar'] ? $vc['avatar'] : 'ico.png';
                @endphp
              <li>
                <div id="{{$id_cmt}}-comment" class="post-comment">
                  <img src="{{asset('storage/app/media/files/users/'.$avatar)}}" class="img-thumbnail img-circle img-profile" alt="">
                  <div class="desc" id="{{$id_cmt}}-form">
                    <h3><a href="#">{{$userCmt}}</a></h3>
                    <p class="date">{{date('H:i:s d/m/Y', strtotime($vc['created_at']))}}</p>
                    <p>{{$vc['content']}}</p>
                    <p class="reply-btn"><a href="#" onclick="return formCmt({{ $objItem->id_news}},{{$id_cmt}},'{{$userCmt}}');" class="btn btn-xs btn-default">Reply</a></p>
                  </div>
                </div>
                @if ($vc['child'])
                  <ul class="comments">
                    @foreach ($vc['child'] as $vcc)
                      @php
                      $userCmt2 = $vcc['id'] ? $vcc['fullname'] : $vcc['name'];
                      $avatar2  = $vcc['avatar'] ? $vcc['avatar'] : 'ico.png';
                      @endphp
                      <li>
                        <div class="post-comment">
                          <img src="{{asset('storage/app/media/files/users/'.$avatar2)}}" class="img-thumbnail img-circle img-profile" alt="">
                          <div class="desc">
                            <h3><a href="#">{{$userCmt2}}&nbsp;&nbsp;@ <span class="namert">{{$vcc['namert']}}</span></a></h3>
                            <p class="date">{{date('H:i:s d/m/Y', strtotime($vcc['created_at']))}}</p>
                            <p>{{$vcc['content']}}</p>
                            <p class="reply-btn"><a href="#" onclick="return formCmt({{ $objItem->id_news}},{{$id_cmt}},'{{$userCmt2}}');" class="btn btn-xs btn-default">Reply</a></p>
                          </div>
                        </div>
                      </li>
                    @endforeach
                  </ul>
                @endif
              </li>
              @endforeach
            </ul><!-- end  blog comments -->
            <div class="noti-cmtNlog"></div>

            <div class="white-space-10"></div>
            <h3 class="title"><span>Bình luận</span></h3>
            <div class="white-space-10"></div>

            <!-- form comment -->
            @if(Auth::check())
            <form onsubmit="return cmtLog('{{ $objItem->id_news}}')">
              <div class="form-group">
                <label>Nội dung (*)</label>
                <textarea id="contentLog" class="form-control form-flat" name="message" rows="4" ></textarea>
              </div>
              <div class="form-group">
                <button  class="btn btnc2 with-br"><span>Gửi bình luận</span></button>
              </div>
            </form>
            @else
            <form onsubmit="return cmtNlog('{{ $objItem->id_news}}')" id="form-cmt-nlog">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Tên (*)</label>
                    <input type="text" id="nameNlog" class="form-control form-flat" name="name" >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Email (*)</label>
                    <input type="email" id="emailNlog" class="form-control form-flat" name="email" >
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Nội dung (*)</label>
                <textarea class="form-control form-flat" id="contentNlog" name="content" rows="4" ></textarea>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btnc2 with-br"><span>Gửi bình luận</span></button>
              </div>
            </form>
            @endif
            <!-- end  form comment -->
          </div>
        </div>
      </div><!-- end Content body -->

@endsection
@section('js')
<script>
var ckeckuser = 0;
</script>
@if(Auth::check())
<script>
   ckeckuser = 1;
</script>
@endif
<script>
  function cmtLog(id){
    var contentLog = $('#contentLog').val();
    $.ajax({
      url: "{{ route('aboutme.abmnews.cmtlog') }}",
      type: 'GET',
      cache: false,
      data: {aid:id,acontentLog:contentLog},
     
      success: function(data){
          if (data.errors) {
            swal('',data.errors.join('\n\n'),'warning');
          } else {
            $('#commentsn').append(data);
            $('#contentLog').val('');
          }
      },
      error: function (){
        swal('','Vui lòng nhập nội dung!','warning');
      }
    });
    return false;
  };
  //
  function cmtNlog(id){
    var nameNlog = $('#nameNlog').val();
    var emailNlog = $('#emailNlog').val();
    var contentNlog = $('#contentNlog').val();
    $.ajax({
      url: "{{ route('aboutme.abmnews.cmtnlog') }}",
      type: 'GET',
      cache: false,
      data: {aid:id,anameNlog:nameNlog,aemailNlog:emailNlog,acontentNlog:contentNlog},
      success: function(data){
          if (data.errors) {
            swal('',data.errors.join('\n'),'warning');
          } else {
            swal('',data,'success');
            $('#form-cmt-nlog input').val('');
          }
      }
    });
    return false;
  };
  // 
    function formCmt(id,idcmt,namert){
     var html = '';
     $('.form-cmt').remove();
       if (ckeckuser) {
         html += '<form class="form-cmt" onsubmit="return cmtLog2('+id+','+idcmt+',\''+namert+'\')"> <div class="form-group"> <textarea id="contentLog2" class="form-control form-flat" name="message" rows="2" placeholder="Nội dung (*)" ></textarea> </div> <div class="form-group"> <button  class="btn btnc2 with-br"><span>Gửi bình luận</span></button> </div> </form>';
       } else {
         html += '<form class="form-cmt" onsubmit="return cmtNLog2('+id+','+idcmt+',\''+namert+'\')"><div class="row"> <div class="col-sm-6"> <div class="form-group"> <input type="text" id="namenloglv" class="form-control form-flat" placeholder="Tên" value="" > </div> </div> <div class="col-sm-6"> <div class="form-group"> <input type="email" id="emailnLoglv" class="form-control form-flat" name="email" placeholder="Email"  value="" > </div> </div> </div><div class="form-group"> <textarea id="contentNLog2" class="form-control form-flat" name="message" rows="2" placeholder="Nội dung (*)" ></textarea> </div> <div class="form-group"> <button  class="btn btnc2 with-br"><span>Gửi bình luận</span></button> </div> </form>';
       }
          $('#'+idcmt+'-form').append(html);
    }
    //cmt lv2
    function cmtNLog2(id,idcmt,namert){
      var namenloglv = $('#namenloglv').val();
      var emailnLoglv = $('#emailnLoglv').val();
      var contentnlog2 = $('#contentNLog2').val();
      $.ajax({
        url: "{{ route('aboutme.abmnews.cmtnlognnnn') }}",
        type: 'GET',
        cache: false,
        data: {aid:id,acontentnlog2:contentnlog2,emailnLoglv:emailnLoglv,namenloglv:namenloglv,aidcmtrtlog2:idcmt,anamertlog2:namert},
        success: function(data){
          if (data.errors) {
            swal('',data.errors.join('\n'),'warning');
          } else {
            $('.form-cmt textarea').val('');
            $('.form-cmt input').val('');
            swal('',data,'success');
          }
        }
      });
      return false;
    };
    //cmt lv2
    function cmtLog2(id,idcmt,namert){
      var contentlog2 = $('#contentLog2').val();
      $.ajax({
        url: "{{ route('aboutme.abmnews.cmtlog2') }}",
        type: 'GET',
        cache: false,
        data: {aid:id,acontentlog2:contentlog2,aidcmtrtlog2:idcmt,anamertlog2:namert},
        success: function(data){
          if (data.errors) {
            swal('',data.errors.join('\n'),'warning');
          } else {
            $('#'+idcmt+'-comment').after(data);
            $('.form-cmt textarea').val('');
          }
        }
      });
      return false;
    };
    
</script>
@endsection