<?php
session_start();
include "connection.php";
include "database-functions.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Child Guardian</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style-backend-website.css"  type="text/css" media="all">
<link rel="shortcut icon" href="/assets/favocon.ico">
<style>
	/*body{
		background:linear-gradient(135deg,#71b7e6,#9b59b6)
	}*/
	table{
		border-collapse: collapse;
		border-radius:15px;	
		margin: 1px 500px
	}	
	h1{
		text-align:center;
        color:navy;
		font-size:30px; 
	}
	caption {
		font-size:20px;
		color:navy;
    }
	form {
    	display:inline-block;
		width:500px;
		border:2px solid #ccc;	
		border-radius:15px;
		margin:25px 410px;
		padding: 30px 35px;
    }
	/*th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color:;
		color: white;
	}
	
	td {
		padding: 5px;
		text-align: left;
		border-bottom: 1px solid #ddd;
	}
	/*td:hover {
		background-color: rgb(95, 141, 68);
	}
	tr:nth-child(odd) {background-color: #ABEBC6 } */

	.select{
		padding: 10px 12px;
		color:#333333;
		background-color:#eeeeee;
		border:1px solid #dddddd;
		cursor:pointer;
		border-radius:5px;
		font-size:15px;
	
		/*Replace default styeling (arrow)*/
		
	
	.select:hover, select.focus{
		outline:none;
		border:2px solid rgb(95, 141, 68);
	}
	.select option{
		background:rgb(95, 141, 68);
		color:white;
	}
	.registerbtn {
	background:rgb(95, 141, 68);
	border-radius:5px;
	color: white;
	padding: 5px 5px;
	margin: 2px;
	border: none;
	cursor: pointer;
	width: 30%;
	opacity: 0.9;
	}
	.registerbtn:hover {
	opacity: 0.5;
	}
	/*.print {
	text-align:center;
    font-size:30px;
    background:#F2DEDE;
    color:#A94442;
    padding:10px;
    width:50%;
    border-radius:5px;}*/

/*
 <table align="center" border="1">
		<caption>Child Guardian Form</caption><!-- Inline stylesheet -->
<tr>
<td><label>Child Id:</label></td>
<td><select class="select" name="childid">
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
</td>
</tr>
<tr>
<td>Guardian Id:</td>
<td><select class="select" name="guardianid">
	<option value="0">Select a guardian</option>
		<?php
		$sql = "select guardianid, guardianname from guardian";
		$stmt = $conn->query($sql);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row)
		{
			echo "<option value=$row[guardianid]>$row[guardianname]</option>";
		}
		?>
</select>
</td>
</tr>
<tr>
<td colspan="2" align="center"><input class="registerbtn" type="submit" name ="Add" value="Add">
<input class="registerbtn" type="submit" name ="Delete" value="Delete">
<input class="registerbtn" type="submit" name="Viewall" value="Viewall"></td>
</tr>
</table>
*/

</style>
</head>
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
		<a href="send-email-form.php"><i class="fa fa-envelope-o" aria-hidden="true"></i> CONTACT</a>
		<a href="query-form.php"><i class="fa fa-fw fa-search"></i>  QUERIES</a>
		<a href="logout.php" style="float:right"><i class="fa fa-user-o" aria-hidden="true"></i> LOG OUT</a>		
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
			<a href="nurse-form.php">Nurse Form</a>
			<a href="payment-form.php">Payment Form</a>
			<a href="child-allergy-form.php">Child Allergy Form</a>
			<a href="child-form.php">Child Doctor Form</a>
			<a href="child-guardian-form.php">Child Guardian Form</a>
			<a href="child-form.php">Child Nurse Form</a>
			<a href="#">Family Guardian Form</a>
   		</div>
    </div>    
</div>
<body>
<form action="child-guardian-form-process.php" method="post">
	
		<h1>Child Guardian Form</h1><!-- Inline stylesheet -->

<span><label>Child Id:</label></span>
<td><select class="select" name="childid">
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

<span>Guardian Id:</span>
<select class="select" name="guardianid">
	<option value="0">Select a guardian</option>
		<?php
		$sql = "select guardianid, guardianname from guardian";
		$stmt = $conn->query($sql);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row)
		{
			echo "<option value=$row[guardianid]>$row[guardianname]</option>";
		}
		?>
</select>

<input class="registerbtn" type="submit" name ="Add" value="Add">
<input class="registerbtn" type="submit" name ="Delete" value="Delete">
<input class="registerbtn" type="submit" name="Viewall" value="Viewall">
</td>
</tr>
</form>
<?php

	if (isset($_GET["message"])) 
	{
		$message = $_GET["message"];
		print "<p style='color:#A94442;font-size:25px;text-align:center'><b>$message</p>";
	}
?>

</body>
</html>


















