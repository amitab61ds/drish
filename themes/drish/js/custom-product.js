

		jQuery(document).ready(function(){

			jQuery("body").show();

			if(jQuery(".address li span").length){
				jQuery(".address li span").click(function(event){
	
					  var target = jQuery(event.target).next().is(':visible');
					  if(target)
					  {
					   jQuery(this).next().slideUp();
					   jQuery("i",this).removeClass("fa-minus").addClass("fa-plus");
					   
					   jQuery(this).removeClass("active");
					   return;
					  }
					  else {
					   jQuery(".address li span").next().slideUp();
					   jQuery(".address li span i").removeClass("fa-minus").addClass("fa-plus");
					   jQuery(this).next().slideDown();
					   jQuery("i",this).addClass("fa-minus").removeClass("fa-plus");
					   jQuery(".address li span").removeClass("active");
					   jQuery(this).addClass("active");
					   
					   
					  }
					
				 });
			}





			
			var winwid = window.innerWidth;
			if(jQuery('.bxslider').length){
				jQuery('.bxslider').bxSlider({
					auto: true,
					width: 960,
					height: 500,
					autoControls: true,
					pager:true,	
					speed:1000		
				});
			}
			if(jQuery('.bxslider-1').length){
				jQuery('.bxslider-1').bxSlider({
				 minSlides: 2,
				  maxSlides: 6,
				  slideWidth: 320,
				  moveSlides:1
				}); 
			}
			if(jQuery('.bxslider-2').length){
				jQuery('.bxslider-2').bxSlider({
				 minSlides: 2,
				  maxSlides: 6,
				  slideWidth: 320,
				  moveSlides:1,
				  
				}); 
			}
			if(jQuery( '#example3' ).length){
				jQuery( '#example3' ).sliderPro({
					width: 960,
					height: 500,
					fade: true,
					arrows: true,
					buttons: false,
					fullScreen: true,
					shuffle: true,
					smallSize: 500,
					mediumSize: 1000,
					largeSize: 3000,
					thumbnailArrows: true,
					autoplay: false
				});
			}
			var topval = jQuery(this).scrollTop();

			var winheight = jQuery(window).height();
			var head_height = jQuery(".free-shipping").height();
			var newheight = winheight - head_height;
			$('.slider-area').css('margin-top',head_height);
			$('.slider-area.bx-viewport').css('height',newheight);
			$('.imgs').css('height',newheight);

        });   
		
		  jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 50) {
                jQuery('#back-to-top').fadeIn();
            } else {
                jQuery('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        jQuery('#back-to-top').click(function () {
            jQuery('#back-to-top').tooltip('hide');
            jQuery('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
		
		if(jQuery('#back-to-top').length){
			
        	jQuery('#back-to-top').tooltip('show'); 
		}


		jQuery(".cart-box").click(function(){			
			jQuery(".pop-up-cart").slideToggle();
		});
		
		jQuery(".heart-area").click(function(){			
			jQuery(".pop-up-wishlist").slideToggle();
		});
		
		
		
		if(jQuery(".f-nav .f-titles").length){
				jQuery(".address .f-titles").click(function(event){
	
					  var target = jQuery(event.target).next().is(':visible');
					  if(target)
					  {
					   jQuery(this).next().slideUp();
					   jQuery("i",this).removeClass("fa-minus").addClass("fa-plus");
					   
					   jQuery(this).removeClass("active");
					   return;
					  }
					  else {
					   jQuery(".f-nav .f-titles").next().slideUp();
					   jQuery(".f-nav .f-titles i").removeClass("fa-minus").addClass("fa-plus");
					   jQuery(this).next().slideDown();
					   jQuery("i",this).addClass("fa-minus").removeClass("fa-plus");
					   jQuery(".f-nav .f-titles").removeClass("active");
					   jQuery(this).addClass("active");
					   
					   
					  }
					
				 });
			}
						
				jQuery('.bxslider-pro').bxSlider({
				  minSlides: 3,
				  maxSlides: 4,
				  slideWidth: 170,
				  slideMargin: 10,
								nextText: ' ',
								prevText: ' '
				});
				
				
				
			jQuery("#zoom_01").elevateZoom({
			gallery:'gal1', 
			cursor: 'pointer',
			position:"absolute",
			top:"0",
			right:"0",
			 galleryActiveClass: 'active', 
			 imageCrossfade: true,
			 loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'
			 }); 
			
			//pass the images to Fancybox
			jQuery("#zoom_01").bind("click", function(e) {  
			  var ez =   jQuery('#zoom_01').data('elevateZoom');	
				jQuery.fancybox(ez.getGalleryList());
			  return false;
			});