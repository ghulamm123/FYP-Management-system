<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status']== 'teacher') && ($_SESSION['committee'] != '0') ) {

	$file_ret = $conn->prepare('SELECT t1.username, t2.id, t2.filename, t2.description, t2.date_time FROM groups t1 INNER JOIN requested t2 ON t1.id = t2.group_id
				WHERE (t2.status_'.$_SESSION['committee'].' IS NULL) AND (t2.comment_'.$_SESSION['committee'].' IS NULL)');
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
		<p><font size="5">Projects Requested By Groups:</font></p>

			<?php while($results = $file_ret->fetch(PDO::FETCH_ASSOC)){ ?>
			<div class="box">
			<?php
			$files_show = 'uploads/requested/'.$results['filename'].$results['username'];
			echo "Project Name: ".$results['filename'] ."<p style='text-align: right'>".$results['date_time']."</p>" ."<br>";
			echo "Project Description: ".$results['description']. "<br>";
			echo "<a href='$files_show'>DETAILS</a>";
			?>
			<form action="evaluation_reply.php" method="POST">
			<p style='text-align: right'>
			Comments: <textarea rows = "6" cols = "50" maxlength="300" placeholder="Enter Comments here...(300 character only)" name = "comments">
	 		</textarea> <br>
			<button type="submit" name="approve_id" value="<?php echo $results['id']; ?>">APPROVE</button>
			<button type="submit" name="reject_id"  value="<?php echo $results['id']; ?>">REJECT</button>
			</p>
			</form> </div> <br>

			<?php
			}?>

</body>
</html>
