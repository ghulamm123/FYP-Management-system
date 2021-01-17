<? php
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}

 include_once('connect.php');
 $query="select * from student";
 $result=mysql_query($query);
 ?>





<!DOCTYPE html>

<html>
    <title>
       <head> Fetch Data From Database</head>
      </title>
       <body>
<table align="center" border="1px" style="width:600px; line-height:40px;">
   <tr>
<th colspan="4">
  <h2>Student Record</h2></th> </tr>
  <t> <th> ID </th>
    <th> Name </th>
    <th> Email </th>
     <th> Country </th>
  </t>

  <?php
  while($rows=mysql_fetch_assoc($result))
   {  ?>

  <tr>
     <td> <?php echo $rows['ID']; ?>   </td>
     <td> <?php echo $rows['Name']; ?>  </td>
     <td> <?php echo $rows['Email']; ?> </td>
     <td><?php echo $rows['Country'];?> </td>

   </tr>
 <?php } ?>


 </table>
</body>
 </html>
