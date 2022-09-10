<?php

// Get parameters 

$roomname = $_GET['roomname'];

//Connecting to the database 
include 'db_connect.php';

//Execute sql to check whether room exists 

$sql = "SELECT * FROM `rooms` WHERE roomname = '$roomname'";

$result = mysqli_query($conn,$sql);

if($result)
{
	// check if room exists 
	if(mysqli_num_rows($result)==0)
	{
		$message = "This room does not exist. Try creating a new one ";
		echo '<script language="javascript">';
	    echo 'alert("'.$message.'");';
	    echo 'window.location="http://localhost/chatroom";';
	    echo '</script>';





	}
}
 else 
 {
 	echo "Error: ".mysqli_error($conn);
 }

 

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

 .anyClass {
  height: 350px;
  overflowl-y: scroll;
}



</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<link rel="stylesheet" href="css/product.css" >

</head>
<body>

  <div class="container py-3">
  <header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
  <a href="/" class="d-flex align-items-center text-dark text-decoration-none"> 
       
        <span class="fs-4">My Anonymous Chat Room </span>
       </a> 

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-dark text-decoration-none" href="#">Home</a>
        <a class="me-3 py-2 text-dark text-decoration-none" href="#">Contact</a>
        <a class="me-3 py-2 text-dark text-decoration-none" href="#">Support</a>
        
      </nav>
    </div>


<h2>Chat Messages - <?php echo $roomname; ?></h2>


<div class="container">

<div class="anyClass">

 
  </div>
</div>

</header>

</div>


<input type = "text" class="form-control" name="usermsg" id="usermsg" placeholder="Add Messages"><br> 
<button class="btn btn-default" name="submitmsg" id="submitmsg">Send</button>


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>


<script type="text/javascript">

setInterval(runFunction,1000);
function runFunction()
{
  $.post("htcont.php",{room:'<?php echo $roomname ?>'},
    function(data,status){
      document.getElementsByClassName('anyClass')[0].innerHTML = data;
    }



    )
}





// Get the input field
var input = document.getElementById("usermsg");

// Execute a function when the user presses a key on the keyboard
input.addEventListener("keypress", function(event) {
  // If the user presses the "Enter" key on the keyboard
  if (event.key === "Enter") {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("submitmsg").click();
  }
});




  // if user submits the forms 

   $("#submitmsg").click(function(){
  var clientmsg = $("#usermsg").val();
    $.post("postmsg.php",{text:clientmsg,room:'<?php echo $roomname ?>',ip:'<?php echo $_SERVER['REMOTE_ADDR'] ?>'},function(data,status){
       document.getElementsByClassName('anyClass')[0].innerHTML = data;});
     
 $("#usermsg").val("");

      return false;
    
  });


</script>

</body>
</html>
