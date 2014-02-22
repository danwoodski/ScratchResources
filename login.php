<?php session_start('SR'); ?>
<html>
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src='backstretch.js' type='text/javascript'></script>
		<link rel='stylesheet' href='main.css' type='text/css'/>
		<script>
			function InterForm(type){
				$('.optional').fadeOut();
				$('.'+type).fadeIn();
				if(type=='background'){
					$('#file').attr("accept","image/*");
				}else if(type=='sprite'){
					$('#file').attr("accept",".sprite2");
				}else if(type=='script'){
					$('#file').attr("accept",".sprite2,.sprite,.sb,.sb2");
				}else if(type=='sound'){
					$('#file').attr("accept","audio/*");
				}
			}
		</script>
	</head>

	<body>
		<div class='mainBody'>
			<?php 
			include "nav.php";
			include "db.php";
			?>
			<?php
				if(isset($_POST[username])){
					$username = mysql_real_escape_string($_POST[username]);
					$password = hash('sha256',mysql_real_escape_string($_POST[password]));
					$res1 = mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password'") or die(mysql_error());
						if(mysql_num_rows($res1)>0){
							echo "Success!";
							echo "<script>window.open('index.php','_self');</script>";
							$_SESSION[user] = $_POST[username];
						}else{
							echo "Incorrect Username or Password.";
						}
				}
				if($_GET[mode]=='logout'){
					unset($_SESSION[user]);
					echo "<script>window.open('index.php','_self');</script>";
				}
			?>
			<div style='padding:5px;'>
				<h1>Login</h1>
				Don't have an account?  <a href='newAccount.php' style='color:red;'>Create One.</a>
				<form action='login.php' method='post' enctype="multipart/form-data">
					Username: <input type='text' name='username' required='required'/><br/>
					Password: <input type='password' name='password' required='required'/><br/>
					<input type='submit' value='SUBMIT'/>
				</form>
			</div>
		</div>
	</body>
</html>