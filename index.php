<?php
$shortlink = $_SERVER['REQUEST_URI'];
$shortlink = substr_replace($shortlink, "", 0, 1);
if(@strlen($shortlink) == 4) {
    include("connect.php"); //連接資料庫
    $urlexist = "select * from url where shortlink = '$shortlink' limit 1";
    $result = mysqli_query($sql, $urlexist); //找出該網址
    $row = mysqli_fetch_row($result); //將該網址資料轉成Array陣列
    if($row[2] == "1") {
        $url = "https://$row[0]";
        header("Location:$url");
        exit;
    }else if($row[2] == "0") {
        $url = "http://$row[0]";
        header("Location:$url");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PartMent 短網址 - 開源、無廣告的短網址產生器</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="PartMent短網址是一個開源且沒有廣告的短網址產生器">
        <link href="./assets/common.css" rel="stylesheet">
        <link rel="icon" href="https://i2.wp.com/blog.partment.ga/wp-content/uploads/2016/01/cropped-11074718_942141312477271_5563476975322300632_n.png?fit=32%2C32" sizes="32x32">
        <link rel="icon" href="https://i2.wp.com/blog.partment.ga/wp-content/uploads/2016/01/cropped-11074718_942141312477271_5563476975322300632_n.png?fit=192%2C192" sizes="192x192">
        <script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" integrity="sha384-YWP9O4NjmcGo4oEJFXvvYSEzuHIvey+LbXkBNJ1Kd0yfugEZN9NCQNpRYBVC1RvA" crossorigin="anonymous"></script>
        <script src="./assets/common.js"></script>
    </head>
    <body>
        <div id="container">
            <div id="title">PartMent 短網址 - 開源、無廣告的短網址產生器</div>
            <div id="url"><input id="urlvalue" type="text" placeholder="輸入網址" onkeyup="urlverify();" autofocus><li class="icon icon-error"></div>
            <div id="submit" onclick="make();">產生短網址</div>
        </div>
        <div id="footer">Open Source : <a target="blank" href="http://ptmt.ml/mY0i">GitHub</a> Alpha 1.0.2</div>
    </body>
</html>