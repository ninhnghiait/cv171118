<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>CV - Ninh Văn Nghĩa</title>
</head>
<style>
  .container {
    margin-top: 10px;
    margin-bottom: 30px;
  }
  #left {
    margin-right: 50px;
  }
  #name {
    text-align: center;
  }
 #name h1{
      letter-spacing: 0.9px;
    text-transform: uppercase;
    font-size: 30px;
    font-weight: 600;
    color: #3f788d;
 }
 #avatar {
  text-align: center;
  margin-bottom: 20px;
 }
 #avatar img{
  border: 1px solid #aaa;
  outline: 2px solid #aaa;
  padding: 2px;
 }
 #left-bottom {
    background: #3f788d;
    padding: 10px 15px;
 }
 .title-h3 {
text-transform: uppercase;
    color: #fff;
 }
 .title-h4 {
      color: #b9d6df;
    margin-top: 5px;font-size: 18px;
    margin-bottom: 5px;
 }
 .content-h4 {
  color: #fff;
            letter-spacing: 0.4px;
    font-size: 16px;

 }
 .title-small {
 color: #fff;
            letter-spacing: 0.4px;
    font-size: 16px;
 }
 .skill-bar {
width: 100%;
    height: 7px;
    background: #7a949f;
 }
 .skill-vl {
    height: 100%;
    background: #fff;
 }
 .job {
    text-align: right;
    text-transform: uppercase;
    font-size: 22px;
    background: #3f788d;
    line-height: 39px;
    padding-right: 20px;
    color: #fff;
}
 }
 .title-right {
margin-top: 40px;
 }
 .title-right {
    text-transform: uppercase;
    font-weight: bold;
    color: #3f788d;
    font-size: 22px;
	margin-top: 40px;
 }
 .line {
	  background: #3f788d;
    width: 76%;
    height: 3px;
    display: block;
    position: relative;
    top: -14px;
    left: 174px;
 }
.titleh4-right {
	    float: left;
    text-transform: capitalize;
    font-weight: bold;
    font-size: 18px;
	color: #3f788d;
}
.time {
	float: right;
	font-size: 15px;
    color: #8a8a8a;
}
.head-content-right {
	    text-transform: capitalize;
    font-size: 17px;
	color: #3f788d;
}
.content-right {
	font-size: 16px;
    color: #8a8a8a;
	    letter-spacing: 0.2px;
    line-height: 27px;
}
</style>
<body>
  <div class="container">
    <div class="col-md-3" id="left">
      <div class="row">
        <div id="name">
           <h1>{{$objItemIntro->name}}</h1>
        </div>
      </div>

      <div class="row">
        <div id="avatar">
          <img width="160px" src="{{asset('/storage/app/media/files/myinfo/'.$objItemIntro->avatar)}}" alt="">
        </div>
      </div>
      <div class="row" id="left-bottom">
        <h4 class="title-h4">Phone</h4>
        <p class="content-h4">{{$objItemIntro->phone}}</p>
        <h4 class="title-h4">Email</h4>
        <p class="content-h4">{{$objItemIntro->email}}</p>
		<h4 class="title-h4">Ngày sinh</h4>
        <p class="content-h4">{{$objItemIntro->birthday}}</p>
		<h4 class="title-h4">Địa chỉ</h4>
        <p class="content-h4">{{$objItemIntro->address}}</p>
        {{-- <h3 class="title-h3">MUC tieu</h3> --}}
        {{-- <p class="content-h4">Trước khi tự viết hoặc tải về một mẫu CV xin việc, bạn hãy nghiên cứu kỹ những thông tin liên quan đến loại giấy tờ này để có được một CV “đẹp” nhất</p> --}}
        <h3 class="title-h3">{{trans('index.skills')}}</h3>
        @if ($objItemSkills->first())
        @foreach ($objItemSkills as $vs)
          @php
          $sname = $vs->name;
          $svalue = $vs->value;
          @endphp
          <h4 class="title-small">{{$sname}} <small style="color: #fff;font-size: 15px;float: right">{{$svalue}}%</small></h4>
          <div class="skill-bar">
            <div class="skill-vl" style="width: {{$svalue}}%"></div>
          </div>
        @endforeach
        @endif
      </div>
      
    </div>
    <div class="col-md-8" id="right">
      <h2 class="job">Web - developer</h2>
      <div class="content-right">
        <h3 class="title-right">{{trans('index.education')}}<span class="line"></span></h3>
        @if ($objItemEducation->first())
          @foreach ($objItemEducation as $ve)
            @php
              $edate = date('d/m/Y',strtotime($ve->date_create));
              $ename = $ve->name;
              $eaddress = $ve->address;
              $econtent = $ve->content;
            @endphp
        		<h4>
        		   <p class="titleh4-right">{{$ename}}</p><p class="time">{{$edate}}</p>
        		   <div class="clearfix"></div>
        		   <p class="head-content-right">&nbsp;&nbsp;&nbsp;&nbsp;{{$eaddress}}</p>
        		   <p class="content-right">{{$econtent}}</p>
        		</h4>
          @endforeach
        @endif

        <h3 class="title-right">{{trans('index.employement')}}<span class="line"></span></h3>
        @if ($objItemEmployement->first())
          @foreach ($objItemEmployement as $vj)
            @php
              $edate = date('d/m/Y',strtotime($vj->date_create));
              $ename = $vj->name;
              $eaddress = $vj->address;
              $econtent = $vj->content;
            @endphp
            <h4>
               <p class="titleh4-right">{{$ename}}</p><p class="time">{{$edate}}</p>
               <div class="clearfix"></div>
               <p class="head-content-right">&nbsp;&nbsp;&nbsp;&nbsp;{{$eaddress}}</p>
               <p class="content-right">{{$econtent}}</p>
            </h4>
          @endforeach
        @endif

        <h3 class="title-right">{{trans('index.project')}}<span class="line"></span></h3>
        @if ($objItemProjects->first())
          @foreach ($objItemProjects as $vp)
            @php
              $pname = $vp->name;
              $pdetail = $vp->detail;
            @endphp
            <h4>
               <p class="titleh4-right">{{$pname}}</p>
               <div class="clearfix"></div>
               <p class="content-right">{{$pdetail}}</p>
            </h4>
          @endforeach
        @endif
      </div>
    </div>
  </div>
  

</body>
</html>