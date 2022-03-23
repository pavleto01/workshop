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
			<h2 style="text-align:center; ">Car details</h2>
		</div>
		
			<tr>
				<th style="text-align:center; color:blue; width: 5%">Car number</th>
				<th style="text-align:center; color:blue; width: 5%">Car brand</th>
				<th style="text-align:center; color:blue; width: 5%">Car model</th>
                <th style="text-align:center; color:blue; width: 5%">License</th>
				<th style="text-align:center; color:blue; width: 5%">VIN</th>
			</tr>
		
			<?php
        if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM cars WHERE id_car = $id";
        $query=mysqli_query($conn,$sql)or die(mysqli_error());
        while($row=mysqli_fetch_array($query)){
        ?>
        <tr style="height:50px">
				<td style="text-align:center; "><?php echo $row['id_car'] ?></td>
                <td style="text-align:center; "><?php echo $row['car_brand'] ?></td>
				<td style="text-align:center; "><?php echo $row['car_model'] ?></td>
                <td style="text-align:center; "><?php echo $row['car_license'] ?></td>
                <td style="text-align:center; "><?php echo $row['VIN'] ?></td>
			</tr>
		<?php  }
		} ?>						 
		
	</table>
<?php
				$sql = "SELECT * from cars WHERE id_car = $id";
				$result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($result))
                    { ?>
	<table style="width:90%">
		<form method="post">
		<tr>
			<th>
				<h4>Car KM:</h4>
				<input name="car_km" type="text" value="<?php echo $row['car_km'] ?>">
			
			</th>

			<th>
				<h4>Firm/Owner</h4>
				<input name="car_firm" type="text" value="<?php echo $row['car_firm'] ?>">
			</th>

			<th colspan="2">
				<h4>Firm/Owner address</h4>
				<textarea rows="2" cols="40" name="owner_address" ><?php echo $row['owner_address'];?></textarea>
			</th>
		</tr>

		<tr>
			<th>
				<h4>Telephone 1:</h4>
				<input name="owner_phone1" type="text" value="<?php echo $row['owner_phone1'] ?>">
			
			</th>

			<th>
				<h4>Telephone 2</h4>
				<input name="owner_phone2" type="text" value="<?php echo $row['owner_phone2'] ?>">
			</th>

			<th>
				<h4>Telephone 3</h4>
				<input name="owner_phone3" type="text" value="<?php echo $row['owner_phone3'] ?>">
			</th>

			<th>
				<h4>Firm/Owner email</h4>
				<input name="owner_email" type="text" value="<?php echo $row['owner_email'] ?>">
			</th>
		</tr>

		<tr>
			<th colspan="4">
				<h4>Car note</h4>
				<textarea rows="3" cols="60" name="car_note" ><?php echo $row['car_note'];?></textarea>
				<br><br><input class="button" type="submit" name="update" value="Update">
			</th>
		</tr>
		</form>
	</table>
<?php 

if(isset($_POST['update'])) 
{
    $car_km = $_POST['car_km'];
    $car_firm = $_POST['car_firm'];
    $car_note = $_POST['car_note'];
    $owner_address = $_POST['owner_address'];
    $owner_email = $_POST['owner_email'];
    $owner_phone1 = $_POST['owner_phone1'];
    $owner_phone2 = $_POST['owner_phone2'];
    $owner_phone3 = $_POST['owner_phone3'];
   

    $sql5 = "UPDATE cars set car_km = '$car_km',car_firm = '$car_firm',car_note = '$car_note',owner_address = '$owner_address',owner_email = '$owner_email',owner_phone1 = '$owner_phone1',owner_phone2 = '$owner_phone2',owner_phone3 = '$owner_phone3' where id_car = '$id'";
    
    
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
} 
?>
</body>
</html>