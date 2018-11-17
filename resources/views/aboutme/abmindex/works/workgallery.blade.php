<div class="section-padd " >
  <div class="container-body clearfix">
    <!-- project title -->
    <h2 class="title"><span>{{$arGlr['name']}}</span></h2>
    <div class="white-space-10"></div>


    <!-- project preview -->
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      </ol>
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        @foreach ($arGlr['img'] as $key => $v)
        @php
        $active = $key == 0 ? 'active' : ''; 
        @endphp
        <div class="item {{$active}}">
          <img src="{{asset('storage/app/media/files/gallery/'.$v['image'])}}" alt="" class="img-full">
        </div>
        @endforeach
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <div class="white-space-30"></div>
    <p><a href="#" class="btn btnc2 with-br"><span>Visit Site <i class="fa fa-globe"></i></span></a> </p>
  </div>
</div>