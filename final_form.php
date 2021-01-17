<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'teacher') ) {
	if (isset($_POST['group_id'])) {
		$group_id = $_POST['group_id'];

		$project = $conn->prepare('SELECT id, internal_id, filename FROM proposals WHERE group_id = :id');
		$project->bindParam(':id', $group_id);
		$project->execute();
		$results = $project->fetch(PDO::FETCH_ASSOC);

		$student = $conn->prepare('SELECT id, fullname, rollno, enrollment, cgpa FROM students WHERE group_id = :id');
		$student->bindParam(':id', $group_id);
		$student->execute();

	} else{
		header("Location: index.php");
	}
}
	else{
		header("Location: login.php");
}
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

		<p style='text-align: center'><font size="5">Final Evaluation Form:</font></p>
		<p style='text-align: center'><font size="5"><?php echo $results['filename']; ?></font></p>

		<form action="evaluation_server.php" method="POST">
	<?php
		$i = 0;
		while($row = $student->fetch(PDO::FETCH_ASSOC)){
			echo "<div class='box'>";
			echo "<p style='text-align: center'><font size='5'>";
			echo "Student Name: ".$row['fullname'] ." ROLL No: ".$row['rollno'] ."<br>";
			echo "Enrollment No: ".$row['enrollment'] ." CGPA: ".$row['cgpa'] ."<br>";
			echo "</font></p>";
	?>
			<p style='text-align: center'><font size="4">
			Criterion 1: How clearly has the student identified issues and explained the Methodology? PLO-4 <br>
			</font></p>

			Represents the issues inaccurately or inappropriately. Fails to explain how/why/which specific methods of research are relevant to the kind of issue at hand<br>
			<input type="radio" name="criterion_1[<?php echo $i; ?>]" value="1" required> 1
			<input type="radio" name="criterion_1[<?php echo $i; ?>]" value="2" required> 2
			<input type="radio" name="criterion_1[<?php echo $i; ?>]" value="3" required> 3 <br><br>
			Represents some issues inaccurately or inappropriately. Identifies some but not all methods required for dealing with the issue; does not explain why they are relevant or effective<br>
			<input type="radio" name="criterion_1[<?php echo $i; ?>]" value="4" required> 4
			<input type="radio" name="criterion_1[<?php echo $i; ?>]" value="5" required> 5
			<input type="radio" name="criterion_1[<?php echo $i; ?>]" value="6" required> 6
			<input type="radio" name="criterion_1[<?php echo $i; ?>]" value="7" required> 7 <br><br>
			Clearly identifies and summarizes main issues and successfully explains why/how they are problems or questions; and successfully explains how /why / which methods are most relevant to the problem<br>
			<input type="radio" name="criterion_1[<?php echo $i; ?>]" value="8" required> 8
			<input type="radio" name="criterion_1[<?php echo $i; ?>]" value="9" required> 9
			<input type="radio" name="criterion_1[<?php echo $i; ?>]" value="10" required> 10 <br><br>


			<p style='text-align: center'><font size="4">
			Criterion 2: How well have the tasks been distributed among members? PLO-11 <br>
			</font></p>

			The project roles and responsibilities were not divided among team members<br>
			<input type="radio" name="criterion_2[<?php echo $i; ?>]" value="1" required> 1
			<input type="radio" name="criterion_2[<?php echo $i; ?>]" value="2" required> 2
			<input type="radio" name="criterion_2[<?php echo $i; ?>]" value="3" required> 3 <br><br>
			The project roles and responsibilities were unevenly divided among team members<br>
			<input type="radio" name="criterion_2[<?php echo $i; ?>]" value="4" required> 4
			<input type="radio" name="criterion_2[<?php echo $i; ?>]" value="5" required> 5
			<input type="radio" name="criterion_2[<?php echo $i; ?>]" value="6" required> 6
			<input type="radio" name="criterion_2[<?php echo $i; ?>]" value="7" required> 7 <br><br>
			The project roles and responsibilities were evenly divided among team members<br>
			<input type="radio" name="criterion_2[<?php echo $i; ?>]" value="8" required> 8
			<input type="radio" name="criterion_2[<?php echo $i; ?>]" value="9" required> 9
			<input type="radio" name="criterion_2[<?php echo $i; ?>]" value="10" required> 10 <br><br>


			<p style='text-align: center'><font size="4">
			Criterion 3: How do you rate the project's progress and plan to carry out rest of the project? PLO-11 <br>
			</font></p>

			Students provided inaccurate, incomplete reports of project progress and have not provided any description of future work related to the project<br>
			<input type="radio" name="criterion_3[<?php echo $i; ?>]" value="1" required> 1
			<input type="radio" name="criterion_3[<?php echo $i; ?>]" value="2" required> 2
			<input type="radio" name="criterion_3[<?php echo $i; ?>]" value="3" required> 3 <br><br>
			Students provided relatively accurate, complete reports of project progress and have provided inadequate description of future work related to the project<br>
			<input type="radio" name="criterion_3[<?php echo $i; ?>]" value="4" required> 4
			<input type="radio" name="criterion_3[<?php echo $i; ?>]" value="5" required> 5
			<input type="radio" name="criterion_3[<?php echo $i; ?>]" value="6" required> 6
			<input type="radio" name="criterion_3[<?php echo $i; ?>]" value="7" required> 7 <br><br>
			Students provided accurate, complete reports of project progress and have provided a detailed description of future work related to the project<br>
			<input type="radio" name="criterion_3[<?php echo $i; ?>]" value="8" required> 8
			<input type="radio" name="criterion_3[<?php echo $i; ?>]" value="9" required> 9
			<input type="radio" name="criterion_3[<?php echo $i; ?>]" value="10" required> 10 <br><br>


			<p style='text-align: center'><font size="4">
			Criterion 4: How do you grade the student’s performance as an individual and as a team member? PLO-9 <br>
			</font></p>

			The student did not work on the assigned task and brought chaos and indiscipline to the team<br>
			<input type="radio" name="criterion_4[<?php echo $i; ?>]" value="1" required> 1
			<input type="radio" name="criterion_4[<?php echo $i; ?>]" value="2" required> 2
			<input type="radio" name="criterion_4[<?php echo $i; ?>]" value="3" required> 3 <br><br>
			The student worked on the assigned task, and accomplished goals satisfactorily and positively affected the contributions of other team members<br>
			<input type="radio" name="criterion_4[<?php echo $i; ?>]" value="4" required> 4
			<input type="radio" name="criterion_4[<?php echo $i; ?>]" value="5" required> 5
			<input type="radio" name="criterion_4[<?php echo $i; ?>]" value="6" required> 6
			<input type="radio" name="criterion_4[<?php echo $i; ?>]" value="7" required> 7 <br><br>
			The student worked on the assigned task, and accomplished goals beyond expectations and boosted morale of the team and brought consensus when required <br>
			<input type="radio" name="criterion_4[<?php echo $i; ?>]" value="8" required> 8
			<input type="radio" name="criterion_4[<?php echo $i; ?>]" value="9" required> 9
			<input type="radio" name="criterion_4[<?php echo $i; ?>]" value="10" required> 10 <br><br>


			<p style='text-align: center'><font size="4">
			Criterion 5: How do you grade student’s personal ethics? PLO-8 <br>
			</font></p>

			The student lacks discipline and does not follow appropriate dress code<br>
			<input type="radio" name="criterion_5[<?php echo $i; ?>]" value="1" required> 1
			<input type="radio" name="criterion_5[<?php echo $i; ?>]" value="2" required> 2
			<input type="radio" name="criterion_5[<?php echo $i; ?>]" value="3" required> 3 <br><br>
			The student is disciplined but lacks adherence to a respectable dress code and/or exhibits a disheveled personality<br>
			<input type="radio" name="criterion_5[<?php echo $i; ?>]" value="4" required> 4
			<input type="radio" name="criterion_5[<?php echo $i; ?>]" value="5" required> 5
			<input type="radio" name="criterion_5[<?php echo $i; ?>]" value="6" required> 6
			<input type="radio" name="criterion_5[<?php echo $i; ?>]" value="7" required> 7 <br><br>
			The student is disciplined, adheres to a respectable dress code and exhibits a groomed personality<br>
			<input type="radio" name="criterion_5[<?php echo $i; ?>]" value="8" required> 8
			<input type="radio" name="criterion_5[<?php echo $i; ?>]" value="9" required> 9
			<input type="radio" name="criterion_5[<?php echo $i; ?>]" value="10" required> 10 <br><br>


			<p style='text-align: center'><font size="4">
			Criterion 6: Demonstration of Project? PLO-4 <br>
			</font></p>
			Poor<br>
			<input type="radio" name="criterion_6[<?php echo $i; ?>]" value="1" required> 1
			<input type="radio" name="criterion_6[<?php echo $i; ?>]" value="2" required> 2<br><br>
			Average<br>
			<input type="radio" name="criterion_6[<?php echo $i; ?>]" value="3" required> 3
			<input type="radio" name="criterion_6[<?php echo $i; ?>]" value="4" required> 4<br><br>
			Good<br>
			<input type="radio" name="criterion_6[<?php echo $i; ?>]" value="5" required> 5
			<input type="radio" name="criterion_6[<?php echo $i; ?>]" value="6" required> 6<br><br>
			Very Good<br>
			<input type="radio" name="criterion_6[<?php echo $i; ?>]" value="7" required> 7
			<input type="radio" name="criterion_6[<?php echo $i; ?>]" value="8" required> 8<br><br>
			Excellent<br>
			<input type="radio" name="criterion_6[<?php echo $i; ?>]" value="9" required> 9
			<input type="radio" name="criterion_6[<?php echo $i; ?>]" value="10" required> 10<br><br>


			<input type="hidden" name="student_id[<?php echo $i; ?>]" value="<?php echo $row['id']; ?>">
			</div> <br>
		<?php
			$i++;
		}

		?>
			<input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
			<input type="hidden" name="proposal_id" value="<?php echo $results['id']; ?>">
			<input type="hidden" name="internal_id" value="<?php echo $results['internal_id']; ?>">
			<p style='text-align: center'>
			<button type="submit" name="final_form_submit">SUBMIT</button>
			</p>
		</form>
</body>
</html>
