<?php session_start('SR');
include "db.php"; ?>
<html>
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src='backstretch.js' type='text/javascript'></script>
		<script>
			function deleteItem(id){
			$('#popUp1').fadeOut();
				$('#popUp1').load('browse2.php?mode=delete&id='+id,function(){
					$('.miniBox.'+id).fadeOut();
				});
			}
			function loadInfo(id,mode){
				if (mode=='hide'){
					$('#popUp1').hide();
					$('.miniBox').show();
					$.backstretch('bg.jpg');
				}else{
					$('#popUp1').show();
					$('.miniBox').hide();
					$('#popUp1').text("Updating...");
					$('#popUp1').load('browse2.php?mode=moreInfo&id='+id);
					$.backstretch('bg.jpg');
				}
			}
			$(window).scroll(function() {
				if($(window).scrollTop()>125){
					$('#navContainer').css('top','0');
				}else{
					$('#navContainer').css('top','175');
				}
			});
			function filter(type){
				var sort = $('#sort').val();
				$('#currentType').text(type);
				$('.miniBox').fadeOut();
				$('#loadingZone').load('browse2.php?mode=filter&type='+type+'&sort='+sort,function(){
					$(".miniBox").each(function(index) {
						$(this).delay(50*index).fadeIn(300);
					});
				});
			}
			function search(){
				var query = $('#search').val();
				$('.miniBox').fadeOut();
				$('#loadingZone').load('browse2.php?mode=search&query='+query,function(){
					$(".miniBox").each(function(index) {
						$(this).delay(50*index).fadeIn(300);
					});
				});
			}
			function sort(){
				$('.miniBox').fadeOut();
				var sort = $('#sort').val();
				var type = $('#currentType').val();
				if(type==''){
					type = 'all';
				}
				$('#loadingZone').load('browse2.php?mode=filter&type='+type+'&sort='+sort,function(){
					$(".miniBox").each(function(index) {
						$(this).delay(50*index).fadeIn(300);
					});
				});
			}
		</script>
		<link rel='stylesheet' href='main.css' type='text/css'/>
	</head>

	<body>
		<div class='mainBody'>
		<div id='popUp1' style='display:none;'></div>
			<?php 
			include "nav.php";
			include "db.php";
			echo "<datalist id='titles'>";
				$res2 = mysql_query("SELECT * FROM resources") or die(mysql_error());
					while($row = mysql_fetch_array($res2)){
						echo "<option value='$row[title]'>";
					}
			echo "</datalist>";
			echo "<div id='navContainer' style='position:fixed;width:1000px;z-index:1;'>";
				echo "<ul class='sideBar' style='float:right;'>";
					echo "<li><input type='text' name='search' id='search' placeholder='Search...' list='titles' onchange='search()'/>
						<button style='width:40px;' onclick='search()'>GO!</button>
						</li>";
					echo "<li>Sort By: <select name='sort' id='sort' onchange='sort()'>";
						echo "<option value='timestamp'>Date Added</option>";
						echo "<option value='title'>Title (A-Z)</option>";
						echo "<option value='user'>User</option>";
					echo "</select></li>";
					echo "<li onclick=\"filter('all')\">All</li>";
					echo "<li onclick=\"filter('script')\">Scripts</li>";
					echo "<li onclick=\"filter('background')\">Backgrounds</li>";
					echo "<li onclick=\"filter('sound')\">Sounds</li>";
					echo "<li onclick=\"filter('sprite')\">Sprites</li>";
				echo "</ul>";
			echo "</div>";
			echo "<span id='currentType' style='display:none;'></span>";
			echo "<br/><br/><br/>";
			echo "<div id='loadingZone'>";
			$res1 = mysql_query("SELECT * FROM resources ORDER BY timestamp LIMIT 0,20") or die(mysql_error());
				while($row = mysql_fetch_array($res1)){
					$type = clearHTML($row[type]);
					$title = clearHTML($row[title]);
					$description = clearHTML($row[description]);
					$user = clearHTML($row[user]);
					if($user==''){$user="Unknown";}
					echo "<div class='miniBox $row[id]' onclick=\"loadInfo('$row[id]')\">";
						echo "<img src='$type.png' width='50' height='50' style='float:left;border:none;'/>";
						echo "<b>$title</b><br/>";
						echo "<b>Shared by</b> <span onclick=\"filterUser('$user')\">$user</span><br/>";
						echo "<i>$description</i>";
					echo "</div>";
				}
			echo "</div>";
			?>
		</div>
	</body>
</html>