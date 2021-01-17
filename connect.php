

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>


 .text { color: #fff; background: #000; }

    #customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
    </style>
  </head>
  <body>
    <?php
/*    if(!isset($_SERVER['HTTP_REFERER'])){
        // redirect them to your desired location
        header('login.php');
        exit;
    }
*/

    /* Attempt MySQL server connection. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    $link = mysqli_connect("localhost", "root", "", "test");

    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    else {  echo '<h2 class="text">the database is working!</h2>';}

    // Attempt select query execution
    $sql = "SELECT * FROM student";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            echo '<table id="customers" border=1 cellpadding=1 width="90%">';
                   echo '<tr >';
                    echo "<th>ID</th>";
                    echo "<th>Name</th>";
                    echo "<th>timing</th>";
                    echo "<th>location</th>";
                      echo "<th><a href='edit.php'> edit</a></th>";
                      echo "<th>delete option</th>";
                        echo "<th><a href='login.php'> log out</a></th>";
                echo '</tr>';
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                    echo "<td>" . $row['ID'] . "</td>";
                    echo "<td>" . $row['Name'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "<td>" . $row['Country'] . "</td>";
      echo " <td> <a href='https://meet.google.com/new' target='_blank'>meet link generator </a></td>";
          echo "<td><a href='delete.php?del=".$row['ID']."'> delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
            // Free result set
            mysqli_free_result($result);
        } else{
            echo "No records matching your query were found.";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    // Close connection
    mysqli_close($link);
    ?>


  </body>
</html>
