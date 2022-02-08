<?php
ob_start();
include "connection.php";
class Child {
  public $childid;
  public $childfirstname;
  public $childlastname;
  public $childdob;
  public $childgender;

	public function __construct()//Technique to create constructors
	{
		$arguments = func_get_args();
		$numberOfArguments = func_num_args();

		if (method_exists($this, $function = '__construct'.$numberOfArguments)) 
		{
			call_user_func_array(array($this, $function), $arguments);
		}
	}
   
    public function __construct1($a1)//This method is used to create an object
    {
        $this->childid = $a1;
    }
	
	public function __construct2($a1, $a2)
    {
		
		$this->childid = $a1;
		$this->childdob = $a2;
    }
	public function __construct4($a1, $a2, $a3, $a4)
    {
		$this->childfirstname = $a1;
		$this->childlastname = $a2;
		$this->childdob = $a3;
		$this->childgender = $a4;
    }

	public function __construct5($a1, $a2, $a3, $a4, $a5)
    {
		$this->childid = $a1;
		$this->childfirstname = $a2;
		$this->childlastname = $a3;
		$this->childgender = $a4;
		$this->childdob = $a5;
    }
  
	public function ConnectToDatabase()
	{
		try
		{
			/*$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_CASE => PDO::CASE_NATURAL,
			PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
			];*/
			
			$conn = new PDO("mysql:host=localhost;dbname=childcare0221", "root", "");//This statement is creating an object of the PDO class. root is user name and password is blank.
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//print "Connection Successful" . "<br>";
			return $conn;
		}
		catch (PDOException $e)//PDOException is a class for catching exceptions/errors
		{
			if ($e->getCode() == 1044)
			{
				print "Access denied for this database childcare0221";
			}
		}
		
	}	
	
	
  function SearchChild()
  {
      $conn = $this->ConnectToDatabase();
	  $sql = "select * from child where childid = $this->childid";
      $stmt = $conn->query($sql);
      if ($stmt)
      {
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach ($result as $row)
          {
            $_SESSION["childid"] = $row["childid"];
			$_SESSION["childfirstname"] = $row["childfirstname"];
			$_SESSION["childfamilyname"] = $row["childfamilyname"];
			$_SESSION["childdob"] = $row["childdob"];
			$_SESSION["childgender"] = $row["childgender"];
            return true;	
          }
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
  
  function DeleteChild()
  {
	  $conn = $this->ConnectToDatabase();
	  $found = $this->SearchChild();
	  if ($found)
	  {
		try
		{
			$sql = "delete from child where childid = $this->childid";
			$conn->query($sql);
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
  function AddChild()
  {
	$conn = $this->ConnectToDatabase();
	try
	{
		$sql = "insert into child values (childid,'$this->childfirstname','$this->childlastname','$this->childgender','$this->childdob')";
		$conn->query($sql);
		$_SESSION["last_insert_id"] = $conn->lastInsertId();
		return 1;	
	}
	catch (PDOException $e)//$e is an object of the PDOException class
	{
		return 2;
	}
  }
  
  function UpdateChild()
  {
	  $conn = $this->ConnectToDatabase();
	  $found = $this->SearchChild();
	  if ($found)
	  {
		try
		{
			$sql = "update child set childdob = '$this->childdob' where childid = $this->childid";
			$conn->query($sql);
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
      $conn = $this->ConnectToDatabase();
	  $sql = "select * from child";
      $stmt = $conn->query($sql);
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