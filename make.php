<?php
include("connect.php"); //連接資料庫
$url = $_POST["url"]; //取得欲縮短網址
$regUrl = "%^(?:(?:https?:)?//)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu"; //網址正則表達式
function make_random($length = 4) { //產生4位亂碼函數
   if(is_numeric($length) && $length >0){
     $chr = array_merge(range('A', 'Z'), range('a', 'z'),range(0, 9));
     $out = '';
      for($i = 0;$i < $length;$i++) {
        $out .= $chr[mt_rand(0,count($chr)-1)];
      }
      return $out;
    }
}
if(preg_match($regUrl, $url)){ //比對網址
    $http = substr($url, 0, 7); //取得網址Protocol
    $https = substr($url, 0, 8); //取得網址Protocol
    $endpoint = substr($url, -1); //取得網址最後一個字
    while($endpoint == "." || $endpoint == "/") { //判斷網址最後一個字是否為 "."或"/"
        $url = substr_replace($url, "", -1, 1); //去除"."或"/"
        $endpoint = substr($url, -1); //取得網址最後一個字
    }
    if($http == "http://") { //判斷網址Protocol
        $url = substr_replace($url, "", 0, 7); //去除protocol
        $protocol = 0; //設定protocol參數
    }else if($https == "https://") {
        $url = substr_replace($url, "", 0, 8); //去除protocol
        $protocol = 1; //設定protocol參數
    }
    $localverify = substr($url, 0, 7);
    if($localverify == "ptmt.ml") {
        echo "Use Local Shortlink"; //回應網址不符合
        exit; //跳出
    }
    $urlexist = "select 1 from url where url = '$url' AND https = '$protocol' limit 1"; //網址是否存在SQL查詢語句
    $urlexistquery = mysqli_query($sql, $urlexist); //執行$urlexist
    if(mysqli_num_rows($urlexistquery)) { //判斷網址是否存在;
        $searchurl = "select * from url where url='$url'"; //找出該網址SQL語句
        $result = mysqli_query($sql, $searchurl); //找出該網址
        $row = mysqli_fetch_row($result); //將該網址資料轉成Array陣列
        echo $row[1]; //回應
        exit; //跳出
    }
    $random = make_random(); //產生亂數
    $shortlinkexist = "select 1 from url where shortlink = '$random' limit 1"; //短網址是否存在SQL查詢語句
    $shortlinkexistquery = mysqli_query($sql, $shortlinkexist); //執行$shortlinkexist
    while(mysqli_num_rows($shortlinkexistquery) == 1) { //重複判斷短網址是否存在
        $random = make_random(); //產生亂數
        $shortlinkexist = "select 1 from url where shortlink = '$random' limit 1"; //短網址是否存在SQL查詢語句
        $shortlinkexistquery = mysqli_query($sql, $shortlinkexist); //執行$shortlinkexist
    }
    $query = "insert into url (url, shortlink, https) values ('$url', '$random', '$protocol')"; //寫入網址、短網址和protocol參數SQL語句
    mysqli_query($sql, $query); //寫入網址、短網址和protocol參數
    echo $random; //回應短網址
    exit; //跳出
}else {
    echo "Url Verify Error"; //回應網址不符合
    exit; //跳出
}
?>