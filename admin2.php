<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'admin') ) {
	$defence_date = $conn->prepare('SELECT defence_deadline, internal_selection_deadline FROM admin WHERE id = :id');
	$defence_date->bindParam(':id', $_SESSION['user_id']);
	$defence_date->execute();
	$results = $defence_date->fetch(PDO::FETCH_ASSOC);
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
	::-webkit-scrollbar {
	  width: 10px;
	}

	/* Track */
	::-webkit-scrollbar-track {
	  box-shadow: inset 0 0 5px grey;
	  border-radius: 10px;
	}

	/* Handle */
	::-webkit-scrollbar-thumb {
	  background: #16181a;
	  border-radius: 10px;
	}

	/* Handle on hover */
	::-webkit-scrollbar-thumb:hover {
	  background:grey;
	}


			.box {
				border: 1px solid black;
			}

			ul {
				list-style-type: none;
				margin: 0px;
				padding: 0px;
				background-color: #333;
				position: fixed;
				top: 0;
				width: 100%;
				overflow: hidden;
			}

			li {
				float: left;
			}

			li a {
				display: block;
				color: white;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
			}

			li a:hover {
				background-color: grey;
				text-decoration: none;

			}


			button {
				width: 20%;
				padding: 16px 32px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
				margin: 4px 2px;
				transition-duration: 0.4s;
				cursor: pointer;
				background-color: white;
				color: whitesmoke;
				border: 2px solid #e7e7e7;
				font-family: 'PT Sans', sans-serif;

			}

			button:hover {
				background-color: #e7e7e7;
				}
</style>
<!--<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link href="https://fonts.googleapis.com/css2?family=PT+Sans&family=Raleway:wght@100&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">




	<!--<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'> -->
</head>
<body>
		<br />Welcome <?= $_SESSION['username']; ?>
		<br /><br />
		<p>
		<p style="font-size: 29px; font-family: 'Raleway', sans-serif;" class="text-center">Set Dates For Defence and
			Internal Selection:</p>
		</p>







		<div class="container-fluid">
			<div class="row justify-content-start">
				<div class="col-xs-6 col-sm-8 col-lg-6 col-xl-6  box" style="width:100%;height:45rem">
					<div style="font-family: 'Raleway', sans-serif; color: whitesmoke;font-size: 30px;">
						HELLLLLLOOOOOO
					<?php
				echo "Defence Deadline Date: ".$results['defence_deadline']. "<br>";
				?>
			</div>
					<form action="admin_server.php" method="POST" style="align-items: center;">
						<div style='text-align:center;margin-top: 26rem;' class="text-primary">


							<div class="form-group" style="position:relative;left:33%;width: 30%;">
								<label class="control-label" style="font-family: 'Raleway', sans-serif; color: whitesmoke;font-size: 20px; text-transform: uppercase;">Appointment Time</label>
								<div class='input-group date' id='datetimepicker1'>
									<input type='text' class="form-control" />
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
							<button type="submit" name="defence_deadline" style="text-transform: uppercase;">Change
								Date</button>
						</div>
					</form>
				</div>



				<div class="container-fluid">
					<div class="row justify-content-start">
						<div class="col-xs-6 col-sm-8 col-lg-6 col-xl-6  box" style="width:100%;height:45rem">
							<div style="font-family: 'Raleway', sans-serif; color: whitesmoke;font-size: 30px;">
								HELLLLLLOOOOOO
							<?php
						echo "Defence Deadline Date: ".$results['defence_deadline']. "<br>";
						?>
					</div>
							<form action="admin_server.php" method="POST" style="align-items: center;">
								<div style='text-align:center;margin-top: 26rem;' class="text-primary">


									<div class="form-group" style="position:relative;left:33%;width: 30%;">
										<label class="control-label" style="font-family: 'Raleway', sans-serif; color: whitesmoke;font-size: 20px; text-transform: uppercase;">Appointment Time</label>
										<div class='input-group date' id='datetimepicker2'>
											<input type='text' class="form-control" />
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<button type="submit" name="defence_deadline" style="text-transform: uppercase;">Change
										Date</button>
								</div>
							</form>
						</div>














		<!-- <div class="box">
				<?php
				echo "Defence Deadline Date: ".$results['defence_deadline']. "<br>";
				?>
				<form action="admin_server.php" method="POST">
				<p style='text-align: right' class="text-primary">
				Date: <input type="date" name="defence_date">
				<button type="submit" name="defence_deadline">Change Date</button>
				</p>
				</form> </div> <br>

				<div class="box ">
				<?php
				echo "Internal Selection Deadline: ".$results['internal_selection_deadline']. "<br>";
				?>
				<form action="admin_server.php" method="POST">
				<p style='text-align: right' class="text-primary">
				Date: <input type="date" name="internal_date">
				<button type="submit" name="internal_deadline">Change Date</button>
				</p>
				</form> </div> <br> -->
	</body>
	<script>
		$(function () {
			$('#datetimepicker1').datetimepicker();
		});

		$(function () {
			$('#datetimepicker2').datetimepicker();
		});
	</script>

	</html>
