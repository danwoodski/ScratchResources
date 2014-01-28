<?php
	function clearHTML($text, $linebreaks = false) {
		$text = htmlspecialchars($text);
		if ($linebreaks) {
			$text = preg_replace('/\R/u', "\n", $text);
		}
		return $text;
	}
	include "db.php";
	if($_GET[mode]=='moreInfo'){
		$id = $_GET[id];
		$res1 = mysql_query("SELECT * FROM resources WHERE id='$id'") or die(mysql_error());
			while($row = mysql_fetch_array($res1)){
				$type = $row[type];
				echo "<img src='$type.png' width='100' height='100' style='float:left;margin:0;'/>";
				echo "<span class='x' onclick=\"loadInfo('0','hide')\"> X </span>";
				$title = $row[title];
				$description = $row[description];
				$user = $row[user];
				$date = date('M d, Y',strtotime($row[timestamp]));
				if($user==''){$user="Unknown";}
				echo "<b style='font-size:2em;'>$title</b><br/>";
				echo "<b>Shared by: </b><span onclick=\"filterUser('$user')\">$user</span> <b>on</b> $date<br/>";
				echo "<b>Description: </b><i>$description</i><br/>";
				echo "<b>Category: </b>$category<br/>";
				echo "<hr/>";
				if($type=='script'){
					echo "Made for $program - <a href='help/import_$program' target='_new'>Import Help</a>";
					echo "<b>";
				}
			}
	}elseif($_GET[mode]=='lessInfo'){
		$res1 = mysql_query("SELECT * FROM resources WHERE id='$_GET[id]'") or die(mysql_error());
			while($row = mysql_fetch_array($res1)){
				$type = clearHTML($row[type]);
				$title = clearHTML($row[title]);
				$description = clearHTML($row[description]);
				$user = clearHTML($row[user]);
				if($user==''){$user="Unknown";}
				echo "<img src='$type.png' width='50' height='50' style='float:left;border:none;'/>";
				echo "<b>$title</b><br/>";
				echo "<b>Shared by</b><span onclick=\"filterUser('$user')\">$user</span><br/>";
				echo "<i>$description</i>";
			}
	}elseif($_GET[mode]=='filter'){
		$type = mysql_real_escape_string($_GET[type]);
		$sort = mysql_real_escape_string($_GET['sort']);
		if($type=='all'){
			$res1 = mysql_query("SELECT * FROM resources ORDER BY $sort") or die(mysql_error());
		}else{
			$res1 = mysql_query("SELECT * FROM resources WHERE type='$type' ORDER BY $sort") or die(mysql_error());
		}
				while($row = mysql_fetch_array($res1)){
					$type = clearHTML($row[type]);
					$title = clearHTML($row[title]);
					$description = clearHTML($row[description]);
					$user = clearHTML($row[user]);
					$date = date('Y-m-d');
					if($user==''){$user="Unknown";}
					echo "<div class='miniBox $row[id]' onclick=\"loadInfo('$row[id]')\" style='display:none;'>";
						echo "<img src='$type.png' width='50' height='50' style='float:left;border:none;'/>";
						echo "<b>$title</b><br/>";
						echo "<b>Shared by</b> <span onclick=\"filterUser('$user')\">$user</span><br/>";
						echo "<i>$description</i>";
					echo "</div>";
				}
	}
?>