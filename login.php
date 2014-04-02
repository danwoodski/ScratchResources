<?php session_start('SR'); ?>
			<?php 
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