<?php 

	// connect to database
  $conn = mysqli_connect('localhost', 'pavel', 'naruto', 'workshop');

 // check connection
 if(!$conn){
    echo 'Connection error: mysqli_connect_error()';
  }

?>