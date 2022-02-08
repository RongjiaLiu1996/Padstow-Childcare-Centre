  <?php
session_start();
try
{   //This statement is creating an object of the PDO class. root is user name and password is blank
	$conn = new PDO("mysql:host=localhost;dbname=childcare", "root", "");
	print  "Connection Successful" . "<br>";
}
catch (PDOException $e)//PDOException is a class for catching exceptions/errors
{
	print $e->getMessage();
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Padstow Childcare Centre</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="style.css" rel="stylesheet" type="text/css"></link>
<script src="child-validation.js">

</script>
</head>
<body>
    <form action="childform-process.php" method="post" onsubmit="return ValidateInput()">
	<table align="center" border="1">
	<caption>Child Form</caption>
	<tr>
	<td colspan="3">Child Id:</td>
	<td colspan="3"><input type="text" name="childid" id="childid" value="<?php if (isset($_SESSION['childid'])) print $_SESSION['childid']?>"></td>
	</tr>
	<tr>
	<td colspan="3">Child First Name:</td>
	<td colspan="3"><input type="text" name="childfirstname" id="childfirstname" value="<?php if (isset($_SESSION['childfirstname'])) print $_SESSION['childfirstname']?>"</td>
	</tr>
	<tr>
	<td colspan="3">Child Family Name:</td>
	<td colspan="3"><input type="text" name="childfamilyname" id="childfamilyname" value="<?php if (isset($_SESSION['childfamilyname'])) print $_SESSION['childfamilyname']?>"</td>
	</tr>
	<tr>
	<td colspan="3">Child Gender:</td>
	
	<?php
	if (isset($_SESSION["childgender"]) && $_SESSION["childgender"] == "m")
	{
		print '<td colspan="3">Female<input type="radio" name="childgender" id="childgender" value="f">';
		print 'Male<input type="radio" name="childgender" id="childgender" value="m" checked></td>';
	}
	else
	if (isset($_SESSION["childgender"]) && $_SESSION["childgender"] == "f")
	{		
		print '<td colspan="3">Male<input type="radio" name="childgender" id="childgender" value="m">';
		print 'Female<input type="radio" name="childgender" id="childgender" value="f" checked></td>';
	}
	else
	{
		print '<td colspan="3">Male<input type="radio" name="childgender" id="childgender" value="m">';
		print 'Female<input type="radio" name="childgender" id="childgender" value="f"></td>';
	}
	?>
	</tr>
	<tr>
	<td colspan="3">Child DOB:</td>
	<td colspan="3"><input type="date" name="childdob" id="childdob" value="<?php if (isset($_SESSION['childdob'])) print $_SESSION['childdob']?>"</td>
	</tr>

	<tr>
	<td align="center"><input type="submit" id="Add" name="Add" value="Add"></td>
	<td align="center"><input type="submit" name="Delete" value="Delete"></td>
	<td align="center"><input type="submit" name="Reset" value="Reset"></td>
	<td align="center"><input type="submit" name="Update" value="Update"></td>
	<td align="center"><input type="submit" name="Search" value="Search"></td>
	<td align="center"><input type="submit" name="ViewAll" value="View All"></td>
	</tr>
	</table>
	</form>
	<p id="message" style="color:red; font-size:20px; font-family:tahoma" align="center"></p>
<?php

	if (isset($_GET["message"])) 
	{
		$message = $_GET["message"];
		print "<p style='color:red;font-size:20px;text-align:center'>$message</p>";
	}
	unset($_SESSION["childid"]);
	unset($_SESSION["childfirstname"]);
	unset($_SESSION["childfamilyname"]);
	unset($_SESSION["childdob"]);
	unset($_SESSION["childgender"]);
?>

</body>
</html>