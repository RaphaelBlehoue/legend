jQuery(document).ready(function($) {
    var ocPortfolio = $(".oc-portfolio");
    ocPortfolio.owlCarousel({
        margin: 1,
        autoplay: true,
        autoplayHoverPause: true,
        dots: false,
        nav: true,
        navText : ['<i class="icon-angle-left"></i>','<i class="icon-angle-right"></i>'],
        responsive:{
            0:{ items:1 },
            600:{ items:2 },
            1000:{ items:3 },
            1200:{ items:4 }
        }
    });
});