@extends('client.layout.index')
@section('contentClient')

<section id="primary" class="main-content clearfix">
		<div id="search">
  <header class="archive-header">
  	<h1 class="archive-title">Kết quả tìm kiếm</h1>
  </header>
  <div class="search-content">
  <!-- Begin results -->
  @foreach($products as $product)
  <div class="entry results">
	<a href="{{route('chitiet',$product->id)}}" class="thumb">
    @foreach($product->hinhproduct as $hinh)
    <img src="storage/app/upload/product/{{$hinh->hinh}}" alt="" width="100px" height="100px"></a>
    @break
    @endforeach
	  <div class="search-result">
	    <h3 class="entry-title"><a href="{{route('chitiet',$product->id)}}" title="">{{$product->ten}}</a></h3>
	    
	  </div>
  </div>
  @endforeach
  <div class="row text-center">{{$products->links()}}</div>
  <div class="navigation">
    

</nav>
</div> 
	</div>
  	
</div> <!-- /#search -->
		</section>
    @endsection