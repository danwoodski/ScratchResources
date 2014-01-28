<link href='http://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
<script>
$.backstretch('bg.jpg');
</script>
<div class='header'>
	Scratch Resources
</div>
<ul class='mainMenu'>
	<li class='mainMenuItem'><a href='index.php'>HOME</a></li>
	<li class='mainMenuItem'><a href='share.php'>SHARE</a></li>
	<li class='mainMenuItem'><a href='browse.php'>BROWSE</a></li>
	<li class='mainMenuItem'><a href='help.php'>HELP</a></li>
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