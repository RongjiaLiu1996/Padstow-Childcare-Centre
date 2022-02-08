<?php
include "connection.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en-ca">
<head>
    <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style-backend-website.css"  type="text/css" media="all">
    <script src="nurse-validation.js"></script>
	<style>
		table{
			margin:10px -250px;
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
			<a href="nurse-form">Nurse Form</a>
			<a href="payment-form.php">Payment Form</a>
			<a href="child-allergy-form.php">Child Allergy Form</a>
			<a href="child-form.php">Child Doctor Form</a>
			<a href="child-guardian-form.php">Child Guardian Form</a>
			<a href="-form.php">Child Nurse Form</a>
			<a href="#">Family Guardian Form</a>
   		</div>
    </div>    
</div>
<body>



<form action="nurse-form-process.php" method="post" onsubmit="return ValidateInput(this)">
	<div class="container">

	<h2>Nurse Form</h2><!-- Inline stylesheet --> 

<hr>

<label>Nurse ID:</label>
<input type="text" placeholder="" name="nurseid" id="nurseid" 
value="<?php if (isset($_SESSION['nurseid'])) print $_SESSION['nurseid'];?>">

<label>Nurse Name:</label>
<input type="text"  name="nursename" id="nursename" 
value="<?php if (isset($_SESSION['nursename'])) print $_SESSION['nursename'];?>">

<label>Nurse Address:</label>
<input type="text" name="nurseaddress" id="nurseaddress" 
value="<?php if (isset($_SESSION['nurseaddress'])) print $_SESSION['nurseaddress'];?>">

<label>Nurse Phone:</label>
<input type="text"  name="nursephone" id="nursephone" 
value="<?php if (isset($_SESSION['nursephone'])) print $_SESSION['nursephone'];?>">

<label>Nurse Mobile:</label>
<input type="text"  name="nursemobile" id="nursemobile" 
value="<?php if (isset($_SESSION['nursemobile'])) print $_SESSION['nursemobile'];?>">

<label>Nurse Email:</label>
<input type="text"  name="nurseemail" id="nurseemail" 
value="<?php if (isset($_SESSION['nurseemail'])) print $_SESSION['nurseemail'];?>">

<label>Nurse Gender:</label>
<?php 
if (isset($_SESSION["nursegender"]) && $_SESSION["nursegender"] == "m")
{
   print '<td>Female<input id="woman" type="radio"  name="nursegender" value="f"/>';
   print 'Male<input id="men" type= "radio" name="nursegender" value="m" checked></td>';
}	
else 
if (isset($_SESSION["nursegender"]) && $_SESSION["nursegender"] == "f")
{
    print '<td>Female<input id="woman" type= "radio" name="nursegender" value="f" checked/>';
    print 'Male<input id="men" type="radio"  name="nursegender" value="m"></td>';
}
else 
{
  print '<td>Male<input id="men" type="radio"  name="nursegender" value="m"/>';
  print 'Female<input id="woman" type= "radio" name="nursegender" value="f"></td>';
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
<p id="message" style="color:#A94442; font-size:20px; font-family:'Montserrat', sans-serif" align="center"></p>
</form>




</body>
</html>

