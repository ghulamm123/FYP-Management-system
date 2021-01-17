<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'admin') ) {
	$assign_internal = $conn->prepare('SELECT id FROM groups WHERE internal_id IS NULL AND internal_req_id IS NULL');
	$assign_internal->execute();

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
		<p><font size="5">Assign Internal To Remaining Projects/Groups:</font></p>

		<?php while($results = $assign_internal->fetch(PDO::FETCH_ASSOC)){
			echo "<div class='box'>";
			$group_info = $conn->prepare('SELECT fullname, rollno, enrollment, cgpa FROM students WHERE group_id = :id');
			$group_info->bindParam(':id', $results['id']);
			$group_info->execute();

			while($row = $group_info->fetch(PDO::FETCH_ASSOC)){
				echo "Student Name: ".$row['fullname'] ." ROLL No: ".$row['rollno'] ."<br>";
				echo "Enrollment No: ".$row['enrollment'] ." CGPA: ".$row['cgpa'] ."<br>";
			}
		$internals_ret = $conn->prepare('SELECT id, fullname FROM internals WHERE status = 1');
		$internals_ret->execute();
		?>
		<form action="admin_server.php" method="POST">
		<p style='text-align: right'>
		<input type="hidden" name="group_id" value="<?php echo $results['id']; ?>">
		<select name="internal_id">
		<?php while($internal_info = $internals_ret->fetch(PDO::FETCH_ASSOC)){?>

		<option value="<?php echo $internal_info['id']; ?>"><?php echo $internal_info['fullname']; ?></option>

		<?php
		}?>
		</select>
		<button type="submit" name="assign_internal">Assign</button>
		</p>
		</form> </div> <br>
		<?php
		}

		?>
</body>
</html>
