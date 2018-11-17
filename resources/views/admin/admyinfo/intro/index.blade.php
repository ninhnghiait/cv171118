@extends('templates.admin.master')
@section('content')
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Thông tin <small>Intro</small></h3>
    </div>

    <div class="title_right">
      @include('templates.admin.topsearch')
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>

        @if (Session::has('msg')) 
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <strong>{{ Session::get('msg') }}</strong>
        </div>
        @endif

        <div class="x_content">
          <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action">

              <tbody>

              @if (!$objItems->first())
                @php
                    $colspan = 9;
                @endphp
                <tr class="even pointer">
                  <td class="a-center " colspan="{{ $colspan }}">
                     <p>Chưa có dữ liệu</p>
                  </td>
                </tr>
              @else
                @foreach ($objItems as $key => $objItem)
                    @php
                        $id = $objItem->id_if;
                        $name = $objItem->name;
                        $birthdaystr = strtotime($objItem->birthday);
                        $birthday = date('d-m-Y',$birthdaystr);
                        $email = $objItem->email;
                        $address = $objItem->address;
                        $phone = $objItem->phone;
                        $content = $objItem->content;
                        $confirm = $objItem->confirm;
                        $fb = $objItem->fb;
                        $gg = $objItem->gg;
                        $tt = $objItem->tt;
                        $ig = $objItem->ig;
                        $avatar = $objItem->avatar;
                        $language = $objItem->language_code == 'en' ? 'English' : 'Việt Nam';
                        $urlAvatar = asset('storage/app/media/files/myinfo/'.$avatar);
                        $picture = $objItem->picture;
                        $urlPicture = asset('storage/app/media/files/myinfo/'.$picture);
                        $urlEdit = route('intro_admin.edit', $id);
                        $trrow = "odd";
                    @endphp
                    @if ($key % 2 == 0)
                        @php
                            $trrow = "even";
                        @endphp
                    @endif
                <tr class="{{ $trrow }} pointer">
                  <th>Ngôn ngữ</th>
                  <td>{{ $language }}</td>
                  <td rowspan="13" style="vertical-align:middle;font-weight: bold"> <a href="{{ $urlEdit }}">Sửa</a></td>
                </tr>
                <tr class="{{ $trrow }} pointer">
                  <th>Tên</th>
                  <td>{{ $name }}</td>
                </tr>
                <tr class="{{ $trrow }} pointer">
                  <th>Ngày sinh</th>
                  <td>{{ $birthday }}</td>
                </tr>
                 <tr class="{{ $trrow }} pointer">
                  <th>Email</th>
                  <td>{{ $email }}</td>
                </tr>
                <tr class="{{ $trrow }} pointer">
                  <th>Avatar</th>
                  <td><img width="150px" src="{{ $urlAvatar }}" alt=""></td>
                </tr>
                <tr class="{{ $trrow }} pointer">
                  <th>Picture</th>
                  <td><img width="150px" src="{{ $urlPicture }}" alt=""></td>
                </tr>
                 <tr class="{{ $trrow }} pointer">
                  <th>Địa chỉ</th>
                  <td>{{ $address }}</td>
                </tr>
                 <tr class="{{ $trrow }} pointer">
                  <th>Số điện thoại</th>
                  <td>{{ $phone }}</td>
                </tr>
                <tr class="{{ $trrow }} pointer">
                  <th>Giới thiệu</th>
                  <td>{{ $content }}</td>
                </tr>
                <tr class="{{ $trrow }} pointer">
                  <th>Facebook</th>
                  <td>{{ $fb }}</td>
                </tr>
                 <tr class="{{ $trrow }} pointer">
                  <th>Twitter</th>
                  <td>{{ $tt }}</td>
                </tr>
                 <tr class="{{ $trrow }} pointer">
                  <th>Google + </th>
                  <td>{{ $gg }}</td>
                </tr>
                 <tr class="{{ $trrow }} pointer">
                  <th>Instagram</th>
                  <td>{{ $ig }}</td>
                </tr>
                 <tr class="{{ $trrow }} pointer">
                  <th></th>
                  <td></td>
                </tr>

                @endforeach
              @endif
              </tbody>              
            </table>
          </div>
    
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
  <script>
    function active(id){
      $.ajax({
        url: "{{ route('admin.admyinfo.intro.confirm') }}",
        type: 'GET',
        cache: false,
        data: {aid:id},
        success: function(data){
          $('.confirm-intro-'+id+' a').html(data);
        },
        error: function (){
          alert('Có lỗi xảy ra');
        }
      });
      return false;
    };
  </script>
@endsection