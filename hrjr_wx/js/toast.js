$(function() {
    $.extend({
        showToast: showToast
    })

    var options = {
        fadeTime: 500,
        duration: 2000
    }

    function showToast(message, option){
        options = $.extend(options, option);
        var toastStyle = 'position: fixed; top: 20%; left: 50%; z-index: 9999; padding: 10px 20px 10px 20px;'
            + 'background-color: #99CCFF; width: 150px; color: black; opacity: 0.9; margin-left: -75px;'
            + 'border:2px solid #0099CC; overflow-x:hidden; text-align: center;';
        var toastString = '';
        toastString += '<div id=toast style="' + toastStyle + '">' + message + '</div>';

        $('#toast').remove();
        $('body').append(toastString);
        $('#toast').fadeIn(options.fadeTime).delay(options.duration).fadeOut(options.fadeTime);
    }
});