<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'student') ) {
	$file_ret = $conn->prepare('SELECT filename, description, poster FROM proposals WHERE group_id = :id AND internal_id = :internal_id');
	$file_ret->bindParam(':id', $_SESSION['user_id']);
	$file_ret->bindParam(':internal_id', $_SESSION['internal_id']);
	$file_ret->execute();
	$results = $file_ret->fetch(PDO::FETCH_ASSOC);
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

		<?php if ( $results['poster'] == 0 ){ ?>
			<p><font size="5">Upload Poster and Brochure Of Your Project:</font></p>

				<form action="upload.php" method="POST" enctype="multipart/form-data">
				<input type="file" name="poster" required> <br />
				<input type="file" name="brochure" required> <br />
				<button type="submit" name="document" value="<?php echo $results['filename']; ?>" >UPLOAD FILE</button>
				</form>

		<?php
			}

			elseif ( $results['poster'] == 1 ) {
				echo "<p><font size='5'>Poster and Brochure Of Your Project:</font></p>";
				echo "<div class='box'>";
				$poster_show = 'uploads/poster/'.$results['filename'].$_SESSION['username'];
				$brochure_show = 'uploads/brochure/'.$results['filename'].$_SESSION['username'];
				echo "Project Name: ".$results['filename']. "<br>";
				echo "Project Description: ".$results['description']. "<br>";
				echo "<a href='$poster_show'>POSTER</a>". "<br>";
				echo "<a href='$brochure_show'>BROCHURE</a>". "<br>" ."</div>" . "<br>";

			}

			?>
</body>
</html>
