<link href='http://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
<script>
$.backstretch('bg.jpg');
	function showLoginForm(divName){
		$('.loginBox1').hide();
		$('.'+divName).slideDown();
		$('#loginBox2').css('text-decoration','none');
		$('#loginBox3').css('text-decoration','none');
		$('#'+divName).css('text-decoration','underline');
	}
</script>
<div class='header'>
<div class='loginBox'>
	<?php
		if(isset($_SESSION[user])){
			echo "Welcome, $_SESSION[user] | <a class='login' href='login.php?mode=logout'>Logout</a>";
		}else{
			echo "<span class='login link' id='loginBox2' onclick=\"showLoginForm('loginBox2')\">Login</span> | ";
			echo "<span class='login link' id='loginBox3' onclick=\"showLoginForm('loginBox3')\">New Account</span>";
		}
	?>
	<!--Login-->
	<div class='loginBox1 loginBox2' style='display:none;'>
		<form action='#' onsubmit='checkLogin()' method='post' enctype="multipart/form-data">
			<table>
			<tr><td class='loginBox3'>Username</td><td><input type='text' name='username' required='required'/></td></tr>
			<tr><td class='loginBox3'>Password</td><td><input type='password' name='password' required='required'/></td></tr>
			<tr>
				<td class='loginBox3'><input type='submit' value='SUBMIT' class='submitButton1'/></td>
				<td class='loginBox3'><button form='none' class='submitButton2' onclick='showLoginForm()'>CANCEL</button></td>
			</tr>
			</table>
		</form>
	</div>
	<!--New Account-->
	<div class='loginBox1 loginBox3' style='display:none;'>
		<form action='newAccount2.php' method='post' enctype="multipart/form-data">
			<table>
			<tr><td class='loginBox3'>Username</td><td><input type='text' name='username' required='required'/></td></tr>
			<tr><td class='loginBox3'>Password</td><td><input type='password' name='password' required='required'/></td></tr>
			<tr>
				<td class='loginBox3'><input type='submit' value='SUBMIT' class='submitButton1'/></td>
				<td class='loginBox3'><button form='none' class='submitButton2' onclick='showLoginForm()'>CANCEL</button></td>
			</tr>
			</table>
		</form>
	</div>
</div>
	Scratch Resources <span style='font-size:15px;'>Beta</span>
</div>
<ul class='mainMenu'>
	<li class='mainMenuItem'><a href='index.php'>HOME</a></li>
	<li class='mainMenuItem'><a href='share.php'>SHARE</a></li>
	<li class='mainMenuItem'><a href='browse.php'>BROWSE</a></li>
	<li class='mainMenuItem'><a href='http://scratch.mit.edu/discuss/topic/27554/'>HELP</a></li>
</ul>
<br/><br/><br/>
<?php
	function clearHTML($text, $linebreaks = false) {
		$text = htmlspecialchars($text);
		if ($linebreaks) {
			$text = preg_replace('/\R/u', "\n", $text);
		}
		return $text;
		}
?>