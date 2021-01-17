<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}

require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'teacher') && ($_SESSION['committee'] != '0') ) {
	$file_ret = $conn->prepare('SELECT t1.id, t1.username, t2.filename, t2.description, t2.date_time FROM groups t1 INNER JOIN proposals t2 ON t1.id = t2.group_id
				WHERE t1.midyear_external_id = :id AND t1.midyear_status = 0');
	$file_ret->bindParam(':id', $_SESSION['user_id']);
	$file_ret->execute();

	$evaluated = $conn->prepare('SELECT t1.id, t1.username, t2.filename, t2.description, t2.date_time FROM groups t1 INNER JOIN proposals t2 ON t1.id = t2.group_id
				WHERE t1.midyear_external_id = :id AND t1.midyear_status = 1');
	$evaluated->bindParam(':id', $_SESSION['user_id']);
	$evaluated->execute();

	$groups = $conn->prepare('SELECT t1.id, t1.username, t2.filename, t2.description, t2.date_time FROM groups t1 INNER JOIN proposals t2 ON t1.id = t2.group_id
				WHERE t1.internal_id = :id AND t1.midyear_status = 1');
	$groups->bindParam(':id', $_SESSION['user_id']);
	$groups->execute();
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
		<p><font size="5">Groups For Mid-Year Evaluation:</font></p>

		<?php while($results = $file_ret->fetch(PDO::FETCH_ASSOC)){
			echo "<div class='box'>";
			$group_info = $conn->prepare('SELECT fullname, rollno, enrollment, cgpa FROM students WHERE group_id = :id');
			$group_info->bindParam(':id', $results['id']);
			$group_info->execute();

			$files_show = 'uploads/proposals/'.$results['filename'].$results['username'];
			echo "Project Name: ".$results['filename'] ."<p style='text-align: right'>".$results['date_time']."</p>" ."<br>";
			echo "Project Description: ".$results['description']. "<br>";
			echo "<a href='$files_show'>DETAILS</a>". "<br>";

			while($row = $group_info->fetch(PDO::FETCH_ASSOC)){
				echo "Student Name: ".$row['fullname'] ." ROLL No: ".$row['rollno'] ."<br>";
				echo "Enrollment No: ".$row['enrollment'] ." CGPA: ".$row['cgpa'] ."<br>";
			}
		?>
		<form action="midyear_form.php" method="POST">
		<p style='text-align: right'>
		<button type="submit" name="group_id" value="<?php echo $results['id']; ?>">EVALUATE</button>
		</p>
		</form> </div> <br>
		<?php
		}

		echo "<p><font size='5'>Groups Evaluated By You:</font></p>";

		while($results = $evaluated->fetch(PDO::FETCH_ASSOC)){
			echo "<div class='box'>";
			$group_info = $conn->prepare('SELECT fullname, rollno, enrollment, cgpa FROM students WHERE group_id = :id');
			$group_info->bindParam(':id', $results['id']);
			$group_info->execute();

			$files_show = 'uploads/proposals/'.$results['filename'].$results['username'];
			echo "Project Name: ".$results['filename'] ."<p style='text-align: right'>".$results['date_time']."</p>" ."<br>";
			echo "Project Description: ".$results['description']. "<br>";
			echo "<a href='$files_show'>DETAILS</a>". "<br>";

			while($row = $group_info->fetch(PDO::FETCH_ASSOC)){
				echo "Student Name: ".$row['fullname'] ." ROLL No: ".$row['rollno'] ."<br>";
				echo "Enrollment No: ".$row['enrollment'] ." CGPA: ".$row['cgpa'] ."<br>";
			}
		?>
		<form action="midyear_response.php" method="POST">
		<input type="hidden" name="group_id" value="<?php echo $results['id']; ?>">
		<p style='text-align: right'>
		<button type="submit" name="response">Response</button>
		</p>
		</form> </div> <br>
		<?php
		}

		echo "<p><font size='5'>Your Groups being Evaluated:</font></p>";

		while($results = $groups->fetch(PDO::FETCH_ASSOC)){
			echo "<div class='box'>";
			$group_info = $conn->prepare('SELECT fullname, rollno, enrollment, cgpa FROM students WHERE group_id = :id');
			$group_info->bindParam(':id', $results['id']);
			$group_info->execute();

			$files_show = 'uploads/proposals/'.$results['filename'].$results['username'];
			echo "Project Name: ".$results['filename'] ."<p style='text-align: right'>".$results['date_time']."</p>" ."<br>";
			echo "Project Description: ".$results['description']. "<br>";
			echo "<a href='$files_show'>DETAILS</a>". "<br>";

			while($row = $group_info->fetch(PDO::FETCH_ASSOC)){
				echo "Student Name: ".$row['fullname'] ." ROLL No: ".$row['rollno'] ."<br>";
				echo "Enrollment No: ".$row['enrollment'] ." CGPA: ".$row['cgpa'] ."<br>";
			}
		?>
		<form action="midyear_response.php" method="POST">
		<input type="hidden" name="group_id" value="<?php echo $results['id']; ?>">
		<p style='text-align: right'>
		<button type="submit" name="your_group">Response</button>
		</p>
		</form> </div> <br>
		<?php
		}

		?>
</body>
</html>
