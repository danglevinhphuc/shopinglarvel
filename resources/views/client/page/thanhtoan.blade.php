

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>
		LKT Fashion - Thanh toán đơn hàng
	</title>

	
	<meta name="description" content="LKT Fashion - Thanh to&#225;n đơn h&#224;ng" />
	
	<link href='{{ asset("public") }}/css/check_out.css' rel='stylesheet' type='text/css'  media='all'  />
	<script src='{{ asset("public") }}/js/jquery.min.js' type='text/javascript'></script>
	<script src='{{ asset("public") }}/js/jquery.validate.js' type='text/javascript'></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=no">

	<script type='text/javascript'>
//<![CDATA[
if ((typeof Haravan) === 'undefined') {
  Haravan = {};
}
Haravan.culture = 'vi-VN';
Haravan.shop = 'lkt-fashion.myharavan.com';
Haravan.theme = {"name":"lkt-fashion","id":1000061625,"role":"main"};
Haravan.domain = 'lkt-fashion.myharavan.com';
//]]>
</script>

	<script type="text/javascript">
	    var parseQueryString = function() {

	        var str = window.location.search;
	        var objURL = {};

	        str.replace(
            new RegExp("([^?=&]+)(=([^&]*))?", "g"),

            function($0, $1, $2, $3) {
                if($3 != undefined && $3 != null)
                    objURL[$1] = decodeURIComponent($3);
                else
                    objURL[$1] = $3;
            });
	        return objURL;
	    };
	    var params = parseQueryString();
	    var flag = true;
	    $(document).ready(function () {

	        // submit function
	        var submitFormStep1 = function() {
	            var fvaild = true;
	            var $this = $(this);

	            if($(this).attr('required') && ($(this).val() == "" || $(this).val() == null)) {
	                fvaild = false;
	                $(this).valid();
	            }
	            if(fvaild) {
	                $(".form-group .formcontrol").each(function() {
	                    if($(this).attr('required') && ($(this).val() == "" || $(this).val() == null)) {
	                        fvaild = false;
	                    }
	                });
	            }
	            if (fvaild) {
					
	                $(".summary").hide();
	                $('.listerror').html('');
                    
	                $.ajax({
	                    type: "POST",
	                    url: $("#forminfo").attr("action"),
	                    data: $("#forminfo").serialize(), // serializes the form's elements.
	                    success: function (data) { 
	                        if(data.pm_changed)
	                        {
	                            if(data.pm != null && data.pm != undefined && data.pm!="")
	                            {
	                                var ajaxdata = $.parseJSON(data.pm);
	                                $(".shiping-ajax").html('');
	                                $(ajaxdata).each(function(){
	                                    var instr = $(this)[0].instruction != null ? $(this)[0].instruction : '';
	                                    $(".shiping-ajax").append('<label class="lb-method"> <input class="input-method" type="radio"  name="gateway" value="'+$(this)[0].id+'"> <span class="label-radio"> ' + $(this)[0].name + '</span> </label><span class="desc" >' + instr + '</span>');
	                                });
	                                $(".shiping-ajax input:first").attr("checked", "checked").change();
	                            }
	                        }
	                        
	                        if(data.orderid == undefined)
	                        {
	                            $("#purchase-form").attr("action", "/checkout/create_order");
	                            $("#discount-apply").val("/checkout/create_order");
	                        }
	                        else 
	                        {
	                            
	                            $("#purchase-form").attr("action", "/orders/" + data.orderid + "/pay");
	                            $("#discount-apply").val("/orders/" + data.orderid + "/apply_discount");
	                            
	                            $("#ab_number_fn").val(data.orderid);
	                            $("#ab_number").val(data.orderid);
	                        }

	                        if (data.error) {
	                            if (data.message != undefined && data.message != ""){
	                                $('.listerror').html('<div class="error">' + data.message + '</div>');
	                                $(".drop_shipping, .h-shipping").hide();

	                                return false;
	                            }
	                        }

	                        var json = $.parseJSON(data.data);
	                        
	                        $(".drop_shipping").html("");
	                        $(json).each(function () {
	                            
	                            if($(this)[0].shipping_district_rates && $(this)[0].shipping_district_rates.length > 0  && $('#shipping_district') && ($('#shipping_district').val()!="" && $('#shipping_district').val()!=null ) )
	                            {
	                                for (var i = 0; i < $(this)[0].shipping_district_rates.length; i++) {
	                                    var _districtRate = $(this)[0].shipping_district_rates[i];
	                                    var _provinceId = $('#billing_address_province').val();
	                                    var _districtId = $('#shipping_district').val();
	                                    if(_districtRate.province_id == _provinceId && _districtRate.district_id == _districtId)
	                                    {
	                                        $(".drop_shipping").append("<option value='" + $(this)[0].id + "'>" + $(this)[0].name + " - " + _districtRate.final_rate + "</option>");
	                                    }
	                                }
	                            }
	                            else {
	                                $(".drop_shipping").append("<option value='" + $(this)[0].id + "'>" + $(this)[0].name + " - " + $(this)[0].shipping_price + "</option>");
	                            }
	                            
	                        });

	                        if ($(".drop_shipping option").length > 0) {
	                            $(".drop_shipping").change();
	                            $(".drop_shipping, .h-shipping").show();
                                
	                            if($.inArray($this[0], $("#billing_address_province,#order_email,#shipping_district"))>=0 && $this.attr('required') )
	                            {
	                                removeCoupon();
	                            }
	                        } else {
	                            $(".drop_shipping, .h-shipping").hide();
	                        }
	                    }
	                });
	            } else {
	                $(".summary").show();
	                $(".drop_shipping, .h-shipping").hide();
	            }
	        };
	       
	        if (params["province_id"] != undefined) {
	            $("#billing_address_province").val(params["province_id"] );
	        }
	        if (params["note"] != undefined) {
	            $("#billing_note").val(params["note"] );
	        }

	        $("#forminfo").validate({
	            errorPlacement: function(){
	                return false;
	            },
	            rules: {
	                'billing_address[phone]': {
	                    minlength: 8,
	                    maxlength: 11,
	                    number:true
	                }
	            }
	        })
	        //Lấy thông tin browWWserWW
	        $.ajax({
	            type: 'POST',
	            url: '/browser-info?w=' + $(window).width() + '&h=' + $(window).height(),
	            success: function() {}
	        });
	        $("#Loading").hide();
	        //Hiện loading khi ajax
	        $(document).ajaxStart(function() {
	            $('.overlay').show();
	            $("#Loading").show();
	        }).ajaxStop(function() {
	            $("#Loading").hide();
	            $('.overlay').hide();
	        });
	        //Hien mo tả field form
			
	        

	        // Hiện ẩn hiện thông tin mô tả hình thức thanh toán
	        $('.shiping-ajax').on('change',".input-method",function(){
	            if($(this).is(":checked")){
	                var checkinput= $(this).parent(".lb-method");
	                if(checkinput.next('.desc').is(":hidden") && checkinput.next('.desc').text().trim()!=""){
	                    $('.desc').slideUp();
	                    checkinput.next('.desc').slideDown().css('display', 'block');
	                }
	            }
	        });
	        //Hiện thông tin mô tả default
	        $(".input-method:checked").parent(".lb-method").next('.desc').slideDown().css('display', 'block');
            
	        // Lấy phương thức vẩn chuyển sau khi thay đổi hình thức thanh toán
	        $(".drop_shipping").change(function () {
	            var $this = $(this);
	            if ($this.val() == null || $('#billing_address_province').val() == null)
	                return;
	            $.ajax({
	                type: "GET",
	                url: '/checkout/get_shipping?id=' + $('#ab_number_fn').val() + '&shipping_rate=' + $this.val() + '&province_id=' + $('#billing_address_province').val()+ '&district_id=' + $('#shipping_district').val(),
	                success: function (data) {
	                    $(".shiping-price label").html(data.sp_price);
	                    $(".total-checkout span").html(data.tt_price);
                        
	                    

	                    if (data.error) {
	                        $('.listerror').html('<div class="error">Không tìm thấy phương thức vận chuyển.</div>');
	                        $(".drop_shipping, .h-shipping").hide();
	                    }
	                }
	            });
	        });

	        //check submit form checkout
	        $("#purchase-form").submit(function () {
	            

	            var isvalid = $("#forminfo").valid() 
					&& ($(".h-shipping").is(":visible") || $(".h-shipping").hasClass('hide-shipping'));
                
	            if (isvalid) {
	                $(".summary").hide();
	                $('.btn-checkout').attr('disabled','disabled');
	                return true;
	            } else {
	                if($("#forminfo").valid() == false) {
	                    $(".summary").show();
	                    $('.listerror').html("");
	                    $(".drop_shipping, .h-shipping").hide();
	                } else {
	                    $('.listerror').html('<div class="error">Không tìm thấy phương thức vận chuyển.</div>');
	                    $(".drop_shipping, .h-shipping").hide();
	                }
	            }

	            

	            return isvalid;
	        });
	      
	        window.districtid='';
	        function getOrderHistory(control) {
	            var $this = control;
	            $.ajax({
	                type: "POST",
	                url: '/checkout/get_address',
	                async :false,
	                data: { id: control.val() }, // serializes the form's elements.
	                success: function (data) {
	                    $('#billing_address_full_name').val(data.last_name + ' ' + data.first_name);
	                    $('#order_email').val('');
	                    $('#billing_address_phone').val(data.phone);
	                    $('#billing_address_address1').val(data.address1);
	                    $('#billing_address_province').val(data.provinceid);
	                    getListDistrict(data.provinceid);
	                    $('#shipping_district').val(data.districtid);
	                    // $("#billing_address_province").change();
	                }
	            });
	        }
	        $("#billing_address_customer").change(function () {
	            getOrderHistory($(this));
	        });
            
	        
	        var getListDistrict = function(province_id) {
	            $.ajax({
	                type: "POST",
	                url: '/checkout/getlistdistrict',
	                async: false,
	                data: { province_id: province_id },
	                success: function (result) {
	                    if (result != null && result.length > 0) {
	                        var html = "";
	                        html +='<option value="" selected>'+'Vui lòng chọn quận/huyện.'+'</option>';
	                        for(var i = 0; i < result.length; i++) {
	                            html += "<option value=\"" + result[i].id + "\">" + result[i].name + "</option>\n";
	                        }
	                        $('#shipping_district').html(html);
	                        $('#shipping_district_container').removeClass('hidden');
	                    } else {
	                        $('#shipping_district_container').addClass('hidden');
	                        $('#shipping_district').html("");
	                    }
	                    if(window.districtid && window.districtid != 0){
	                        $('#shipping_district').val(window.districtid);
	                    }
	                    
	                }
	            });
	        };
	        getListDistrict($('#billing_address_province').val());
	        $('#billing_address_province').change(function() {
	            getListDistrict($(this).val());
	        });
	        

	        //Nếu form hợp lệ thì khởi tạo đơn hàng bước 1
	        $(".form-group .formcontrol").change(function () {
	            submitFormStep1();
	        });
	        
	        //Mở form nhập coupon
	        $('.btn-coupon').click(function () {
	            $(".use-coupon").show();
	            $('.couponcode').focus();
	            $('.continue-coupon').hide();
	            $('.cancel-coupon').hide();
	            $('.btn-submit-coupon').show();
	            $(this).hide();
	            return false;
	        });
	        //Nếu k nhập mã coopon thì đóng form lại
	        $('.couponcode').focusout(function () {
	            if ($(this).val() == "") {
	                $(".use-coupon").hide();
	                $(".btn-coupon ").show();
	            }
	        });
	        $('.continue-coupon').on("click", function() {
	            $('#morecoupon').val(true);
	            $('.btn-submit-coupon').click();
	            flag = true;
	        });
	        $('.cancel-coupon').on("click", function() {
	            $(".use-coupon").hide();
	            $(".btn-coupon ").show();
	            flag = true;
	        });
	        //Check và tạo coupon
	        $('.btn-submit-coupon').click(function () {
	            if($("#forminfo").valid() == false) {
	                $(".summary").show();
	                $('.listerror').html("");
	                $(".drop_shipping, .h-shipping").hide();
	            }
	            else {
	                $this = $(this);
	                var couponcode = $('.couponcode').val();
	                $('.couponcode').removeClass("error");
	                $('.couponcode').nextAll("span").remove();
	                if (couponcode != "") {
	                    var url = $('#discount-apply').val();
	                    if(url=="" && $("#order_id").val()!="" && $("#order_id").val()!=0 ){
	                        
	                        url="/orders/" + $("#order_id").val() + "/apply_discount";
	                        
	                    }
                    
	                    if (flag && url != "") {
	                        $this.attr('disabled', 'disabled');

	                        $.ajax({
	                            type: "POST",
	                            url: url,
	                            data: $("#purchase-form").serialize(),
	                            beforeSend: function () { },
	                            success: function (data) {
	                            
	                                if(data.haspromote && data.showbut == true) {
	                                    $('.couponcode').next('.coupon-error').remove();
	                                    $('.couponcode').after('<span class="error coupon-error">' + data.message + '</span>');
	                                    $('.btn-submit-coupon').hide();
	                                    $('.continue-coupon,.use-coupon').show();
	                                    $('.cancel-coupon').show();
	                                }
	                                else 
	                                {
	                                    if (!data.error) {
	                                        flag = false;
	                                        $('.couponcode').removeClass("error");
	                                        $(".coupon").show();
	                                        $(".coupon span").text("Mã giảm giá giảm");
	                                        $(".coupon label").html(" - " + data.saving);
	                                        $(".use-coupon").hide();

	                                        if($('#morecoupon').val() == "true")
	                                        {   
	                                            if(data.allowcoupon) {
	                                                var refresh_html = '';
	                                                  
	                                                refresh_html += '<div class="list_item cart-item"><span>2 x</span><span> &#193;o kho&#225;c Cardgian Merino</span>'
                                                    + '<span class="price">680,000₫</span>'
                                                    + '<p class="variant-title">XL</p></div>'
	                                                
	                                                $('.total-price').html('Tạm tính   <label> 680,000₫</label>');
	                                                $('.cart-items').html(refresh_html);
	                                            } else {
	                                                var refresh_html = '';
	                                                  
	                                                refresh_html += '<div class="list_item cart-item"><span>2 x</span><span> &#193;o kho&#225;c Cardgian Merino</span>'
                                                    + '<span class="price">680,000₫</span>'
                                                    + '<p class="variant-title">XL</p></div>'
	                                                
	                                                $('.total-price').html('Tạm tính   <label> 680,000₫</label>');
	                                                $('.cart-items').html(refresh_html);
	                                            }
	                                        }
	                                    } else {
	                                        $('.couponcode').next('.coupon-error').remove();
	                                        $('.couponcode').after("<span class='error coupon-error'>" + data.message + "</span>");
	                                        $('.use-coupon').show();
	                                    }
	                                }
	                                //Tổng tiền đơn hàng sau khi ap dụng discount() khi chưa đầy đủ thông tin info validate= false
	                                $(".total-checkout span").html(data.tt_price);
	                                $(".drop_shipping").change();
	                                submitFormStep1();
	                                $("#Loading").hide();
	                            }
	                        });
	                        $this.removeAttr('disabled');
	                    } else {
	                        $('html, body').animate({
	                            scrollTop: 100
	                        }, 800);
	                        $this.removeAttr('disabled');
	                        var isvalid = $("#forminfo").valid();
	                        if(!isvalid){
	                            $(".summary").show();
	                        }
	                        else{
	                            $(".summary").hide();
	                        }
	                    }
	                }
	            }
	            
	            return false;
	        });
	        
	       
	        function removeCoupon(isremove){
	            
	            flag = true;
	            if($(".coupon").is(":visible")==false){
	                if(params["couponcode"]!=undefined && params["couponcode"]!="" && isremove==undefined){
	                    $(".couponcode").val(params["couponcode"]);
	                    $(".btn-coupon").hide();
	                    $('.btn-submit-coupon').click();
	                }
	                return false;
	            }
	            $(".remove-coupon").prev("span").text("");
	            $(".remove-coupon").parent(".coupon").hide();
	            $(".btn-coupon").show();
	            var url = "/checkout/remove_coupon?id=" + $('#ab_number_fn').val();
	            $.ajax({
	                type: "POST",
	                url: url,
	                beforeSend: function () { },
	                success: function (data) {
	                    if (data.tt_price && data.tt_price !="") {
                            
	                        $(".total-checkout span").html(data.tt_price);
	                    }else{
	                        $(".drop_shipping").change();
	                    }
	                    var refresh_html = '';
	                      
	                    refresh_html += ' <div class="list_item cart-item"><span>2 x</span><span> &#193;o kho&#225;c Cardgian Merino</span>'
            			+ '<span class="price">680,000₫</span>'
            			+ '<p class="variant-title">XL</p></div>'
	                    
	                    $('.total-price').html('Tạm tính   <label> 680,000₫</label>');
	                    $('.cart-items').html(refresh_html);
	                    $('#morecoupon').val(false);
                        
	                    if(params["couponcode"]!=undefined && params["couponcode"]!="" && isremove==undefined){
	                        $(".couponcode").val(params["couponcode"]);
	                        $(".btn-coupon").hide();
	                        $('.btn-submit-coupon').click();
	                    }
	                    submitFormStep1();
	                }
	            });
	        }

	        //tạo coupon khi co orderid
            
	        if($("#order_id").val()!="" && $("#order_id").val()!=0 && params["couponcode"]!=undefined && params["couponcode"]!="" ){
	            
	            if($(".new_order").valid()==false)
	            {
	                removeCoupon();
	            }
	          
	        }
	        //XÓa coupon
	        $(".remove-coupon").click(function () {
	            removeCoupon(true);
	            return false;
	        });
	        //Khi enter thì tạo coupon
	        $('.couponcode').keydown(function(e) {
	            var key = e.charCode || e.keyCode || 0;
	            if( key == 13){
	                $(".btn-submit-coupon").click();
	                return false;
	            }
	        });
	        //style css cho dropbox
	      
	        if($('.btn-checkout').css('position') == 'fixed'){
	            $('.btn-checkout').width($(".total-checkout").outerWidth());
	            $(window).resize(function(){
	                $('.btn-checkout').width($(".total-checkout").outerWidth());
	            });
	        }
	       
	        ////Nếu thay đổi nơi giao hàng thì trigger xóa coupon
	        //$("#billing_address_province,#order_email,#shipping_district").change(function () {
	        //  $(".remove-coupon").click();
	        // });
	        ////trigger nếu đã điền đầy đủ form thì lấy danh sách vận chuyển
	        var checkform = true;
	        $(".form-group .formcontrol").each(function() {
	            if($(this).attr('required') && ($(this).val() == "" || $(this).val() == null)) {
	                checkform = false;
	            }
	        });
	        if(checkform){
	            $("#billing_address_province").change();
	        }

	    })
