<?php
	include "db.php";
	$username = mysql_real_escape_string($_POST[username]);
	$password = hash('sha256',mysql_real_escape_string($_POST[password]));
	mysql_query("INSERT INTO users (username,password) VALUES ('$username','$password')") or die(mysql_error());
	echo "<script>window.open('index.php','_self');</script>";
?>