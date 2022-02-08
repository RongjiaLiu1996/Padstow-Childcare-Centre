<?php
session_start();
include "payment-connection.php";
?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style-backend-website.css" type="text/css" media="all">
<script>document.write('<script src="payment.js?dev=' + Math.floor(Math.random() * 100) + '"\><\/script>');</script>
</head>
<style>
	table{
		margin:10px -250px
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
		<a href="send-email-form.php"><i class="fa fa-envelope-o" aria-hidden="true"></i> CONTACT</a>
		<a href="query-form.php"><i class="fa fa-fw fa-search"></i>  QUERIES</a>
		<a href="#" style="float:right"><i class="fa fa-user-o" aria-hidden="true"></i> LOG OUT</a>		
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
			<a href=".php">Child Nurse Form</a>
			<a href="#">Family Guardian Form</a>
   		</div>
    </div>    
</div>
</head>
<body>





<form action="payment-form-process.php" method="post" onsubmit="return ValidateInput(this);" >

<h2>Payment Form</h2>
<hr>
<label><b>Payment ID:</label>
<select class="select" name="paymentid">
	<option value=0>Select a payment</option>
	<?php
	$sql = "select paymentid from payment";
	$stmt = $conn->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $row)
	{
		if ($_SESSION["paymentid"] == $row["paymentid"])
		{
			echo "<option value=$row[paymentid] selected>$row[paymentid]</option>";
		}
		else
		{
			echo "<option value=$row[paymentid]>$row[paymentid]</option>";
		}
	}
	?>
</select>


<label><b>Payment Start Date:</label>
<input type="text" placeholder="" name="paymentstartdate" id="paymentstartdate" 
value="<?php if (isset($_SESSION['paymentstartdate'])) print $_SESSION['paymentstartdate'];?>">

<label><b>Payment End Date:</label>
<input type="text" placeholder=""name="paymentenddate" id="paymentenddate" 
value="<?php if (isset($_SESSION['paymentenddate'])) print $_SESSION['paymentenddate'];?>">

<label><b>Payment Due Date:</label>
<input type="text" placeholder="" name="paymentduedate" id="paymentduedate" 
value="<?php if (isset($_SESSION['paymentduedate'])) print $_SESSION['paymentduedate'];?>">

<label><b>Payment Amount:</label>
<input type="text" placeholder="" name="paymentamount" id="paymentamount" 
value="<?php if (isset($_SESSION['paymentamount'])) print $_SESSION['paymentamount'];?>">

<label><b>Payment Date:</label>
<input type="text" placeholder="" name="paymentdate" id="paymentdate" 
value="<?php if (isset($_SESSION['paymentdate'])) print $_SESSION['paymentdate'];?>">


<label><b>Child ID:</label>
<select class="select" name="childid">
	<option value=0>Select a child</option>
		<?php
		$sql = "select childid, concat(childfirstname, ' ' ,childfamilyname) as childname from child";
		$stmt = $conn->query($sql);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row)
		{
			if ($_SESSION["childid"] == $row["childid"])
			{
				echo "<option value=$row[childid] selected>$row[childid] $row[childname]</option>";
			}
			else
			{
				echo "<option value=$row[childid]>$row[childid] $row[childname]</option>";
			}
		}
		?>
</select> 
<hr>
<br>
<input type="submit" name="search" class="registerbtn" value="Search">
<input type="submit" name="add" class="registerbtn" value="Add">
<input type="submit" name="update" class="registerbtn" value="Update">
<input type="submit" name="delete" class="registerbtn" value="Delete">
<input type="submit" name="viewall" class="registerbtn" value="Viewall">
<input type="submit" name="reset" class="registerbtn" value="Reset">
</hr>
</form>
<?php if (isset($_GET['error'])){?>
<p class="error"><?php echo $_GET['error']; ?></p>
<?php }?>

<p id="message" style='color:red;font-size:20px;text-align:center'></p>

<?php

	if (isset($_GET["message"])) 
	{
		$message = $_GET["message"];
		print "<p style='color:red;font-size:20px;text-align:center'>$message</p>";
	}
	$_SESSION["paymentid"] = "";
	$_SESSION["paymentstartdate"] = "";
	$_SESSION["paymentenddate"] = "";
	$_SESSION["paymentduedate"] = "";
	$_SESSION["paymentamount"] = "";
	$_SESSION["paymentdate"] = "";
	$_SESSION["paymentid"] = "";
?>
</body>
</html>
