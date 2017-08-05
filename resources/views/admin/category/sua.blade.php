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
                            <small>Sửa danh mục sản phẩm</small>
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
                        <form action="{{route('suacategory',$category->id)}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên danh mục <span class="bat-buoc" >(*)</span></label>
                                <input type="text" class="form-control" value="{{$category->ten}}" name="ten" placeholder="Tên danh mục...">
                            </div>
                            <button type="submit" class="btn btn-primary">Sửa danh mục</button>
                            <a href="{{route('danhsachcategory')}}" type="reset" class="btn btn-danger">Back</a>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        @endsection