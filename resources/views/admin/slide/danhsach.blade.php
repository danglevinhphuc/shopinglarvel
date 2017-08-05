
@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<style type="text/css">
   tr td .fa{
        font-size: 30px !important;
    }
    .danger{
        color: red !important; 
    }
    .success{
        color: green !important;
    }   
</style>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>Danh sách slider sản phẩm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                     @if(Session::has("thanhcong"))
                        <div class="alert alert-success">
                            {{Session::get('thanhcong')}}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover text-center" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Hình</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($slide as $slide)
                            <tr>
                                <td>{{$slide->id}}</td>
                                <td><img src="storage/app/upload/slide/{{$slide->hinh}}" height="100px" width="350px"></td>
                                <td><a href="admin/slide/xoa/{{$slide->id}}"><i class="fa fa-trash-o danger" aria-hidden="true" onClick="javascript:return confirm('Bạn có muốn  xoá slide này không??' );"></i></a></td>
                                    <td><a href="admin/slide/sua/{{$slide->id}}"><i class="fa fa-pencil-square-o success" aria-hidden="true"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection