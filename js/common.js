/**
 * Created by maks on 1/4/17.
 */
$(document).ready(function () {
    $('.finger').click(function () {
        if($(this).children('span').hasClass('glyphicon-thumbs-up')){
            $(this).children('span').removeClass('glyphicon-thumbs-up');
            $(this).children('span').addClass('glyphicon-thumbs-down');
        }else{
            $(this).children('span').removeClass('glyphicon-thumbs-down');
            $(this).children('span').addClass('glyphicon-thumbs-up');
        }
        var id = $(this).children('input[name=idrepo]').val();
        var name = $(this).children('input[name=name]').val();
        var login = $(this).children('input[name=login]').val();
        $.ajax({
            url:'?r=repos/like&id='+id+'&name='+name+'&login='+login
        }).done(function (data) {
            console.log(data);

        });

    });
    $('.fingerUser').click(function () {

        if($(this).children('span').hasClass('glyphicon-thumbs-up')){
            $(this).children('span').removeClass('glyphicon-thumbs-up');
            $(this).children('span').addClass('glyphicon-thumbs-down');
        }else{
            $(this).children('span').removeClass('glyphicon-thumbs-down');
            $(this).children('span').addClass('glyphicon-thumbs-up');
        }

        var id = $(this).children('input[name=iduser]').val();
        var login = $(this).children('input[name=login]').val();
        $.ajax({
            url:'?r=user/like&id='+id+'&login='+login
        }).done(function (data) {
            console.log(data);

        });

    });

});
