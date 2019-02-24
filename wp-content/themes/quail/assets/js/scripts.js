jQuery(document).ready(function($){

var cururl = window.location.href;

if( cururl.includes( '#' ) ){

    var sectionid = cururl.substr ( cururl.indexOf ( '#' ) ); 
        if( $(sectionid).length > 0 ){
            var scrollTo = $(sectionid).offset().top;
            scrollTo = scrollTo-50;
            $('html,body').animate({ scrollTop:scrollTo+'px'} , 1000);
        }

}
   
	//Mobile menu accordian
	var winWidth = $(window).width();

	if(winWidth < 1021){
		$('.menu-main').addClass('is_mobile--menu');
		$('.menu-item-has-children a').off().on('click', function(e){
			e.preventDefault();
			$(this).siblings('.sub-menu').slideToggle(400);
		})
	}
	else{
		$('.menu-main').removeClass('is_mobile--menu');
	}

homeHeight();


/* one page scroll */
$('#primary-menu li a').on('click' , function(e){
    var href= $(this).attr('href'); 
    if( href.includes( '#' ) ){
        var sectionid = href.substr ( href.indexOf ( '#' ) ); 
        if( $(sectionid).length > 0 ){
            e.preventDefault();
            $(this).parent().siblings().removeClass('current-menu-item');
            $(this).parent().addClass('current-menu-item');
            var scrollTo = $(sectionid).offset().top;
            scrollTo = scrollTo-50;
            $('html,body').animate({ scrollTop:scrollTo+'px'} , 1000);
        }
        
    }
});


/* page builder row styles */
var row_container = $('body').data('container');
var fdn_cotainer = row_container;
$('.panel-row-style').each(function(){
    /* container */
    var row_co = $(this).data('container');
    if(row_co == null || row_co=='' || row_co == undefined){
        row_co = row_container;
    }
    $(this).find('.panel-grid-cell').wrapAll('<div class="'+row_co+'"></div>');

    
 });
/* container ends */

/* banner slider */
   var auto_play = true;
    var s_speed = parseInt( $('.full-screen-slider').data('speed') );
    if( s_speed === 0 ){
        auto_play = false;
    }
    var a_speed = parseInt( $('.full-screen-slider').data('animation') ); 
    $('.full-screen-slider').flexslider({
        slideshow: auto_play,
        slideshowSpeed: s_speed,
        animationSpeed: a_speed,
        controlNav: false,
        directionNav: true,
        animationLoop: true,
        prevText: '<i class="fas fa-angle-left"></i>',
        nextText: '<i class="fas fa-angle-right"></i>',
        
    });
    $('.flex-direction-nav').addClass('container-fluid');


/* pagebuilder widget styles */
$('.panel-widget-style').each(function(){
    var title_color = $(this).data('title-color');
    if( title_color ){
        $(this).find('.compo-header h2').css('color',title_color);
    }
});




    $(".scroll-to-loc").click(function(e){
        e.preventDefault();
        var target = $(this).attr('href');
        var scrolltop = $(target).offset().top;
        scrolltop = scrolltop - 50;
        $('html, body').animate({scrollTop: scrolltop }, 1000 );
    });

    
    

//Ends==========

$(".toolbar button").off().on("click", function () {
    $(".toolbar button").removeClass("active-work");
    $(this).addClass("active-work");

});

//Fixed footer
function fixFooter(){
    if($('#footer').hasClass('fixed-footer')){
        var spaceBtm = $('.fixed-footer').outerHeight();
        $('.main').addClass('keepSpace');
        $('.keepSpace').css({
            'margin-bottom': spaceBtm - 24 + 'px'
        })
    }
}

fixFooter();

//Input form underline

$('.input-box').not(this).on('click', function(){
    $(this).parent().removeClass('has-border');
});

$('.input-box').off().on('focus', function(){
    $('.input-wrap').removeClass('has-border');
    $(this).parent().addClass('has-border');
});

//Popup setting=====================================
$('.fire-video-popup').off().on('click', function(){
    $('#videoPop').fadeIn(400);
    $('body').css({
        'overflow-y':'hidden'
    });
});

$('.custop-pop-close').off().on('click', function(){
    $('#videoPop').fadeOut(400);
    $('body').css({
        'overflow-y':'auto'
    });
});
//===================================================

//Menu trigger====================
$('.mobile-menu').on('click', function(){
    $(this).toggleClass('collapse-menu')
    $('.menu-main').slideToggle(400);
});

//If no banner

if($('.main').hasClass('no-banner')){
    var hdrHeight = $('.quail-header').outerHeight() + 'px';
    $('.quail-header + section, .quail-header + div').css({
        'paddingTop': hdrHeight
    });
}

//full width youtube video
$(function(){
    $('.quial-header-image iframe').css({ width: $(window).innerWidth() + 'px', height: $(window).innerHeight() + 'px' });
  
    $(window).resize(function(){
      $('.quial-header-image iframe').css({ width: $(window).innerWidth() + 'px', height: $(window).innerHeight() + 'px' });
    });
  });



//Skill bar js
$('.skillbar').each(function(){
    $(this).find('.skillbar-bar').animate({
        width:$(this).attr('data-percent')
    },2000);
});



//Owl carousel===========


    //multiple carousel in one page
    $('.testimonialCarousel').owlCarousel({
        loop:true,
        autoplay:true,
        margin:10,//Gutter space between items
        autoHeight:false,
        items:1,
        nav:true,
        navText: ["<span class='fa fa-arrow-left'></span>","<span class='fa fa-arrow-right'></span>"]
    });

    //Team
    $('.teamCarousel').owlCarousel({
        loop:true,
        autoplay:true,
        autoplayTimeout:7000,
        margin:10,
        nav:true,
        navText: ["<span class='fas fa-arrow-circle-left'></span>","<span class='fas fa-arrow-circle-right'></span>"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    //Client Logos
    if( $('.clientLogo').length > 0 ) {

        $('.clientLogo').owlCarousel({
        loop:true,
        margin:10,
        autoplay:true,
        autoplayTimeout:1000,
        nav:false,
        navText: ["<span class='fa fa-arrow-left'></span>","<span class='fa fa-arrow-right'></span>"],
        responsive:{
            0:{
                items:2
            },
            600:{
                items:2
            },
            1000:{
                items:5
            }
        }
    });

    }
    

//Sticky Header =========

$(window).scroll(function () {
    var scrollTop = $(window).scrollTop();
    if(scrollTop > 80){
        $('.quail-header').addClass('scrolled')
    }
    else{
        $('.quail-header').removeClass('scrolled')
    }
});

$(window).resize(function(){
    homeHeight();
    $(window).trigger('resize.px.parallax');
    if ($(window).width() > 768){
        $('nav.menu-main').show();
    }

    

});


/*-----------------------------------------------------------------------------------*/
/*  MENU
/*-----------------------------------------------------------------------------------*/
function calculateScroll() {
    var contentTop      =   [];
    var contentBottom   =   [];
    var winTop      =   $(window).scrollTop();
    var rangeTop    =   200;
    var rangeBottom =   500;
    $('.navmenu').find('.scroll_btn a').each(function(){
        contentTop.push( $( $(this).attr('href') ).offset().top );
        contentBottom.push( $( $(this).attr('href') ).offset().top + $( $(this).attr('href') ).height() );
    })
    $.each( contentTop, function(i){
        if ( winTop > contentTop[i] - rangeTop && winTop < contentBottom[i] - rangeBottom ){
            $('.navmenu li.scroll_btn')
            .removeClass('active')
            .eq(i).addClass('active');
        }
    })
};

jQuery(document).ready(function() {
    //MobileMenu
    if ($(window).width() < 768){
        jQuery('.menu_block .container').prepend('<a href="javascript:void(0)" class="menu_toggler"><span class="fa fa-align-justify"></span></a>');
        jQuery('header .navmenu').hide();
        jQuery('.menu_toggler, .navmenu ul li a').click(function(){
            jQuery('header .navmenu').slideToggle(300);
        });
    }

    // if single_page
    if (jQuery("#page").hasClass("single_page")) {
    }
    else {
        $(window).scroll(function(event) {
            calculateScroll();
        });
        $('.navmenu ul li a, .mobile_menu ul li a, .btn_down').click(function() {
            $('html, body').animate({scrollTop: $(this.hash).offset().top - 80}, 1000);
            return false;
        });
    };
});



// utility functions 
function homeHeight(){
    var wh = jQuery(window).height() - 0;
    var ww = jQuery(window).width();
    var hh = jQuery('#quail-header').height();
    hh = hh-31;
    if( ww > 767 ){
         jQuery('.full-screen-slider, .full-screen-slider .slides li').css('height', wh);
     }else{
        jQuery('.full-screen-slider, .full-screen-slider .slides li').css({'height':'350px' , 'margin-top':hh+'px'});
     }
   
}

  // makes sure the whole site is loaded
jQuery(window).load(function() {
        // will first fade out the loading animation
  jQuery("#status").fadeOut();
        // will fade out the whole DIV that covers the website.
  jQuery("#preloader").fadeOut();
});

});


