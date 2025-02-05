function getTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    // document.getElementById('clock').innerHTML = h + ":" + m + ":" + s;
    $('#clock').html(h + ":" + m + ":" + s)
    t = setTimeout(function() {
        getTime()
    }, 500);
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

$(document).ready(function() {
    $("#login-div").hide();
    $(".login-link").click(function(e) {
        e.preventDefault();
        $("#welcome-div").hide();
        $("#login-div").show();
    });
    $(".close-button").click(function() {
        $("#login-div").hide();
        $("#welcome-div").show();
    });

    $(document).mouseup(function(e) {
        var container = $("#login-div");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.hide();
            $("#welcome-div").show();
        }
    });

    // Bu Alanı Yorum Satırına Alarak Random Arkaplanları Kapatabilirsiniz.
    if($("#loginPage").length > 0){
        var url = 'https://unsplash.it/' + $(window).outerWidth() + '/' + $(window).outerHeight() + '/?random';
        $("#loginPage").css('background-image', 'url('+url+')');
    }

})