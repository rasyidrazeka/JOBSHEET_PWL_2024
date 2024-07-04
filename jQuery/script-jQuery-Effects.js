$(document).ready(function () {
    // Hide Effect
    $('#hideBtn').click(function () {
        $('.box').hide(1000);
    });

    // Show Effect
    $('#showBtn').click(function () {
        $('.box').show(1000);
    });

    // Fade In Effect
    $('#fadeInBtn').click(function () {
        $('.box').fadeIn(1000);
    });

    // Fade Out Effect
    $('#fadeOutBtn').click(function () {
        $('.box').fadeOut(1000);
    });

    // Slide Up Effect
    $('#slideUpBtn').click(function () {
        $('.box').slideUp(1000);
    });

    // Slide Down Effect
    $('#slideDownBtn').click(function () {
        $('.box').slideDown(1000);
    });

    // Toggle Effect
    $('#toggleBtn').click(function () {
        $('.box').toggle(1000);
    });

    // Animate Effect
    $('#animateBtn').click(function () {
        $('.box').animate({ left: '200px', opacity: '0.5', height: '+=150px', width: '+=150px' }, 1000);
    });
});