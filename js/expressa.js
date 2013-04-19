jQuery(document).ready(function ($) {

  var flag = true;

	$(window).bind('load resize',function() {
		if($(window).width() > 768) {	
			$(window).scroll(function() {
				var vPos = $(window).scrollTop();
				var totalH = $('.before-content').offset().top;
				var finalSize = totalH - vPos;
				var scrolled = $(window).scrollTop(); //Parallax window scroll height
				
				console.log("if failed!");
				
				if(finalSize <= 10) {
					if(flag){
					$('#scroll-menu').animate({'top':'0'},150);
					$('nav.main').hide();
					}	
					flag=false;	
				} else if(finalSize > 10) {
					if(!flag){
					$('#scroll-menu').animate({'top':'-45'},150);
					$('nav.main').show();
					}
					flag=true;
				}
			});
		} else {
			$(window).unbind('scroll');
		}
	});
  
  $('ul.menu').superfish({delay	: 100});
  
  $(".cart-empty-block").html("<button class='btn btn-small'><i class='icon-shopping-cart'></i>0 Items</div>");

  $("a[rel^='prettyPhoto']").prettyPhoto();

  $('#ei-slider').eislideshow({
				animation			: 'center',
				autoplay			: true,
				slideshow_interval	: 3000,
				titlesFactor		: 0
		  });
  
  $('header .header-cart-wrap .commerce-line-item-views-form').hide();
  
  $('header .view-cart').click(function(){
    $('header .header-cart-wrap .commerce-line-item-views-form').slideToggle();
  });
  
   $('#scroll-menu .header-cart-wrap .commerce-line-item-views-form').hide();
  
  $('#scroll-menu .view-cart').click(function(){
    $('#scroll-menu .header-cart-wrap .commerce-line-item-views-form').slideToggle();
  });
  

  
  $('#recent_projects').carouFredSel({
	    width: '100%',
	    responsive: true,
	    circular : false,
	    infinite : false,
	    auto: false,
	    next : {
	      button : "#next",
	      key	: "right"
	    },
	    prev : {
	      button : "#prev",
	      key	: "left"
	    },
	    swipe: {
	      onMouse: true,
	      onTouch: false
	    },
	    items: {
	      
	      visible: {
	        min: 1,
	        max: 4
	      }
	    }
	  });
	  
	  $('#store-carousel-list-wrap').carouFredSel({
	    width: '100%',
	    responsive: true,
	    circular : false,
	    infinite : false,
	    auto: false,
	    next : {
	      button : "#store-next",
	      key	: "right"
	    },
	    prev : {
	      button : "#store-prev",
	      key	: "left"
	    },
	    swipe: {
	      onMouse: true,
	      onTouch: false
	    },
	    items: {
	      
	      visible: {
	        min: 1,
	        max: 4
	      }
	    }
	  });
});

$(window).load(function(){



  $('.search-api-sorts li a').addClass('btn');
  
  $('header input[type="submit"]').addClass('btn');
  
  $('#scroll-menu input[type="submit"]').addClass('btn');
  
  $('.search-api-sort-active a:last').removeClass('btn');

  $('.flexslider').flexslider({
    controlNav: false, 
    animation: "slide"
  });
     
  var $container = $('#isotope_test');

  $container.isotope({
    itemSelector : '.switch'
  });
  
  var $optionSets = $('#options .option-set'),
      $optionLinks = $optionSets.find('a');

  $optionLinks.click(function(){
    var $this = $(this);
    // don't proceed if already selected
    if ( $this.hasClass('selected') ) {
      return false;
    }
    var $optionSet = $this.parents('.option-set');
    $optionSet.find('.selected').removeClass('selected');
    $this.addClass('selected');

    // make option object dynamically, i.e. { filter: '.my-filter-class' }
    var options = {},
        key = $optionSet.attr('data-option-key'),
        value = $this.attr('data-option-value');
    // parse 'false' as false boolean
    value = value === 'false' ? false : value;
    options[ key ] = value;
    if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
      // changes in layout modes need extra logic
      changeLayoutMode( $this, options )
    } else {
      // otherwise, apply new options
      $container.isotope( options );
    }
    
    return false;
  });
});  