</script>


</head>

<body class="step1">
	
	
	<span class="fbtracker-checkout"></span>
	<a  href="{{route('cart')}}" ><h1><span class="btn-back">Quay về giỏ hàng</span>  LKT Fashion</h1></a>
	
	<div class="container clearfix"> 
		

		<div class="col-4 step1">
			<h2>Thông tin giao hàng</h2>
            
			
			<div class="user-login"><a href="{{route('dangky')}}" >Đăng ký tài khoản mua hàng</a> | <a href="{{route('dangnhap')}}">Đăng nhập</a></div>
			
			<div class="line"></div>
			<div class="form-info">
				
				<label class="color-blue">Mua không cần tài khoản</label>
				

				<form accept-charset="UTF-8" action="/checkout/create_order" class="new_order" id="forminfo" method="post">        
					<input type="hidden" id="ab_number" name="ab_number" value="1013044721" />
					<input type="hidden" id="token" name="token" value ="" />
					
					<div class="form-group">
						
					</div>
					
					<div class="form-group">
						<input placeholder="Họ và tên" class="formcontrol" id="billing_address_full_name" name="billing_address[full_name]" size="30"  type="text"  />
						<p>Họ và tên</p>
					</div>
					
					

					<div class="form-group">
						<input placeholder="Số điện thoại"  maxlength="11" id="billing_address_phone" class="formcontrol" name="billing_address[phone]" size="30" title="Nhập số điện thoại" pattern="^\d{8,11}"  type="tel" value="" required />
						<p>Số điện thoại</p>
					</div>
					
					
					<div class="form-group">
						<input placeholder="Email"  id="order_email" name="checkout_user[email]" class="formcontrol" size="30" type="email" value="" />
						<p>Email</p>
					</div>
					
					
					<div class="form-group">
						<input placeholder="Địa chỉ" id="billing_address_address1" class="formcontrol" name="billing_address[address1]" size="30" type="text" value=""  />
						<p>Địa chỉ</p>
					</div>
					
					<input name="billing_address[zip]"  type="hidden" value="70000"  />
					<input name="billing_address[country_id]" type="hidden" value="241" />
					<input name="billing_address[address2]"  type="hidden" value=""  />
                    <input name="is_show_shipping_address"  type="hidden" value="true"  />
					<input type="checkbox" style="display:none"  name="billing_address[billing_is_shipping]" value="true" checked="checked" id="shipping-toggle"  tabindex="12" />
					
					<div class="form-group ctrl-city">
                        <div class='custom-dropdown'>
							<select id="billing_address_province" name="billing_address[province_id]" class="formcontrol" required>
								<option value="null" selected>Vui lòng chọn tỉnh/thành phố.</option>
								
									
										
											<option value="50" >Hồ Chí Minh</option>
										
									
										
											<option value="1" >Hà Nội</option>
										
									
										
											<option value="32" >Đà Nẵng</option>
										
									
										
											<option value="57" >An Giang</option>
										
									
										
											<option value="49" >Bà Rịa - Vũng Tàu</option>
										
									
										
											<option value="15" >Bắc Giang</option>
										
									
										
											<option value="4" >Bắc Kạn</option>
										
									
										
											<option value="62" >Bạc Liêu</option>
										
									
										
											<option value="18" >Bắc Ninh</option>
										
									
										
											<option value="53" >Bến Tre</option>
										
									
										
											<option value="35" >Bình Định</option>
										
									
										
											<option value="47" >Bình Dương</option>
										
									
										
											<option value="45" >Bình Phước</option>
										
									
										
											<option value="39" >Bình Thuận</option>
										
									
										
											<option value="63" >Cà Mau</option>
										
									
										
											<option value="59" >Cần Thơ</option>
										
									
										
											<option value="3" >Cao Bằng</option>
										
									
										
											<option value="42" >Đắk Lắk</option>
										
									
										
											<option value="43" >Đắk Nông</option>
										
									
										
											<option value="7" >Điện Biên</option>
										
									
										
											<option value="48" >Đồng Nai</option>
										
									
										
											<option value="56" >Đồng Tháp</option>
										
									
										
											<option value="41" >Gia Lai</option>
										
									
										
											<option value="2" >Hà Giang</option>
										
									
										
											<option value="23" >Hà Nam</option>
										
									
										
											<option value="28" >Hà Tĩnh</option>
										
									
										
											<option value="19" >Hải Dương</option>
										
									
										
											<option value="20" >Hải Phòng</option>
										
									
										
											<option value="60" >Hậu Giang</option>
										
									
										
											<option value="11" >Hòa Bình</option>
										
									
										
											<option value="21" >Hưng Yên</option>
										
									
										
											<option value="37" >Khánh Hòa</option>
										
									
										
											<option value="58" >Kiên Giang</option>
										
									
										
											<option value="40" >Kon Tum</option>
										
									
										
											<option value="8" >Lai Châu</option>
										
									
										
											<option value="44" >Lâm Đồng</option>
										
									
										
											<option value="13" >Lạng Sơn</option>
										
									
										
											<option value="6" >Lào Cai</option>
										
									
										
											<option value="51" >Long An</option>
										
									
										
											<option value="24" >Nam Định</option>
										
									
										
											<option value="27" >Nghệ An</option>
										
									
										
											<option value="25" >Ninh Bình</option>
										
									
										
											<option value="38" >Ninh Thuận</option>
										
									
										
											<option value="16" >Phú Thọ</option>
										
									
										
											<option value="36" >Phú Yên</option>
										
									
										
											<option value="29" >Quảng Bình</option>
										
									
										
											<option value="33" >Quảng Nam</option>
										
									
										
											<option value="34" >Quảng Ngãi</option>
										
									
										
											<option value="14" >Quảng Ninh</option>
										
									
										
											<option value="30" >Quảng Trị</option>
										
									
										
											<option value="61" >Sóc Trăng</option>
										
									
										
											<option value="9" >Sơn La</option>
										
									
										
											<option value="46" >Tây Ninh</option>
										
									
										
											<option value="22" >Thái Bình</option>
										
									
										
											<option value="12" >Thái Nguyên</option>
										
									
										
											<option value="26" >Thanh Hóa</option>
										
									
										
											<option value="31" >Thừa Thiên Huế</option>
										
									
										
											<option value="52" >Tiền Giang</option>
										
									
										
											<option value="54" >Trà Vinh</option>
										
									
										
											<option value="5" >Tuyên Quang</option>
										
									
										
											<option value="55" >Vĩnh Long</option>
										
									
										
											<option value="17" >Vĩnh Phúc</option>
										
									
										
											<option value="10" >Yên Bái</option>
										
									 
								  
							</select>
						</div>
					</div>
					
					<div class="form-group ctrl-district" id="shipping_district_container">
                        <div class='custom-dropdown'>
							<select id="shipping_district" name="shipping_district" class="formcontrol" ></select>
						</div>
					</div>
					
					<div class="form-group">                   
						<textarea id="billing_note" placeholder="Ghi chú đơn hàng" name="billing_address[note]" rows="3" class="formcontrol ordernote"></textarea>
						<p>Ghi chú đơn hàng</p>
					</div>
					<div class="error summary">
						(<span class="color-red ">*</span>)Vui lòng nhập đủ thông tin</div> 
					</form></div>
					<div class="listerror">

					</div>
				</div>
				<form accept-charset="UTF-8"  id="purchase-form" method="post">   
					<input type="hidden" id="ab_number_fn" name="ab_number_fn" value="1013044721" />  
					<input type="hidden" id="token" name="token" value ="" />   
					<input type="hidden" id="morecoupon" name ="morecoupon" value="false" />
                    <input type="hidden" id="order_id" value="1013044721" />
					
					<div class="col-4">
						<!-- Vận chuyển & Thanh Toán -->
						<div class="ctrl-shipping">
							<h3 class="h-shipping ">Vận chuyển</h3>
							<div class="form-group ">
								<div class='custom-dropdown'><select class="drop_shipping" name="shipping_rate"></select></div>
							</div>
						</div>

						<h3>Thanh toán</h3>
						<div class="shiping-ajax">
							

							<label class="lb-method">
								<input class="input-method" type="radio"  checked="checked"  name="gateway" value="93018" />
								<span class="label-radio"> Thanh toán khi giao hàng (COD)</span>
							</label>
							<span class="desc"></span>

							

							<label class="lb-method">
								<input class="input-method" type="radio"  name="gateway" value="93019" />
								<span class="label-radio"> Chuyển khoản qua ngân hàng</span>
							</label>
							<span class="desc"></span>

							
						</div>
						
						
					</div>
					<div class="box-btn-checkout-first">
						<button type="submit" class="btn-checkout btn-checkout-first">Đặt hàng</button></div>
						<div class="col-4">
							<div class="box-cart">
								<h2>Đơn hàng</h2>
								<?php
									$tong = 0;
								?>
								(<span>{{Cart::count()}}</span> sản phẩm)
								<div class="cart-items">
									
									 @foreach($cart as $cart)
									<div class="list_item cart-item">
										<span>{{$cart->qty}}</span>                        
										<span>{{$cart->name}}</span>
										<span class="price">{{number_format($cart->price*$cart->qty)}}₫</span>
										<p class="variant-title">{{$cart->options->has('size') ? $cart->options->size : ''}}</p>
									</div> 
									<?php
                  						$tong = $tong+ ($cart->price*$cart->qty);
              						?>
									@endforeach
									
								</div>                
								<div class="total-price">
									Tạm tính   <label> {{number_format($tong)}}₫</label>
								</div>
								<div class="shiping-price">
									Phí vận chuyển   <label>0</label>
								</div>                
								<a class="btn-coupon btn-arrow" href="javascript:void(0);"><span></span>Sử dụng mã giảm giá </a>
								<div class="coupon"><a class="remove-coupon">Xóa</a> <span></span> <label></label></div>
								<div class="use-coupon">
									<div class="form-group">
										<input type="hidden" id="discount-apply" name="discount-apply" />
										<input name="discount.code" class="couponcode" placeholder="Nhập mã giảm giá" />
										<a class="btn-submit-coupon">Sử dụng</a>
										<a class="continue-coupon ">Tiếp tục sử dụng</a>
										<a class="cancel-coupon">Hủy</a>
									</div>
								</div>               
								<div class="total-checkout">
									Tổng cộng <span> {{number_format($tong)}}₫</span>
								</div>
							</div>
							<button type="submit" class="btn-checkout">Đặt hàng</button>
							
						</div>
				</form>
        
                    
				

					
				</div>
				
				<div id="Loading">
					<div id="Loading_1" class="Loading"></div>
					<div id="Loading_2" class="Loading"></div>
					<div id="Loading_3" class="Loading"></div>
					<div id="Loading_4" class="Loading"></div>
					<div id="Loading_5" class="Loading"></div>
					<div id="Loading_6" class="Loading"></div>
					<div id="Loading_7" class="Loading"></div>
					<div id="Loading_8" class="Loading"></div>
				</div> 
			</body>
			</html>