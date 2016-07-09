function urlverify() {
    console.log("Start UrlVerify");
    url = $("#urlvalue").val();
    var regUrl = /^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,}))\.?)(?::\d{2,5})?(?:[/?#]\S*)?$/i;
    if(url.substring(0,7) !== "http://" && url.substring(0,8) !== "https://") {
        var http = "http://";
        url = http.concat(url);
    }
    if(url.length > 1 && regUrl.test(url)) {
        console.log("Url Verify Pass");
        $("#urlvalue").animate({borderColor:"#0085d6"},100);
        $(".icon-error").fadeOut(100);
        return true;
    }else {
        console.log("Url Verify Denied");
        $("#urlvalue").animate({borderColor:"#ff0000"},100);
        $(".icon-error").fadeIn(100);
        return false;
    }
}
function make() {
    console.log("Start Make");
    if (!urlverify()) {return false}
    $.ajax({
        url: "make.php",
        method: "POST",
        timeout: 10000,
        datatype: "text",
        data: { url : url },
        beforeSend: function () {
            console.log("Sending Data to Server");
            $("#urlvalue").prop("disabled", true);
            $("#urlvalue").val("處理中...");
        },
        success: function(shortlink) {
            if (shortlink === "Url Verify Error") {
                console.log("Server Responses Url is Invalid");
                $("#urlvalue").val("");
                $("#urlvalue").animate({borderColor:"#ff0000"},100);
                $(".icon-error").fadeIn(100);
            } else {
                console.log("Server Responses Shortlink");
                $("#urlvalue").val(shortlink);
            }
        },
        error: function () {
            console.log("Server Error");
            alert("伺服器錯誤，請稍後再試");
        },
        complete: function () {
            console.log("Make End");
            $("#urlvalue").prop("disabled", false);
        }
    });
}