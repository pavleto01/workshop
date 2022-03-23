<?php 
include('config/db_connect.php');
?>
<script type="text/javascript">
window.print();
 </script>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
		h2 {
  text-align: center;
}

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
	<h2 >Reciept</h2>
<table style="width:100%">
		<div class="alert alert-success">
		</div>
		  <?php
        if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT cases.bulstat,cases.date_in, cases.id_case, cases.case_type,cases.car_id,cases.part_type,cars.VIN, cars.car_model,cars.car_license,cars.car_firm,cars.owner_address,cars.owner_phone1,cars.owner_phone2,cars.owner_phone3, cases.km_in, cases.safo_type, cases.owner, cases.payment_type, cases.sum, cases.note,cases.ow_address,cases.ow_phone1,cases.ow_phone2,cases.ow_phone3 FROM cases JOIN cars ON cases.car_id = cars.id_car WHERE cases.id_case = $id";
        $query=mysqli_query($conn,$sql)or die(mysqli_error());
        while($row=mysqli_fetch_array($query)){
        ?>
			<tr>
				<th style="text-align:center; color:blue; width: 5%">ID</th>
                <th style="text-align:center; color:blue; width: 5%">Date</th>
				<th style="text-align:center; color:blue; width: 5%">Car/part</th>
				<th style="text-align:center; color:blue; width: 5%">Safo Type</th>
                <th style="text-align:center; color:blue; width: 5%">Payment Type</th>
               <?php  if($row['case_type'] == "car") {?>
                <th style="text-align:center; color:blue; width: 5%">KM in</th>
            <?php } ?>
			</tr>
		
		
        <tr style="height:50px">
				<td style="text-align:center; "><?php echo $row['id_case'] ?></td>
                <td style="text-align:center; "><?php echo $row['date_in'] ?></td>
                <?php  if($row['case_type'] == "car") { ?>
                <td style="text-align:center; "><?php echo $row['car_model']."<br>".$row['car_license']."<br>".$row['VIN'] ?></td>
            <?php } if($row['case_type'] == "Part") { ?>
                <td style="text-align:center; "><?php echo $row['part_type'] ?></td>
            <?php } ?>
				<td style="text-align:center; "><?php echo $row['safo_type'] ?></td>
                <td style="text-align:center; "><?php echo $row['payment_type'] ?></td>
                <?php  if($row['case_type'] == "car") { ?>
                <td style="text-align:center; "><?php echo $row['km_in'] ?></td>
            <?php } ?>
			</tr>	

	</table>
<table style="width:100%">
    <tr>
        <th>
            Car/part owner: <br>
            <?php 
            if($row['case_type'] == "car"){
            echo $row['car_firm'];}
            if($row['case_type'] == "Part"){
            echo $row['owner'];}
            ?>                       
         </th>

        <th>
            Telephone 1: <br>
            <?php 
            if($row['case_type'] == "car"){
            echo $row['owner_phone1'];}
            if($row['case_type'] == "Part"){
            echo $row['ow_phone1'];}
            ?>        </th>
        <th>
            Telephone 2:<br>
            <?php 
            if($row['case_type'] == "car"){
            echo $row['owner_phone2'];}
            if($row['case_type'] == "Part"){
            echo $row['ow_phone2'];}
            ?>
        </th>
        <th>
            Telephone 3:<br>
            <?php 
            if($row['case_type'] == "car"){
            echo $row['owner_phone3'];}
            if($row['case_type'] == "Part"){
            echo $row['ow_phone3'];}
            ?>
        </th>
    </tr>
<tr>

    <th>
        Firm/Owner address:<br>
         <?php 
            if($row['case_type'] == "car"){
            echo $row['owner_address'];}
            if($row['case_type'] == "Part"){
            echo $row['ow_address'];}
            ?>
    </th>
    <th>
        Bulstat:<br>
            <?php echo $row['bulstat'];?>
    </th>
    <?php  } }?>


<th colspan="2">
    Case workers:
    
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
			} }
                ?>
     		</th>      
     
     
</th>
</tr>

<tr>
    <th colspan="2">  
        Note:<br>
        <?php
            $query = "SELECT cases.note FROM cases WHERE cases.id_case = $id";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($result)){ 
        echo $row['note']; }?>

    </th>

    <th colspan="2">
        <form class="white" method="POST">
        <h3>Summary:</h3>
        <?php
            $query = "SELECT cases.sum FROM cases WHERE cases.id_case = $id";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($result))
            {
            	echo $row['sum']."лв.";
            }
            ?>
    </form>
        <br>

    </th>
</tr>

</form>
</table>
<hr>
<br>
<hr>
<br>
<hr>
<br>
<hr>
<br>
<hr>
<br>
<hr>
<br>
<hr>
<br>
<hr>
<br>
<hr>
<br>
<hr>
<br>
<hr>
<br>
<hr>

</body>
</html>