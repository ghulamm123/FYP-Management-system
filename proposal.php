<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'student') ) {
	$ret = $conn->prepare('SELECT internal_id FROM groups WHERE id = :id');
	$ret->bindParam(':id', $_SESSION['user_id']);
	$ret->execute();
	$check = $ret->fetch(PDO::FETCH_ASSOC);

	$_SESSION['internal_id'] = $check['internal_id'];
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
	<?php

	if (isset($_POST['proposal'])) {
		$proposal_id = $_POST['proposal'];

		if ( ($_SESSION['internal_id'] != NULL) ) {
	?>
			<br />Welcome <?= $_SESSION['username']; ?>
			<br /><br />

			<form action="upload.php" method="POST" enctype="multipart/form-data">
			Project Name: <input type="text" name="namefile"> <br /><br />
			Description:  <textarea rows = "6" cols = "50" maxlength="300" placeholder="Enter description here...(300 character only)" name = "description">
			</textarea>
			<input type="file" name="file">
			<button type="submit" name="proposal_id" value="<?php echo $proposal_id; ?>">UPLOAD FILE</button>
			</form>
	<?php
		} elseif ( ($_SESSION['internal_id'] == NULL) ) {
			echo "You Don't have any Internal Yet!! First Apply for the Internal OR Wait for the Response.";
		}
	} else {
		header("Location: index.php");
	}
	?>

</body>
</html>
