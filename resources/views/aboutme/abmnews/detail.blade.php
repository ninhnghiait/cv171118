@extends('templates.aboutme.master_blog')
@section('css')
<style>
 .description {margin-top: 5px !important; }
 section.single footer {margin-top: 5px !important; font-style: italic;}
 .comments .comment-list .item {padding: 0 20px !important;margin-bottom: 3px !important;}
 .comments form {margin-top: 5px !important;}
 .namert {color: #aaa}
 </style>
@endsection
@section('content')
<section class="single">
  <div class="container">
    <div class="row">
      @include('templates.aboutme.sidebar_blog')
      @php
      $id_news = $objItem->id_news;
      $nname = $objItem->name;
      $preview_text = $objItem->preview_text;
      $detail_text = $objItem->detail_text;
      $created_at = date('d/m/Y', strtotime($objItem->created_at));
      $picture = $objItem->picture;
      $count_number = $objItem->count_number;
      $routeUrl = route('aboutme.abmnews.detail',[str_slug($nname), $id_news]);
      $id_cat = $objItem->id_cat;
      $cname = $objItem->cname;
      $fullname = $objItem->fullname;
      $avatar = $objItem->avatar;
      $tags = $objItem->tags;
      @endphp
      <div class="col-md-8">
            <ol class="breadcrumb">
              <li><a href="{{route('aboutme.abmnews.index')}}">Home</a></li>
              <li class="active">{{$nname}}</li>
            </ol>
            <article class="article main-article">
              <header>
                <h1>{{$nname}}</h1>
                <ul class="details">
                  <li>{{$created_at}}</li>
                  <li><a>{{$cname}}</a></li>
                  <li>By <a href="#">{{$fullname}}</a></li>
                </ul>
              </header>
              <div class="main">
                <blockquote>{{$preview_text}}</blockquote>
                {!!$detail_text!!}
              </div>
              <footer>
                <div class="col">
                  <ul class="tags">
                    @foreach($tags as $tag)
                    <li><a href="{{route('aboutme.abmnews.tag', str_slug($tag->name))}}">{{$tag->name}}</a></li>
                    @endforeach
                  </ul>
                </div>
              </footer>
            </article>
            <div class="sharing">
            <div class="title"><i class="ion-android-share-alt"></i> Sharing is caring</div>
              <ul class="social">
                <li>
                  <a href="http://www.facebook.com/share.php?u={{$routeUrl}}" class="facebook"  target="_blank"  data-toggle="tooltip" data-placement="bottom" title="Facebook">
                    <i class="ion-social-facebook"></i> Facebook
                  </a>
                </li>
                <li>
                  <a href="http://twitter.com/home?status={{$routeUrl}}" class="twitter"  target="_blank"  data-toggle="tooltip" data-placement="bottom" title="Twitter">
                    <i class="ion-social-twitter"></i> Twitter
                  </a>
                </li>
                <li>
                  <a href="https://plus.google.com/share?url={{$routeUrl}}" class="googleplus" target="_blank"  data-toggle="tooltip" data-placement="bottom" title="Google Plus">
                    <i class="ion-social-googleplus"></i> Google+
                  </a>
                </li>
              </ul>
            </div>
            <div class="line">
              <div>Author</div>
            </div>
            <div class="author">
              <figure>
                @php
                $avatarUrl = $avatar ? '/storage/app/media/files/users/'.$avatar : '/templates/blog/images/users.png';
                @endphp
                <img src="{{$avatarUrl}}">
              </figure>
              <div class="details">
                <div class="job">Web Developer</div>
                <h3 class="name" style="font-size: 24px">{{$fullname}}</h3>
                <p>Dù người ta có nói với bạn điều gì đi nữa, hãy tin rằng cuộc sống là điều kỳ diệu và đẹp đẽ.</p>
                <ul class="social trp sm">
                  <li>
                    <a href="{{$objItemIntro->fb}}" class="facebook">
                      <svg><rect/></svg>
                      <i class="ion-social-facebook"></i>
                    </a>
                  </li>
                  <li>
                    <a href="{{$objItemIntro->tt}}" class="twitter">
                      <svg><rect/></svg>
                      <i class="ion-social-twitter"></i>
                    </a>
                  </li>
                  <li>
                    <a href="{{$objItemIntro->gg}}" class="youtube">
                      <svg><rect/></svg>
                      <i class="ion-social-youtube"></i>
                    </a>
                  </li>
                  <li>
                    <a href="{{$objItemIntro->gg}}" class="googleplus">
                      <svg><rect/></svg>
                      <i class="ion-social-googleplus"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="line"><div>You May Also Like</div></div>
            <div class="row">
              @foreach($ar3Items as $vai)
              @php
              $id_news = $vai['id_news'];
              $nname = $vai['name'];
              $preview_text = $vai['preview_text'];
              $created_at = date('d/m/Y', strtotime($vai['created_at']));
              $picture = $vai['picture'];
              $routeUrl = route('aboutme.abmnews.detail',[str_slug($nname), $id_news]);
              $id_cat = $objItem->id_cat;
              $cname = $objItem->cname;
              $routeCatUrl = route('aboutme.abmnews.cat',[str_slug($cname), $id_cat]);
              @endphp
              <article class="article related col-md-6 col-sm-6 col-xs-12">
                <div class="inner">
                  <figure>
                    <a href="{{$routeUrl}}">
                      <img src="{{asset('storage/app/media/files/news/'.$picture)}}">
                    </a>
                  </figure>
                  <div class="padding">
                    <h2><a href="{{$routeUrl}}">{{$nname}}</a></h2>
                    <div class="detail">
                      <div class="category">
                        <a href="{{$routeCatUrl}}">{{$cname}}</a>
                      </div>
                      <div class="time">{{$created_at}}</div>
                    </div>
                  </div>
                </div>
              </article>
              @endforeach
            </div>
            <div class="line thin"></div>
            <div  class="comments">
              <h2 class="title" style="font-size: 30px">{{$totalCmt}} Comments</h2>
              <div class="comment-list" id="commentsn">
                @foreach ($arCmt as $vc)
                @php
                $id_cmt = $vc['id_cmt'];
                $userCmt = $vc['id'] ? $vc['fullname'] : $vc['name'];
                $avatar = $vc['avatar'] ? $vc['avatar'] : 'ico.png';
                @endphp
                <div class="item" id="{{$id_cmt}}-comment">
                  <div class="user">                                
                    <figure>
                      <img src="{{asset('storage/app/media/files/users/'.$avatar)}}">
                    </figure>
                    <div class="details">
                      <h5 class="name">{{$userCmt}}</h5>
                      <div class="time">{{date('d/m/Y', strtotime($vc['created_at']))}}</div>
                      <div class="description">
                        {{$vc['content']}}
                      </div>
                      <footer>
                        <a href="#" onclick="return formCmt({{ $objItem->id_news}},{{$id_cmt}},'{{$userCmt}}');">Reply</a>
                      </footer>
                    </div>
                  </div>
                  <div id="{{$id_cmt}}-form">
                    
                  </div>
                  @if ($vc['child'])
                  <div class="reply-list">
                    @foreach ($vc['child'] as $vcc)
                      @php
                      $userCmt2 = $vcc['id'] ? $vcc['fullname'] : $vcc['name'];
                      $avatar2  = $vcc['avatar'] ? $vcc['avatar'] : 'ico.png';
                      @endphp
                    <div class="item">
                      <div class="user">                                
                        <figure>
                          <img src="{{asset('storage/app/media/files/users/'.$avatar2)}}">
                        </figure>
                        <div class="details">
                          <h5 class="name">{{$userCmt2}}<span class="namert">&nbsp;&nbsp;@ {{$vcc['namert']}}</span></h5>
                          <div class="time">{{date('H:i:s d/m/Y', strtotime($vcc['created_at']))}}</div>
                          <div class="description">
                            {{$vcc['content']}}
                          </div>
                          <footer>
                            <a href="#" onclick="return formCmt({{ $objItem->id_news}},{{$id_cmt}},'{{$userCmt2}}');">Reply</a>
                          </footer>
                        </div>
                      </div>

                    </div>
                    @endforeach
                  </div>
                  @endif
                </div>
                @endforeach
              </div>
              <div class="line"><div>Comment</div></div>
              @if(Auth::check())

              <form class="row" id="write-comment" onsubmit="return cmtLog('{{ $objItem->id_news}}')">
                <div class="form-group col-md-12">
                  <label for="message">Message<span class="required"></span></label>
                  <textarea style="height: 80px;" class="form-control" id="contentLog" name="message" placeholder="Write your message ..."></textarea>
                </div>
                <div class="form-group col-md-12">
                  <button class="btn btn-primary">Send</button>
                </div>
              </form>

              @else

              <form class="row" id="form-cmt-nlog" onsubmit="return cmtNlog('{{ $objItem->id_news}}')">
                <div class="form-group col-md-4">
                  <label for="name">Name <span class="required"></span></label>
                  <input type="text" id="nameNlog" name="name" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label for="email">Email <span class="required"></span></label>
                  <input type="email"  id="emailNlog" name="email" class="form-control">
                </div>
                <div class="form-group col-md-12">
                  <label for="message">Message <span class="required"></span></label>
                  <textarea  style="height: 80px;" id="contentNlog" class="form-control" name="content" placeholder="Write your message ..."></textarea>
                </div>
                <div class="form-group col-md-12">
                  <button class="btn btn-primary">Send Response</button>
                </div>
              </form>

              @endif
            </div>
          </div>
    </div>
  </div>
</section>
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
        html += '<form class="form-cmt row" onsubmit="return cmtLog2('+id+','+idcmt+',\''+namert+'\')"> <div class="form-group col-md-12"> <label for="message">Message<span class="required"></span></label> <textarea  style="height: 80px;" class="form-control" id="contentLog2" name="message" placeholder="Write your message ..."></textarea> </div> <div class="form-group col-md-12"> <button class="btn btn-primary">Send</button> </div> </form>';
      } else {
        html += '<form class="form-cmt row" onsubmit="return cmtNLog2('+id+','+idcmt+',\''+namert+'\')"> <div class="form-group col-md-4"> <label for="name">Name <span class="required"></span></label> <input type="text" id="namenloglv" name="name" class="form-control"> </div> <div class="form-group col-md-4"> <label for="email">Email <span class="required"></span></label> <input type="email"  id="emailnLoglv" name="email" class="form-control"> </div> <div class="form-group col-md-12"> <label for="message">Message <span class="required"></span></label> <textarea style="height: 80px;" id="contentNLog2" class="form-control" name="content" placeholder="Write your message ..."></textarea> </div> <div class="form-group col-md-12"> <button class="btn btn-primary">Send</button> </div> </form>';
      }
      $('#'+idcmt+'-form').append(html);
      return false;
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
            swal('',data,'success');
            $('.form-cmt').remove();
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
            $('#'+idcmt+'-comment').append(data);
            $('.form-cmt').remove();
          }
        }
      });
      return false;
    };
    
</script>
@endsection