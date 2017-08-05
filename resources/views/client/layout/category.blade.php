<section id="secondary" class="sidebar">
			
	
	<aside id="list-products" class="widget">
		<h4 class="widget-title">Danh Mục Sản Phẩm</h4>
		<div class="widget-content">
			<ul class="menu">
			
			  
			  @foreach($category as $category)
	  <li>
	    <a href="{{route('danhmuc',$category->tenkhongdau)}}" class="">
	      <span>{{$category->ten}}</span></a>
	  </li>
	  @endforeach
			  
			  
  			</ul> 
  		</div>
  	</aside>
  

  
  <div class="widget support-online">
  	<h4 class="widget-title">Hỗ Trợ Trực Tuyến</h4>
  	<div class="widget-content">
	  	
		<div class="supports">
			
			<div class="people">
			<p><span class="name">Mr. Tin</span></p>
			<a href="ymsgr:sendIM?tinhuynhquoctin" class="yahoo"><img alt="yahoo" src="storage/app/logo/yahoo2310.png"></a>
			<a href="skype:huynhtin_92?call" class="skype"><img alt="skype" src="storage/app/logo/skype2310.png"></a><p></p>
			<p><span class="label">Điện thoại:</span><span class="tel">0985 984 021</span></p>
			</div>
			
			
			<h4 style="margin: 0; font-size: 14px; font-size: 1.4rem; border-top: 1px solid #eee">Thời gian làm việc</h4>
Bất cứ khi nào bạn cần, hỗ trợ 24/7, 7 ngày trong tuần
		</div>
	  </div>
  </div>
  
  
 
  
  
  <div class="widget custom">
  	
  		<h4 class="widget-title">Chúng tôi trên MXH</h4>
  		<div class="widget-content">
  	
  		<div class="fb-page" data-href="https://www.facebook.com/lienkettreteam" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/lienkettreteam"><a href="https://www.facebook.com/lienkettreteam">Liên Kết Trẻ Team</a></blockquote></div></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "../connect.facebook.net/vi_VN/sdk.html#xfbml=1&version=v2.4&appId=732043950258590";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	
	  	</div>
	
  </div>
  
  
  
		</section>