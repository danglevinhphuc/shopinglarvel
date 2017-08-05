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
                <h1 class="page-header">Products
                    <small>Sửa thông tin cho sản phẩm</small>
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
                <form action="{{route('suaproducts',$product->id)}}" method="POST"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Tên sản phẩm: <span class="bat-buoc" >(*)</span></label>
                        <input type="text" name="ten" placeholder="Tên sản phẩm..." class="form-control" value="{{$product->ten}}">
                    </div>
                    <div class="form-group">
                        <label>Chọn danh mục cho sản phẩm: <span class="bat-buoc" >(*)</span></label>
                        <select name="category" class="form-control">
                            @foreach($category as $category)
                                @if($product->id_category == $category->id)
                                    <option value="{{$category->id}}" selected="true">{{$category->ten}}</option>    
                                @else
                                    <option value="{{$category->id}}" >{{$category->ten}}</option>    
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mô tả sản phẩm: <span class="bat-buoc" >(*)</span></label>
                        <textarea id="demo" class="ckeditor" name="description">{{$product->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Giá góc: <span class="bat-buoc" >(*)</span></label>
                        <input type="number" name="unit_price" placeholder="Giá góc sản phẩm ..." class="form-control" value="{{$product->unit_price}}">
                    </div>
                    <div class="form-group">
                        <label>Giá khuyến mãi:</label>
                        <input type="number" name="promotion_price" placeholder="Giá khuyến mãi sản phẩm ..." class="form-control" min="0" value="{{$product->promotion_price}}">
                    </div>
                    <div class="form-group">
                        <label>Sản phẩm mới:</label><br/>
                        @if($product->new == 1)
                            Có:<input type="radio" name="new" value="1" checked="true">
                            Không:<input type="radio" name="new" value="0" >
                        @else
                            Có:<input type="radio" name="new" value="1" >
                            Không:<input type="radio" name="new" value="0" checked="true">
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Sửa Sản Phẩm</button>
                    <a href="{{route('suaproducthinh',$product->id)}}" type="reset" class="btn btn-warning">Sửa hình sản phẩm</a>
                    <a href="{{route('danhsachproducts')}}" type="reset" class="btn btn-danger">Back</a>
                    <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        @endsection