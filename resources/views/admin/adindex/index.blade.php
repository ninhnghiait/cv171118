@extends('templates.admin.master')
@section('css')
<style>
.gal-container{
  padding: 12px;
}
.gal-item{
  overflow: hidden;
  padding: 3px;
}
.gal-item .box{
  height: 350px;
  overflow: hidden;
}
.box img{
  height: 100%;
  width: 100%;
  object-fit:cover;
  -o-object-fit:cover;
}
.gal-item a:focus{
  outline: none;
}
.gal-item a:after{
  content:"\e003";
  font-family: 'Glyphicons Halflings';
  opacity: 0;
  background-color: rgba(0, 0, 0, 0.75);
  position: absolute;
  right: 3px;
  left: 3px;
  top: 3px;
  bottom: 3px;
  text-align: center;
    line-height: 350px;
    font-size: 30px;
    color: #fff;
    -webkit-transition: all 0.5s ease-in-out 0s;
    -moz-transition: all 0.5s ease-in-out 0s;
    transition: all 0.5s ease-in-out 0s;
}
.gal-item a:hover:after{
  opacity: 1;
}
.modal-open .gal-container .modal{
  background-color: rgba(0,0,0,0.4);
}
.modal-open .gal-item .modal-body{
  padding: 0px;
}
.modal-open .gal-item button.close{
    position: absolute;
    width: 25px;
    height: 25px;
    background-color: #000;
    opacity: 1;
    color: #fff;
    z-index: 999;
    right: -12px;
    top: -12px;
    border-radius: 50%;
    font-size: 15px;
    border: 2px solid #fff;
    line-height: 25px;
    -webkit-box-shadow: 0 0 1px 1px rgba(0,0,0,0.35);
  box-shadow: 0 0 1px 1px rgba(0,0,0,0.35);
}
.modal-open .gal-item button.close:focus{
  outline: none;
}
.modal-open .gal-item button.close span{
  position: relative;
  top: -3px;
  font-weight: lighter;
  text-shadow:none;
}
.gal-container .modal-dialogue{
  width: 80%;
}
.gal-container .description{
  position: relative;
  height: 40px;
  top: -40px;
  padding: 10px 25px;
  background-color: rgba(0,0,0,0.5);
  color: #fff;
  text-align: left;
}
.gal-container .description h4{
  margin:0px;
  font-size: 15px;
  font-weight: 300;
  line-height: 20px;
}
.gal-container .modal.fade .modal-dialog {
    -webkit-transform: scale(0.1);
    -moz-transform: scale(0.1);
    -ms-transform: scale(0.1);
    transform: scale(0.1);
    top: 100px;
    opacity: 0;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    transition: all 0.3s;
}

.gal-container .modal.fade.in .modal-dialog {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
    -webkit-transform: translate3d(0, -100px, 0);
    transform: translate3d(0, -100px, 0);
    opacity: 1;
}
@media (min-width: 768px) {
.gal-container .modal-dialog {
    width: 55%;
    margin: 50 auto;
}
}
@media (max-width: 768px) {
    .gal-container .modal-content{
        height:250px;
    }
}
/* Footer Style */
i.red{
    color:#BC0213;
}

footer{
    font-family: 'Quicksand', sans-serif;
}
footer a,footer a:hover{
    color: #88C425;
}

</style>
@endsection
@section('content')
@php
$name = $objItemIntro->name;
$birthday = date('d/m/Y',strtotime($objItemIntro->birthday));
$email = $objItemIntro->email;
$address = $objItemIntro->address;
$phone = $objItemIntro->phone;
$content = $objItemIntro->content;
$urlPicture = asset('storage/app/media/files/myinfo/'.$objItemIntro->picture);
@endphp

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="{{$urlPicture}}" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3>{{$name}}</h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> {{$address}}
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> Web Development
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i>
                          <a href="#" target="_blank">{{$email}}</a>
                        </li>
                      </ul>

                      <br />
                      <!-- start skills -->
                      <h4>Skills</h4>
                      <ul class="list-unstyled user_data">
                        @if ($objItemSkills->first())
                        @foreach ($objItemSkills as $v)
                        <li>
                          <p>{{$v->name}}</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$v->value}}"></div>
                          </div>
                        </li>

                        @endforeach
                        @endif
                      </ul>
                      <!-- end of skills -->
                    </div>
                    
      <!-- start of weather widget -->
      <div class="col-md-9 col-sm-8 col-xs-12">
        
{{-- <section>
  <div class="container gal-container">
    @if ($objImg->first())
    @foreach($objImg as $key => $v)
    <div class="col-md-6 col-sm-12 co-xs-12 gal-item">
      <div class="box">
        <a href="#" data-toggle="modal" data-target="#{{$key}}">
          <img src="{{asset('storage/app/media/files/gallery/'.$v->image)}}">
        </a>
        <div class="modal fade" id="{{$key}}" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              <div class="modal-body">
                <img src="{{asset('storage/app/media/files/gallery/'.$v->image)}}">
              </div>
                <div class="col-md-12 description">
                  <h4>Ninh Nguyen</h4>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    @endif
  </div>
</section> --}}


      </div>
      <!-- end of weather widget -->
  </div>
</div>
        
@endsection
