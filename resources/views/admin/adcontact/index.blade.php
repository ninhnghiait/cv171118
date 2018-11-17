@extends('templates.admin.master')
@section('content')
<form action="{{-- {{ route('vinaenter.vneuser.delall') }} --}}" method="post" class="form-horizontal form-label-left">
{{ csrf_field() }}
</form>
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Liên hệ <small>contact</small></h3>
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
              <thead>
                <tr class="headings">
                  <th class="column-title">Tên </th>
                  <th class="column-title">Email </th>
                  <th class="column-title">Phone </th>
                  <th class="column-title">Địa chỉ </th>
                  <th class="column-title">Message </th>
                  <th class="column-title">Time </th>
                  <th class="column-title no-link last"><span class="nobr">Chức năng</span></th>
                  <th class="bulk-actions" colspan="7">
                    <a class="antoo" style="color:#fff; font-weight:500;">Chọn ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                  </th>
                </tr>
              </thead>

              <tbody>

              @if (!$objItems->first())
                @php
                    $colspan = 6;
                @endphp
                <tr class="even pointer">
                  <td class="a-center " colspan="{{ $colspan }}">
                     <p>Chưa có dữ liệu</p>
                  </td>
                </tr>
              @else
                @foreach ($objItems as $key => $objItem)
                    @php
                        $id = $objItem->id_ct;
                        $name = $objItem->name;
                        $email = $objItem->email;
                        $phone = $objItem->phone;
                        $address = $objItem->address;
                        $content = $objItem->content;
                        $created_at = date('H:i:s d-m-Y',strtotime($objItem->created_at));
                        $urlDel  = route('contact_admin.destroy', $id);

                        $trrow = "odd";
                    @endphp
                    @if ($key % 2 == 0)
                        @php
                            $trrow = "even";
                        @endphp
                    @endif

                <tr class="{{ $trrow }} pointer">
                  <td class=" ">{{ $name }}</td>
                  <td class=" ">{{ $email }}</td>
                  <td class=" ">{{ $phone }}</td>
                  <td class=" ">{{ $address }}</td>
                  <td class=" ">{{ $content }}</td>
                  <td class=" ">{{ $created_at }}</td>
                  <td>
                    <form action="{{$urlDel}}" method="post">
                      @csrf
                      @method('delete')
                      <input type="submit" class="btn" value="Delete">
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
