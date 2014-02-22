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
			}
		</script>
	</head>

	<body>
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