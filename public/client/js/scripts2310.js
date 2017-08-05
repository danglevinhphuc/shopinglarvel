$(document).ready(function(){

   function addItem(form) {
      $.ajax({
        type: 'POST',
        url: '/cart/add.js',
        dataType: 'json',
        data: form.serialize(),
        success: function(data){
        	Haravan.onSuccess(form);
        },
        error: Haravan.onError
      });
   }
   
   
   $('.addtocart').click(function(e) {
      e.preventDefault();
      var form = $(this).parents('form');
      $(this).prop('disabled', true);
      addItem(form);
   });   
   

   Haravan.onSuccess = function(form) {

      var elem = form.find('.addtocart');

      elem.removeAttr("disabled");

      var quantity = parseInt(jQuery('[name="quantity"]').val(), 10) || 1;

      $("html, body").animate({ scrollTop: 0 }, 250, 'swing');

      function animate(form) { 

        form.find(".cart-animation").show();

        var addtocartWidth = elem.outerWidth() / 2
        var addtocartHeight = elem.outerHeight() / 2

        var addtocartLeft = elem.offset().left + addtocartWidth;
        var addtocartTop = $(elem).offset().top + addtocartHeight ;

        var buttonAreaWidth = $("#cart-target .fa-shopping-cart").outerWidth();
        var buttonAreaHeight = $("#cart-target .fa-shopping-cart").outerHeight();

        var buttonAreaLeft = $("#cart-target .fa-shopping-cart").offset().left;
        var buttonAreaTop = $("#cart-target .fa-shopping-cart").offset().top - buttonAreaHeight;

        var path = {
          start: {
            x: addtocartLeft,
            y: addtocartTop,
            angle: 190.012,
            length: 0.2
          },
          end: {
            x: buttonAreaLeft,
            y: buttonAreaTop,
            angle: 90.012,
            length: 0.50
          }
        };

        form.find('.cart-animation').text(quantity).animate(
        {
          path : new $.path.bezier(path)
        },
        1200,
        function() {
          form.find(".cart-animation").fadeOut(500, function() {
            $(elem).prop("disabled", false)
            var cartCount =  parseInt($('#cart-count').text())? parseInt($('#cart-count').text()) + quantity:quantity;
            $('#cart-count').text(cartCount + " sản phẩm")
            $('#cart-target').addClass('has-items');
          })
        }
        );
      }

      animate(form);
    };

    Haravan.onError = function(XMLHttpRequest, textStatus) {
      // Haravan returns a description of the error in XMLHttpRequest.responseText.
      // It is JSON.
      // Example: {"description":"The product 'Amelia - Small' is already sold out.","status":500,"message":"Cart Error"}
      var data = eval('(' + XMLHttpRequest.responseText + ')');
      if (!!data.message) {
        alert(data.message + '(' + data.status  + '): ' + data.description);
      } else {
        alert('Error : ' + Haravan.fullMessagesFromErrors(data).join('; ') + '.');
      }

      $('.addtocart').removeAttr("disabled");
    };

    Haravan.fullMessagesFromErrors = function(errors) {
      var fullMessages = [];
      jQuery.each(errors, function(attribute, messages) {
        jQuery.each(messages, function(index, message) {
          fullMessages.push(attribute + ' ' + message);
        });
      });
      return fullMessages;
    };

})

jQuery(document).ready(function($){
	$("#main-nav .menu-mobile").click(function() {
		$("body").toggleClass("show-menu-mobile");
	});
	$('#mobile-menu .close-menu-mobile, .overlay-background').on('click',function(){
		$("#main-nav .menu-mobile").click();
		return false;
	});
	$('#slider').flexslider({
		animation: "slide",
		animationLoop: true,
		controlNav: false,
		pauseOnAction: false, 
		pauseOnHover: true,
	});
  $("select.loc_on_change").change(function(){
  	if($(this).attr("value") == "#") return false;
  	window.location = $(this).attr("value");
  });
  /*load layout cookie*/
 var product_layout = getCookie('product_layout');
 if(product_layout){
 	$(".change-layout .layout").removeClass('select');
 	$(".change-layout .layout[data-name="+product_layout+"]").addClass('select');
 	$('#primary .products.change-layout').removeClass('grid row').addClass(product_layout); 
 }
  $(".change-layout .layout").on('click',function(){
  	var class_layout = $(this).data('name');
  	if(class_layout){
	  	$(".change-layout .layout").removeClass('select');
	  	$(this).addClass('select');
	  	$(this).parents('.main-content').find('.products').removeClass('row').removeClass('grid').addClass(class_layout);
	  	setCookie('product_layout',class_layout);
  	}
  });
	function setCookie(key, value) {
	    var expires = new Date();
	    expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
	    document.cookie = key + '=' + value +';path=/'+ ';expires=' + expires.toUTCString();
	}
	
	function getCookie(key) {
	    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
	    return keyValue ? keyValue[2] : null;
	}
	
	if($('.product-slider .list-zoom .jqzoom > img').length > 0){
		function create_jqzoom(){
			$(".jqzoom").each(function(){
				var xzoom = 0;
				var yzoom = 0;
				var offset = 10;
				xzoom = $(this).parents('.main-product').width() - $(this).outerWidth(true);
				//console.log($(this).parents('.entry').width() + ' - ' + $(this).outerWidth(true));
				//console.log(xzoom + ' / ' + $(this).outerWidth() + ' * ' +$(this).outerHeight());
				yzoom = (xzoom/$(this).outerWidth())*$(this).outerHeight();
				$(this).jqueryzoom({xzoom: xzoom - offset, yzoom: yzoom, offset: offset});
			});
		}
		var firstImage = $('.product-slider .list-zoom .jqzoom > img').filter(':first');
	    var checkforloaded = setInterval(function() {
	        var image = firstImage.get(0);
	        if (image.complete || image.readyState == 'complete' || image.readyState == 4) {
	            clearInterval(checkforloaded);
	            create_jqzoom();
	        }
	
	    }, 20);
	
		$(window).resize(function() {create_jqzoom();});
		$('.product-slider .list-zoom').each(function(){
			var html_ul = '<ul class="gallery clear">';
			$(this).find('.jqzoom').each(function(){
				var active = 'active';
				if($(this).index() > 0){
					$(this).addClass('hidden'); 
					active = '';
				} else $(this).addClass('active');
				html_ul += '<li class="'+active+'" data-id="'+$(this).attr('data-id')+'">'+$(this).html()+'</li>';
			});
			html_ul += '</ul>';
			$(this).after(html_ul);
		});
		$('.product-slider ul.gallery li').on('click',function(){
			$(this).parent().find('li').removeClass('active');
			$(this).addClass('active');
			$(this).parents('.product-slider').find('.list-zoom .jqzoom.active').removeClass('active').fadeOut(0).addClass('hidden');
			$(this).parents('.product-slider').find('.list-zoom .jqzoom[data-id='+$(this).attr('data-id')+']').fadeIn(500).removeClass('hidden').addClass('active');
			create_jqzoom();
		});
	}
	
});

