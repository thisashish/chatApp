<?php 


//getting the value of post parameter

$room  = $_POST['room'];




if(strlen($room)>20  or strlen($room)<2)
{
	
	$message = "Please select value between 2 and 20";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/chatroom";';
	echo '</script>';
  

}

// checking whether the room name is alphanumeric 

else if(!ctype_alnum($room))
{
	$message = "Please choose an alphanumeric room name";
   echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/chatroom";';
	echo '</script>';
}

else{
	
	 include 'db_connect.php';
	
}

// check if room already exists

$sql = "SELECT * FROM `rooms` WHERE  roomname= '$room'";
$result = mysqli_query($conn,$sql);

if($result)
{
	if(mysqli_num_rows($result)>0)
	{
		$message = "Please choose a different  room name. This room is already claimed";
	   echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/chatroom";';
	echo '</script>';

		}

		else 
		{
			$sql = "INSERT INTO `rooms` ( `roomname`, `stime`) VALUES ( '$room', current_timestamp());";

         if(mysqli_query($conn,$sql))
         {
            
		$message = "Your room is ready and you can chat now";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/chatroom/rooms.php?roomname=' . $room.'";';
	echo '</script>';
	echo 'window.location="http://localhost/chatroom/rooms.php?roomname=' . $room.'";';
	

         }


		}
}

else 
{

   echo "Error: " . mysqli_error($conn);


}








?>