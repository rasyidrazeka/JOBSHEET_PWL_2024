$(document).ready(function () {
    $('#checkButton').click(function () {
        // Method chaining dengan addClass() dan removeClass()
        $('#myDiv').addClass('highlight').removeClass('bold');

        // Method chaining dengan hasClass()
        var hasHighlightClass = $('#myDIv').hasClass('highlight');
        console.log('Apakah #myDiv memiliki class highlight?', hasHighlightClass);

        // Method chaining dengan attr() dan removeAttr()
        $('#myDiv').attr('title', 'Ini adalah div').removeAttr('id');

        // Method chaining dengan text() dan html()
        $('#myDiv').text('Teks yang diubah').html('<p>Teks HTML yang diubah</p>');

        // Method chaining dengan append() dan prepend()
        $('#myDiv').append('<p>Teks yang ditambahkan di akhir</p>').prepend('<p>Teks yang ditambahkan di awal</p>');

        // Method chaining dengan remove()
        $('#myDiv').find('p').remove();
    });
});