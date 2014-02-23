<?php session_start('SR'); ?>
<html>
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src='backstretch.js' type='text/javascript'></script>
		<link rel='stylesheet' href='main.css' type='text/css'/>
	</head>
	<script>
		function loadInfo(id,mode){
				if (mode=='hide'){
					$('#popUp1').hide();
				}else{
					$('#popUp1').show();
					$('#popUp1').text("Updating...");
					$('#popUp1').load('browse2.php?mode=moreInfo&id='+id);
				}
			}
		function fadeIn(){
			$('.miniBox').fadeIn();
		}
	</script>

	<body onload='fadeIn()'>
		<div class='mainBody'>
		<div id='popUp1' style='display:none;'></div>
			<?php
			include "nav.php";
			include "db.php";
			echo "<table>";
				echo "<tr>";
					echo "<td>";
						echo "<h3>Recent Uploads</h3>";
						$res1 = mysql_query("SELECT * FROM resources ORDER BY timestamp DESC LIMIT 0,10") or die(mysql_error());
						//if(mysql_num_rows($res1)==0){echo "No Results.";}
							while($row = mysql_fetch_array($res1)){
								$type = $row[type];
								$title = $row[title];
								$description = $row[description];
								$user = $row[user];
								$date = date('Y-m-d');
								if($user==''){$user="Unknown";}
								echo "<div class='miniBox $row[id] column1' onclick=\"loadInfo('$row[id]')\" style='display:none;'>";
									echo "<img src='$type.png' width='50' height='50' style='float:left;border:none;border:none;border-top-left-radius:5px;'/>";
									echo "<b>$title</b><br/>";
									echo "<b>Shared by</b> <span onclick=\"filterUser('$user')\">$user</span><br/>";
									echo "<i>$description</i>";
								echo "</div>";
							}
					echo "</td>";
					echo "<td>";
						echo "<h3>Top Downloaded</h3>";
						$res1 = mysql_query("SELECT * FROM resources ORDER BY timestamp ASC LIMIT 0,10") or die(mysql_error());
						//if(mysql_num_rows($res1)==0){echo "No Results.";}
							while($row = mysql_fetch_array($res1)){
								$type = $row[type];
								$title = $row[title];
								$description = $row[description];
								$user = $row[user];
								$date = date('Y-m-d');
								if($user==''){$user="Unknown";}
								echo "<div class='miniBox column2 $row[id]' onclick=\"loadInfo('$row[id]')\" style='display:none;'>";
									echo "<img src='$type.png' width='50' height='50' style='float:left;border:none;border:none;border-top-left-radius:5px;'/>";
									echo "<b>$title</b><br/>";
									echo "<b>Shared by</b> <span onclick=\"filterUser('$user')\">$user</span><br/>";
									echo "<i>$description</i>";
								echo "</div>";
							}
					echo "</td>";
				echo "</tr>";
			echo "</table>";
			?>
		</div>
	</body>
</html>