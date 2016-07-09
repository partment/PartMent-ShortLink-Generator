function urlverify() {
    console.log("Start UrlVerify");
    var url = $("#urlvalue").val();
    var regUrl = /(?:https?:\/\/)?(?:[a-zA-Z0-9.-]+?\.(?:[a-zA-Z])|\d+\.\d+\.\d+\.\d+)/;
    if(regUrl.test(url)) {
        console.log("Url Verify Pass");
        $("#urlvalue").animate({borderColor:"#0085d6"},100);
        $(".icon-error").fadeOut(100);
        return true;
    }else {
        console.log("Url Verify Denied");
        $("#urlvalue").animate({borderColor:"#ff0000"},100);
        $(".icon-error").fadeIn(100);
        return false;
    };
};
function make() {
    console.log("Start Make");
    var url = $("#urlvalue").val();
    if (!urlverify()) {return false};
    $.ajax({
        url: "make.php",
        method: "POST",
        timeout: 10000,
        datatype: "text",
        data: { url : url },
        beforeSend: function () {
            $("#urlvalue").prop("disabled", true);
            $("#urlvalue").val("處理中...");
        },
        success: function(shortlink) {
            $("#urlvalue").val(shortlink);
        },
        error: function () {
            alert("伺服器錯誤，請稍後再試");
        },
        complete: function () {
            $("#urlvalue").prop("disabled", false);
        }
    });
};