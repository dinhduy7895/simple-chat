function doScroll() {
    $(".msgs").animate({
        scrollTop: $(".msgs")[0].scrollHeight
    });
}

function reload() {
    localStorage['lastShow'] = $(".msgs .msg:last").attr("title");
    $.ajax({
       url : 'messages.php',
        success : function (view) {

            $(".msgs").html(view);
            if (localStorage['lastShow'] != $(".msgs .msg:last").attr("title")) {
                doScroll();
            }
        }
    });
    $(".list-users").load("listUsers.php");
}

$(document).ready(function () {
    doScroll();
    $("#msg_form").on("submit", function () {
        // t = $(this);
        input  = $(this).find("input[type=text]");
        val = input.val();
        if (val != "") {
            $.ajax({
               type : 'Post',
                url : 'sendMessage.php',
                data :{
                    msg : val,
                },
                success : function () {
                    reload();
                    input.val("");
                }
            });
        }
        return false;
    });
});

setInterval(function () {
    reload();
}, 1000);
