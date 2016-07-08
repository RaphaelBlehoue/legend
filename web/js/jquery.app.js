$(document).ready(function(){

    $('.mediaUpdate').on('click', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var href = $(this).attr('href');
        $.ajax({
            url : href,
            method : 'GET',
            dataType : 'json',
            cache : false,
            success: function(data){
                console.log(data);
            },
            error: function () {
                console.log('une erreur est survenu');
            }
        });
    });

});