  <?php
session_start();
include "connection.php";

if (isset($_POST["search"]))
	{
    if (empty($_POST["guardianid"]))
       {
        header("location:guardian-form.php?error=Sorry, input empty");
	    exit();
       }		
    $guardianid = $_POST["guardianid"];
	$sql= "select * from guardian where guardianid = $guardianid";
	$stmt = $conn->query($sql);
	if ($stmt->rowCount () > 0)
	{
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    foreach ($data as $row)
	{
		$_SESSION["guardianid"] = $row["guardianid"];
		$_SESSION["guardianname"] = $row["guardianname"];
		$_SESSION["guardianaddress"] = $row["guardianaddress"];
		$_SESSION["guardianemail"] = $row["guardianemail"];
		$_SESSION["guardianmobile"] = $row["guardianmobile"];
		$_SESSION["guardianphone"] = $row["guardianphone"];
		$_SESSION["guardianemergencycontact"] = $row["guardianemergencycontact"];
		$_SESSION["guardiangender"] = $row["guardiangender"];
	}
	header("location:guardian-form.php");
	exit();
    }
    else 
    {
	header("location:guardian-form.php?error=Sorry, this ID doesn't exist");
	exit();
    }
	}

else
if (isset($_POST["delete"]))
{
	$guardianid = $_POST["guardianid"];
	$sql= "delete from guardian where guardianid = $guardianid";
	$stmt = $conn->query($sql);
	header("location:guardian-form.php?error=Congraluations,the details of this guardian has been deleted.");
	exit();
}
else
if (isset($_POST["update"]))
{
	$guardianid = $_POST["guardianid"];
	$guardianname = $_POST["guardianname"];
	$guardianaddress = $_POST["guardianaddress"];
	$guardianemail = $_POST["guardianemail"];
	$guardianmobile = $_POST["guardianmobile"];
	$guardianphone = $_POST["guardianphone"];
	$guardianemergencycontact = $_POST["guardianemergencycontact"];
	$guardiangender = $_POST["guardiangender"];
	$sql= "update guardian set guardianname = '$guardianname', guardianaddress = '$guardianaddress', 
	guardianemail = '$guardianemail', guardianmobile='$guardianmobile', guardianphone ='$guardianphone', 
	guardianemergencycontact= '$guardianemergencycontact', guardiangender = '$guardiangender' where guardianid = $guardianid";
	$stmt = $conn->query($sql);
	header("location:guardian-form.php?error=Congraluations, details has been updated");
	exit();
}
if (isset($_POST["add"]))
{  
	if(isset($_POST["guardianid"]))
    {
	$guardianid = $_POST["guardianid"];
	$guardianname = $_POST["guardianname"];
    $guardianaddress = $_POST["guardianaddress"];
    $guardianemail = $_POST["guardianemail"];
    $guardianmobile = $_POST["guardianmobile"];
    $guardianphone = $_POST["guardianphone"];
	$guardianemergencycontact = $_POST["guardianemergencycontact"];
	$guardiangender = $_POST["guardiangender"];
	$sql = "insert into guardian values (guardianid, '$guardianname','$guardianaddress', '$guardianemail',
	'$guardianmobile','$guardianphone','$guardianemergencycontact','$guardiangender')";
	$stmt = $conn->query($sql);
	$_SESSION["last_insert_id"] = $conn->lastInsertID();
	header("location:guardian-form.php?error=This guardian id ". $_SESSION["last_insert_id"]. " has been inserted");
	exit();  
    }
}

else
if (isset($_POST["viewall"]))
{
    $sql = "select * from guardian";
    $stmt = $conn->query($sql);//Execute the sql query 
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);//fetching data from table
    $str .= "<table color='navy' align='center' border='1'>";
    $str .= "<caption style='color:navy'><b>Children Information</caption>";
    $str .= "<tr>";
	$str .= "<th>ID</th>";
	$str .= "<th>Name</th>";
	$str .= "<th>Address</th>";
	$str .= "<th>Email</th>";
	$str .= "<th>Mobile</th>";
	$str .= "<th>Phone</th>";
	$str .= "<th>Emergency Contact</th>";
	$str .= "<th>Gender</th>";
	$str .= "</tr>";
    foreach ($data as $row)//display the data from the table
    {
    $str .= "<tr>";
	$str .= "<td>$row[guardianid]</td>";
	$str .= "<td>$row[guardianname]</td>";
	$str .= "<td>$row[guardianaddress]</td>";
	$str .= "<td>$row[guardianemail]</td>";
	$str .= "<td>$row[guardianmobile]</td>";
	$str .= "<td>$row[guardianphone]</td>";
	$str .= "<td>$row[guardianemergencycontact]</td>";
	$str .= "<td>$row[guardiangender]</td>";
	$str .= "</tr>";
    }
    $str .= "</table>";
	header("location:guardian-form.php?error=$str");
	exit();
}
else 
if (isset($_POST["reset"]))
{
		$_SESSION["guardianid"] = "";
		$_SESSION["guardianname"] = "";
		$_SESSION["guardianaddress"] = "";
		$_SESSION["guardianemail"] = "";
		$_SESSION["guardianmobile"] = "";
		$_SESSION["guardianphone"] = "";
		$_SESSION["guardianemergencycontact"] = "";
		$_SESSION["guardiangender"] = "";
	header("location:guardian-form.php");
	exit();
}

?>