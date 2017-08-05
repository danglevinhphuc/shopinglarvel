
@extends('client.layout.index')
@section('contentClient')
@section('title')
	Shoping online|Trang chủ
@endsection
<section id="primary" class="main-content clearfix">
		<!-- Start products -->


  <div class="clearfix helper-section products-section home-section">
	<h4 class="section-title"><span class="name">
		Sản Phẩm 
	</span></h4>
	<div class="products section-content grid clearfix">
	@foreach($product as $product)
<div class="product clear"> 

	<a href="{{route('chitiet',$product->id)}}" class="thumb">
		@foreach($product->hinhproduct as $hinh)
	  	<img src="storage/app/upload/product/{{$hinh->hinh}}" alt="MANGO Man">
	  @break
	  @endforeach
	  @If($product->promotion_price != null)
	  <span class="circle sale">Sale</span>
	  @Endif
	</a>

  <div class="details">
    <h4 class="title"><a href="{{route('chitiet',$product->id)}}">
      {{$product->ten}}
    </a></h4>
	  <p class="product-price">
	    <span class="price">{{number_format($product->promotion_price)}}₫</span>
	    @If($product->promotion_price != null)
	    <del class="old-price price">{{number_format($product->unit_price)}}₫</del>
	    @Endif
	  </p>
	  <p class="product-description">
	  </p>
	  <form action="{{route('addCart')}}" method="post" class="variants clearfix form-add-to-cart">
        <!-- Begin product options -->
        <input type="hidden" name="_token" value="{{csrf_token()}}">
	      <input type="hidden" name="id" value="{{$product->id}}">
	      <input id="quantity" type="hidden" name="quantity" value="1" class="tc item-quantity">
	      @If($product->promotion_price != null)
	    	<input type="hidden" name="price" value="{{$product->promotion_price}}">
	      @else
	      	<input type="hidden" name="price" value="{{$product->unit_price}}">
	      @endif
	      <button type="submit" class="add-to-cart btn" name="add" value="fav_HTML">Giỏ Hàng</button>
	      <div class="cart-animation">1</div>
        <!-- End product options -->
      </form>
      <a class="readmore button" href="{{route('chitiet',$product->id)}}">
	      Chi tiết
	  </a>
	  <span class="haravan-product-reviews-badge" data-id="1000829690"></span>
  </div>
</div>
@endforeach
	</div>
  </div>

<!-- End products -->

<!-- Start products -->


  <div class="clearfix helper-section products-section home-section">
	<h4 class="section-title"><span class="name">
		Sản phẩm Mới
	</span></h4>
	
    
	<div class="products section-content grid clearfix">
@foreach($productNew as $productNew)
<div class="product clear"> 

	<a href="{{route('chitiet',$productNew->id)}}" class="thumb">
		@foreach($productNew->hinhproduct as $hinh)
	  	<img src="storage/app/upload/product/{{$hinh->hinh}}" alt="MANGO Man">
	  @break
	  @endforeach
	  @If($productNew->promotion_price != null)
	  <span class="circle sale">Sale</span>
	  @Endif
	</a>

  <div class="details">
    <h4 class="title"><a href="{{route('chitiet',$productNew->id)}}">
      {{$productNew->ten}}
    </a></h4>
	  <p class="product-price">
	    <span class="price">{{number_format($productNew->promotion_price)}}₫</span>
	    @If($productNew->promotion_price != null)
	    <del class="old-price price">{{number_format($productNew->unit_price)}}₫</del>
	    @Endif
	  </p>
	  <p class="product-description">
	  </p>
	  <form action="{{route('addCart')}}" method="post" class="variants clearfix form-add-to-cart">
        <!-- Begin product options -->
        <input type="hidden" name="_token" value="{{csrf_token()}}">
	      <input type="hidden" name="id" value="{{$productNew->id}}">
	      <input id="quantity" type="hidden" name="quantity" value="1" class="tc item-quantity">
	      @If($productNew->promotion_price != null)
	    	<input type="hidden" name="price" value="{{$productNew->promotion_price}}">
	      @else
	      	<input type="hidden" name="price" value="{{$productNew->unit_price}}">
	      @endif
	      <button type="submit" class="add-to-cart btn" name="add" value="fav_HTML">Giỏ Hàng</button>
	      <div class="cart-animation">1</div>
        <!-- End product options -->
      </form>
      <a class="readmore button" href="{{route('chitiet',$productNew->id)}}">
	      Chi tiết
	  </a>
	  <span class="haravan-product-reviews-badge" data-id="1000829690"></span>
  </div>
</div>
@endforeach

	</div>
  </div>

<!-- End products -->

<!-- Start products -->

<!-- End products -->
		</section>
@endsection