@extends('templates.admin.master')
@section('css')
<style>
  .picture-project {
    width: 130px;
    border-radius: 7px;
    border: 2px solid #5580aa;
  }
</style>
@endsection
@section('content')
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>CV <small>list</small></h3>
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
            <form action="{{route('admin.admyinfo.cv.upload')}}" id="upload_form" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
            <table class="table table-striped jambo_table bulk_action">
              <thead>
                <tr class="headings">
                  <th class="column-title">Ngôn ngữ</th>
                  <th class="column-title">Link</th>
                  <th class="column-title">Filename</th>
                  <th class="column-title no-link last"><span class="nobr">Chức năng</span></th>
                </tr>
              </thead>
              
              <tbody>
                @foreach($objItems as $vl)
                <tr class="pointer">
                  <td class=" ">{{$vl->lang == 'vi' ? 'Việt Nam' : 'English'}}</td>
                  <td><a href="{{$vl->link}}">{{$vl->link}}</a></td>
                  <td>{{$vl->file_name}}</td>
                  <td class="last" width="10%">
                    @php
                    $editUrl = route('admin.admyinfo.cv.edit',$vl->id);
                    @endphp
                    <a href="" data-toggle="modal" data-target="#editModal" onclick="return $('#form-edit').attr('action','{{$editUrl}}');">Edit</a> | 
                    <a href="{{route('admin.admyinfo.cv.readcv',$vl->lang)}}">Download</a> | 
                    <a class="upload" style="cursor: pointer;">Upload</a>
                    <input type="file" name="file{{$vl->id}}" style="display: none" onchange="return $('#submit-form').click();" />
                  </td>
                </tr>
                @endforeach
              </tbody>              
            </table>
            <input type="submit" id="submit-form" style="display: none;">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" id="form-edit" method="post">
        {{ csrf_field() }}
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Link</h5>
        </div>
        <div class="modal-body">
        <input type="url" name="link" required="" class="form-control" placeholder="Enter link">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
  $('.upload').click(function(){
    $(this).next().click();
  });
</script>
@endsection
