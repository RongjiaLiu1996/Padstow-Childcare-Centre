<?php
/* 
Author Name: Rongjia Liu
Version Number: 1.0
Date Started: 2021-08-08
Company Name: ROI Development
Project Name: Padstow ChildCare Centre
Purpose: This form is used to get the input on child from the user to add, update, search, delete and viewall, reset all children. 
*/
session_start();
include "connection.php";
//The following code segment is used to add a child from the child table.The input fields are validated before using them
if (isset($_POST["add"]))
{   
	$childid = $_POST["childid"];
    $childfirstname = $_POST["childfirstname"];
    $childfamilyname = $_POST["childfamilyname"];
	$childdob = $_POST["childdob"];
	$childgender = $_POST["childgender"];
    if (empty($_POST["childid"]))
       {
        header("location:child-form.php?error=Child ID is required");
	    exit();
       }
	$childfirstname = $_POST["childfirstname"];
	if (empty($_POST["childfirstname"])) 
	   {
	header("location:child-form.php?error=Please fill the firstname");
	exit();
	   }
	$childfamilyname = $_POST["childfamilyname"];
	if (empty($_POST["childfamilyname"])) 
	   {
	header("location:child-form.php?error=Familyname is required");
	exit();
	   }

	$childgender = $_POST["childgender"]; 
	if ($childgender== null)
	   {
	   header("location:child-form.php?error=Please select a gender");
	   exit();
	   }
	$childdob = $_POST["childdob"];
	if (empty($_POST["childdob"])) 
		{
	header("location:child-form.php?error=Child DOB is required");
	exit();
		} 	
    $childid = $_POST["childid"];
	if (!is_numeric($childid))
	    {
		header("location:child-form.php?error=Child ID must be numbers only");
		//exit();
		}
	/*$curDate = new Datetime();
    $pastDate = $curDate->modify('-5 years');
	$childdob1 = new Datetime($childdob);
	$diff = $childdob1 ->diff($pastDate);
	if ($diff->format("%R%a") > 0)
	{
		header("location:child-form.php?error=This child must be at least 5 years old");
		exit();
	}*/
	try
	{
		$sql= "insert into child values(childid, '$childfirstname', '$childfamilyname', '$childdob', '$childgender')";
		$stmt =$conn->query($sql);
		$_SESSION["last_insert_id"] = $conn->lastInsertID();
		header("location:child-form.php?error=This child id ".$_SESSION["last_insert_id"] . " has been inserted");
		exit();
	}
	catch (PDOException $e)
	{
		header("location:child-form.php?error=Problem in inserting this child ID");
		exit();   
	}
		header("location:child-form.php?error=Child ID " . $_SESSION["last_insert_id"]);
		exit();
}

