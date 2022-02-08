<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en-ca">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style-backend-website.css"  type="text/css" media="all">
	<style>
		
		table{
			 margin: 10px -230px
		}

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
			<a href="child-form.php">Child Nurse Form</a>
			<a href="#">Family Guardian Form</a>
   		</div>
    </div>    
</div>
</head>
<body>



<form name="guardian-form.php" action="guardian-form-process.php" method="post">
	<div class="container">

	<h2>Guardian Form</h2><!-- Inline stylesheet --> 

<hr>

<label><b>Guardian ID:</label>
<input type="text" placeholder="" name="guardianid" id="guardianid" 
value="<?php if (isset($_SESSION['guardianid'])) print $_SESSION['guardianid'];?>">

<label><b>Guardian Name:</label>
<input type="text"  name="guardianname" id="guardianname" 
value="<?php if (isset($_SESSION['guardianname'])) print $_SESSION['guardianname'];?>">

<label><b>Guardian Address:</label>
<input type="text" name="guardianaddress" id="guardianaddress" 
value="<?php if (isset($_SESSION['guardianaddress'])) print $_SESSION['guardianaddress'];?>">

<label><b>Guardian Email:</label>
<input type="text"  name="guardianemail" id="guardianemail" 
value="<?php if (isset($_SESSION['guardianemail'])) print $_SESSION['guardianemail'];?>">

<label><b>Guardian Mobile:</label>
<input type="text"  name="guardianmobile" id="guardianmobile" 
value="<?php if (isset($_SESSION['guardianmobile'])) print $_SESSION['guardianmobile'];?>">

<label><b>Guardian Phone:</label>
<input type="text"  name="guardianphone" id="guardianphone" 
value="<?php if (isset($_SESSION['guardianphone'])) print $_SESSION['guardianphone'];?>">

<label><b>Guardian Emergency Contact:</label>
<input type="text"  name="guardianemergencycontact" id="guardianemergencycontact" 
value="<?php if (isset($_SESSION['guardianemergencycontact'])) print $_SESSION['guardianemergencycontact'];?>">

<label><b>Guardian Gender:</label>
<?php 
if (isset($_SESSION["guardiangender"]) && $_SESSION["guardiangender"] == "m")
{
   print '<td>Female<input id="woman" type="radio"  name="guardiangender" value="f"/>';
   print 'Male<input id="men" type= "radio" name="guardiangender" value="m" checked></td>';
}	
else 
if (isset($_SESSION["guardiangender"]) && $_SESSION["guardiangender"] == "f")
{
    print '<td>Female<input id="woman" type= "radio" name="guardiangender" value="f" checked/>';
    print 'Male<input id="men" type="radio"  name="guardiangender" value="m"></td>';
}
else 
{
  print '<td>Male<input id="men" type="radio"  name="guardiangender" value="m"/>';
  print 'Female<input id="woman" type= "radio" name="guardiangender" value="f"></td>';
}
?>
<hr>

<br>
<input type="submit" name="search" class="registerbtn" value="Search">
<input type="submit" name="add" class="registerbtn" value="Add">
<input type="submit" name="update" class="registerbtn" value="Update">
<input type="submit" name="delete" class="registerbtn" value="Delete">
<input type="submit" name="viewall" class="registerbtn" value="Viewall">
<input type="submit" name="reset" class="registerbtn" value="Reset">
</br>
<?php if (isset($_GET['error'])){?>
<p class="error"><?php echo $_GET['error']; ?></p>
<?php }?>
</form>
</body>
</html>

