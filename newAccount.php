<?php session_start('SR'); ?>
<html>
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src='backstretch.js' type='text/javascript'></script>
		<link rel='stylesheet' href='main.css' type='text/css'/>
	</head>

	<body>
		<div class='mainBody'>
			<?php include "nav.php";?>
			<div style='padding:5px;'>
				<h1>Create a New Account</h1>
				Already have an account?  <a href='login.php' style='color:red;'>Login Here.</a>
				<form action='newAccount2.php' method='post' enctype="multipart/form-data">
					Username <i>Scratch username, please!</i>: <br/>
					<input type='text' name='username' id='username' required='required'/><br/>
					Password: <i>Doesn't have to be the same as on Scratch</i><br/>
					<input type='password' name='password' id='password' required/>
					<input type='submit' value='SUBMIT'/>
				</form>
			</div>
		</div>
	</body>
</html>