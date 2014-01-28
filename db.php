<?php
if($_SERVER[SERVER_ADDR]=='::1' or $_SERVER[SERVER_ADDR]=='192.168.1.107' or $_SERVER[SERVER_ADDR]=='danslaptop'){
$con = mysql_connect("localhost","root","") or die('Could not Connect: '.mysql_error());
mysql_select_db("ScratchResources",$con);
}else{
$con = mysql_connect("mysql.1freehosting.com","u193037307_admin","ski4ever");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("u193037307_bl", $con);
}
?>