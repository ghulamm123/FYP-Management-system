<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'admin') ) {
	$file_ret = $conn->prepare('SELECT t1.username, t2.filename, t2.description FROM groups t1 INNER JOIN proposals t2 ON t1.id = t2.group_id WHERE t2.poster = 1');
	$file_ret->execute();
	}

	else{
	header("Location: admin_login.php");
	}
include ('admin_navbar.html');
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
		<p><font size="5">Poster and Brochure Of Projects:</font></p>

			<?php while($results = $file_ret->fetch(PDO::FETCH_ASSOC)){ ?>
			<div class="box">
			<?php
			$Poster_show = 'uploads/poster/'.$results['filename'].$results['username'];
			$Brochure_show = 'uploads/brochure/'.$results['filename'].$results['username'];
			echo "Project Name: ".$results['filename']. "<br>";
			echo "Project Description: ".$results['description']. "<br>";
			echo "<a href='$Poster_show'>POSTER</a>". "<br>";
			echo "<a href='$Brochure_show'>BROCHURE</a>". "<br>" ."</div>" . "<br>";
			}
			?>

</body>
</html>
