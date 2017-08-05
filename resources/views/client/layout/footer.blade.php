
  <!-- Begin footer -->
  <footer class="footer">
  	<div class="footer-wrapper fix-width"> 
		<div class="widget about-us">
			<h4 class="widget-title">Chúng tôi là ai?</h4>
			<div class="widget-content">
				Team Liên Kết Trẻ tập hợp những lập trình viên trẻ tuổi, nhiệt huyết và có tinh thần trách nhiệm cao trong công việc, có trình độ cao trong lĩnh vực thiết kế website và internet marketting, được hỗ trợ bởi những thành viên có kinh nghiệm lâu năm, chúng tôi tự tin mang đến cho khách hàng những sản phẩm và dịch vụ tốt nhất.
			</div>
		</div>
        
        <!-- Begin footer navigation -->
        <div class="widget footer-menu">
          <h4 class="widget-title">Liên kết nhanh</h4>
          	<div class="widget-content">
	          	<ul class="menu-footer">
	            
	              <li><a href="{{route('trangchu')}}" title="Trang Chủ">Trang Chủ</a></li>
	            
	              <li><a href="{{route('gioithieu')}}" title="Giới thiệu">Giới thiệu</a></li>
	            
	          	</ul>
			</div>
        </div>
        <!-- End footer navigation -->
        

       
        <!-- Begin newsletter -->
          <div class="widget">
          	<h4 class="widget-title">Thông tin Shop</h4>
            <div class="widget-content">
            	LKT Fashion Shop<br />
Hotline: 0120 673 32xx<br />
Email: phucdangB1400718@gmail.com
<br />Website: <a href="https://www.facebook.com/profile.php?id=100004969819329">Phúc Đặng</a>
            	<ul class="credit-cards clearfix">
	            	<li><img src="storage/app/logo/icon-cc-visa2310.png" alt="Visa" /></li>
		            <li><img src="storage/app/logo/icon-cc-mastercard2310.png" alt="MasterCard" /></li>
		            <li><img src="storage/app/logo/icon-cc-amex2310.png" alt="Amex" /></li>
		            
		            
		            
		            
				</ul> <!-- /.credit-cards -->
            </div>
          </div>
        <!-- End newsletter -->
     </div>
    <!-- Begin copyright -->
    <div class="powered-by">
      <p>Bản quyền được đăng ký &copy; 2017 cho <a href="{{route('trangchu')}}" title="">LKT Fashion</a> | <a target='_blank' href='{{route("trangchu")}}'>Powered by Haravan</a></p>
    </div>
    <!-- End copyright -->
	</footer>
  <!-- End footer -->
  	<div class="overlay-background"></div>
	<div id="mobile-menu" class="show-mobile">
	<span class="close-menu-mobile"><i class="fa fa-close"></i></span>
	<ul class="menu">
	
	  
	  
	  @foreach($category as $category)
	  <li>
	    <a href="#" class="">
	      <span>{{$category->ten}}</span></a>
	  </li>
	  @endforeach
	  
	  
	
	  
      	
            
            <li><a class="reg" href="{{route('dangky')}}" title="layout.customer.create_account">Đăng ký</a></li>
            
            <li> <a class="log-only" href="{{route('dangnhap')}}" title="layout.customer.login">Đăng nhập</a></li>
		
      
	</ul>
</div>
  <script src='{{ asset("public") }}/client/js/jquery.flexslider-min2310.js?v=154' type='text/javascript'></script>

  
    <script src='{{ asset("public") }}/client/js/jquery.zoom2310.js?v=154' type='text/javascript'></script>
  
  <script src='{{ asset("public") }}/client/js/jquery.tweet2310.js?v=154' type='text/javascript'></script>
  <script src='{{ asset("public") }}/client/js/jquery.fancybox2310.js?v=154' type='text/javascript'></script>

</body>

<!-- Mirrored from lkt-fashion.myharavan.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Aug 2017 00:58:41 GMT -->
</html>