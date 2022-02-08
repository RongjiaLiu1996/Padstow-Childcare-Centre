<?php
session_start();
include "nurse-class.php";

if (isset($_POST["search"]))
{
    if (isset($_POST["nurseid"]))
	{
		$nurseid = $_POST["nurseid"];
	}
	else
	if (isset($_GET["nurseid"]))
	{
		$nurseid = $_GET["nurseid"];
	}
	$objNurse= new Nurse($nurseid);//Create an object of the Nurse class
	$found = $objNurse->SearchNurse();//Call the method by using the object
	
	if ($found)
	{
		header("location:nurse-form.php");
		exit();
	}
	else
	{
		header("location:nurse-form.php?error=This nurse does not exist");
		exit();
	}
}
else
if (isset($_GET["nurseid"]))
{
	$nurseid = $_GET["nurseid"];
	$found = SearchNurse($nurseid, $conn);
	if ($found)
	{
		header("location:nurse-form.php ");
		exit();
	}
	else
	{
		header("location:nurse-form.php?error=This nurse does not exist");
		exit();
	}
}
else 
if (isset($_POST["delete"]))
{		
	$nurseid = $_POST["nurseid"];
	$objNurse = new Nurse($nurseid);
	$errorNumber = $objNurse->DeleteNurse();
	if ($errorNumber == 1)
	{
		header("location:nurse-form.php?error=This nurse ID has been deleted successfully");
		exit();
	}
	/*else
	if ($errorNumber == 2)
	{
		header("location:nurse-form.php?error=This nurse has got allergies - Can't delete");
		exit();
	}
	else
	if ($errorNumber == 3)
	{
		header("location:nurse-form.php?message=This child has got guardians - Can't delete");
		exit();
	}
	else
	if ($errorNumber == 4)
	{
		header("location:nurse-form.php?message=This child has got payments - Can't delete");
		exit();
	}
	else
	if ($errorNumber == 5)
	{
		header("location:nurse-form.php?message=This child  does not exit");
		exit();
	}*/
}

