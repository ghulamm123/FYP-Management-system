<?php

session_start();

if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'teacher') && ($_SESSION['committee'] != '0') ) {
	$file_ret = $conn->prepare('SELECT filename, description, date_time FROM uploads WHERE internal_id = :id AND group_req_id IS NULL AND group_id IS NULL');
	$file_ret->bindParam(':id', $_SESSION['user_id']);
	$file_ret->execute();
	}

	else{
	header("Location: login.php");
	}
include ('committee_navbar.html');
?>


<!DOCTYPE html>
<html>
<head>
	<title>FYMS</title>
	<style>

	input[type=text], select {
		width: 20%;


		display: inline-block;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;


		width: 100%;
		 border: 1px solid #ccc;
		 background: #FFF;
		 margin: 0 0 5px;
		 padding: 10px;

	}

	input[type=submit] {
		width: 20%;
		background-color: #4CAF50;
		color: white;
		padding: 14px 20px;
		margin: 8px 0;
		border: none;
		border-radius: 2px;
		cursor: pointer;





	}

	input[type=submit]:hover {
		background-color: #45a049;
	}

	fieldset {
				 background: #e1eff2;
			 }
			 legend {
				 padding: 10px 0;
				 font-size: 20px;
			 }












	.box {
    border: 1px solid red;
		border-style: dotted dashed solid double;
	}
	</style>
	<!--<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'> -->
</head>
<body>
		<br />Welcome <?= $_SESSION['username']; ?>
		<br /><br />
		<form action="upload.php" method="POST" enctype="multipart/form-data">
			Project Name: <input type="text" name="namefile"> <br /><br />
			Description:  <textarea rows = "6" cols = "50" maxlength="300" placeholder="Enter description here...(300 character only)" name = "description">
			</textarea>
			<input type="file" name="file">
			<button type="submit" name="submit">UPLOAD FILE</button>
			</form>
			<p><font size="5">Uploaded Projects:</font></p>
				<?php while($results = $file_ret->fetch(PDO::FETCH_ASSOC)){ ?>
				<div class="box">
				<?php
				$files_show = 'uploads/internals/'.$results['filename'].$_SESSION['username'];
				echo "Project Name: ".$results['filename'] ."<p style='text-align: right'>".$results['date_time']."</p>" ."<br>";
				echo "Project Description: ".$results['description']. "<br>";
				echo "<a href='$files_show'>DETAILS</a>" ."<a href='delete_record.php?filename=".$results['filename']."' style='float: right;'>DELETE</a>" . "<br>". "</div>".  "<br>";
				}
				?>

</body>
</html>
