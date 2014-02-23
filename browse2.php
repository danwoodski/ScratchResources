<?php
session_start('SR');
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
				$type = $row[type];
				$user = $row[user];
				$ext = $row[fileExt];
				$date = date('M d, Y',strtotime($row[timestamp]));
				if($user==''){$user="Unknown";}
				echo "<b style='font-size:2em;'>$title</b><br/>";
				echo "<b>Shared by: </b><span onclick=\"filterUser('$user')\">$user</span> <b>on</b> $date<br/>";
				echo "<b>Description: </b><i>$description</i><br/>";
				echo "<b>Category: </b>$category<br/>";
				echo "<hr/>";
				if($type=='script'){
					if($program==''){$program='Unknown';}
					echo "Made for $program<br/>";
					echo "<b>";
				}
				$title = rawurlencode($title);
				echo "<a href='uploads/$type/$id-$title.$ext'>Download</a> | ";
				echo "<span class='link'>Download Help</span>";
				echo "<br/>";
				if($_SESSION[user]=='admin' or $_SESSION[user]==$user){
					echo "<span class='link' style='color:red;' onclick=\"deleteItem('$row[id]')\">Delete</span>";
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
				echo "<img src='$type.png' width='50' height='50' style='float:left;border:none;border:none;border-top-left-radius:5px;'/>";
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
						if($_SESSION[user]=='admin'){
							//echo "<span class='x' style='border-radius:0px 5px 0px 5px;' onclick='\"deleteItem('$row[id]')\">X</span>";
						}
						echo "<img src='$type.png' width='50' height='50' style='float:left;border:none;border:none;border-top-left-radius:5px;'/>";
						echo "<b>$title</b><br/>";
						echo "<b>Shared by</b> <span onclick=\"filterUser('$user')\">$user</span><br/>";
						echo "<i>$description</i>";
					echo "</div>";
				}
	}elseif($_GET[mode]=='search'){
		$type = mysql_real_escape_string($_GET[type]);
		$sort = mysql_real_escape_string($_GET['sort']);
		$query = mysql_real_escape_string($_GET[query]);
		// if($type=='all'){
			// $res1 = mysql_query("SELECT * FROM resources ORDER BY $sort") or die(mysql_error());
		// }else{
			// $res1 = mysql_query("SELECT * FROM resources WHERE type='$type' ORDER BY $sort") or die(mysql_error());
		// } //---Add back in if using type and sort for searches
			$res1 = mysql_query("SELECT * FROM resources WHERE title LIKE '%$query%' OR user LIKE '%$query%'") or die(mysql_error());
			if(mysql_num_rows($res1)==0){
				echo "No results were found.";
			}
				while($row = mysql_fetch_array($res1)){
					$type = clearHTML($row[type]);
					$title = clearHTML($row[title]);
					$description = clearHTML($row[description]);
					$user = clearHTML($row[user]);
					$date = date('Y-m-d');
					if($user==''){$user="Unknown";}
					echo "<div class='miniBox $row[id]' onclick=\"loadInfo('$row[id]')\" style='display:none;'>";
						echo "<img src='$type.png' width='50' height='50' style='float:left;border:none;border-top-left-radius:5px;'/>";
						echo "<b>$title</b><br/>";
						echo "<b>Shared by</b> <span onclick=\"filterUser('$user')\">$user</span><br/>";
						echo "<i>$description</i>";
					echo "</div>";
				}
	}elseif($_GET[mode]=='delete'){
		mysql_query("DELETE FROM resources WHERE id='$_GET[id]'") or die(mysql_error());
	}
?>