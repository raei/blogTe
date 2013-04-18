<?php

include_once("config.php");

mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysql_query('SET NAMES utf8'); 
mysql_query('SET CHARACTER_SET utf8;');  
mysql_select_db(DB_DATABASE);



// Host, database, user and password stored in separate file
//require_once('config.php');
/*
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
if (mysqli_connect_error()) {
    print_r("Connect failed: ".mysqli_connect_error()."<br>");
  exit();
}
print_r( "<p>Connected successfully</p>");
*/
include_once("func/blog.php");


