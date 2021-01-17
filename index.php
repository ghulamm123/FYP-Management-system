<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}

if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status']== 'teacher') ){
	if ($_SESSION['committee'] != '0' ) {
		header("Location: committee_home.php");
	}
	elseif ($_SESSION['committee'] == '0') {
		header("Location: internal_home.php");
	}

}

elseif( isset($_SESSION['user_status']) && ($_SESSION['user_status']== 'student') ){
		header("Location: student_home.php");
}

elseif( isset($_SESSION['user_status']) && ($_SESSION['user_status']== 'admin') ){
		header("Location: admin_home.php");
}

else{
	header("Location: login.php");
	}

?>
