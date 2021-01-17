<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'student') ) {
	$file_ret = $conn->prepare('SELECT filename, description, date_time FROM proposals WHERE group_id = :id AND internal_id = :internal_id');
	$file_ret->bindParam(':id', $_SESSION['user_id']);
	$file_ret->bindParam(':internal_id', $_SESSION['internal_id']);
	$file_ret->execute();
}

	else{
	header("Location: login.php");
	}
include ('student_navbar.html');
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
		<p><font size="5">Your Project:</font></p>

			<?php while($results = $file_ret->fetch(PDO::FETCH_ASSOC)){ ?>
			<div class="box">
			<?php
			$files_show = 'uploads/proposals/'.$results['filename'].$_SESSION['username'];
			echo "Project Name: ".$results['filename'] ."<p style='text-align: right'>".$results['date_time']."</p>" ."<br>";
			echo "Project Description: ".$results['description']. "<br>";
			echo "<a href='$files_show'>DETAILS</a>". "<br>" ."</div>" . "<br>";
			}
			?>
</body>
</html>
