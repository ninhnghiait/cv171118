@extends('templates.aboutme.master')
@section('css')
<style> .itsme:hover {background: #aaa !important; } .itsme:hover a{color: #ffdb43; text-decoration: none;} .itsme a {width: 100% !important; height: 100% !important; line-height: 25px !important; border: none !important; } </style> @endsection
@section('content')
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="{{route('switchlang')}}" method="get">
      <div class="modal-header">
        <h4 class="modal-title">WELCOME TO NVN-IT CV !</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="sel1">Select language:</label>
          <select class="form-control" id="sel1" name="language_code">
            
            @if(Session::has('locale'))
            @php
            $select = Session::get('locale') == 'en' ? 'selected' : '';
            @endphp
            @else
            $select = '';
            @endif
            <option value="vi">Việt Nam</option>
            <option {{$select}} value="en">English</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default">Go!</button>
        <button type="button" onclick="return close_lang()" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>

<div id="modalError" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="{{route('switchlang')}}" method="get">
      <div class="modal-body">
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>

  <!-- ////////////// -->
    @php

      $name = $objItemIntro->name;
      $birthday = date('d/m/Y',strtotime($objItemIntro->birthday));
      $email = $objItemIntro->email;
      $address = $objItemIntro->address;
      $phone = $objItemIntro->phone;
      $content = $objItemIntro->content;
      $fb = $objItemIntro->fb;
      $tt = $objItemIntro->tt;
      $gg = $objItemIntro->gg;
      $ig = $objItemIntro->ig;
      $urlAvatar = '/storage/app/media/files/myinfo/'.$objItemIntro->avatar;
      $urlPicture = '/storage/app/media/files/myinfo/'.$objItemIntro->picture;
      //
      foreach ($objItemsQuotations as $key => $v) {
         $qcontent = $v->content;
         $qname = $v->name;
      }
    @endphp
  
  
    @if(!Session::has('checklocale'))
    <!-- Page Loader -->
    <div class="page-loader">
      <div class="v-align-center">
        <div class="middle-content">
          <div class="img-p-area"> <img src="{{$urlAvatar}}" alt="" class="img-thumbnail no-radius"></div>
          <span class="itsme" >It's me</span>
          <h4>{{$name}}</h4>
          <p>please wait</p>
          <div class="anim-pg">
            <span ></span>
          </div>
          <div class="force-pg"><button type="button" id='force-close-pg' class="btn">Skip This &rarr;</button></div>
        </div>
      </div>
    </div><!-- End Page Loader -->
    @endif
    <!-- body-area -->
    <div class="body-area">
      <!-- Header -->
      <header class="main-header">
        <div class="nav-main">
          <span class="itsme" ><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">{{trans('index.language')}}</a></span>
          <span class="itsme" style="margin-left: 5px" ><a href="{{route('aboutme.abmnews.index')}}">{{trans('index.watchblog')}}</a></span>

          <a href="#menu-ovefly" class="toogle-overfly"><i class="fa fa-bars open-t"></i> <i class="fa fa-times close-t"></i></a>
          <a href="#share-ovefly" class="toogle-overfly"><i class="fa fa-plus open-t"></i> <i class="fa fa-times close-t"></i></a>
        </div>

        <div class="over-fly-area" id="menu-ovefly">
          <div class="inner-overfly">
            <div class="middle-overfly">
              <h2 class="title-over">Menu</h2>
              <nav class="main-nav" id="menu">
                <ul class="nav">
                  <li class="active"><a href="#aboutme" class="inner-link" data-text="About Me"><span>About Me</span></a></li>
                  <li><a href="#resume" class="inner-link" data-text="{{trans('index.skills')}}"><span>{{trans('index.skills')}}</span></a></li>
                  <li><a href="#portfolio" class="inner-link" data-text="{{trans('index.works')}}"><span>{{trans('index.works')}}</span></a></li>
                  <li><a href="{{route('aboutme.abmnews.index')}}"><span>Blog</span></a>
                  </li>
                  <li><a href="#contact" class="inner-link"  data-text="{{trans('index.contact')}}"><span>{{trans('index.contact')}}</span></a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>


        <div class="over-fly-area" id="share-ovefly">
          <div class="inner-overfly">
            <div class="middle-overfly">
              <h2 class="title-over">Share This Page</h2>
              <!-- You MUST change the URL definition in these links to share YOUR page - simply change the URL -->
              @php
              $doimain = Request::root();
              @endphp
              <div class="social-share">
                <a href="https://plus.google.com/share?url={{$doimain}}" target="_blank"  data-toggle="tooltip" data-placement="bottom" title="Google Plus"><i class="fa fa-google-plus"></i></a>
                <a href="http://pinterest.com/pin/create/button/?url={{$doimain}}" target="_blank"  data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                <a href="http://www.facebook.com/share.php?u={{$doimain}}" target="_blank"  data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                <a href="http://twitter.com/home?status={{$doimain}}" target="_blank"  data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
              </div>
            </div>
          </div>
        </div>

        <!-- hero  -->
        <div class="hero-01">
          <div class="hero-border">
            <div class="top"></div>
            <div class="bottom"></div>
            <div class="left"></div>
            <div class="right">
              <div class="v-area">
                <div class="v-middle  show-span" >
                  <div class="p5" id="label-menu">
                    <span>A</span>
                    <span>B</span>
                    <span>O</span>
                    <span>U</span>
                    <span>T</span>
                    <span></span>
                    <span>M</span>
                    <span>E</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="my-thumb">
            <div class="thumb-top"><a href="{{$urlAvatar}}" class="image-popup" title="This is Me."><img src="{{$urlAvatar}}" class="img-thumbnail no-radius"  alt=""></a></div>
          </div>

          <div class="content-hero">
            <div class="v-content">
              <h4 class="font-normal">{{trans('index.myname')}}</h4>
              <h1 class="myname" style="font-family: 'Kaushan Script', cursive;font-size: 60px !important;">{{$name}}</h1>
              <h3 class="font-normal with-line">Web Developer</h3>
              <h4 class="font-normal with-line">Download CV</h4>
              <p> 
                <a href="{{route('aboutme.abmindex.cv_vi')}}" class="btn btnc1"><span>CV Việt Nam</span></a>
                <a href="{{route('aboutme.abmindex.cv_en')}}" class="btn btnc1"><span>CV English</span></a>
              </p>
            </div>
          </div>
        </div><!-- hero  -->

      </header><!-- end HEader -->
      <!-- Content body -->
      <div class="content-body">

        <!-- start about me section -->
        <section id="aboutme">
          <div class="section-padd bg2" >
            <div class="container-body clearfix">
              <div class="big-qoute">
                <h3 style="font-family: 'Kaushan Script', cursive;font-size: 30px !important">{{$qcontent}} <small>&rarr; {{$qname}}</small></h3>
              </div>
            </div>
          </div>
          <div class="section-padd top-bold-border" >
            <div class="container-body clearfix">
              <div class="row">
                <div class="col-md-12">
                  <div class="img-pr">
                    <a href="{{$urlPicture}}" class="image-popup" title="This is Me.">
                      <img src="{{$urlPicture}}" alt="" >
                    </a>
                  </div>
                  <h2 class="title"><span>{{trans('index.hello')}}</span></h2>
                  <p>{{$content}}</p>  
                </div>
              </div>
            </div>
          </div>
         {{--  <div class="clearfix br-t" >
            <div class="col-md-6 col-sm-6 no-padding">
              <div class="desc-mini n-br-l">
                <div class="mid-desc-mini">
                  <h3>Web Designer</h3>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 no-padding">
              <div class="desc-mini">
                <div class="mid-desc-mini">
                  <h3>Web Developer</h3>
                </div>
              </div>
            </div>
          </div> --}}
          <div class="bg2 p30 br-b">
            <div class="container-body clearfix">
              <div class="clearfix br-t br-r " >
                <div class="col-lg-4 col-md-6 col-sm-6 no-padding">
                  <div class="desc-mini">
                    <div class="mid-desc-mini">
                      <h4>Birthdate</h4>
                      <p>{{$birthday}}</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 no-padding">
                  <div class="desc-mini">
                    <div class="mid-desc-mini">
                      <h4>Facebook</h4>
                      <p>Ninh Nghia</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 no-padding">
                  <div class="desc-mini">
                    <div class="mid-desc-mini">
                      <h4>Phone </h4>
                      <p>{{$phone}}</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 no-padding">
                  <div class="desc-mini">
                    <div class="mid-desc-mini">
                      <h4>Email</h4>
                      <p>{{$email}}</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 no-padding">
                  <div class="desc-mini" >
                    <div class="mid-desc-mini">
                      <h4>Website</h4>
                      <p>aboutme</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 no-padding">
                  <div class="desc-mini">
                    <div class="mid-desc-mini">
                      <h4>Address </h4>
                      <p>{{$address}}.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section><!-- end about me section -->

        <!-- start resume section -->
        <section id="resume">
          <div class="section-padd" >
            <div class="container-body clearfix">
              <h2 class="title"><span>{{trans('index.education')}}</span></h2>
              <div class="white-space-10" ></div>
              <!-- resume list-->
              <ul class="resume-list">
                @if ($objItemEducation->first())
                  @foreach ($objItemEducation as $ve)
                    @php
                      $edate = date('d/m/Y',strtotime($ve->date_create));
                      $ename = $ve->name;
                      $eaddress = $ve->address;
                      $econtent = $ve->content;
                    @endphp
                  <li> 
                    <h4><i class="fa fa-calendar ic-re"></i> {{$edate}}</h4>
                    <i>{{$eaddress}}</i>
                    <h3><i class="fa fa-building-o ic-re" ></i> {{$ename}}</h3>
                    <p>{{$econtent}}</p>
                  </li>

                 @endforeach
                @endif
                

              </ul><!-- end resume list-->
              <h2 class="title"><span>{{trans('index.employement')}}</span></h2>
              <div class="white-space-10" ></div>
              <!-- resume list-->
              <ul class="resume-list"> 
                @if ($objItemEmployement->first())
                  @foreach ($objItemEmployement as $ve)
                    @php
                      $edate = date('d/m/Y',strtotime($ve->date_create));
                      $ename = $ve->name;
                      $eaddress = $ve->address;
                      $econtent = $ve->content;
                    @endphp
                    <li> 
                      <h4><i class="fa fa-calendar ic-re" ></i> {{$edate}}</h4>
                      <i>{{$eaddress}}</i>
                      <h3><i class="fa fa-building-o ic-re" ></i> {{$ename}}</h3>
                      <p>{{$econtent}}</p>
                    </li>
                  @endforeach
                @endif

              </ul><!-- end resume list-->
              <h2 class="title"><span>{{trans('index.skills')}}</span></h2>
              <!-- skills -->
              <div class="row">
                <div class="col-md-12">
                  {{-- <h3 class="title-2">Web Designer</h3> --}}
                  <ul class="list-unstyled list-progress">
                  @if ($objItemSkills->first())
                  @foreach ($objItemSkills as $vs)
                    @php
                      $sname = $vs->name;
                      $svalue = $vs->value;
                    @endphp
                    <li>
                      <h4>{{$sname}}  <small>{{$svalue}}%</small></h4>
                      <div class="progress-line">
                        <div class="line" data-holdwidth="{{$svalue}}%" ></div>
                      </div>
                    </li>
                    @endforeach
                  @endif
                    
                  </ul>
                </div>
              </div><!-- skills -->

              <!-- soft skills -->
              {{-- <h3 class="title-2">Soft Skills</h3>
              <div class="clearfix text-center" >
                <div class="col-md-3 col-sm-6 col-xs-6  no-padding">
                  <div class="mb30">
                    <div class="chart" data-percent="87"><span class="percent"></span></div>
                    <h4>Creative   </h4>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6  col-xs-6 no-padding">
                  <div class="mb30">
                    <div class="chart" data-percent="73"><span class="percent"></span></div>
                    <h4>Leadership   </h4>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6  no-padding">
                  <div class="mb30">
                    <div class="chart" data-percent="80"><span class="percent"></span></div>
                    <h4>Communication </h4>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6 no-padding">
                  <div class="mb30">
                    <div class="chart" data-percent="90"><span class="percent"></span></div>
                    <h4>Confident </h4>
                  </div>
                </div>
              </div> --}}<!-- end soft skills -->
            </div>
          </div>
        </section><!-- end resume section-->

        <!-- start portfolio section-->
        <section id="portfolio" >

          <!-- filter portfolio -->
          <div class="section-padd br-t bg2" >
            <div class="container-body clearfix">
              <h2 class="title dark"><span>{{trans('index.works')}}</span></h2>
              <ul class="list-inline list-filter-galery">
                <li class="active" data-filter="*"><a href="#">All</a></li>
                <li data-filter=".img"><a href="#" >Image</a></li>
                <li data-filter=".gal"><a href="#">Gallery</a></li>
                {{-- <li data-filter=".vid"><a href="#">Video</a></li> --}}
              </ul>
            </div>
          </div>
          <!-- grid portfolio -->
          <div class="galery-box clearfix bg2">
          @if ($obj8Img->first())
          @foreach ($obj8Img as $vi)
            <div class="col-sm-3 col-xs-6 item-box img">
              <div class="hover-area">
                <div class="text-vcenter-area">
                  <div class="text-vcenter">
                    <h3><a href="{{route('aboutme.abmindex.works',$vi->img_id)}}" class="link-work"> <i class="fa fa-link"></i></a></h3>
                  </div>  
                </div>
              </div>
              <img width="218px" height="156px" src="/storage/app/media/files/gallery/{{$vi->image}}" alt="">
            </div>
          @endforeach
          @endif

          @if ($arGlr[0])
          @foreach ($arGlr as $vg)
            <div class="col-sm-3 col-xs-6 item-box gal">
              <div class="hover-area">
                <div class="text-vcenter-area">
                  <div class="text-vcenter">
                    <h3><a href="{{route('aboutme.abmindex.gallery',$vg['gallery_id'])}}" class="link-work">{{$vg['name']}} <i class="fa fa-link"></i></a></h3>
                  </div>  
                </div>
              </div>
              <div id="bs-gslider1" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                @foreach ($vg['img'] as $key => $vi)
                  @php
                    $activei = $key == 0 ? 'active' : '';
                  @endphp
                  <div class="item {{$activei}}">
                    <img src="/storage/app/media/files/gallery/{{$vi['image']}}" alt="">
                  </div>
                @endforeach
                </div>
              </div>
            </div>
          @endforeach
          @endif
            {{-- <div class="col-sm-3 col-xs-6 item-box vid">
              <div class="hover-area">
                <div class="text-vcenter-area">
                  <div class="text-vcenter">
                    <h3><a href="works/work-vimeo.html" class="link-work">3 <i class="fa fa-link"></i></a></h3>
                  </div>  
                </div>
              </div>
              <img src="{{$publicUrl}}/assets/theme/img/thumb/4.jpg" alt="">
            </div> --}}

            
          </div><!-- end grid portfolio -->


          <div class="section-padd">
            <div class="container-body clearfix">
              <!-- testimonial -->  
              <h2 class="title"><span>{{trans('index.project')}}</span></h2>
              <div class="white-space-10"></div>
              <ul class="list-unstyled list-testimonial clearfix ">
                @if ($objItemProjects->first())
                @foreach ($objItemProjects as $vp)
                 @php
                  $pname = $vp->name;
                  $plink = $vp->link;
                  $ppicture = $vp->picture;
                  $arpPic = explode('|', $ppicture);
                 @endphp
                <li>
                  @if ($ppicture != '')
                  <div class="col-md-6 col-sm-6 col-xs-6" style="float: left;">
                    <div id="bs-gslider1" class="carousel slide carousel-fade" data-ride="carousel">
                      <div class="carousel-inner" role="listbox">
                        @foreach ($arpPic as $key => $v)
                          @if ($v != '')
                            @php
                              $activep = ($key == 0) ? 'active' : '';
                            @endphp
                          <div class="item {{$activep}}">
                            <img src="{{ Storage::url('app/media/files/project/'.$v) }}" alt="">
                          </div>
                          @endif
                        @endforeach
                      </div>
                    </div>
                  </div>
                  @endif
                  <div class="text-testimonial col-md-6 col-sm-6 col-xs-6" style="float: left;">
                    <h3>{{$pname}}
                    </h3>
                    <h4><a href="{{$plink}}" target="_blank"><i class="fa fa-globe"></i> Link</a></small></h4>
                  </div>
                  <div class="clearfix"></div>
                </li>
                @endforeach
                @endif
                  
              </ul><!-- end testimonial -->
            </div>
          </div>

          
        </section><!-- end portfolio section -->

        <!-- start contact section -->
        <section id='contact'>

          <!-- map -->
          <div class="map-area  br-t br-b">
            <!-- change data-lat="48.856318" data-lng="2.351866" with your location-->
            <div class="map">
              <iframe src="https://www.google.com/maps/d/embed?mid=1_bxF1fKp16fkbueI0xEy9IhaYmg" width="100%" height="100%" allowfullscreen></iframe>
            </div>

            <div class="map-scroll-space"></div>
            {{-- <div class="map-wait-msg">Plase Wait...</div> --}}
            <div class="map-detail-location">
              <h4>Locations:</h4>
              <p>TP Đà Nẵng - Việt Nam</p>
            </div>
          </div><!-- end map -->

          <!-- contact form -->
          <div class="section-padd">
            <div class="container-body clearfix">
              <h2 class="title dark"><span>{{trans('index.contact')}}</span></h2>
              <div class="white-space-10"></div>
              <form action="{{route('aboutme.abmcontact.postContact')}}" method="post" id="ContactForm" name="contactForm" class="validate-form">
                {{ csrf_field() }}
               {{--  <input type="hidden" name="subject" value="" id='subject_contact'>
                <input type="hidden" name="file" id="file-att" value=""> --}}
                
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
                <div class="form-group">
                  <label>{{trans('index.yourname')}} (*)</label>
                  <input type="text" name="name" class="form-control form-flat" value="{{old('name')}}" required="">
                </div>
                <div class="form-group">
                  <label>Email (*)</label>
                  <input type="email" name="email" class="form-control form-flat" value="{{old('email')}}" required="">
                </div>
                <div class="form-group">
                  <label>Phone (*)</label>
                  <input type="number" name="phone" class="form-control form-flat" value="{{old('phone')}}" required="">
                </div>
                <div class="form-group">
                  <label>{{trans('index.message')}} (*)</label>
                  <textarea name="content" class="form-control form-flat" rows="8" required="" >{{old('content')}}</textarea>
                </div>

                {{-- <div class="hold-feature uploader-hold">
                  <div class="form-group">
                    <label>Attach Your Document (Optional) <span class="display-block ">(only .pdf  allowed , max size 2Mb)</span></label>
                    <div class="clearfix">            
                      <input type="button" id="upload-btn" class="btn  btn-file btn-xs btn-default clearfix" value="Choose file">
                      <div id="errormsg" class="clearfix error"></div>                
                      <div id="pic-progress-wrap" class="progress-wrap"></div>  
                      <div id="picbox" class="attbox "></div>
                    </div>
                  </div>  
                </div> --}}

                <div class="hold-feature captcha-hold">
                  <div class="form-group">
                    <!-- generate captcha -->
                    <div id="mycaptcha-wrap" class="mycaptcha1">
                      <div id="mycaptcha" class="mycaptcha1"></div>
                    </div>
                  </div>  
                </div>


                <div class="form-group">
                  <button type="submit" class="btn btnc2 with-br "><span>{{trans('index.sendmessage')}}</span></button>
                </div>

                <div class="form-group">
                  <!-- aja msg -->
                  <div class="preload-submit hidden"><hr/> <i class="fa fa-spinner fa-spin"></i> Please Wait ...</div>
                  <div class="message-submit error hidden"></div>
                </div>
              </form>
            </div>
          </div><!-- end contact form -->

          <!-- social links -->
          <div class="clearfix br-t" >
            <div class="col-md-3 col-xs-6 no-padding">
              <div class="desc-mini no-br-l">
                <div class="mid-desc-mini">
                  <h3><a href="{{$fb}}" class="black-link" target="_blank">&nbsp;<i class="fa fa-facebook"></i> &nbsp;</a></h3>
                  <p><a href="{{$fb}}" class="black-link" target="_blank">Facebook</a></p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-6 no-padding">
              <div class="desc-mini">
                <div class="mid-desc-mini">
                  <h3><a href="{{$gg}}" class="black-link" target="_blank">&nbsp;<i class="fa fa-google-plus"></i> &nbsp;</a></h3>
                  <p><a href="{{$gg}}" class="black-link" target="_blank">Google +</a></p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-6 no-padding">
              <div class="desc-mini">
                <div class="mid-desc-mini">
                  <h3><a href="{{$tt}}" class="black-link" target="_blank">&nbsp;<i class="fa fa-twitter"></i>&nbsp;</a></h3>
                  <p><a href="{{$tt}}" class="black-link" target="_blank">Twitter</a></p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-6 no-padding">
              <div class="desc-mini">
                <div class="mid-desc-mini">
                  <h3><a href="{{$ig}}" class="black-link" target="_blank">&nbsp;<i class="fa fa-instagram"></i>&nbsp;</a></h3>
                  <p><a href="{{$ig}}" class="black-link" target="_blank">Instagram</a></p>
                </div>
              </div>
            </div>
          </div><!-- end social links -->

        </section><!-- end contact section -->
      </div><!-- end Content body -->
<!-- footer /////////////// -->

@endsection
@section('js')
 @if (!Session::has('checklocale'))
  <script>
  $(window).load(function(){ 
    $('#myModal').modal('show');
  }); 
  </script>
  @endif
  @if ($errors->any())
  <script>
  $(window).load(function(){ 
    $('#modalError').modal('show');
  }); 
  </script>
  @endif
  @if (Session::has('msg'))
  <script>
    swal ( "NVN-IT" , "{{Session::get('msg')}}" ,'success');
  </script>
  @endif
  <script>
  function close_lang() {
    var lang = $('#sel1').val();
    $.ajax({
      url: "{{ route('switchlang_close') }}",
      type: 'GET',
      cache: false,
      data: {lang:lang},
    });
  }
  </script>
@endsection