<?php 
include('config/db_connect.php');
include ('view/header.php');
if(!isset($_SESSION['agent_username']))
{
  ?>
        <script type="text/javascript">
            window.location.href = "login.php";
            </script>
<?php
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
	table{
   margin-left: auto;
  margin-right: auto;
  width: 80%;
  border-collapse: collapse;
}

th{
 	background-color: #D6EEEE;
}

 th, td {
 	border-style:solid;
  border-color: #96D4D4;
}
</style>
</head>
<body>
<table style="width:90%">
		<div class="alert alert-success">
			<h2 style="text-align:center; ">List of cases</h2>
		</div>
		<?php
        if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT cases.bulstat,cases.date_in, cases.id_case, cases.case_type,cases.car_id,cases.part_type,cars.VIN, cars.car_model,cars.car_license,cars.car_firm,cars.id_car, cases.km_in, cases.safo_type, cases.owner, cases.payment_type, cases.sum, cases.note,cases.ow_address,cases.ow_phone1,cases.ow_phone2,cases.ow_phone3 FROM cases JOIN cars ON cases.car_id = cars.id_car WHERE cases.id_case = $id";

        $query=mysqli_query($conn,$sql)or die(mysqli_error());
        while($row=mysqli_fetch_array($query)){
            $id_car = $row['id_car'];
            $case_type = $row['case_type'];
        ?>
			<tr>
				<th style="text-align:center; color:blue; width: 5%">Case number</th>
                <th style="text-align:center; color:blue; width: 5%">Date</th>
				<th style="text-align:center; color:blue; width: 5%">Car/part</th>
				<th style="text-align:center; color:blue; width: 5%">Safo Type</th>
                <th style="text-align:center; color:blue; width: 5%">Payment Type</th>
                <th style="text-align:center; color:blue; width: 5%">Bulstat</th>
				<th style="text-align:center; color:blue; width: 5%">Car/part owner</th>
                <?php if($row['case_type'] == "car") { ?>
                <th style="text-align:center; color:blue; width: 5%">KM in</th>
            <?php } ?>
			</tr>
		
        <tr style="height:50px">

				<td style="text-align:center; "><?php echo $row['id_case']?></td>
                <td style="text-align:center; "><?php echo $row['date_in'] ?></td>
                <?php if($row['case_type'] == "car") { ?>
                <td style="text-align:center; "><?php echo $row['car_model']."<br>".$row['car_license']."<br>".$row['VIN'] ?></td>
            <?php } if($row['case_type'] == "Part") {?>
                <td style="text-align:center; "><?php echo $row['part_type'] ?></td>
            <?php } ?>
				<td style="text-align:center; "><?php echo $row['safo_type'] ?></td>
                <td style="text-align:center; "><?php echo $row['payment_type'] ?></td>
                <td style="text-align:center; "><?php echo $row['bulstat'] ?></td>
                <?php if($row['case_type'] == "car") {?>
                <td style="text-align:center; "><?php echo $row['car_firm'] ?></td>
                <td style="text-align:center; "><?php echo $row['km_in'] ?></td>
            <?php } if($row['case_type'] == "Part") {?>
                <td style="text-align:center; "><?php echo $row['owner'] ?></td>
            <?php } ?>
			</tr>
		
       
	</table>

<?php

	 
if(isset($_POST['add']))
{
    $workerID  = $_POST['workerID'];
    $sql3 = "INSERT INTO caseworkers (caseID,workerID) VALUES ('$id', '$workerID')";
	
    
    if(mysqli_query($conn, $sql3))
    {
        mysqli_close($conn); 
        header("Refresh:0"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }   
}

if(isset($_POST['delete'])) 
{
    $workerID  = $_POST['workerID'];
    $sql4 = "DELETE FROM caseworkers WHERE workerID = '$workerID' AND caseID = '$id'";
	
    
    if(mysqli_query($conn, $sql4))
    {
        mysqli_close($conn);
        header("Refresh:0"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }    	
}

if(isset($_POST['update'])) 
{
    $note = $_POST['note'];
   

    $sql2 = "UPDATE cases set note = '$note' where id_case = '$id'";
    
    
    if(mysqli_query($conn, $sql2))
    {
        mysqli_close($conn); 
        header("Refresh:0"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }       
}

if(isset($_POST['updatesum'])) 
{
    $sum = $_POST['sum'];
   

    $sql5 = "UPDATE cases set sum = '$sum' where id_case = '$id'";
    
    
    if(mysqli_query($conn, $sql5))
    {
        mysqli_close($conn); 
        header("Refresh:0"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }       
}

if(isset($_POST['print'])) 
{    
       header('Location: print.php?id='.$id);

}


if(isset($_POST['updateadr'])) 
{

   if($case_type == "car"){
    $owner_address = $_POST['owner_address'];
    $sql6 = "UPDATE cars set owner_address = '$owner_address' where id_car = '$id_car'";
     if(mysqli_query($conn, $sql6))
    {
        mysqli_close($conn); 
        header("Refresh:0"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }       
   }

     if($case_type == "Part"){
    $ow_address = $_POST['ow_address'];
    $sql6 = "UPDATE cases set ow_address = '$ow_address' where id_case = '$id'";
     if(mysqli_query($conn, $sql6))
    {
        mysqli_close($conn); 
        header("Refresh:0"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }       
   } 
}

if(isset($_POST['updateph1'])) 
{
   if($case_type == "car"){
    $owner_phone1 = $_POST['owner_phone1'];
    $sql7 = "UPDATE cars set owner_phone1 = '$owner_phone1' where id_car = '$id_car'";
     if(mysqli_query($conn, $sql7))
    {
        mysqli_close($conn); 
        header("Refresh:0"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }       
   }

     if($case_type == "Part"){
    $ow_phone1 = $_POST['ow_phone1'];
    $sql7 = "UPDATE cases set ow_phone1 = '$ow_phone1' where id_case = '$id'";
     if(mysqli_query($conn, $sql7))
    {
        mysqli_close($conn); 
        header("Refresh:0"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }       
   } 
}

if(isset($_POST['updateph2'])) 
{
   if($case_type == "car"){
    $owner_phone2 = $_POST['owner_phone2'];
    $sql9 = "UPDATE cars set owner_phone2 = '$owner_phone2' where id_car = '$id_car'";
     if(mysqli_query($conn, $sql9))
    {
        mysqli_close($conn); 
        header("Refresh:0"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }       
   }

     if($case_type == "Part"){
    $ow_phone2 = $_POST['ow_phone2'];
    $sql9 = "UPDATE cases set ow_phone2 = '$ow_phone2' where id_case = '$id'";
     if(mysqli_query($conn, $sql9))
    {
        mysqli_close($conn); 
        header("Refresh:0"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }       
   } 
}

if(isset($_POST['updateph3'])) 
{
   if($case_type == "car"){
    $owner_phone3 = $_POST['owner_phone3'];
    $sql8 = "UPDATE cars set owner_phone3 = '$owner_phone3' where id_car = '$id_car'";
     if(mysqli_query($conn, $sql8))
    {
        mysqli_close($conn); 
        header("Refresh:0"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }       
   }

     if($case_type == "Part"){
    $ow_phone3 = $_POST['ow_phone3'];
    $sql8 = "UPDATE cases set ow_phone3 = '$ow_phone3' where id_case = '$id'";
     if(mysqli_query($conn, $sql8))
    {
        mysqli_close($conn); 
        header("Refresh:0"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }       
   } 
}

}}
?>
 
<table style="width:90%">

    <?php
        $sql = "SELECT cases.bulstat,cases.date_in, cases.id_case, cases.case_type,cases.car_id,cases.part_type,cars.VIN, cars.car_model,cars.car_license,cars.car_firm,cars.owner_address,cars.owner_phone1,cars.owner_phone2,cars.owner_phone3, cases.km_in, cases.safo_type, cases.owner, cases.payment_type, cases.sum, cases.note,cases.ow_address,cases.ow_phone1,cases.ow_phone2,cases.ow_phone3 FROM cases JOIN cars ON cases.car_id = cars.id_car WHERE cases.id_case = $id";
        $query=mysqli_query($conn,$sql)or die(mysqli_error());
        while($row=mysqli_fetch_array($query)){
    ?>


    <tr>
        <form method="post">
        <th>
            <h4>Firm/Owner address:</h4>
            <?php 
            if($row['case_type'] == "car"){ ?>
            <textarea rows="3" cols="30" name="owner_address" ><?php echo $row['owner_address'];?></textarea> <?php }
            if($row['case_type'] == "Part"){ ?>
            <textarea rows="3" cols="30" name="ow_address" ><?php echo $row['ow_address'];?></textarea> <?php }
            ?>
            <br><br>
            <input class="button" type="submit" name="updateadr" value="Update address">
        </th>
    </form>

    <form method="post">
        <th>
            <h4>Telephone 1:</h4>
            <?php 
            if($row['case_type'] == "car"){ ?>
            <input type="text" name="owner_phone1" value="<?php echo $row['owner_phone1']?>"> <?php }
            if($row['case_type'] == "Part"){ ?>
            <input type="text" name="ow_phone1" value="<?php echo $row['ow_phone1']?>"> <?php }
            ?>
            <br><br>
            <input class="button" type="submit" name="updateph1" value="Update phone 1">
        </th>
    </form>


    <form method="post">
        <th>
            <h4>Telephone 2:</h4>
            <?php 
            if($row['case_type'] == "car"){ ?>
            <input type="text" name="owner_phone2" value="<?php echo $row['owner_phone2']?>"> <?php }
            if($row['case_type'] == "Part"){ ?>
            <input type="text" name="ow_phone2" value="<?php echo $row['ow_phone2']?>"> <?php }
            ?>
            <br>
            <br>
            <input class="button" type="submit" name="updateph2" value="Update phone 2">
        </th>
    </form>

    <form method="post">
        <th>
            <h4>Telephone 3:</h4>
           <?php 
            if($row['case_type'] == "car"){ ?>
            <input type="text" name="owner_phone3" value="<?php echo $row['owner_phone3']?>"> <?php } 
            if($row['case_type'] == "Part"){ ?>
            <input type="text" name="ow_phone3" value="<?php echo $row['ow_phone3']?>">
        <?php } ?>
            <br><br>
            <input class="button" type="submit" name="updateph3" value="Update phone 3">
        </th>
    </form>
    </tr>
    <?php } ?>


<tr><th>
<div class="from-group">	
	<h4>Add worker: </h4>
		<form class="white" method="POST">
  	<select name="workerID" class="form-control">
   							<option value="">--Select worker--</option>
      						<?php

      							$query = "SELECT * FROM agents WHERE id_agent != 1";
      							$result = mysqli_query($conn, $query);
      							while($row = mysqli_fetch_array($result)){
      						?>
      					<option value = <?php echo $row['id_agent'];?>> <?php echo $row['agent_firstname']." ".$row['agent_lastname'] ?> </option>
      				<?php } ?>

   							</select>
                       
   							<input type="submit" name="add" value="Add">
   						</form>
</div>
</th>

<th>
<div class="from-group">	
	<h4>Delete worker: </h4>
		<form class="white" method="POST">
  	<select name="workerID" class="form-control">
   							<option value="">--Select worker--</option>
      						<?php

      							$query = "SELECT caseworkers.workerID, agents.agent_firstname,agents.agent_lastname FROM agents JOIN caseworkers ON agents.id_agent = caseworkers.workerID JOIN cases ON caseworkers.caseID = cases.id_case WHERE cases.id_case = $id AND agents.id_agent != 1";
      							$result = mysqli_query($conn, $query);
      							while($row = mysqli_fetch_array($result)){
      						?>
      					<option value = <?php echo $row['workerID'];?>> <?php echo $row['agent_firstname']." ".$row['agent_lastname']; ?> </option>
      				<?php } ?>
   							</select>
                        
   							<input type="submit" name="delete" value="Delete">
   							</form>
</div>
</th>

<th colspan="2">
    <h4>Case workers:</h4>
    <form class="white" method="POST">
            <?php 
            if(isset($_GET['id'])){
            $id = mysqli_real_escape_string($conn, $_GET['id']);

            $sql = "SELECT cases.id_case, agents.agent_firstname,agents.agent_lastname, agents.id_agent, caseworkers.workerID, caseworkers.salary FROM agents JOIN caseworkers ON agents.id_agent = caseworkers.workerID JOIN cases ON caseworkers.caseID = cases.id_case WHERE cases.id_case = $id AND agents.id_agent != 1 ";

            $result = mysqli_query($conn, $sql);
            $query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
                while($row=mysqli_fetch_array($result)){
                 ?>
                <br>
                <?php 
                     echo $row['agent_firstname']." ".$row['agent_lastname'].": ".$row['salary']."лв.";

                ?>
                <input  type="checkbox"  name="selector[]" value = "<?php echo $row['workerID']; ?>">
                
                <?php } ?>
                <br><input class="button" type="submit" name="updatesal" value="Update salary">
<?php } ?>
                <?php

                if(isset($_POST['updatesal'])){

                    $worker=$_POST['selector'];
                    $N = count($worker);
                    for($i=0; $i < $N; $i++)
                    {
                     $sql = "SELECT * FROM caseworkers where workerID='$worker[$i]' AND caseID = '$id'";
                     $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($result))
                    { ?>
                    <section class = "container" grey-text>
                    <table class = "centertable2">

                    <form class="white">
        
                    <tr>
                    <th style=" color:dodgerblue;"> Salary: 
                    <br>
                        <input name="workerID[]" type="hidden" value="<?php echo  $row['workerID'] ?>" >
                        <input name="salary[]" type="text" value="<?php echo $row['salary'] ?>">
                    </th>
                 </tr>
             </form>
         </table>
     <?php } }
     ?>
<br><input class="button" type="submit" name="updatesal2" value="Update salary">
     <?php } ?>        
            </form>

            <?php 
            if(isset($_POST['updatesal2'])){
            $salary = $_POST['salary'];
            $workerID = $_POST['workerID'];
            $N = count($workerID);
            for($i=0; $i < $N; $i++)
            {
            $sql6 = "UPDATE caseworkers SET salary='$salary[$i]' where workerID='$workerID[$i]' AND caseID = '$id'" or die(mysqli_error());
            $result = mysqli_query($conn, $sql6);
   
            }

            echo("<meta http-equiv='refresh' content='0'>"); 
        }
            ?>
</form>

            <br>       
</th>

</tr>

<tr>
    <th colspan="4">
        <form class="white" method="POST">
        <h4>Note: </h4>
        <?php
            $query = "SELECT cases.note FROM cases WHERE cases.id_case = $id";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($result)){ ?>
        <textarea rows="7" cols="35" name="note" ><?php echo $row['note'];?></textarea>
    <?php } ?>
        <br> <br><input class="button" type="submit" name="update" value="Update"><br>
    </form>
    </th>

</tr>

<tr>
    <th colspan="4">
        <form class="white" method="POST">
        <h3>Summary:</h3>
        <?php
            $query = "SELECT cases.sum FROM cases WHERE cases.id_case = $id";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($result))
            {
            ?>
            <input type="text" name="sum" value = "<?php echo $row['sum']."лв."; ?>">
            <input class="button" type="submit" name="updatesum" value="Update">
            <br><br><br><input class="button" type="submit" name="print" value="Print">
        <?php } ?>
    </form>
        <br>
    </th>
</tr>


</form>
</table>
</body>
</html>