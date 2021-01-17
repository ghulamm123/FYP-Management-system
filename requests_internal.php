<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status']== 'teacher') && ($_SESSION['committee'] == '0') ) {
	$groups_ret = $conn->prepare('SELECT id FROM groups WHERE internal_req_id = :id AND internal_id IS NULL');
	$groups_ret->bindParam(':id', $_SESSION['user_id']);
	$groups_ret->execute();

	$projects_ret = $conn->prepare('SELECT id, filename, description, date_time, group_req_id FROM uploads WHERE internal_id = :id AND group_req_id IS NOT NULL AND group_id IS NULL');
	$projects_ret->bindParam(':id', $_SESSION['user_id']);
	$projects_ret->execute();

	$groups_confirm = $conn->prepare('SELECT id FROM groups WHERE internal_req_id = :req_id AND internal_id = :id');
	$groups_confirm->bindParam(':req_id', $_SESSION['user_id']);
	$groups_confirm->bindParam(':id', $_SESSION['user_id']);
	$groups_confirm->execute();

	$projects_confirm = $conn->prepare('SELECT id, filename, description, date_time, group_id FROM uploads WHERE internal_id = :id AND group_req_id IS NOT NULL AND group_id IS NOT NULL');
	$projects_confirm->bindParam(':id', $_SESSION['user_id']);
	$projects_confirm->execute();
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
		<?php

		echo "<p><font size='5'>Requests From Groups With Their Own Project Idea:</font></p>";

		while($results = $groups_ret->fetch(PDO::FETCH_ASSOC)){
			echo "<div class='box'>";
			$group_info = $conn->prepare('SELECT fullname, rollno, enrollment, cgpa FROM students WHERE group_id = :id');
			$group_info->bindParam(':id', $results['id']);
			$group_info->execute();

            while($row = $group_info->fetch(PDO::FETCH_ASSOC)){
				echo "Student Name: ".$row['fullname'] ." ROLL No: ".$row['rollno'] ."<br>";
				echo "Enrollment No: ".$row['enrollment'] ." CGPA: ".$row['cgpa'] ."<br>";
			}
			?>
		<form action="request_server.php" method="POST">
		<p style='text-align: right'>
		<button type="submit" name="group_accept_id" value="<?php echo $results['id']; ?>">ACCEPT</button>
		<button type="submit" name="group_reject_id" value="<?php echo $results['id']; ?>">REJECT</button>
		</p>
		</form> </div> <br>
		<?php
		}


		echo "<p><font size='5'>Requests From Groups For Your Projects:</font></p>";

		while($results = $projects_ret->fetch(PDO::FETCH_ASSOC)){
			echo "<div class='box'>";
			$group_info = $conn->prepare('SELECT fullname, rollno, enrollment, cgpa FROM students WHERE group_id = :id');
			$group_info->bindParam(':id', $results['group_req_id']);
			$group_info->execute();

			$files_show = 'uploads/internals/'.$results['filename'].$_SESSION['username'];
			echo "Project Name: ".$results['filename'] ."<p style='text-align: right'>".$results['date_time']."</p>" ."<br>";
			echo "Project Description: ".$results['description']. "<br>";
			echo "<a href='$files_show'>DETAILS</a>". "<br>";

            while($row = $group_info->fetch(PDO::FETCH_ASSOC)){
				echo "Student Name: ".$row['fullname'] ." ROLL No: ".$row['rollno'] ."<br>";
				echo "Enrollment No: ".$row['enrollment'] ." CGPA: ".$row['cgpa'] ."<br>";
			}
			?>
		<form action="request_server.php" method="POST">
		<p style='text-align: right'>
		<input type="hidden" name="project_id" value="<?php echo $results['id']; ?>">
		<input type="hidden" name="group_req_id" value="<?php echo $results['group_req_id']; ?>">
		<button type="submit" name="project_accept">ACCEPT</button>
		<button type="submit" name="project_reject">REJECT</button>
		</p>
		</form> </div> <br>
		<?php
		}


		echo "<p><font size='5'>Your Approved Groups With Their Own Project Idea:</font></p>";

		while($results = $groups_confirm->fetch(PDO::FETCH_ASSOC)){
			echo "<div class='box'>";
			$group_info = $conn->prepare('SELECT fullname, rollno, enrollment, cgpa FROM students WHERE group_id = :id');
			$group_info->bindParam(':id', $results['id']);
			$group_info->execute();

            while($row = $group_info->fetch(PDO::FETCH_ASSOC)){
				echo "Student Name: ".$row['fullname'] ." ROLL No: ".$row['rollno'] ."<br>";
				echo "Enrollment No: ".$row['enrollment'] ." CGPA: ".$row['cgpa'] ."<br>";
			}
			?>
		<form action="request_server.php" method="POST">
		<p style='text-align: right'>
		<button type="submit" name="group_drop_id" value="<?php echo $results['id']; ?>">DROP</button>
		</p>
		</form> </div> <br>
		<?php
		}


		echo "<p><font size='5'>Your Approved Groups With Your Project:</font></p>";

		while($results = $projects_confirm->fetch(PDO::FETCH_ASSOC)){
			echo "<div class='box'>";
			$group_info = $conn->prepare('SELECT fullname, rollno, enrollment, cgpa FROM students WHERE group_id = :id');
			$group_info->bindParam(':id', $results['group_id']);
			$group_info->execute();

			$files_show = 'uploads/internals/'.$results['filename'].$_SESSION['username'];
			echo "Project Name: ".$results['filename'] ."<p style='text-align: right'>".$results['date_time']."</p>" ."<br>";
			echo "Project Description: ".$results['description']. "<br>";
			echo "<a href='$files_show'>DETAILS</a>". "<br>";

            while($row = $group_info->fetch(PDO::FETCH_ASSOC)){
				echo "Student Name: ".$row['fullname'] ." ROLL No: ".$row['rollno'] ."<br>";
				echo "Enrollment No: ".$row['enrollment'] ." CGPA: ".$row['cgpa'] ."<br>";
			}
			?>
		<form action="request_server.php" method="POST">
		<p style='text-align: right'>
		<input type="hidden" name="project_id" value="<?php echo $results['id']; ?>">
		<input type="hidden" name="group_id" value="<?php echo $results['group_id']; ?>">
		<button type="submit" name="project_drop">DROP</button>
		</p>
		</form> </div> <br>
		<?php
		}

		?>
</body>
</html>
