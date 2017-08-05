  <div id="menu-top">
    <div class="menu-wrap fix-width">
    	<ul class="menu">
    		<li class="support">
    			<span class="hotline">Hotline: 0120 673 32xx</span>
				
					<a class="social" href="http://facebook.com/"><fa class="fa fa-facebook"></fa></a>
				
				
					<a class="social" href="http://plus.google.com/"><fa class="fa fa-google-plus"></fa></a>
				
				
					<a class="social" href="http://twitter.com/"><fa class="fa fa-twitter"></fa></a>
				
				
					<a class="social" href="http://youtube.com/"><fa class="fa fa-youtube"></fa></a>
				
	        </li>
	      
			  
				  
				  <li>
				    <a href="{{route('trangchu')}}" class=" current">
				      <span>Trang Chủ</span></a>
				  </li>
				  
			  
				  
				  <li>
				    <a href="{{route('gioithieu')}}" class="">
				      <span>Giới thiệu</span></a>
				  </li>
                @if(Auth::check())
					<li><a class="reg" href="#" title="layout.customer.create_account">Chào bạn {{Auth::user()->name}}</a></li>	
					<li><a class="reg" href="{{route('dangxuat')}}" title="layout.customer.create_account">Đăng xuất</a></li>	
                @else
                <li><a class="reg" href="{{route('dangky')}}" title="layout.customer.create_account">Đăng ký</a></li>
                
                <li> <a class="log-only" href="{{route('dangnhap')}}" title="layout.customer.login">Đăng nhập</a></li>
                @endif
	      
		</ul>
    </div>
    </div>
  <!-- End toolbar -->
<header class="header">
	<div class="site-branding fix-width">
		<div class="logo">
            
	            <a href="{{ route('trangchu') }}" title="LKT Fashion"><img src="storage/app/logo/logo2310.png" alt="LKT Fashion" /></a>
	            
	            	<h1 class="site-title hidden"><a href="{{ route('trangchu') }}">LKT Fashion</a></h1>
	            
            
		</div>
      	
			<form class="search hide-mobile" action="{{route('tim')}}" method="GET">
				<input type="text" name="q" class="search_box" placeholder="Từ khóa ..." value=""  />
				<button type="submit" value="fav_HTML" id="go"><i class="fa fa-search"></i> Tìm kiếm</button>
			</form>
		
		<div class="right-header">
			<div id="cart-target" class="toolbar-cart ">
	            <a href="{{route('cart')}}" class="cart" title="Shopping Cart">
	              <span class="fa fa-shopping-cart"></span>
	              <span class="text">
	              		Giỏ hàng

	              		<span id="cart-count">
	              		<?php
	              			if(isset($cartItem)){
	              		?>
	              			 
	              			 @if(Cart::count() == 0) 
	              			 	{{'rỗng'}}
	              			 @else
								{{Cart::count()}} Sản phẩm
							 @endif
	              		<?php
	              			}else{
	              		?>
	              			{{'rỗng'}}
	              		<?php
							}
	              		?>
	              		</span>
	              </span>
	            </a>
			</div>
		</div>
	</div>
</header>
<div id="main-nav">
	<div class="fix-width">
		<span class="menu-mobile show-mobile"><i class="fa fa-bars"></i></span>
	    <nav class="menu hide-mobile">
	      <ul>
	
	  
	  @foreach($category as $category)
	  <li>
	    <a href="{{route('danhmuc',$category->tenkhongdau)}}" class="">
	      <span>{{$category->ten}}</span></a>
	  </li>
	  @endforeach
	  
	  
	  
	  
  
</ul>
	    </nav> <!-- /.main -->
      	
			<form class="search show-mobile" action="{{route('tim')}}" method="GET">
				<input type="text" name="q" class="search_box" placeholder="Từ khóa ..." value=""  />
				<button type="submit" value="fav_HTML" id="go"><i class="fa fa-search"></i> </button>
			</form>
		 
	</div>
</div>