<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>


    <style >
    input[type=text], select {
      width: 20%;


      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;


      width: 100%;
       border: 1px solid #ccc;
       background: #FFF;
       margin: 0 0 5px;
       padding: 10px;

    }

    input[type=submit] {
      width: 20%;
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 2px;
      cursor: pointer;





    }

    input[type=submit]:hover {
      background-color: #45a049;
    }

    fieldset {
           background: #e1eff2;
         }
         legend {
           padding: 10px 0;
           font-size: 20px;
         }


    </style>
  </head>


  <?php

  session_start();
  if(!isset($_SERVER['HTTP_REFERER'])){
  		// redirect them to your desired location
  		header('login.php');
  		exit;
  }


?>


<body>
<form action="insert.php" method="post">
  <fieldset>
    <legend>Personal Information:</legend>

      id: <input type="text" name="id" /><br><br>
      name: <input type="text" name="name" /><br><br>
      time: <input type="text" name="email" /><br><br>
      location: <input type="text" name="country" /><br><br>
<input type="submit">
</fieldset>
</form>

</body>
</html>
