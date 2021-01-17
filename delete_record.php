<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if ( isset($_SESSION['user_status']) && ($_SESSION['user_status']== 'teacher') )
{
	if (isset($_GET['filename'])) {

		$filename= $_GET['filename'];
		$delete_record = $conn->prepare('DELETE FROM uploads WHERE filename = :filename');
		$delete_record->bindParam(':filename', $filename);
			if( $delete_record->execute() ){
				$file_destination = 'uploads/internals/'.$filename.$_SESSION['username'];
				unlink($file_destination);
				header("Location: index.php");
			} else {
				header("Location: index.php");
			}
	} else {
		header("Location: index.php");
	}
} else{
	header("Location: login.php");
}
?>
