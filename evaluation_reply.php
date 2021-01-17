<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if ( isset($_SESSION['user_status']) && ($_SESSION['user_status']== 'teacher') && ($_SESSION['committee'] != '0') )
{
	if (isset($_POST['approve_id']))
	{
		$approve_id= $_POST['approve_id'];
		$comments= $_POST['comments'];

		if (!empty($comments))
		{
			$reply = $conn->prepare('UPDATE requested SET status_'.$_SESSION['committee'].' = 1, comment_'.$_SESSION['committee'].' = :comments WHERE id = :approve_id');
			$reply->bindParam(':comments', $comments);
			$reply->bindParam(':approve_id', $approve_id);
			if( $reply->execute() ){
				header("Location: index.php");
			} else {
				header("Location: index.php");
			}

		} else {
			echo "comments are required!";
		}
	}

	elseif (isset($_POST['reject_id']))
	{
		$reject_id= $_POST['reject_id'];
		$comments= $_POST['comments'];

		if (!empty($comments)){

			$reply = $conn->prepare('UPDATE requested SET status_'.$_SESSION['committee'].' = 0, comment_'.$_SESSION['committee'].' = :comments WHERE id = :reject_id');
			$reply->bindParam(':comments', $comments);
			$reply->bindParam(':reject_id', $reject_id);
			if( $reply->execute() ){
				header("Location: index.php");
			} else {
				header("Location: index.php");
			}

		} else{
			echo "comments are required!";
		}
	}

	else {
			header("Location: index.php");
	}
}

else{
	header("Location: login.php");
}
?>
