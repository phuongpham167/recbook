$( document ).ready(function() {
    $('.slider-section').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000
    })

    $(window).load(function(){
        $('#myModal').modal('show');
    });
    window.onscroll = function() {scrollFunction()};
    function scrollFunction(){
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            $('#goTop').fadeIn(200);
        } else {
            $('#goTop').fadeOut(200);
        }
    }

    document.getElementById("goTop").onclick = function() {goToTop()};
    function goToTop(){
        $('body,html').animate({
            scrollTop : 0
        }, 500);
    }
});
