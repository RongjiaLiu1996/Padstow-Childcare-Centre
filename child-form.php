<?php
/* 
Author Name: Rongjia Liu
Version Number: 1.0
Date Started: 2021-08-08
Company Name: ROI Development
Project Name: Padstow ChildCare Centre
Purpose: This form is used to get the input on child form the user
*/
session_start();
?>
<!DOCTYPE html>
<html lang="en-ca">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style-backend-website.css"  type="text/css" media="all">
	<script src="child-validation.js"></script>
	<style>
		/*table{
			margin:-5px 430px;
		}*/
	
	
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

<body>
<form action="childform-process.php" method="post">

<h1>Padstow Childcare Center</h1>
<h2>Child Form</h2><!-- Inline stylesheet <i class="fa fa-user icon"></-i> --> 

<hr>
<div style="max-width:400px;margin:auto">
        <div class="input-icons">
<label>Child ID:</label>
  <input class="input-field" type="text" placeholder="" name="childid" id="childid" 
  value="<?php if (isset($_SESSION['childid'])) print $_SESSION['childid'];?>">
</div>
  </div>
<label>Child First Name:</label>
<input type="text" placeholder="" name="childfirstname" id="childfirstname" 
value="<?php if (isset($_SESSION['childfirstname'])) print $_SESSION['childfirstname'];?>">

<label>Child Family Name:</label>
<input type="text" placeholder=""name="childfamilyname" id="childfamilyname" 
value="<?php if (isset($_SESSION['childfamilyname'])) print $_SESSION['childfamilyname'];?>">

<label>Child DOB:</label>
<input type="date" placeholder="" min="1990-01-01" max="2021-12-31" name="childdob" id="childdob" 
value="<?php if (isset($_SESSION['childdob'])) print $_SESSION['childdob'];?>">

<label>Child Gender:</label>
<?php 
if (isset($_SESSION["childgender"]) && $_SESSION["childgender"] == "m")
{
   print '<td>Female<input id="woman" type="radio"  name="childgender" value="f"/>';
   print 'Male<input id="men" type= "radio" name="childgender" value="m" checked></td>';
}	
else 
if (isset($_SESSION["childgender"]) && $_SESSION["childgender"] == "f")
{
    print '<td>Female<input id="woman" type= "radio" name="childgender" value="f" checked/>';
    print 'Male<input id="men" type="radio"  name="childgender" value="m"></td>';
}
else 
{
  print '<td>Male<input id="men" type="radio"  name="childgender" value="m"/>';
  print 'Female<input id="woman" type= "radio" name="childgender" value="f"></td>';
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

<?php if (isset($_GET['error'])){?>
<b><p class="error"><?php echo $_GET['error']; ?></p></b>
<?php }?>

</form>

<p id="message" style="color:#A94442; font-size:50px; font-family:'Montserrat', sans-serif" text-align="center"></p>



</body>
</html>


