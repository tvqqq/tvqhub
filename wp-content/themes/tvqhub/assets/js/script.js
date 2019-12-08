jQuery(document).ready(function ($) {

    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    // Back to top
    $(window).scroll(function () {
        if ($(this).scrollTop() > 180) {
            $('.back-to-top').show();
        } else {
            $('.back-to-top').hide();
        }
    });
    $('.back-to-top').on('click', function (event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 700);
    });

    // Particle Effects
    $.rnd = function (m, n) {
        m = parseInt(m);
        n = parseInt(n);
        return Math.floor(Math.random() * (n - m + 1)) + m;
    };

    function confetti() {
        $.each($('.particletext.confetti'), function () {
            for (let i = 0; i <= 15; i++) {
                $(this).append('<span class="particle c' + $.rnd(1, 2) + '" style="top:' + $.rnd(10, 50) + '%; left:' + $.rnd(0, 100) + '%;width:' + $.rnd(4, 8) + 'px; height:' + $.rnd(3, 4) + 'px;animation-delay: ' + ($.rnd(0, 50) / 10) + 's;"></span>');
            }
        });
    }

    confetti();
});
