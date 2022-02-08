<?php
include "connection.php";
include "database-functions.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Queries Form</title>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style-backend-website.css" href="backend website.html" type="text/css" media="all">
</head>
<style>
form {
  width:500px;
  border:2px solid #ccc;
  padding: 65px 65px 65px 65px; 
  border-radius:15px;
  margin:50px 350px;
  background:linear-gradient(135deg,#8eccf0,#9b59b6,#95d8b8);
}

</style> 
<header>
	<div id="container">
	<div class ="header">
		<img src="sitelogo.png" alt="">		
	</div>
	<h3>Padstow Childcare Center</h3>
</header>
<div class="navbar">
		<a class="active" href="backend website.php"><i class="fa fa-fw fa-home"></i>  HOME</a>
		<a href="#"><i class="fa fa-paper-plane-o"></i>  ABOUT US</a>
		<a href="#"><i class="fa fa-picture-o" aria-hidden="true"></i>  EVENTS</a>
		<a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> CONTACT</a>
		<a href="query-form.php"><i class="fa fa-fw fa-search"></i>  QUERIES</a>
		<a href="#" style="float:right"><i class="fa fa-user-o" aria-hidden="true"></i> LOGIN</a>		
    <div class="dropdown">
		<button class="dropbtn"><i class="fa fa-file-text-o" aria-hidden="true"></i>  FORMS</a>
		  <i class="fa fa-caret-down"></i>
		</button>
    	<div class="dropdown-content">
			<a href="#">Allergy Form</a>
            <a href="child-form.php">Child Form</a>
			<a href="#">Doctor Form</a>
			<a href="#">Enrolment </a> 
			<a href="#">Family Form</a>
			<a href="guardian-form.php">Guardian Form</a>
			<a href="#">Nurse Form</a>
			<a href="#">Payment Form</a>
			<a href="child-form.php">Child Allergy Form</a>
			<a href="child-form.php">Child Doctor Form</a>
			<a href="child-form.php">Child Guardian Form</a>
			<a href="child-form.php">Child Nurse Form</a>
			<a href="#">Family Guardian Form</a>
   		</div>
    </div>        
</div>
</head>

<body>
	<form action="queries-process.php" method="post">
	<table align="center" border="1">
	<caption style=' font-size:20px;color:white'>Queries Form</caption>
<tr>
    <td>Query ID:</td>
	<td colspan="2"><select name="queryid"> 
	<option value=0>Select a query</option>
	<option value=1>1.Guardian for a child</option>
	<option value=2>2.Children for a guardian</option>
	<option value=3>3.Allergies for a child</option>
	<option value=4>4.Chidren affected by an allergy</option>
	<option value=5>5.Payments for a child</option>
	<option value=6>6.Payments for a children</option>
	<option value=7>7.Number of guardians for children</option>
	<option value=8>8.Number of children for guardian</option>
	<option value=9>9.Child payment amount</option>
	<option value=10>10.Child Guardian Information</option>
</td></tr>
<tr>
	<td>Child ID:</td>
	<td><select name="childid">
	<option value=0>Select a child</option>
		<?php
			$sql = "select childid, childfirstname from child";
			$stmt = $conn->query($sql);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $row)
				{
					echo "<option value=$row[childid]>$row[childfirstname]</option>";
				}
		?>
	</select>
</td></tr>

<tr>
	<td>Guardian ID:</td>
	<td><select name="guardianid">
	<option value="0">Select a guardian</option>
		<?php
		$sql = "select guardianid,guardianname from guardian";
		$stmt = $conn->query($sql);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row)
		{
			echo "<option value=$row[guardianid]>$row[guardianname]</option>";
		}
		?>
	</select>
</td></tr>

<tr>
	<td>Allergy ID:</td>
	<td><select name="allergyid">
	<option value="0">Select an allergy</option>
	<?php
	$sql = "select allergyid, allergyname from allergy";
	$stmt = $conn->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $row)
	{
		echo "<option value=$row[allergyid]>$row[allergyname]</option>";
	}
	?>
	</select>
</td></tr>


<tr>
<td align="center"><input type="submit" name ="Submit" value="submit"></td>

</tr>
</table>
</form>
<?php

	if (isset($_GET["message"])) 
	{
		$message = $_GET["message"];
		print "<p style='color:red;font-size:20px;text-align:center'>$message</p>";
	}
?>
</body>
</html>