/*============================*/
/* Update main product image. */
/*============================*/
var switchImage = function(newImageSrc, newImage, mainImageDomEl) {
  // newImageSrc is the path of the new image in the same size as originalImage is sized.
  // newImage is Haravan's object representation of the new image, with various attributes, such as scr, id, position.
  // mainImageDomEl is the passed domElement, which has not yet been manipulated. Let's manipulate it now.
  jQuery(mainImageDomEl).attr('src', newImageSrc);
  
  if ($(window).width() > 782) {jQuery(mainImageDomEl).parent().trigger('zoom.destroy').zoom( { url: newImageSrc.replace('_master', '') } );}
  
};
/* jQuery css bezier animation support -- Jonah Fox */

;(function($){

  $.path = {};

  var V = {
    rotate: function(p, degrees) {
      var radians = degrees * Math.PI / 180,
        c = Math.cos(radians),
        s = Math.sin(radians);
      return [c*p[0] - s*p[1], s*p[0] + c*p[1]];
    },
    scale: function(p, n) {
      return [n*p[0], n*p[1]];
    },
    add: function(a, b) {
      return [a[0]+b[0], a[1]+b[1]];
    },
    minus: function(a, b) {
      return [a[0]-b[0], a[1]-b[1]];
    }
  };

  $.path.bezier = function( params, rotate ) {
    params.start = $.extend( {angle: 0, length: 0.3333}, params.start );
    params.end = $.extend( {angle: 0, length: 0.3333}, params.end );

    this.p1 = [params.start.x, params.start.y];
    this.p4 = [params.end.x, params.end.y];

    var v14 = V.minus( this.p4, this.p1 ),
      v12 = V.scale( v14, params.start.length ),
      v41 = V.scale( v14, -1 ),
      v43 = V.scale( v41, params.end.length );

    v12 = V.rotate( v12, params.start.angle );
    this.p2 = V.add( this.p1, v12 );

    v43 = V.rotate(v43, params.end.angle );
    this.p3 = V.add( this.p4, v43 );

    this.f1 = function(t) { return (t*t*t); };
    this.f2 = function(t) { return (3*t*t*(1-t)); };
    this.f3 = function(t) { return (3*t*(1-t)*(1-t)); };
    this.f4 = function(t) { return ((1-t)*(1-t)*(1-t)); };

    /* p from 0 to 1 */
    this.css = function(p) {
      var f1 = this.f1(p), f2 = this.f2(p), f3 = this.f3(p), f4=this.f4(p), css = {};
      if (rotate) {
        css.prevX = this.x;
        css.prevY = this.y;
      }
      css.x = this.x = ( this.p1[0]*f1 + this.p2[0]*f2 +this.p3[0]*f3 + this.p4[0]*f4 +.5 )|0;
      css.y = this.y = ( this.p1[1]*f1 + this.p2[1]*f2 +this.p3[1]*f3 + this.p4[1]*f4 +.5 )|0;
      css.left = css.x + "px";
      css.top = css.y + "px";
      return css;
    };
  };

  $.path.arc = function(params, rotate) {
    for ( var i in params ) {
      this[i] = params[i];
    }

    this.dir = this.dir || 1;

    while ( this.start > this.end && this.dir > 0 ) {
      this.start -= 360;
    }

    while ( this.start < this.end && this.dir < 0 ) {
      this.start += 360;
    }

    this.css = function(p) {
      var a = ( this.start * (p ) + this.end * (1-(p )) ) * Math.PI / 180,
        css = {};

      if (rotate) {
        css.prevX = this.x;
        css.prevY = this.y;
      }
      css.x = this.x = ( Math.sin(a) * this.radius + this.center[0] +.5 )|0;
      css.y = this.y = ( Math.cos(a) * this.radius + this.center[1] +.5 )|0;
      css.left = css.x + "px";
      css.top = css.y + "px";
      return css;
    };
  };

  $.fx.step.path = function(fx) {
    var css = fx.end.css( 1 - fx.pos );
    if ( css.prevX != null ) {
      $.cssHooks.transform.set( fx.elem, "rotate(" + Math.atan2(css.prevY - css.y, css.prevX - css.x) + ")" );
    }
    fx.elem.style.top = css.top;
    fx.elem.style.left = css.left;
  };

})(jQuery);
