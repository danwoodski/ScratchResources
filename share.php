<?php session_start('SR'); ?>
<html>
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src='backstretch.js' type='text/javascript'></script>
		<link rel='stylesheet' href='main.css' type='text/css'/>
		<script>
			function InterForm(type){
				$('.optional').fadeOut();
				$('.'+type).fadeIn();
				if(type=='background'){
					$('#file').attr("accept","image/*");
				}else if(type=='sprite'){
					$('#file').attr("accept",".sprite2");
				}else if(type=='script'){
					$('#file').attr("accept",".sprite2,.sprite,.sb,.sb2");
				}else if(type=='sound'){
					$('#file').attr("accept","audio/*");
				}
				$('#category').empty();
				if(type=='background'){
					var options = 
					"<option value='indoors'>Indoors</option>"+
					"<option value='outdoors'>Outdoors</option>"+
					"<option value='nature'>Nature</option>"+
					"<option value='sports'>Sports</option>";
				}else if(type=='sprite'){
					var options = 
					"<option value='animals'>Animals</option>"+
					"<option value='fantasy'>Fantasy</option>"+
					"<option value='letters'>Letters</option>"+
					"<option value='people'>People</option>"+
					"<option value='things'>Things</option>"+
					"<option value='transportation'>Transportation</option>";
				}else if(type=='script'){
					var options = 
					"<option value='movement'>Movement</option>"+
					"<option value='math'>Math</option>"+
					"<option value='lists'>Lists</option>"+
					"<option value='misc'>Misc</option>";
				}else if(type=='sound'){
					var options = 
					"<option value='animal'>Animal</option>"+
					"<option value='effects'>Effects</option>"+
					"<option value='electronic'>Electronic</option>"+
					"<option value='human'>Human</option>"+
					"<option value='instruments'>Instruments</option>"+
					"<option value='music loops'>Music Loops</option>"+
					"<option value='percussion'>Percussion</option>"+
					"<option value='vocals'>Vocals</option>";
				}
				$('#category').append(options)
			}
		</script>
	</head>

	<body>
		<?php
			if(!isset($_SESSION[user])){
				echo "<script>alert('Please Login to continue.')</script>";
				echo "<script>window.open('index.php','_self');</script>";//Add login box here eventually
			}
		?>
		<div class='mainBody'>
			<?php include "nav.php";?>
			<div style='padding:5px;'>
				<h1>Share Your Creation!</h1>
				<form action='share2.php' method='post' enctype="multipart/form-data">
					What Are You Uploading?
						<input type='radio' name='type' id='type' value='background' checked onchange='InterForm(this.value)'>Background
						<input type='radio' name='type' id='type' value='sprite' onchange='InterForm(this.value)'>Sprite
						<input type='radio' name='type' id='type' value='script' onchange='InterForm(this.value)'>Script
						<input type='radio' name='type' id='type' value='sound' onchange='InterForm(this.value)'>Sound
					<br/><br/>
					Category
						<select id='category' name='category'>
							<option value='indoors'>Indoors</option>
							<option value='outdoors'>Outdoors</option>
							<option value='nature'>Nature</option>
							<option value='sports'>Sports</option>
						</select>
						<br/>
					<!--Script Only-->
					<div class='script optional' style='display:none;'>
					Which mod is your script made for?
						<input type='radio' name='program' id='program' value='Scratch 2.0' checked>Scratch 2.0
						<input type='radio' name='program' id='program' value='Snap'>Snap
					<br/><br/>
					</div>
					<!--------------->
					
					Title: <input type='text' required name='title' id='title' style='width:385px;'/><br/><br/>
					Description/Notes: <br/>
					<textarea rows='5' cols='50' name='description' id='description'></textarea>
					<br/><br/>
					Upload File: <input type='file' name='file' id='file' accept='image/*'/>
					<br/><br/>
					<input type='submit' value='SUBMIT'/>
				</form>
			</div>
		</div>
	</body>
</html>