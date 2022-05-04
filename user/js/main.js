$(function () {
    //Slick JS
    $('.autoplay').slick({
        dots: false,
        prevArrow: false,
        nextArrow: false,
        accessibility: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: false
              }
            },
            {
              breakpoint: 729,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
        ]
    });

    $('.dropdown').on('mouseover', ()=>{
        $('.dropdown').addClass('show');
        $('.dropdown').data('aria-expanded', true);
        $('.dropdown-menu').addClass('show');
    });

    $('.dropdown').on('mouseleave', ()=>{
        $('.dropdown').removeClass('show');
        $('.dropdown').data('aria-expanded', false);
        $('.dropdown-menu').removeClass('show');
    });

    

});