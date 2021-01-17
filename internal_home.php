<?php

session_start();

if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'teacher') && ($_SESSION['committee'] == '0') ) {
	$file_ret = $conn->prepare('SELECT filename, description, date_time FROM uploads WHERE internal_id = :id AND group_req_id IS NULL AND group_id IS NULL');
	$file_ret->bindParam(':id', $_SESSION['user_id']);
	$file_ret->execute();
	}

	else{
	header("Location: login.php");
	}
include ('internal_navbar.html');
?>


<!DOCTYPE html>
<html>
<head>
	<title>FYMS</title>
	<style>
	.box {
    border: 1px solid black;
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