if (isset($_POST["add"]))
{  
	if(isset($_POST["childid"]))
    {
	$childid = $_POST["childid"];
    $childfirstname = $_POST["childfirstname"];
    $childfamilyname = $_POST["childfamilyname"];
    $childgender = $_POST["childgender"];
    $childdob = $_POST["childdob"];
	$sql = "insert into child values ($childid, '$childfirstname', '$childfamilyname','$childgender','$childdob')";
	$stmt = $conn->query($sql);
	header("location:child-form.php?error=This child id ".$_SESSION["last_insert_id"] . " has been inserted");
	exit();  
    }
}
////The following code segment is used to delete a child from the child table.The input fields are validated before using them
else 
if (isset($_POST["delete"]))
{	
	$childid = $_POST["childid"];
	$childfirstname = $_POST["childfirstname"];
	$childfamilyname = $_POST["childfamilyname"];
	$childgender = $_POST["childgender"];
	$childdob = $_POST["childdob"];
	if (empty($_POST["childid"]))
	{
	 header("location:child-form.php?error=Child ID is required");
	 exit();
	}
	$childdob = $_POST["childdob"];
	if (!is_numeric($childid))
	{
	 header("location:child-form.php?error=Child ID must be numbers only");
	 exit();
	}
	$childid = $_POST["childid"];
	$sql= "delete from child where childid = $childid";
	$stmt = $conn->query($sql);
	header("location:child-form.php?error=Congraluations,the details of this child has been deleted.");
	exit();
}
//The following code segment is used to update a child from the child table.The input fields are validated before using them
else
if (isset($_POST["update"]))
	{
		$childid = $_POST["childid"];
		$childfirstname = $_POST["childfirstname"];
		$childfamilyname = $_POST["childfamilyname"];
		$childgender = $_POST["childgender"];
		$childdob = $_POST["childdob"];

		if (empty($_POST["childid"]))
		{
		   header("location:child-form.php?error=Child ID is required");
		   exit();
		}
		$childfirstname = $_POST["childfirstname"];
		if (empty($_POST["childfirstname"]))
		{
		   header("location:child-form.php?error=Child Firstname is required");
		   exit();
		}
		$childfamilyname = $_POST["childfamilyname"];
		if (empty($_POST["childfamilyname"]))
		{
		   header("location:child-form.php?error=Child Familyname is required");
		   exit();
		}
		$childgender = $_POST["childgender"];
        if ($childgender = null)
		{
			header("location:child-form.php?error=Child Gender is required");
		    exit();
		}
		$childdob = $_POST["childdob"];
		if ($childdob == "")
		{
            header("location:child-form.php?error=Child DOB is required");
		    exit();
		}
		$childid = $_POST["childid"];
		$childfirstname = $_POST["childfirstname"];
		$childfamilyname = $_POST["childfamilyname"];
		$childgender = $_POST["childgender"];
		$childdob = $_POST["childdob"];
		$sql= "update child set childfirstname = '$childfirstname', childfamilyname = '$childfamilyname', 
		childgender = '$childgender', childdob='$childdob' where childid = $childid";
		$stmt = $conn->query($sql);
		header("location:child-form.php?error=Congraluations, details has been updated");
		exit();
	}
//The following code segment is used to search a child from the child table.The input fields are validated before using them
if (isset($_POST["search"]))
	{
    if (empty($_POST["childid"]))
       {
        header("location:child-form.php?error= Child ID is required");
	    exit();
       }		
		$childid = $_POST["childid"];
		$sql= "select * from child where childid = $childid";
		$stmt = $conn->query($sql);
		if ($stmt->rowCount () > 0)
	{
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    foreach ($data as $row)
	{
		$_SESSION["childid"] = $row["childid"];
		$_SESSION["childfirstname"] = $row["childfirstname"];
		$_SESSION["childfamilyname"] = $row["childfamilyname"];
		$_SESSION["childgender"] = $row["childgender"];
		$_SESSION["childdob"] = $row["childdob"];
	}
		header("location:child-form.php");
		exit();
    }
    else 
    {
		header("location:child-form.php?error=Sorry, this Child ID doesn't exist");
		exit();
    }
	}
	

//The following code segment is used to viewall a child from the child table.The input fields are validated before using them	
else
if (isset($_POST["viewall"]))
{
    $sql = "select * from child";
    $stmt = $conn->query($sql);//Execute the sql query 
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);//fetching data from table
    $str .= "<table style='color:navy' align='center' border='1'>";
    $str .= "<caption style='color:navy'>Children Information</caption>";
    $str .= "<tr>";
	$str .= "<th>Child ID</th>";
	$str .= "<th>Child Firstname</th>";
    $str .= "<th>Child Familyname</th>";
	$str .= "<th>Child Gender</th>";
	$str .= "<th>Child DOB</th>";
	$str .= "</tr>";
    foreach ($result as $row)//display the data from the table
    {
    $str .= "<tr>";
    $str .= "<td>$row[childid]</td>";
	$str .= "<td>$row[childfirstname]</td>";
	$str .= "<td>$row[childfamilyname]</td>";
	$str .= "<td>$row[childgender]</td>";
	$str .= "<td>$row[childdob]</td>";
	$str .= "</tr>";
    }
    $str .= "</table>";
	header("location:child-form.php?error=$str");
	exit();
}
else 
if (isset($_POST["reset"]))
{
	    $_SESSION["childid"] = "";
		$_SESSION["childfirstname"] = "";
		$_SESSION["childfamilyname"] = "";
		$_SESSION["childgender"] = "";
		$_SESSION["childdob"] = "";
	header("location:child-form.php");
	exit();
}




?>





