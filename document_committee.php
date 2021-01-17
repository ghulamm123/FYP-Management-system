<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'teacher') && ($_SESSION['committee'] != '0') ) {
	$file_ret = $conn->prepare('SELECT t1.username, t2.filename, t2.description FROM groups t1 INNER JOIN proposals t2 ON t1.id = t2.group_id WHERE t2.internal_id = :id AND t2.poster = 1');
	$file_ret->bindParam(':id', $_SESSION['user_id']);
	$file_ret->execute();

	$checklist = $conn->prepare('SELECT id, group_id, filename, description FROM proposals WHERE internal_id = :id AND checklist = 0');
	$checklist->bindParam(':id', $_SESSION['user_id']);
	$checklist->execute();
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
		<p><font size="5">Poster and Brochure Of Your Projects:</font></p>

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

			echo "<p><font size='5'>Final Submission Checklist For Project:</font></p>";

			while($project = $checklist->fetch(PDO::FETCH_ASSOC)){
			echo "<div class='box'>";
			echo "Project Name: ".$project['filename'] ."<br>";
			echo "Project Description: ".$project['description'];
			?>
			<form action="checklist_form.php" method="POST">
			<p style='text-align: right'>
			<input type="hidden" name="proposal_id" value="<?php echo $project['id']; ?>">
			<input type="hidden" name="group_id" value="<?php echo $project['group_id']; ?>">
			<button type="submit" name="checklist_form">Checklist</button>
			</p>
			</form> </div> <br>
			<?php

			}

			?>

</body>
</html>
