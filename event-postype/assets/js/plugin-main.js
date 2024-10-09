$(function () {
  // ********************************************
  var defaultSettings = "fa";
  (function (e) {
    e.fn.persiaNumber = function (t) {
      function r(e, t) {
        e.find("*")
          .addBack()
          .contents()
          .each(function () {
            if (
              this.nodeType === 3 &&
              this.parentNode.localName != "style" &&
              this.parentNode.localName != "script"
            ) {
              this.nodeValue = this.nodeValue.replace(
                this.nodeValue.match(/[0-9]*\.[0-9]+/),
                function (e) {
                  return e.replace(/\./, ",");
                }
              );
              this.nodeValue = this.nodeValue.replace(/\d/g, function (e) {
                return String.fromCharCode(e.charCodeAt(0) + t);
              });
            }
          });
      }
      if (typeof t == "string" && t.length > 0) defaultSettings = t;
      var n = 1728;
      if (t == "ar") {
        n = 1584;
      }
      window.persiaNumberedDOM = this;
      r(this, n);
      e(document).ajaxComplete(function () {
        var e = window.persiaNumberedDOM;
        r(e, n);
      });
    };
  })(jQuery);
  origParseInt = parseInt;
  parseInt = function (e) {
    e =
      e &&
      e
        .toString()
        .replace(
          /[\u06F0\u06F1\u06F2\u06F3\u06F4\u06F5\u06F6\u06F7\u06F8\u06F9]/g,
          function (e) {
            return String.fromCharCode(e.charCodeAt(0) - 1728);
          }
        )
        .replace(
          /[\u0660\u0661\u0662\u0663\u0664\u0665\u0666\u0667\u0668\u0669]/g,
          function (e) {
            return String.fromCharCode(e.charCodeAt(0) - 1584);
          }
        )
        .replace(/[\u066B]/g, ".");
    return origParseInt(e);
  };
  origParseFloat = parseFloat;
  parseFloat = function (e) {
    e =
      e &&
      e
        .toString()
        .replace(
          /[\u06F0\u06F1\u06F2\u06F3\u06F4\u06F5\u06F6\u06F7\u06F8\u06F9]/g,
          function (e) {
            return String.fromCharCode(e.charCodeAt(0) - 1728);
          }
        )
        .replace(
          /[\u0660\u0661\u0662\u0663\u0664\u0665\u0666\u0667\u0668\u0669]/g,
          function (e) {
            return String.fromCharCode(e.charCodeAt(0) - 1584);
          }
        )
        .replace(/[\u066B]/g, ".");
    return origParseFloat(e);
  };

  $(".persiannum").persiaNumber();
  // ================================================
  // fancy box for post gallary 
    $('.wp-block-gallery a').attr("data-fancybox", "gallery");

  // ================================================

//menu part
$('.menu-button').click(function(){
  $('.menu-button>span').css('width', '100%')
  $(".main-menu").css("right", "0");
  $(".bg-overly").fadeIn(400)
})
$(".mobile-menu-button-close").click(function () {
$(".main-menu").css("right", "-100%");
$('.menu-button>span:nth-of-type(1)').css('width', '45%')
$('.menu-button>span:nth-of-type(2)').css('width', '85%')
$('.menu-button>span:nth-of-type(3)').css('width', '55%')
$(".bg-overly").fadeOut(400)
});
$(".bg-overly").click(function () {
$(".main-menu").css("right", "-100%");
$('.menu-button>span:nth-of-type(1)').css('width', '45%')
$('.menu-button>span:nth-of-type(2)').css('width', '85%')
$('.menu-button>span:nth-of-type(3)').css('width', '55%')
$(".bg-overly").fadeOut(400)
});

// sub menu open and close ********************************************
$('.open-submenu').click(function(){
  $(this).siblings('ul').toggleClass("openmenus")
  $(this).toggleClass("openarrow");
})

// sub menu open and close ********************************************

$('.tab-button-item').click(function(){
  var _selected = $(this).index()
  $(this).siblings('span').css({'background-color':'#dbdbdb','color':'#5A5A5A'})
  $(this).css({'background-color':'#fe753b','color':'#fff'})
  console.log();
  $('.tab-content-item').css('display','none')
  $('.tab-content-item').eq(_selected).css('display','flex')

})

  //faq
  $('.faq-item_title').click(function(){
    $(this).siblings("div").slideToggle(400);
    $(this).children("div").children("i").toggleClass("open_status");
  })


  // search modal==============================================
$('.search-button').click(function(){
  $('.search-modal-wrapper').css('display','flex')
})
$('.close-search-modal').click(function(){
  $('.search-modal-wrapper').css('display','none')
})
  // video modal==============================================
$('.video-play-button').click(function(){
  $('.video-wrapper').css('display','flex')
})
$('.close-video-button').click(function(){
  $('.video-wrapper').css('display','none')
  $('.video-wrapper').children('video').trigger('pause');
  
})

// HEADER ==============================================
$(document).scroll(function(){
  var menuscroll = $(this).scrollTop()
  if(menuscroll > 50){
      $('.main-header').css('background-color','var(--primery)')
  }else{
    $('.main-header').css('background-color','#ffffff00')
  }
})



// sliders********************************************
if(jQuery('.main-splide') && jQuery('.main-splide').length != 0 ){
  var splide_main = new Splide(".main-splide", {
    type: "slide",
    speed: 700,
    rewind: true,
    direction: 'rtl',
    arrows: true,
    pagination: false,
    autoplay: true,
  });
  splide_main.mount();
  }
  if(jQuery('.post-box-splide') && jQuery('.post-box-splide').length != 0 ){
  
  var splide_post_box_splide = new Splide(".post-box-splide", {
    type: "slide",
    speed: 700,
    direction: 'rtl',
    rewind: true,
    arrows: true,
    pagination: false,
    autoplay: true,
    perPage: 4,
    breakpoints: { 
          1023: {
            perPage: 3,
          },
          570: {
            perPage: 1,
          },
        },
  });
  splide_post_box_splide.mount();
  }
  if(jQuery('.pardis-box-splide') && jQuery('.pardis-box-splide').length != 0 ){
  
  var splide_pardis_box_splide = new Splide(".pardis-box-splide", {
    type: "slide",
    speed: 700,
    rewind: true,
    arrows: true,
    pagination: false,
    autoplay: true,
    direction: 'rtl',
    perPage: 4,
    breakpoints: {
          1280: {
            perPage: 3,
          },
          1023: {
            perPage: 2,
          },
          570: {
            perPage: 1,
          },
        },
  });
  splide_pardis_box_splide.mount();
  }
  if(jQuery('.event-box-splide1') && jQuery('.event-box-splide1').length != 0 ){
  
  var event_pardis_box_splide1 = new Splide(".event-box-splide1", {
    type: "slide",
    speed: 700,
    rewind: true,
    arrows: true,
    pagination: false,
    direction: 'rtl',
    autoplay: true,
    perPage: 2,
    breakpoints: {
          1023: {
            perPage: 2,
          },
          570: {
            perPage: 1,
          },
        },
  });
  event_pardis_box_splide1.mount();
  }
  if(jQuery('.event-box-splide2') && jQuery('.event-box-splide2').length != 0 ){
  
  var event_pardis_box_splide2 = new Splide(".event-box-splide2", {
    type: "slide",
    speed: 700,
    rewind: true,
    arrows: true,
    pagination: false,
    direction: 'rtl',
    autoplay: true,
    perPage: 2,
    breakpoints: {
          1023: {
            perPage: 2,
          },
          570: {
            perPage: 1,
          },
        },
  });
  event_pardis_box_splide2.mount();
  }
  if(jQuery('.units-box-splide') && jQuery('.units-box-splide').length != 0 ){
  
  var units_pardis_box_splide = new Splide(".units-box-splide", {
    type: "slide",
    speed: 700,
    rewind: true,
    arrows: true,
    pagination: false,
    direction: 'rtl',
    autoplay: true,
    perPage: 6,
    breakpoints: {
          1023: {
            perPage: 3,
          },
          570: {
            perPage: 2,
          },
        },
  });
  units_pardis_box_splide.mount();
  }
  
  

  

});
