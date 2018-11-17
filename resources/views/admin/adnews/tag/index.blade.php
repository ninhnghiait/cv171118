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
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Tin tức <small>Tag</small></h3>
    </div>

  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><a href="{{ route('tags_admin.create') }}"><i class="fa fa-plus-square"></i> Thêm</a></h2>
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
                  <th class="column-title">Tên </th>
                  <th class="column-title">tag </th>
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
                        $id = $objItem->id_tag;
                        $name = $objItem->name;
                        $tag = $objItem->tag;
                        $urlEdit = route('tags_admin.edit', $id);
                        $urlDel  = route('tags_admin.destroy', $id);
                        $trrow = "odd";
                    @endphp
                    @if ($key % 2 == 0)
                        @php
                            $trrow = "even";
                        @endphp
                    @endif

                <tr class="{{ $trrow }} pointer">
                  <td class=" ">{{ $name }}</td>
                  <td class=" ">{{ $tag }}</td>
                  <td>
                    <button class="btn"><a href="{{ $urlEdit }}">Edit</a></button>
                    <form action="{{ $urlDel }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')"  style="display: inline">
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