else
if (isset($_POST["add"]))
{
	//$_SESSION["childid"] = "";
	$nurseid = $_POST["nurseid"];
    $nursename = $_POST["nursename"];
    $nurseaddress = $_POST["nurseaddress"];
    $nursephone = $_POST["nursephone"];
    $nursemobile = $_POST["nursemobile"];
    $nurseemail = $_POST["nurseemail"];
    $nursegender = $_POST["nursegender"];
	if (empty($_POST["nurseid"]))
	{
		header("location:nurse-form.php?error=Nurse ID is required to add");
		exit();
	}
	else
	{
		$objNurse = new Nurse($nurseid,$nursename,$nurseaddress,$nursephone,$nursemobile,$nurseemail,$nursegender);
		$errNumber = $objNurse->AddNurse();
		if ($errNumber == 1)//
		{
			header("location:nurse-form.php?error=This nurse ID " . $_SESSION["last_insert_id"] . " has been inserted successfully");
			exit();
		}
		else
		if ($errNumber == 2)
		{
			header("location:nurse-form.php?error=Problem in inserting this nurse ID");
			exit();
		}
	}
}
else
if (isset($_POST["update"]))
{
	$nurseid = $_POST["nurseid"];
    $nursename = $_POST["nursename"];
    $nurseaddress = $_POST["nurseaddress"];
    $nursephone = $_POST["nursephone"];
    $nursemobile = $_POST["nursemobile"];
    $nurseemail = $_POST["nurseemail"];
    $nursegender = $_POST["nursegender"];
	$objNurse = new Nurse($nurseid,$nursename,$nurseaddress,$nursephone,$nursemobile,$nurseemail,$nursegender);
	$errNumber = $objNurse->UpdateNurse();
	if ($errNumber == 1)
	{
		header("location:nurse-form.php?error=This Nurse ID has been updated successfully");
		exit();
	}
	else
	if ($errNumber == 2)
	{
		header("location:nurse-form.php?error=Problem in updating this nurse ID");
		exit();
	}
	else
	if ($errNumber == 3)
	{
		header("location:nurse-form.php?error=This Nurse ID does not exist");
		exit();
	}
}	
else
if (isset($_POST["viewall"]))
{	
	//$error = "<h4 style='color:red;text-align:center'>List of all nurse</h4>";
	//$sql = "select * from child";
	//$sql = "CALL SearchChild(0)";
	//$str .= ViewAll($sql, $conn);
	//header("location:child-form.php?error=$str");
	//exit();
	//$childid = $_POST["childid"];
	$ctr = 0;
	//$sql = "select * from child";
	//$stmt = $conn->query($sql);
	$objNurse = new Nurse();//Using default constructor in the class
	$data = $objNurse->ViewAll();
	//$count = $result->rowCount();
	//$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$message .= "<table border='1' align='center'>";
	$message .= "<caption style='color:red'>List of all Nurse</caption>";
	$message .= "<tr>";
	$message .=  "<td>Nurse ID</td>";
	$message .=  "<td>Nurse Name</td>";
	$message .=  "<td>Address</td>";
	$message .=  "<td>Phone</td>";
    $message .=  "<td>Mobile</td>";
    $message .=  "<td>Email</td>";
    $message .=  "<td>Gender</td>";
	$message .=  "</tr>";
	if ($data)
	{		
		foreach($data as $row)
		{
			$message .=  "<tr>";
			$message .=  "<td>$row[nurseid]</td>";
			$message .=  "<td><a href='nurse-form-process.php?nurseid=$row[nurseid]'>$row[nursename]</td>";
			$message .=  "<td>$row[nurseaddress]</td>";
			$message .=  "<td>$row[nursephone]</td>";
            $message .=  "<td>$row[nursemobile]</td>";
            $message .=  "<td>$row[nurseemail]</td>";
            $message .=  "<td>$row[nursegender]</td>";
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
	header("location:nurse-form.php?error=$message");
	exit();
}
else 
if (isset($_POST["reset"]))
{
	$_SESSION["nurseid"] ="";
	$_SESSION["nursename"] = "";
	$_SESSION["nurseaddress"]= "";
	$_SESSION["nursephone"] = "";
	$_SESSION["nursemobile"] = "";
	$_SESSION["nurseemail"] = "";
	$_SESSION["nursegender"] = "";	
	header("location:nurse-form.php");
	exit();

}


//___________________________________________________________________________//
/*function SearchNurse($cid, $conn)
{
	$sql = "select * from nurse where nurseid = $nurseid";
	//$sql = "CALL SearchChild($cid)";
	$stmt = $conn->query($sql);
	//$count = $result->rowCount();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if ($data)
	{
		foreach($data as $row)
		{
			$_SESSION["nurseid"] = $row["nurseid"];
			$_SESSION["nursename"] = $row["nursename"];
			$_SESSION["nurseaddress"] = $row["nurseaddress"];
			$_SESSION["nursephone"] = $row["nursephone"];
			$_SESSION["nursemobile"] = $row["nursemobile"];
            $_SESSION["nurseemail"] = $row["nurseemail"];
            $_SESSION["nursegender"] = $row["nursegender"];
		}
		return true;
	}
	else
	{
		$_SESSION["nurseid"] = $cid;
		$_SESSION["nursename"] = "";
		$_SESSION["nurseaddress"] = "";
		$_SESSION["nursephone"] = "";
		$_SESSION["nursemobile"] = "";
        $_SESSION["nurseemail"] = "";
        $_SESSION["nursegender"] = "";
		return false;
	}
}*/
/*if (isset($_POST["add"]))
{   
	$nurseid = $_POST["nurseid"];
    $nursename = $_POST["nursename"];
    $nurseaddress = $_POST["nurseaddress"];
    $nursephone = $_POST["nursephone"];
    $nursemobile = $_POST["nursemobile"];
    $nurseemail = $_POST["nurseemail"];
    $nursegender = $_POST["nursegender"];
    if (empty($_POST["nurseid"]))
       {
        header("location:nurse-form.php?error=nurse ID is required");
	    exit();
       }
	if (empty($_POST["nurseaddress"])) 
	   {
	header("location:nurse-form.php?error=Please fill the address");
	exit();
	   }
	if (empty($_POST["nursephone"])) 
	   {
	header("location:nurse-form.php?error=Phone number is required");
	exit();
	   }
	if ($nursegender== null)
	   {
	   header("location:nurse-form.php?error=Please select a gender");
	   exit();
	   }
	if (empty($_POST["nursemobile"])) 
		{
	    header("location:nurse-form.php?error=Mobile number is required");
	    exit();
		} 	
    $nurseid = $_POST["nurseid"];
	if (!is_numeric($nurseid))
	    {
		header("location:nurse-form.php?error=Nurse ID must be numbers only");
		exit();
		}  
    $sql = "insert into nurse values($nurseid, '$nursename', '$nurseaddress', '$nursephone', '$nursemobile',
    '$nurseemail','$nursegender')";
    $stmt = $conn->query($sql);
    header("location:nurse-form.php?error=This nurse id has been added");
    exit();  
}


/*function ValidateEmail($email)
{
    if (ValidateEmpty($email) == false)
    {
        print "Email address is required";
        return false;
    }
    else
    if(strpos($email, "@") === false)
    {
        print "Email address must contain @ character";
        return false;
    }
    else
    if ($email[0] == "@")
    {
        print "Email address can not contain @ character at the first position";
        return false;
    }
    else
    if ($email[strlen($email)-1] == "@")
    {
        print "Email address can not contain @ character at the last position";
        return false;
    }
    else
    if (substr_count($email, "@") > 1)
    {
        print "Email address can not contain more tha one @ character";
        return false;
    }
    else
    if(strpos($email, "@.") == true)
    {
        print "Email address must not contain @. characters togather";
        return false;
    }
    else
    if(strpos($email, ".@") == true)
    {
        print "Email address must not contain .@ characters togather";
        return false;
    }
    return true;
}

?>*/


/*
if (isset($_POST["search"]))
	{
    if (empty($_POST["nurseid"]))
       {
        header("location:nurse-form.php?error=Nurse ID is required");
	    exit();
       }		
		$nurseid = $_POST["nurseid"];
		$sql= "select * from nurse where nurseid = $nurseid";
		$stmt = $conn->query($sql);
		if ($stmt->rowCount () > 0)
	{
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    foreach ($data as $row)
	{
		    $_SESSION["nurseid"] = $row["nurseid"];
			$_SESSION["nursename"] = $row["nursename"];
			$_SESSION["nurseaddress"] = $row["nurseaddress"];
			$_SESSION["nursephone"] = $row["nursephone"];
			$_SESSION["nursemobile"] = $row["nursemobile"];
            $_SESSION["nurseemail"] = $row["nurseemail"];
            $_SESSION["nursegender"] = $row["nursegender"];
	}
		header("location:nurse-form.php");
		exit();
    }
    else 
    {
		header("location:nurse-form.php?error=Sorry, this nurse ID doesn't exist");
		exit();
    }
}
else
if (isset($_POST["delete"]))
{
	$nurseid = $_POST["nurseid"];
	$sql= "delete from nurse where nurseid = $nurseid";
	$stmt = $conn->query($sql);
	header("location:nurse-form.php?error=This Nurse ID has been deleted successfully.");
	exit();
}
else 
if (isset($_POST["reset"]))
{
    $_SESSION["nurseid"] = "";
    $_SESSION["nursename"] = "";
    $_SESSION["nurseaddress"] = "";
    $_SESSION["nursephone"] = "";
    $_SESSION["nursemobile"] = "";
    $_SESSION["nurseemail"] = "";
    $_SESSION["nursegender"] = "";
	header("location:nurse-form.php");
	exit();
}


   
*/

   