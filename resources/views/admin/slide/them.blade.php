@extends('admin.layout.index')
@section('content')
<style type="text/css">
    .bat-buoc{
        color: red;
    }
</style>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>Thêm hình ảnh cho slider</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                    {{$err}}<br/>
                    @endforeach
                </div>
                @endif

                @if(Session::has("thanhcong"))
                <div class="alert alert-success">
                    {{Session::get('thanhcong')}}
                </div>
                @endif
                <form action="{{route('themslide')}}" method="POST"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Chọn hình <span class="bat-buoc" >(*)</span></label>
                        <input type="file" name="file[]" class="form-control" multiple="true" required="true" accept="image/gif, image/jpeg, image/png" /><br/>
                        <div class="add_file"></div>
                        <button id="chon-them" type="button" class="btn btn-default">Chọn thêm hình</button>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm slide</button>
                    <a href="{{route('danhsachslide')}}" type="reset" class="btn btn-danger">Back</a>
                    <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        @endsection

        @section('script')
        <script type="text/javascript">
            $(document).ready(function(){
                $("#chon-them").on('click',function(){
                    $(".add_file").append('<input type="file" name="file[]" class="form-control" multiple="true" accept="image/gif, image/jpeg, image/png" /><br/>');
                });
            });
        </script>
        @endsection