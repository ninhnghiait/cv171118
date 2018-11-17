@extends('templates.admin.master')
@section('css')
<style>
  .picture-project {
    width: 150px;
    border-radius: 7px;
    border: 2px solid #5580aa;
  }
</style>
@endsection
@section('content')
<form id="dell-all" action="{{route('news_admin.destroy_all') }}" method="post" class="form-horizontal form-label-left">
@csrf
</form>
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Tin tức <small>danh sách tin tức</small></h3>
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
          <h2><a href="{{ route('news_admin.create') }}"><i class="fa fa-plus-square"></i> Thêm</a></h2>
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
            <button type="submit" form="dell-all" name="del" class="btn btn-success" onclick="return confirm('Bạn thực sự muốn xóa các bản ghi đã chọn?')">Xóa</button>
            <table class="table table-striped jambo_table bulk_action">
              <thead>
                <tr class="headings">
                  <th>
                    <input type="checkbox" id="check-all-vne" class="flat">
                  </th>
                  <th class="column-title">Tên </th>
                  <th class="column-title">Danh mục </th>
                  <th class="column-title">Hình ảnh </th>
                  <th class="column-title">Tag </th>
                  <th class="column-title">Ngày viết </th>
                  <th class="column-title">Lượt xem </th>
                  <th class="column-title">Confirm </th>
                  <th class="column-title">Người viết </th>
                  <th class="column-title no-link last"><span class="nobr">Chức năng</span></th>
                  <th class="bulk-actions" colspan="10">
                    <a class="antoo" style="color:#fff; font-weight:500;">Chọn ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                  </th>
                </tr>
              </thead>

              <tbody>

              @if (!$objItems->first())
                @php
                    $colspan = 10;
                @endphp
                <tr class="even pointer">
                  <td class="a-center " colspan="{{ $colspan }}">
                     <p>Chưa có dữ liệu</p>
                  </td>
                </tr>
              @else
                @foreach ($objItems as $key => $objItem)
                    @php
                        $id = $objItem->id_news;
                        $name = $objItem->name;
                        $picture = $objItem->picture;
                        $cname = $objItem->cname;
                        $username = $objItem->username;
                        $count_number = $objItem->count_number;
                        $confirm = $objItem->confirm;
                        $created_at = date('H:i:s d:m:Y',strtotime($objItem->created_at));
                        $urlEdit = route('news_admin.edit', [$id]);
                        $urlDel  = route('news_admin.destroy', [$id]);
                        $trrow = "odd";
                        $tags = $objItem->tags;
                    @endphp
                    @if ($key % 2 == 0)
                        @php
                            $trrow = "even";
                        @endphp
                    @endif

                <tr class="{{ $trrow }} pointer">
                  <td class="a-center ">
                    <input type="checkbox" form="dell-all" class="flat vnedel" name="delall[]" value="{{ $id }}">
                  </td>
                  <td class=" ">{{ $name }}</td>
                  <td class=" ">{{ $cname }}</td>
                  <td class=" ">
                    @if ($picture != '')
                      @php
                          $urlPic = Storage::url('app/media/files/news/'.$picture);
                      @endphp
                      <img src="{{ $urlPic }}" class="picture-project" alt="">
                    @else
                      <img src="{{ Storage::url('app/media/files/project/nopicture.png') }}" class="picture-project" alt="">
                    @endif
                  </td>
                  <td>
                    @foreach($tags as $tag)
                    {{$tag->name}} <br>
                    @endforeach
                  </td>
                  <td class=" ">{{ $created_at }}</td>
                  <td class=" ">{{ $count_number }}</td>
                  <td class="confirm-news-{{ $id }}">
                    @if ($confirm == 1)
                      <a href="#" onclick="return active('{{ $id }}')" style="font-size: 18px"><i class="fa fa-check-square"></i></a>
                    @else
                      <a href="#" onclick="return active('{{ $id }}')" style="font-size: 18px"><i class="fa fa-times-circle"></i></a>
                    @endif
                  </td>
                  <td class=" ">{{ $username }}</td>
                  <td width="10%">
                    <button class="btn"><a href="{{$urlEdit}}">Edit</a></button>
                    <form action="{{$urlDel}}" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')" method="post" style="display: inline">
                      @csrf
                      @method('delete')
                      <input class="btn" type="submit" value="Delete">
                    </form>
                  </td>
                </tr>
                @endforeach
              @endif
              </tbody>              
            </table>
            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <button type="submit" form="dell-all" name="del" class="btn btn-success" onclick="return confirm('Bạn thực sự muốn xóa các bản ghi đã chọn?')">Xóa</button>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="dataTables_paginate paging_simple_numbers" id="datatable-responsive_paginate">
                {{ $objItems->links() }}
              </div>
            </div>
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
        url: "{{ route('admin.adnews.news.confirm') }}",
        type: 'GET',
        cache: false,
        data: {aid:id},
        success: function(data){
          $('.confirm-news-'+id+' a').html(data);
        },
        error: function (){
          alert('Có lỗi xảy ra');
        }
      });
      return false;
    };
  </script>
@endsection