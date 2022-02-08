<?php
/* 
Author Name: Rongjia Liu
Version Number: 1.0
Date Started: 2021-09-15
Company Name: ROI Development
Project Name: Padstow ChildCare Centre
Purpose: This class is to search, add, delete, update and viewall all nurses.
*/
ob_start();
include "db.class.php";
class Nurse {
  public $nurseid;
  public $nursename;	
  public $nurseaddress;
  public $nursephone;
  public $nursemobile;
  public $nurseemail;
  public $nursegender;
  public $conn;
    //Class constructors. This constructor detects number of agruments and arguments and generators other constructors 

	public function __construct()//Technique to create constructors, also behaves like a default constructor
	{
		$arguments = func_get_args();
		$numberOfArguments = func_num_args();

		if (method_exists($this, $function = '__construct'.$numberOfArguments)) 
		{
			call_user_func_array(array($this, $function), $arguments);
		}
		$db = new DBConnection();
	    $this->conn = $db->con;
	}
    public function __construct0()//This method is used to create an object
    {
    
    }

    public function __construct1($a1)//This method is used to create an object
    {
        $this->nurseid = $a1;
    }
	
	public function __construct3($a1, $a, $a3)
    {	
		$this->nurseid = $a1;
		$this->nursename = $a2;
		$this->nurseaddress = $a3;
    }
	public function __construct4($a1, $a2, $a3, $a4)
    {
		$this->nursename = $a1;
		$this->nurseaddress = $a2;
		$this->nursegender = $a3;
		$this->nursemobile = $a4;
    }

	public function __construct7($a1, $a2, $a3, $a4, $a5, $a6, $a7)
    {
		$this->nurseid = $a1;
		$this->nursename = $a2;
		$this->nurseaddress = $a3;
		$this->nursephone = $a4;
		$this->nursemobile= $a5;
		$this->nurseemail= $a6;
		$this->nursegender= $a7;
    }

  function SearchNurse()// This function is used to search a child using Child ID, it populates session variables and return true or false.
  {
	  //$conn = $this->ConnectToDatabase();
	  $sql = "select * from nurse where nurseid = $this->nurseid";
      $stmt = $this->conn->query($sql);
	  //$stmt = $this->conn->prepare($sql);//"select childid, childfirstname, childfamilyname, childgender, childdob from child where childid = $this->childid");
	  //$stmt->execute();
	  if ($stmt)
	  {
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		foreach ($result as $row)     
		{      
			$_SESSION["nurseid"] = $result["nurseid"];
			$_SESSION["nursename"] = $result["nursename"];
			$_SESSION["nurseaddress"] = $result["nurseaddress"];
			$_SESSION["nursephone"] = $result["nursephone"];
			$_SESSION["nursemobile"] = $result["nursemobile"];
        	$_SESSION["nurseemail"] = $result["nurseemail"];
			$_SESSION["nursegender"] = $result["nursegender"];
			return true;	
		}
      }
	  else
	  {
		  	$_SESSION["nurseid"] =$nid;
			$_SESSION["nursename"] = "";
			$_SESSION["nurseaddress"]= "";
			$_SESSION["nursephone"] = "";
			$_SESSION["nursemobile"] = "";
			$_SESSION["nurseemail"] = "";
			$_SESSION["nursegender"] = "";
			return false;	
	  }
  }

function DeleteNurse()
{ 
	$found = $this->SearchNurse();
	if ($found)
	{
	  try
	  {
		  $sql = "delete from nurse where nurseid = $this->nurseid";
		  $this->conn->query($sql);
		  return 1;
		  exit();
	  }
	  catch (PDOException $e)//$e is an object of the PDOException class
	  {
		  if (strrpos($e->errorInfo[2], "child_allergy_fk"))//getMessage() is a method of PDOException class
		  {
			  
			  //header("location:child-form.php?message=This child has got allergies - Can't delete");
			  //exit();
			  return 2;
		  }
		  //else
		  if (strrpos($e->errorInfo[2], "child_guardian_fk"))//getMessage() is a method of PDOException class
		  {
			  //header("location:child-form.php?message=This child has got guardians - Can't delete");
			  //exit();
			  return 3;
		  }
		  //else
		  if (strrpos($e->errorInfo[2], "child_payment_fk"))//getMessage() is a method of PDOException class
		  {
			  //header("location:child-form.php?message=This child has got payments - Can't delete");
			  //exit();
			  return 4;
		  }
	  }
	}
	else
	{
		return 5;
	}
	$conn = null;
}

function AddNurse()
{
  try
  {
	  $sql = "insert into nurse values ('$this->nurseid','$this->nursename','$this->nurseaddress','$this->nursephone',
	  '$this->nursemobile','$this->nurseemail','$this->nursegender ')";
	  $this->conn->query($sql);
	 // $_SESSION["last_insert_id"] = $conn->lastInsertId();
	  return 1;	
  }
  catch (PDOException $e)//$e is an object of the PDOException class
  {
	  return 2;
  }
}

function UpdateNurse()
{
	$found = $this->SearchNurse();
	if ($found)
	{
	  try
	  {
		  $sql = "update nurse set nursename = '$this->nursename', nurseaddress = '$this->nurseaddress',
		  nursephone = '$this->nursephone',nursemobile = '$this->nursemobile',nurseemail = '$this->nurseemail',
		  nursegender = '$this->nursegender' where nurseid = $this->nurseid";
		  $this->conn->query($sql);
		  return 1;	
	  }
	  catch (PDOException $e)//$e is an object of the PDOException class
	  {
		  return 2;
	  }
	}
	else
	{
		return 3;
	}
}


function ViewAll()
{
	$sql = "select * from nurse";
	$stmt = $this->conn->query($sql);
	if ($stmt)
	{
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;          
	}
	else
	{			
		return null;
	}
}
}
?>
