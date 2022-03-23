<?php
	include('config/db_connect.php');
	include ('view/header.php');	
	$sql = 'SELECT cases.id_case, cases.case_type, cars.car_model, cases.km_in, cases.safo_type, cases.owner, cases.payment_type, cases.sum, cases.worker, cases.note FROM cases JOIN cars ON cases.car_id = cars.id_car';

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
  width: 100%;
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
<br>
<div class = "center">
	<form method="post">
			<label >Search case</label>
			<input type="text" name="search">
			<input type="submit" name="submit" value = "Search">
			</form>	

			<?php

				if (isset($_POST["search"])) {
					?>
					<table class="centertable">

			<tr style="height:50px">
				<th style="text-align:center; color:blue; width: 5%">Case number</th>
				<th style="text-align:center; color:blue; width: 5%">Date</th>
				<th style="text-align:center; color:blue; width: 5%">Car/part</th>
				<th style="text-align:center; color:blue; width: 5%">Car Owner</th>
				<th style="text-align:center; color:blue; width: 5%">Safo Type</th>
				<th style="text-align:center; color:blue; width: 5%">Details</th>
			</tr>

<?php
  	$str = $_POST["search"];
  	$sql3 ="SELECT
    caseworkers.workerID,
    cases.date_in,
    cases.id_case,
    cases.case_type,
    cases.part_type,
    cars.VIN,
    cars.car_model,
    cars.car_license,
    cars.car_firm,
    cases.km_in,
    cases.safo_type,
    cases.owner,
    cases.payment_type,
    cases.sum,
    cases.note
FROM
    cases
JOIN caseworkers ON cases.id_case = caseworkers.caseID
JOIN cars ON cases.car_id = cars.id_car
JOIN agents ON caseworkers.workerID = agents.id_agent
WHERE
    cases.case_type LIKE '%$str%' OR cases.owner LIKE '%$str%' OR cases.safo_type LIKE '%$str%' OR cases.payment_type LIKE '%$str%' OR cars.car_model LIKE '%$str%' OR cars.car_firm LIKE '%$str%' OR cars.car_license LIKE '%$str%' OR cases.id_case LIKE '%$str%' OR cases.part_type LIKE '%$str%' OR cases.ow_phone1 LIKE '%$str%' OR cases.ow_phone2 LIKE '%$str%' OR cases.ow_phone3 LIKE '%$str%' OR cars.owner_phone1 LIKE '%$str%' OR cars.owner_phone2 LIKE '%$str%' OR cars.owner_phone3 LIKE '%$str%' OR cars.VIN LIKE '%$str%' OR agents.agent_firstname LIKE '%$str%'
ORDER BY
    cases.date_in
DESC";
		$query=mysqli_query($conn,$sql3)or die(mysqli_error($conn));
		while($row=mysqli_fetch_array($query)){
		$id_case=$row['id_case'];
	if($idagent == $row['workerID'] ){
		?>


			<tr style="height:50px">
				<tr style="height:50px">
				<td style="text-align:center; "><?php echo $row['id_case'] ?></td>
				<td style="text-align:center; "><?php echo $row['date_in'] ?></td>
				<?php if($row['case_type'] == "car"){ ?>
				<td style="text-align:center; "><?php echo $row['car_model']."<br>".$row['car_license']."<br>".$row['VIN'] ?></td>
				<td style="text-align:center; "><?php echo $row['car_firm'] ?></td>
			<?php } if($row['case_type'] == "Part"){?>
				<td style="text-align:center; "><?php echo $row['part_type'] ?></td>	
				<td style="text-align:center; "><?php echo $row['owner'] ?></td>
				<?php } ?>
				<td style="text-align:center; "><?php echo $row['safo_type'] ?></td>
				<td style="text-align:center; "><a  href="casedetails.php?id=<?php echo $row['id_case']; ?>">Showdetails</a></td>
			</tr>	

			<?php } } }?>
		</div>

<?php  
if (!isset($_POST["search"])) { ?>

	<table class="centertable">
		<div class="alert alert-success">
			<h2 style="text-align:center; ">List of cases</h2>
		</div>
		<thead>
			<tr  style="height:50px">
				<th style="text-align:center; color:blue; width: 5%">Case number</th>
				<th style="text-align:center; color:blue; width: 5%">Date</th>
				<th style="text-align:center; color:blue; width: 5%">Car/part</th>
				<th style="text-align:center; color:blue; width: 5%">Firm/Owner</th>
				<th style="text-align:center; color:blue; width: 5%">Safo Type</th>
				<th style="text-align:center; color:blue; width: 5%">Details</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		
			
				$sql = "SELECT
    caseworkers.workerID,
    cases.date_in,
    cases.id_case,
    cases.case_type,
    cases.part_type,
    cars.VIN,
    cars.car_model,
    cars.car_license,
    cars.car_firm,
    cases.km_in,
    cases.safo_type,
    cases.owner,
    cases.payment_type,
    cases.sum,
    cases.note
FROM
    cases
JOIN caseworkers ON cases.id_case = caseworkers.caseID
JOIN cars ON cases.car_id = cars.id_car
ORDER BY
    cases.date_in
DESC; ";
		$query=mysqli_query($conn,$sql)or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		if($idagent == $row['workerID']){
		?>
			<tr style="height:50px">
				<td style="text-align:center; "><?php echo $row['id_case'] ?></td>
				<td style="text-align:center; "><?php echo $row['date_in'] ?></td>
				<?php if($row['case_type'] == "car"){ ?>
				<td style="text-align:center; "><?php echo $row['car_model']."<br>".$row['car_license']."<br>".$row['VIN'] ?></td>
				<td style="text-align:center; "><?php echo $row['car_firm'] ?></td>
			<?php } if($row['case_type'] == "Part"){?>
				<td style="text-align:center; "><?php echo $row['part_type'] ?></td>	
				<td style="text-align:center; "><?php echo $row['owner'] ?></td>
				<?php } ?>
				<td style="text-align:center; "><?php echo $row['safo_type'] ?></td>
				<td style="text-align:center; "><a  href="casedetails.php?id=<?php echo $row['id_case']; ?>">Showdetails</a></td>
			</tr>
		<?php  
		 
		}	
		} 
	}
		
?>					 
		</tbody>
	</table>	
			
</tbody>
</table>

</body>
</html>