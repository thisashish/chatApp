<?php 
 $servername = "localhost";
 $username  = "root";
 $password = "";
 $database = "chatroom";


 // creating database connection

 $conn = mysqli_connect($servername,$username,$password,$database);

 //check connection 

 if(!$conn)
 {
 	die("Failed to connnect".mysqli_connect_error());
 }







 ?>