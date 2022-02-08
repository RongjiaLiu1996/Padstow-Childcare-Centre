<?php
session_start();
include "connection.php";
include "validation-functions.php";
include "child-class.php";
$allergies = "";
if (isset($_POST["Search"]))
{
	if (isset($_POST["childid"]))
	{
		$childid = $_POST["childid"];
	}
	else
	if (isset($_GET["childid"]))
	{
		$childid = $_GET["childid"];
	}
	$objChild = new Child($childid);//Create an object of the Child class
	$found = $objChild->SearchChild();//Call the method by using the object
	
	if ($found)
	{
		header("location:child-form.php ");
		exit();
	}
	else
	{
		header("location:child-form.php?message=This child does not exist");
		exit();
	}
}
else
if (isset($_GET["childid"]))
{
	$childid = $_GET["childid"];
	$found = SearchChild($childid, $conn);
	if ($found)
	{
		header("location:child-form.php ");
		exit();
	}
	else
	{
		header("location:child-form.php?message=This child does not exist");
		exit();
	}
}
if (isset($_POST["Delete"]))
{		
	$childid = $_POST["childid"];
	$objChild = new Child($childid);
	$errorNumber = $objChild->DeleteChild();
	if ($errorNumber == 1)
	{
		header("location:child-form.php?message=This child has been deleted successfully");
		exit();
	}
	else
	if ($errorNumber == 2)
	{
		header("location:child-form.php?message=This child has got allergies - Can't delete");
		exit();
	}
	else
	if ($errorNumber == 3)
	{
		header("location:child-form.php?message=This child has got guardians - Can't delete");
		exit();
	}
	else
	if ($errorNumber == 4)
	{
		header("location:child-form.php?message=This child has got payments - Can't delete");
		exit();
	}
	else
	if ($errorNumber == 5)
	{
		header("location:child-form.php?message=This child  does not exit");
		exit();
	}
}
else
if (isset($_POST["Add"]))
{
	//$_SESSION["childid"] = "";
	$childfirstname = $_POST["childfirstname"];
	$childfamilyname = $_POST["childfamilyname"];
	$childgender = $_POST["childgender"];
	
	$childdob = $_POST["childdob"];
	$curDate = new DateTime();
	//echo $curDate->format('r') . PHP_EOL; 
	$pastDate = $curDate->modify('-5 years');
    $childdob1 = new DateTime($childdob);
	$diff = $childdob1->diff($pastDate);
	if ($diff->format("%R%a") > 0)
	{
		header("location:child-form.php?message=This child id must be five years old");
		exit();
	}
	else
	{
		$objChild = new Child($childfirstname,$childfamilyname,$childdob,$childgender);
		$errNumber = $objChild->AddChild();
		if ($errNumber == 1)
		{
			header("location:child-form.php?message=This child id " . $_SESSION["last_insert_id"] . " has been inserted successfully");
			exit();
		}
		else
		if ($errNumber == 2)
		{
			header("location:child-form.php?message=Problem in inserting this child");
			exit();
		}
	}
}
else
if (isset($_POST["Update"]))
{
	$childid = $_POST["childid"];
	//$childfirstname = $_POST["childfirstname"];
	//$childfamilyname = $_POST["childfamilyname"];
	$childdob = $_POST["childdob"];
	//$childgender = $_POST["childgender"];
	$objChild = new Child($childid, $childdob);
	$errNumber = $objChild->UpdateChild();
	if ($errNumber == 1)
	{
		header("location:child-form.php?message=This child id has been updated successfully");
		exit();
	}
	else
	if ($errNumber == 2)
	{
		header("location:child-form.php?message=Problem in updating this child");
		exit();
	}
	else
	if ($errNumber == 3)
	{
		header("location:child-form.php?message=This child does not exist");
		exit();
	}
}				
else
if (isset($_POST["ViewAll"]))
{	
	$message = "<h4 style='color:red;text-align:center'>List of all children</h4>";
	//$sql = "select * from child";
	//$sql = "CALL SearchChild(0)";
	//$str .= ViewAll($sql, $conn);
	//header("location:child-form.php?message=$str");
	//exit();
	//$childid = $_POST["childid"];
	$ctr = 0;
	//$sql = "select * from child";
	//$stmt = $conn->query($sql);
	$objChild = new Child(1);//Using default constructor in the class
	$data = $objChild->ViewAll();
	//$count = $result->rowCount();
	//$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$message .= "<table border='1' align='center'>";
	$message .= "<caption style='color:red'>List of all children</caption>";
	$message .= "<tr>";
	$message .=  "<td>Child Id</td>";
	$message .=  "<td>Child Name</td>";
	$message .=  "<td>Child Gender</td>";
	$message .=  "<td>Child DOB</td>";
	$message .=  "</tr>";
	if ($data)
	{		
		foreach($data as $row)
		{
			$message .=  "<tr>";
			$message .=  "<td>$row[childid]</td>";
			$message .=  "<td><a href='child-form-process.php?childid=$row[childid]'>$row[childfirstname] $row[childfamilyname]</td>";
			$message .=  "<td>$row[childgender]</td>";
			$message .=  "<td>$row[childdob]</td>";
			/*if (!GuardianFound($row['childid'], $conn))
			{
				$message .=  "<td><a href='child-allergy-form.php?childid= $row[childid]'>No guardian for this child</a></td>";
			}
			else
			{
				$message .=  "<td></td>";
			}
			
			if (!AllergyFound($row['childid'], $conn))
			{
				$message .=  "<td style='background-color:yellow'>No allergies for this child</td>";
			}
			else
			{
				$message .=  "<td>$allergies</td>";
			}
			
			$message .=  "</tr>";*/
			$ctr++;
		}
	}
	$message .=  "<tr>";
	$message .= "<td colspan='3' style='text-align:right'>Total number of rows</td>";
	$message .= "<td colspan='2' style='text-align:left'>" . $ctr . "</td>";
	$message .=  "<tr>";
	header("location:child-form.php?message=$message");
	exit();
}
else
if (isset($_POST["Reset"]))
{
	$_SESSION["childid"] = $cid;
	$_SESSION["childfirstname"] = "";
	$_SESSION["childfamilyname"] = "";
	$_SESSION["childgender"] = "";
	$_SESSION["childdob"] = "";
	header("location:child-form.php");
	exit();
}


