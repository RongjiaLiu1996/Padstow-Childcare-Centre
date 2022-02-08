<?php
include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Child Allergy</title>
</head>
<body>
<form action="child-allergy-form-process.php" method="post">
<table align="center" border="1">
<caption>Child Allergy Form</caption><!-- Inline stylesheet -->
<tr>
<td>Child Id:</td>
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
</td>
</tr>
<tr>
<td>Allergy Id:</td>
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
</td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name ="Add" value="Add">
<input type="submit" name ="Delete" value="Delete">
<input type="submit" name="Viewall" value="Viewall"></td>
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


















