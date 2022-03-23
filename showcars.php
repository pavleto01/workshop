<?php
	include('config/db_connect.php');
	include ('view/header.php');	
	$sql = 'SELECT id_car,car_license,car_model,VIN, owner FROM cars';

 	// make query & get result
  	$result = mysqli_query($conn, $sql);

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
	<link rel="stylesheet" href="css/main.css">
	<title>Workshop</title>
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
	<table>
		<div class="alert alert-success">
			<h2 style="text-align:center; ">List of cars</h2>
		</div>
		<thead>
			<tr>
				<th style="text-align:center; color:blue; width: 10%">Car ID</th>
				<th style="text-align:center; color:blue; width: 10%">Brand, license</th>
				<th style="text-align:center; color:blue; width: 10%">Model</th>
				<th style="text-align:center; color:blue; width: 10%">VIN</th>
				<th style="text-align:center; color:blue; width: 10%">Firm/Owner</th>
				<th style="text-align:center; color:blue; width: 10%">Details</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$sql = "SELECT * from cars WHERE id_car != 1";
		$query=mysqli_query($conn,$sql)or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		$id_car=$row['id_car'];
		?>
			<tr>
				<td style="text-align:center; "><?php echo $row['id_car'] ?></td>
				<td style="text-align:center; "><?php echo $row['car_brand']."<br>".$row['car_license'] ?></td>
				<td style="text-align:center; "><?php echo $row['car_model'] ?></td>
				<td style="text-align:center; "><?php echo $row['VIN'] ?></td>
				<td style="text-align:center; "><?php echo $row['car_firm'] ?></td>
				<td style="text-align:center; "><a  href="cardetails.php?id=<?php echo $row['id_car']; ?>">Showdetails</a></td>
			</tr>
		<?php  } ?>						 
		</tbody>
	</table>			

</body>

</html>