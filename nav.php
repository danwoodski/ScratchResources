<link href='http://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
<script>
$.backstretch('bg.jpg');
</script>
<div class='header'>
<div class='loginBox'>
	<?php
		if(isset($_SESSION[user])){
			echo "Welcome, $_SESSION[user] | <a class='login' href='login.php?mode=logout'>Logout</a>";
		}else{
			echo "<a class='login' href='login.php'>Login</a> | <a class='login' href='newAccount.php'>New Account</a>";
		}
	?>
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