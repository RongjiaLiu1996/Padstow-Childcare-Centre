<?php
session_start();
include "connection.php"
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
	input[type=text], select, textarea {
  	width: 100%; /* Full width */
  	padding: 12px; /* Some padding */ 
  	border: 1px solid #ccc; /* Gray border */
  	border-radius: 4px; /* Rounded borders */
  	box-sizing: border-box; /* Make sure that padding and width stays in place */
  	margin-top: 6px; /* Add a top margin */
  	margin-bottom: 16px; /* Bottom margin */
  	resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type=submit]:hover {
  background-color: #45a049;
}
.11container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
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
			<a href="nurse-form.php">Nurse Form</a>
			<a href="payment-form.php">Payment Form</a>
			<a href="child-form.php">Child Allergy Form</a>
			<a href="child-form.php">Child Doctor Form</a>
			<a href="child-guardian-form.php">Child Guardian Form</a>
			<a href="child-form.php">Child Nurse Form</a>
			<a href="#">Family Guardian Form</a>
   		</div>
    </div>    
</div>

<body>
<div class="container">
    <form action="send-email-form-process.php" method="post">
	<h1>Send Email Form</h1>
	<br>
	<label>Child ID:</label>
	<select name="childid">
		<option value="0">Select an item</option>
    	<option value="All">All</option>
		<?php
		$sql = "select childid, childfirstname, childfamilyname from child";
		$stmt = $conn->query($sql);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row)
		{
		echo "<option value=$row[childid]>$row[childfirstname]</option>";
		}
		?>
	</select>
  
	<label>Subject:</label>
	<input type="text" name="subject" id="subject">
	
	
	<label>Message:</label>
	<textarea name="message" id="message" cols="50" rows="10" 
	placeholder= "Type the message here"></textarea>
	
	<input class="registerbtn" type="submit" name ="submit" value="Submit">
	<?php
		if (isset($_GET["message"])) 
		{
			$message = $_GET["message"];
			print "<p style='color:red;font-size:20px;text-align:center'>!$message</p>";
		}
	?>
	</form>
	</div>

</body>
</html>
