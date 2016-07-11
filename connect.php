<?php
$db_host = "";
$db_user = "";
$db_pw = "";
$db_database = "";
$sql = new mysqli($db_host, $db_user, $db_pw, $db_database);
if(!$sql)
    die("無法對資料庫連線");
?>