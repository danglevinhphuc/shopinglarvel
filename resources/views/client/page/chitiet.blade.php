@extends('client.layout.index')
@section('contentClient')
@section('title')
  Shoping online| {{$product->category->ten}} | {{$product->ten}}
@endsection
	<section id="primary" class="main-content clearfix">
		
<!-- Begin breadcrumb -->
  <div class="breadcrumb clearfix">
    <span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="{{route('trangchu')}}" title="LKT Fashion" itemprop="url"><span itemprop="title">Trang chủ</span></a></span>
    <span class="arrow-space">&gt;</span>
    <span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
      
        <a href="#" title="All Products">{{$product->category->ten}}</a>
      
    </span>
    <span class="arrow-space">&gt;</span>
    <strong>{{$product->ten}}</strong>
  </div>
<!-- End breadcrumb -->
 @if(count($errors) > 0)
                        <div class="alert alert-danger" style="color: red;">
                            @foreach($errors->all() as $err)
                                {{$err}}<br/>
                            @endforeach
                        </div>
                    @endif
<div id="product" class="main-product asos-knitted-blazer-in-merino-wool-mix">
	
	<div class="product-slider">
    	<div class="list-zoom">
 			@foreach($product->hinhproduct as $hinh)
	            <div data-id="image_{{$hinh->id}}" class="jqzoom active" style="display: block;">							
	               <img alt="Khong co" src="storage/app/upload/product/{{$hinh->hinh}}" jqimg="storage/app/upload/product/{{$hinh->hinh}}">
				</div>
			@endforeach
		</div>
	</div>
	<header class="header-product">
		<h1 class="product-title">{{$product->ten}}</h1>
		<ul class="meta-product">
			
	      <li class="purchase">
	        <p class="product-price"><span class="price">
	        @if($product->promotion_price != null)
				{{number_format($product->promotion_price)}}₫
			@else
				{{number_format($product->unit_price)}}₫
			@endif
	        </span></p>
	      </li>
	      <li class="cart">
	      	
		      		
		      <form id="add-item-form" action="{{route('addCartChiTiet')}}" method="post" class="variants clearfix">		
		        <!-- Begin product options -->	
		        <input type="hidden" name="_token" value="{{csrf_token()}}">
		        <input type="hidden" name="id" value="{{$product->id}}">
		        @If($product->promotion_price != null)
	    	<input type="hidden" name="price" value="{{$product->promotion_price}}">
	      @else
	      	<input type="hidden" name="price" value="{{$product->unit_price}}">
	      @endif
		          <div class="select clearfix">
		            <div class="selector-wrapper">
		            <label for="product-select-option-0">Size</label>
		            <select class="single-option-selector" name="size">
		            <option value="L">L</option>
		            <option value="XL">XL</option>
		            </select></div>
		              
		            </select>
			          
			          <div class="selector-wrapper">
			            <label>Số lượng</label>
			            <span class="value">
			            	<input id="quantity" type="number" name="qty" min="1" value="1" class="tc item-quantity">
			            </span>
			          </div>
		          </div>	
		          <div class="purchase-section multiple">
		            <div class="purchase">
		              
		              <button type="submit" class="btn add-to-cart" name="add" value="fav_HTML">Giỏ Hàng</button>
		              <div class="cart-animation">1</div>
		              
		            </div>
		          </div>
		        <!-- End product options -->
		      </form>
	      </li>
		</ul>
	</header>
    <!-- Begin description -->
	  <div class="product-content entry-content clearfix">
	  	<h4 class="heading"><span>Thông tin sản phẩm</span></h4>
	    			{!!$product->description!!}									
				<!-- Begin tags -->
		      
      		<!-- End tags -->
			
	  </div>
    <!-- End description -->
  
  <!-- Begin social buttons -->
  <div class="socials-sharing">
<div class="social-sharing " data-permalink="https://lkt-fashion.myharavan.com/products/asos-knitted-blazer-in-merino-wool-mix">

  
    <a target="_blank" href="http://www.facebook.com/sharer.php?u=https://lkt-fashion.myharavan.com/products/asos-knitted-blazer-in-merino-wool-mix" class="share-facebook">
      <span class="icon icon-facebook" aria-hidden="true"></span>
      <span class="share-title">Facebook</span>
      
        
      
    </a>
  

  
    <a target="_blank" href="http://twitter.com/share?url=https://lkt-fashion.myharavan.com/products/asos-knitted-blazer-in-merino-wool-mix&amp;text=%C3%81o%20kho%C3%A1c%20Knitted" class="share-twitter">
      <span class="icon icon-twitter" aria-hidden="true"></span>
      <span class="share-title">Twitter</span>
      
        <span class="share-count">0</span>
      
    </a>
  

  

    
      <a target="_blank" href="http://pinterest.com/pin/create/button/?url=https://lkt-fashion.myharavan.com/products/asos-knitted-blazer-in-merino-wool-mix&amp;media=http://hstatic.net/610/1000038610/1/2015/9-30/image1xxl_1024x1024.jpg&amp;description=%C3%81o%20kho%C3%A1c%20Knitted" class="share-pinterest">
        <span class="icon icon-pinterest" aria-hidden="true"></span>
        <span class="share-title">Pinterest</span>
        
          
        
      </a>
    

    
      <a target="_blank" href="../../fancy.com/fancyit/logincb77.html?ItemURL=https://lkt-fashion.myharavan.com/products/asos-knitted-blazer-in-merino-wool-mix&amp;Title=%C3%81o%20kho%C3%A1c%20Knitted&amp;Category=Other&amp;ImageURL=//hstatic.net/610/1000038610/1/2015/9-30/image1xxl_1024x1024.jpg" class="share-fancy">
        <span class="icon icon-fancy" aria-hidden="true"></span>
        <span class="share-title">Fancy</span>
      </a>
    

  

  
    <a target="_blank" href="http://plus.google.com/share?url=https://lkt-fashion.myharavan.com/products/asos-knitted-blazer-in-merino-wool-mix" class="share-google">
      <!-- Cannot get Google+ share count with JS yet -->
      <span class="icon icon-google" aria-hidden="true"></span>
      
        <span class="share-count is-loaded">+1</span>
      
    </a>
  

</div>

  </div>
  <!-- End social buttons --> 


		
</div>
<div class="products-related">
    <h4 class="collection-title heading"><span>Sản phẩm liên quan</span></h4>
	<div class="products grid">

@foreach($productOther as $product)
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

		</section>
@endsection