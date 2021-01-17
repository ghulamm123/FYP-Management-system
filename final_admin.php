<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'admin') ) {
	$assign_external = $conn->prepare('SELECT t1.username, t2.group_id, t2.internal_id, t2.filename, t2.description, t2.date_time, FROM groups t1 INNER JOIN proposals t2 ON t1.id = t2.group_id WHERE t1.final_external_id IS NULL');
	$assign_external->execute();

	$groups_external = $conn->prepare('SELECT t1.username, t2.group_id, t2.filename, t2.description, t2.date_time, t3.fullname, t3.designation FROM groups t1 INNER JOIN proposals t2 ON t1.id = t2.group_id INNER JOIN internals t3 ON t1.final_external_id = t3.id WHERE t1.final_external_id IS NOT NULL');
	$groups_external->execute();
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
		<p><font size="5">Assign External To Projects/Groups For Final:</font></p>

		<?php while($results = $assign_external->fetch(PDO::FETCH_ASSOC)){
			echo "<div class='box'>";
			$group_info = $conn->prepare('SELECT fullname, rollno, enrollment, cgpa FROM students WHERE group_id = :id');
			$group_info->bindParam(':id', $results['group_id']);
			$group_info->execute();

			$files_show = 'uploads/proposals/'.$results['filename'].$results['username'];
			echo "Project Name: ".$results['filename'] ."<p style='text-align: right'>".$results['date_time']."</p>" ."<br>";
			echo "Project Description: ".$results['description']. "<br>";
			echo "<a href='$files_show'>DETAILS</a>". "<br>";

			while($row = $group_info->fetch(PDO::FETCH_ASSOC)){
				echo "Student Name: ".$row['fullname'] ." ROLL No: ".$row['rollno'] ."<br>";
				echo "Enrollment No: ".$row['enrollment'] ." CGPA: ".$row['cgpa'] ."<br>";
			}
		$externals_ret = $conn->prepare('SELECT id, fullname FROM internals WHERE id != :id');
		$externals_ret->bindParam(':id', $results['internal_id']);
		$externals_ret->execute();
		?>
		<form action="admin_server.php" method="POST">
		<p style='text-align: right'>
		<input type="hidden" name="group_id" value="<?php echo $results['group_id']; ?>">
		<select name="external_id">
		<?php while($external_info = $externals_ret->fetch(PDO::FETCH_ASSOC)){?>

		<option value="<?php echo $external_info['id']; ?>"><?php echo $external_info['fullname']; ?></option>

		<?php
		}?>
		</select>
		<button type="submit" name="assign_final_external">Assign</button>
		</p>
		</form> </div> <br>
		<?php
		}

		echo "<p><font size='5'>Externals & Response Of The Projects/Groups For Final:</font></p>";

		while($results = $groups_external->fetch(PDO::FETCH_ASSOC)){
			echo "<div class='box'>";
			$group_info = $conn->prepare('SELECT fullname, rollno, enrollment, cgpa FROM students WHERE group_id = :id');
			$group_info->bindParam(':id', $results['group_id']);
			$group_info->execute();

			$files_show = 'uploads/proposals/'.$results['filename'].$results['username'];
			echo "Project Name: ".$results['filename'] ."<p style='text-align: right'>".$results['date_time']."</p>" ."<br>";
			echo "Project Description: ".$results['description']. "<br>";
			echo "External Name: ".$results['fullname'] ."<br>";
			echo "Designation: ".$results['designation'] ."<br>";
			echo "<a href='$files_show'>DETAILS</a>". "<br>";

			while($row = $group_info->fetch(PDO::FETCH_ASSOC)){
				echo "Student Name: ".$row['fullname'] ." ROLL No: ".$row['rollno'] ."<br>";
				echo "Enrollment No: ".$row['enrollment'] ." CGPA: ".$row['cgpa'] ."<br>";
			}
			?>
		<form action="admin_response.php" method="POST">
		<p style='text-align: right'>
		<input type="hidden" name="group_id" value="<?php echo $results['group_id']; ?>">
		<button type="submit" name="final_response">Response</button>
		</p>
		</form> </div> <br>
		<?php
		}

		?>
</body>
</html>
