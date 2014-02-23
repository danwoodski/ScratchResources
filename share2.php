<?php
	session_start('SR');
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
	$path = $_FILES['file']['name'];
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	mysql_query("INSERT INTO resources (type,user,title,description,program,fileExt) VALUES ('$type','$_SESSION[user]','$title','$description','$program','$ext')") or die(mysql_error());
	$res1 = mysql_query("SELECT * FROM resources ORDER BY timestamp DESC LIMIT 0,1") or die(mysql_error());
		while($row = mysql_fetch_array($res1)){
			$id = $row[id];
		}
	rename($uploadfile, "uploads/$type/$id-$title.$ext");
	
	switch($type){
		case "background":
			if($ext=='jpg' or $ext=='png' or $ext=='JPG' or $ext=='PNG' or $ext=='jpeg'){}else{
				die("Invalid File Type!");
			}
			break;
		case "script":
			if($program=='scratch20'){
				if($ext=='sprite2' or $ext=='sprite' or $ext=='sb2' or $ext=='sb'){}else{
					die("Invalid File Type!");
				}
			}elseif($program=='snap'){
				if($ext=='ysp' or $ext=='xml'){}else{
					die("Invalid File Type!");
				}
			}
			break;
		case "sprite":
			if($program=='Scratch 2.0'){
				if($ext=='sprite2' or $ext=='sprite' or $ext=='sb2' or $ext=='sb'){}else{
					die("Invalid File Type!");
				}
			}elseif($program=='Snap'){
				if($ext=='ysp' or $ext=='xml'){}else{
					die("Invalid File Type!");
				}
			}
			break;
		case "sound":
			if($ext=='ogg' or $ext=='mp3' or $ext=='wma'){}else{
				die("Invalid File Type!");
			}
			break;
	}
	echo "<script>window.open('browse.php','_self');</script>";
?>