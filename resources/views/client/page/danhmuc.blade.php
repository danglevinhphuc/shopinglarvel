@extends('client.layout.index')
@section('contentClient')
@section('title')
  Shoping online| {{$ten}}
@endsection
<section id="primary" class="main-content clearfix">
		
  <!-- Begin collection info -->
      <!-- Begin breadcrumb -->
      <div class="breadcrumb clearfix">
        <span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="{{route('trangchu')}}" title="LKT Fashion" itemprop="url"><span itemprop="title">Trang chủ</span></a></span>
        <span class="arrow-space">&gt;</span>
        <span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="#" title="Áo Khoác Nam" itemprop="url"><span itemprop="title">{{$ten}}</span></a></span>
      </div>
      <!-- End breadcrumb -->

      <!-- Begin sort collection -->
      <header class="archive-header">
        <h1 class="collection-title archive-title">{{$ten}}</h1>
        <div class="meta-tools">      
	          <div class="change-layout">
	          	<span class="layout " data-name="grid"><i class="fa fa-th"></i></span>
	          	<span class="layout select" data-name="row"><i class="fa fa-th-list"></i></span>
	          </div>        
        </div>
      </header>

  
  <div class="products row clearfix change-layout"> 
    
    	
        	



@foreach($product as $product)
<div class="product clear" > 

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
  <div class="navigation">
</div> 

  
<script>
  Haravan.queryParams = {};
  if (location.search.length) {
    for (var aKeyValue, i = 0, aCouples = location.search.substr(1).split('&'); i < aCouples.length; i++) {
      aKeyValue = aCouples[i].split('=');
      if (aKeyValue.length > 1) {
        Haravan.queryParams[decodeURIComponent(aKeyValue[0])] = decodeURIComponent(aKeyValue[1]);
      }
    }
  }
  var collFilters = jQuery('.coll-filter');
  collFilters.change(function() {
      var newTags = [];
      var newURL = '';
      delete Haravan.queryParams.page;
      collFilters.each(function() { 
        if (jQuery(this).val()) {
          newTags.push(jQuery(this).val());
        }
      });
      
      if (newTags.length) {
        Haravan.queryParams.constraint = newTags.join('+');        
      }
      else {
        delete Haravan.queryParams.constraint;
      }
      location.search = jQuery.param(Haravan.queryParams).replace(/\+/g, '%20');
            
  });
  jQuery('.sort-by')
    .val('created-descending')
    .bind('change', function() {
      Haravan.queryParams.sort_by = jQuery(this).val();
      location.search = jQuery.param(Haravan.queryParams).replace(/\+/g, '%20');
    });
</script>

		</section>
		@endsection