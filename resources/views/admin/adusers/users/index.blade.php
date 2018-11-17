@extends('templates.admin.master')
@section('css')
<style>
.a-edit {
  background-color: #ddd;
}
</style>
@endsection
@section('content')
<form id="dellall" action="{{ route('users_admin.dellall') }}" method="post" class="form-horizontal form-label-left">
{{ csrf_field() }}
</form>
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Người dùng <small>Danh sách</small></h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><a href="{{ route('users_admin.create') }}"><i class="fa fa-plus-square"></i> Thêm</a></h2>
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
                  <th>
                    <input form="dellall" type="checkbox" id="check-all-vne" class="flat">
                  </th>
                  <th class="column-title">Tên(username) </th>
                  <th class="column-title">Nhóm </th>
                  <th class="column-title">Email </th>
                  <th class="column-title">Fullname </th>
                  <th class="column-title no-link last"><span class="nobr">Chức năng</span></th>
                  <th class="bulk-actions" colspan="7">
                    <a class="antoo" style="color:#fff; font-weight:500;">Chọn ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                  </th>
                </tr>
              </thead>

              <tbody>
              @if (!$objItems->first())
                @php
                    $colspan = 7;
                @endphp
                <tr class="even pointer">
                  <td class="a-center " colspan="{{ $colspan }}">
                     <p>Chưa có dữ liệu</p>
                  </td>
                </tr>
              @else
                @foreach ($objItems as $key => $objItem)
                    @php
                        $id = $objItem->id;
                        $arGroup = $objmGroup->getItemsAllByUid($id);
                        $username = $objItem->username;
                        $fullname = $objItem->fullname;
                        $urlEdit = route('users_admin.edit', $id);
                        $urlDel  = route('users_admin.destroy', $id);

                        $trrow = "odd";
                    @endphp
                    @if ($key % 2 == 0)
                        @php
                            $trrow = "even";
                        @endphp
                    @endif
                <tr class="{{ $trrow }} pointer">
                  <td class="a-center ">
                    <input form="dellall" type="checkbox" class="flat vnedel" name="vnedel[]" value="{{ $id }}">
                  </td>
                  <td class=" ">{{ $username }}</td>
                  <td class=" ">
                      @if (count($arGroup) > 0)
                          @foreach ($arGroup as $key => $arV)
                              {{$arV->name}} {{ ($key+1) != count($arGroup)?'|':'' }}
                          @endforeach
                      @else
                        News user
                      @endif
                  </td>
                  <td class=" ">{{ $objItem->email }}</td>
                  <td class=" ">{{ $objItem->fullname }}</td>
                  <td style="width: 20%;">
                    <a class="btn a-edit" href="{{$urlEdit}}">Edit</a>
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
                <button form="dellall" type="submit" name="del" class="btn btn-success" onclick="return confirm('Bạn thực sự muốn xóa các bản ghi đã chọn?')">Xóa</button>
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