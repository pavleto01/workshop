<?php 
include('config/db_connect.php');
                $salary = $_POST['salary'];
            $workerID = $_POST['workerID'];
            $N = count($workerID);
            for($i=0; $i < $N; $i++)
            {
            $sql = "UPDATE caseworkers SET salary='$salary[$i]' where workerID='$workerID[$i]'" or die(mysqli_error());
            $result = mysqli_query($conn, $sql);
            }
            mysqli_close($conn);
            header("Refresh:0"); 
?>