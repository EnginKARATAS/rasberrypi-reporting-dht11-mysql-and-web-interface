<?php
$db_host = "192.168.1.109";
//$db_host = "127.0.0.1";
$db_name = "isi_nem_db";
$db_user = "root";
$db_pass = "123";
//$db_user = "samet";
//$db_pass = "Bozok*2018";
try
{
    $db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass,  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>