@extends('templates.admin.master')
@section('content')
<form id="dellmore" action="{{ route('cmt_admin.delmore') }}" method="post" class="form-horizontal form-label-left">
{{ csrf_field() }}
</form>
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Bình luận <small>danh sách</small></h3>
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
                  <th>
                    <input type="checkbox" id="check-all-vne" class="flat">
                  </th>
                  <th class="column-title">Tên </th>
                  <th class="column-title">email </th>
                  <th class="column-title">comment </th>
                  <th class="column-title">Tin</th>
                  <th class="column-title">Thời gian</th>
                  <th class="column-title">Confirm </th>
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
                        $id = $objItem->id_cmt;
                        $name = $objItem->name;
                        $email = $objItem->email;
                        $content = $objItem->content;
                        $nname = $objItem->nname;
                        $confirm = $objItem->confirm;
                        $created_at = date('H:i:s d:m:Y',strtotime($objItem->created_at));
                        $urlDel  = route('cmt_admin.destroy', $id);
                        $trrow = "odd";
                    @endphp
                    @if ($key % 2 == 0)
                        @php
                            $trrow = "even";
                        @endphp
                    @endif

                <tr class="{{ $trrow }} pointer">
                  <td class="a-center ">
                    <input form="dellmore" type="checkbox" class="flat vnedel" name="cmtdel[]" value="{{ $id }}">
                  </td>
                  <td class=" ">{{ $name }}</td>
                  <td class=" ">{{ $email }}</td>
                  <td class=" ">{{ $content }}</td>
                  <td class=" ">{{ $nname }}</td>
                  <td class=" ">{{ $created_at }}</td>
                  <td class="confirm-news-{{ $id }}">
                    @if ($confirm == 1)
                      <a href="#" onclick="return active('{{ $id }}')" style="font-size: 18px"><i class="fa fa-check-square"></i></a>
                    @else
                      <a href="#" onclick="return active('{{ $id }}')" style="font-size: 18px"><i class="fa fa-times-circle"></i></a>
                    @endif
                  </td>
                  <td>
                    <form action="{{ $urlDel }}" onsubmit="return confirm('Are you sure!')" method="post">
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
            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <button type="submit" name="del" form="dellmore" class="btn btn-success" onclick="return confirm('Bạn thực sự muốn xóa các bản ghi đã chọn?')">Xóa</button>
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
        url: "{{ route('admin.adnews.cmt.confirm') }}",
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