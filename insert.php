<?Php


//Connect DB
//Create query based on the ID passed from you table
//query : delete where Staff_id = $id
// on success delete : redirect the page to original page using header() method

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "test");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else { echo " the database is working";}

$ID= $_POST['id'];
$Name= $_POST['name'];
$Email= $_POST['email'];
$Country= $_POST['country'];

$sql="INSERT INTO student (ID, Name, Email, Country) VALUES ('$ID', '$Name', '$Email', '$Country')";
if (mysqli_query($link, $sql)) {
    mysqli_close($link);
    header('Location: connect.php'); //If book.php is your main page where you list your all records
    exit;
} else {
    echo "Error inserting  record";
}


?>
