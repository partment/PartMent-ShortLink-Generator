<?php
$shortlink = $_SERVER['REQUEST_URI'];
$shortlink = substr_replace($shortlink, "", 0, 1);
if(@strlen($shortlink) == 4) {
    include("connect.php"); //連接資料庫
    $urlexist = "select * from url where binary shortlink = '$shortlink' limit 1";
    $result = mysqli_query($sql, $urlexist); //找出該網址
    $row = mysqli_fetch_row($result); //將該網址資料轉成Array陣列
    if($row[2] == "1") {
    	$count = $row[3]+1;
    	$addcount = "update url set count = '$count' where binary shortlink = '$shortlink' limit 1";
    	$add = mysqli_query($sql, $addcount);
        $url = "https://$row[0]";
        header("Location: ".$url);
        exit;
    }else if($row[2] == "0") {
    	$count = $row[3]+1;
    	$addcount = "update url set count = '$count' where binary shortlink = '$shortlink' limit 1";
    	$add = mysqli_query($sql, $addcount);
        $url = "http://$row[0]";
        header("Location: ".$url);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
    <head>
        <title>PartMent 短網址 - 開源、無廣告的短網址產生器</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="keywords" content="PartMent 短網址">
        <meta name="description" content="PartMent短網址是一個開源且沒有廣告的短網址產生器">
        <link rel="canonical" href="https://ptmt.ml/">
        <link href="./assets/common.css" rel="stylesheet">
        <script src="./assets/jquery-3.0.0.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
        <script src="./assets/jquery-ui.min.js" integrity="sha384-YWP9O4NjmcGo4oEJFXvvYSEzuHIvey+LbXkBNJ1Kd0yfugEZN9NCQNpRYBVC1RvA" crossorigin="anonymous"></script>
        <script src="./assets/common.js"></script>
    </head>
    <body>
        <div id="container">
            <div id="title">PartMent 短網址 - 開源、無廣告的短網址產生器</div>
            <div id="url"><input id="urlvalue" type="text" placeholder="輸入網址" onkeyup="urlverify();" autofocus><li class="icon icon-error"></div>
            <div id="submit" onclick="make();">產生短網址</div>
        </div>
        <div id="footer">Open Source : <a target="blank" href="https://ptmt.ml/Q6R5">GitHub</a> | <a target="blank" href="https://status.ptmt.ml/">Status</a> | Alpha 1.0.3</div>
    </body>
</html>