function SearchChild($cid, $conn)
{
	//$sql = "select * from child where childid = $cid";
	$sql = "CALL SearchChild($cid)";
	$stmt = $conn->query($sql);
	//$count = $result->rowCount();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if ($data)
	{
		foreach($data as $row)
		{
			$_SESSION["childid"] = $row["childid"];
			$_SESSION["childfirstname"] = $row["childfirstname"];
			$_SESSION["childfamilyname"] = $row["childfamilyname"];
			$_SESSION["childgender"] = $row["childgender"];
			$_SESSION["childdob"] = $row["childdateofbirth"];
		}
		return true;
	}
	else
	{
		$_SESSION["childid"] = $cid;
		$_SESSION["childfirstname"] = "";
		$_SESSION["childfamilyname"] = "";
		$_SESSION["childgender"] = "";
		$_SESSION["childdob"] = "";
		return false;
	}
}

function GuardianFound($cid, $conn)
{
	$sql = "select * from child_guardian where childid = $cid";
	
	$stmt = $conn->query($sql);
	//$count = $result->rowCount();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if ($data)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function AllergyFound($cid, $conn)
{
	global $allergies;
	$allergies = "";
	$sql = "select allergy.allergyid, allergyname from child_allergy, allergy where allergy.allergyid = child_allergy.allergyid and childid = $cid order by allergyname";
	
	$stmt = $conn->query($sql);
	//$count = $result->rowCount();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if ($data)
	{
		foreach($data as $row)
		{
			$allergies .= GetAllergyName($row['allergyid'], $conn);
		}
		$allergies = substr_replace($allergies ,"",-1);
		return true;	
	}
	else
	{
		return false;
	}
}

function GetAllergyName($aid, $conn)
{
	$sql = "select allergyname from allergy where allergyid = $aid";
	
	$stmt = $conn->query($sql);
	//$count = $result->rowCount();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if ($data)
	{
		foreach($data as $row)
		{
			return $row['allergyname'] . ",";	
		}
	}
}
?>
</body>
</html>