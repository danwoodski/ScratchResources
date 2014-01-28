<?php
	//Add Login Checker Here
	include "db.php";
	$type = $_POST[type];
	$title = mysql_real_escape_string($_POST[title]);
	$description = mysql_real_escape_string($_POST[description]);
	if($type=='script'){
		$program = $_POST[program];
	}
	if($type=='' or $title==''){
		echo "ERROR: You left a required field blank.";
		echo "<script>window.open('share.php','_self');</script>";
	}
	$uploaddir = "uploads/$type/";
	$uploadfile = $uploaddir.basename($_FILES['file']['name']);
	echo $_FILES['file']['error'];
	if(!move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)){
		echo "FILE UPLOAD ERROR";
	}
	mysql_query("INSERT INTO resources (type,title,description,program) VALUES ('$type','$title','$description','$program')") or die(mysql_error());
	echo "<script>window.open('browse.php','_self');</script>";
?>