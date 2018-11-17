@foreach($arNews as $vn)
<div class="col-sm-4 grid-inline-box">
  <div class="blog-post-item">
    <div class="post-img">
      <a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($vn['name']) , 'id' => $vn['id_news'] ])}}" class="open-link"><img src="{{asset('storage/app/media/files/news/'.$vn['picture'])}}" class="img-full" alt=""></a>
    </div>
    <div class="post-header text-left" >
      <h3 class="title-2"><span><a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($vn['name']) , 'id' => $vn['id_news'] ])}}" class="open-link">{{$vn['name']}}</a></span></h3>
    </div>
    <div class="post-entry">
      <p>{{$vn['preview_text']}}</p>
    </div>
    <span class="post-date">{{date('H:i:s d/m/Y',strtotime($vn['created_at']))}}</span>
  </div>
</div>
@endforeach
<script>{{'cr = '.$cr.';'}}</script>