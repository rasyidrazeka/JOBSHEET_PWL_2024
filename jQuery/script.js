$(document).ready(function () {
    // Penerapan untuk tag H1
    $('h1').css('color', 'blue');

    // penerapan event mouseEnter dan mouseLeave
    $('#myDiv').mouseenter(function () {
        $(this).text('Kursor Mouse berada di dalam');
    });
    $('#myDiv').mouseleave(function () {
        $(this).text('Kursor Mouse berada di luar');
    });

    // penerapan event ketika tombol di klik
    $('#myButton').click(function () {
        alert('Tombol diklik');
    });

    // penerapan event keyboard keypress
    $(document).keypress(function (event) {
        var key = String.fromCharCode(event.which);
        $('#hasilInput').text('Anda menekan tombol ' + key);
    });

    // penerapan event form submit
    $('#myForm').submit(function (e) {
        e.preventDefault();
        var name = $('#nameInput').val();
        var email = $('#emailInput').val();
        $('#hasilForm').text('Nama: ' + name + ", Email: " + email);
    });
});