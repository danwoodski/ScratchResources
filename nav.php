<?php session_start("SR");?>
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
	function checkLogin(){
		var username = $('#username').val();
		var password = $('#password').val();
		$('#notebox1').remove();
		$('.loginBox1.loginBox2').prepend("<span id='notebox1'>Please Wait...</span>");
		$('#invisibox').load('login.php?username='+username+'&password='+password,function(responseTxt){
			response = responseTxt.trim();
			if(response=='Success!'){
				window.open('login.php?mode=login&username='+username+'&password='+password,'_self');
			}else{
				$('#notebox1').text('Incorrect Username or Password').delay('5000').fadeOut('slow');
				$('#username').val('');
				$('#password').val('');
			}
		});
		return false;
	}
	function expandSearch(){
		//$('#searchInput').slideToggle();
		//$('#searchInput').css('width','0');
		if($('#searchInput').is(':visible')){
			//Hide
			//$('#searchInput').animate({width: "-=0"}, 100);
			$('.searchInput').hide();
		}else{
			//Show
			//$('#searchInput').show().css('width','0');
			//$('#searchInput').animate({width: "+=172"}, 100);
			$('.searchInput').show();
			$('#searchInput').focus();
		}
		
	}
	function navSearch(){
		query = $('#searchInput').val();
		window.open('browse.php?mode=search&query='+query,'_self');
	}
</script>
<div id='invisibox' style='display:none;'></div>
<div class='header'>
<div class='loginBox' style='min-width:230px;max-width:350px;overflow:hidden;'>
<span class='searchBox' style='z-index:10000;position:relative;'>
	<img class='searchButton' src='search.png' onclick='expandSearch()'/>
	<input type='text' class='searchInput' id='searchInput' onchange='navSearch()' placeholder='search...' style='display:none;margin-right:-230px;width:230px;'/>
	<span class='x2 searchInput' style='display:none;' onclick='expandSearch()'>X</span>
</span>
	<span id='loginLinks'>
	<?php
		if(isset($_SESSION[user])){
			echo "Welcome, $_SESSION[user] | <a class='login' href='login.php?mode=logout'>Logout</a>";
		}else{
			echo "<span class='login link' id='loginBox2' onclick=\"showLoginForm('loginBox2')\">Login</span> | ";
			echo "<span class='login link' id='loginBox3' onclick=\"showLoginForm('loginBox3')\">New Account</span>";
		}
	?>
	</span>
	<!--Login-->
	<div class='loginBox1 loginBox2' style='display:none;'>
		<form action='#' onsubmit='return checkLogin();' method='post' enctype="multipart/form-data" style='margin-bottom:-3px;'>
			<table>
			<tr><td class='loginBox3'>Username</td><td><input id='username' type='text' name='username' required='required'/></td></tr>
			<tr><td class='loginBox3'>Password</td><td><input id='password' type='password' name='password' required='required'/></td></tr>
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