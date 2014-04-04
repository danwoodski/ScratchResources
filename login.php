<?php session_start('SR'); ?>
			<?php 
			include "db.php";
			?>
			<?php
				if($_GET[mode]=='login'){
					$username = mysql_real_escape_string($_GET[username]);
					$password = hash('sha256',mysql_real_escape_string($_GET[password]));
					$res1 = mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password'") or die(mysql_error());
						if(mysql_num_rows($res1)>0){
							echo "Success!";
							echo "<script>window.open('index.php','_self');</script>";
							$_SESSION[user] = $_GET[username];
						}else{
							echo "Incorrect Username or Password.";
						}
				}
				elseif($_GET[mode]=='logout'){
					unset($_SESSION[user]);
					echo "<script>window.open('index.php','_self');</script>";
				}else{
					if(isset($_GET[username])){
					$username = mysql_real_escape_string($_GET[username]);
					$password = hash('sha256',mysql_real_escape_string($_GET[password]));
					$res1 = mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password'") or die(mysql_error());
						if(mysql_num_rows($res1)>0){
							echo "Success!";
						}else{
							echo "Incorrect Username or Password.";
						}
					}
				}
			?>