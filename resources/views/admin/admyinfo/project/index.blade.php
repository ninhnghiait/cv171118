@extends('templates.admin.master')
@section('css')
<style>
.a-edit {
  background-color: #ddd;
}
.picture-project {
    width: 130px;
    border: 1px solid #5580aa;
    transition: transform .2s;
}
.picture-project:hover {
    transform: scale(2.5);
}
</style>
@endsection
@section('content')
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Thông tin <small>Project</small></h3>
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
          <h2><a href="{{ route('project_admin.create') }}"><i class="fa fa-plus-square"></i> Thêm</a></h2>
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
              <thead>
                <tr class="headings">
                  <th class="column-title">Tên dự án </th>
                  <th class="column-title">link</th>
                  <th class="column-title">Sort</th>
                  <th class="column-title">Hình ảnh</th>
                  <th class="column-title">Ngôn ngữ</th>
                  <th class="column-title no-link last"><span class="nobr">Chức năng</span></th>
                  <th class="bulk-actions" colspan="7">
                    <a class="antoo" style="color:#fff; font-weight:500;">Chọn ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                  </th>
                </tr>
              </thead>

              <tbody>

              @if (!$objItems->first())
                @php
                    $colspan = 4;
                @endphp
                <tr class="even pointer">
                  <td class="a-center " colspan="{{ $colspan }}">
                     <p>Chưa có dữ liệu</p>
                  </td>
                </tr>
              @else
                @foreach ($objItems as $key => $objItem)
                    @php
                        $id = $objItem->id_prj;
                        $name = $objItem->name;
                        $link = $objItem->link;
                        $sort = $objItem->sort;
                        $picture = $objItem->picture;
                        $lang = $objItem->lang;
                        $arPic = explode('|', $picture);
                        $urlEdit = route('project_admin.edit', $id);
                        $urlDel  = route('project_admin.destroy', $id);

                        $trrow = "odd";
                    @endphp
                    @if ($key % 2 == 0)
                        @php
                            $trrow = "even";
                        @endphp
                    @endif

                <tr class="{{ $trrow }} pointer">
                  <td class=" ">{{ $name }}</td>
                  <td class=" ">{{ $link }}</td>
                  <td class=" ">{{ $sort }}</td>
                  <td class=" ">
                    @if ($picture != '')
                          @foreach ($arPic as $key => $v)
                            @if ($v != '')
                            <img src="{{ Storage::url('app/media/files/project/'.$v) }}" class="picture-project" alt="">
                            @endif
                          @endforeach
                    @else
                      <img src="{{ Storage::url('app/media/files/project/nopicture.png') }}" class="picture-project" alt="">
                    @endif
                  </td>
                  <td>{{$lang}}</td>
                  <td>
                    <a class="btn a-edit" href="{{$urlEdit}}">Edit</a>
                    <form action="{{$urlDel}}" method="post" style="display: inline;">
                      @csrf
                      @method('delete')
                      <input type="submit" value="Delete" class="btn">   
                    </form>
                  </td>
                </tr>
                @endforeach
              @endif
              </tbody>              
            </table>
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
