<?php
session_start();
include "connection.php";


if (isset($_POST["Add"]))
{
	if (empty($_POST["childid"]))
	{
		header("location:child-guardian-form.php?message=Select a child");
		exit();
	}
	else 
	{
		$_SESSION["childid"] =$_POST["childid"];
	}	
	
	if (empty($_POST["guardianid"]))
	{
		header("location:child-guardian-form.php?message=Select a guardian");
		exit();
	}	
	else
	{
		$_SESSION["guardianid"] =$_POST["guardianid"];
	}
	if ((!empty($_SESSION["childid"])) && (!empty($_POST["guardianid"])))
	{
		try
		{
			$childid = $_POST["childid"];
			$guardianid = $_POST["guardianid"];
			$found = SearchTable($childid, $guardianid, $conn, "child_guardian");
			if (!$found)
			{
				$sql = "insert into child_guardian values ($childid, $guardianid)";
				$stmt = $conn->query($sql);
				header("location:child-guardian-form.php?message=This child guardian has been added successfully");
				exit();	
			}
			else
			{
				header("location:child-guardian-form.php?message=This child guardian already exists");
				exit();	
			}
		}
		catch(PDOException $ex)//PDOException is a built-in class in PHP. This statement create an object of this class
		{
			
			if ($ex->errorInfo[1] == 1062)//infoError is a array property of the PDO class
			{
				header("location:child-guardian-form.php?message=PK - This child guardian already exists");
				exit();
			}
			else
			if ($ex->errorInfo[1] == 1452)//infoError is a array property of the PDO class
			{
				if (strstr($ex->geterror(), "child_guardian_fk")) 
				{
					header("location:child-guardian-form.php?message=FK - This child does not exist");
					exit();
				}
				else
				if (strstr($ex->geterror(), "guardian_child_fk")) 
				{
					header("location:child-guardian-form.php?message=FK - This guardian does not exist");
					exit();
				}
			}
			else
			{
				header("location:child-guardian-form.php?message=" . $ex->getMessage());
				exit();
			}			
		}
	}
}
else
if (isset($_POST["Delete"]))
{
	if (empty($_POST["childid"]))
	{
		header("location:child-guardian-form.php?message=Select a child");
		exit();
	}
	else 
	{
		$_SESSION["childid"] =$_POST["childid"];
	}

	
	if ($_POST["guardianid"] == 0)
	{
		header("location:child-guardian-form.php?message=Select a guardian");
		exit();
	}	
	else
	{
		try
		{
			$childid = $_POST["childid"];
			$guardianid = $_POST["guardianid"];
			$found = SearchTable($childid, $guardianid, $conn, "child_guardian");
			if ($found)
			{
				$sql = "delete from child_guardian where childid = $childid and guardianid = $guardianid";
				$stmt = $conn->query($sql);
				header("location:child-guardian-form.php?message=This child guardian has been deleted successfully");
				exit();	
			}
			else
			{
				header("location:child-guardian-form.php?message=This child guardian does not exist");
				exit();	
			}
		}
		catch(PDOException $ex)//PDOException is a built-in class in PHP
		{
			if ($ex->errorInfo[1] == 1146)//infoError is a array property of the PDO class
			{
				header("location:child-guardian-form.php?message=Delete - This table does not exist");
				exit();
			}
			else
			if ($ex->errorInfo[1] == 1054)//infoError is a array property of the PDO class
			{
				header("location:child-guardian-form.php?message=Delete - Invalid column name");
				exit();
			}
			if ($ex->errorInfo[1] == 1064)//infoError is a array property of the PDO class
			{
				header("location:child-guardian-form.php?message=Delete - SQL Statement syntax error");
				exit();
			}
			else
			{
				header("location:child-guardian-form.php?message=" . $ex->getMessage());
				exit();	
			}			
		}
	}
}
else
if (isset($_POST["Viewall"]))
{
	$childid = $_POST["childid"];
	$guardianid = $_POST["guardianid"];
	$sql = "select concat(childfirstname,' ',childfamilyname) as childname, guardianname from child, guardian, 
	child_guardian where child.childid = child_guardian.childid and
	guardian.guardianid = child_guardian.guardianid";
	if (!empty($childid))
	{
		$sql .= " and child.childid = $childid";
	}
	else
	if (!empty($guardianid))
	{
		$sql .= " and guardian.guardianid = $guardianid";
	}	
	$stmt = $conn->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$str = "<table border='1' align='center'>";
	$str .= "<caption style='30px navy'>List of all children</caption>";
	$str .= "<tr>";
	$str .=  "<th>Child Name</td>";
	$str .=  "<th>Guardian Name</td>";
	$str .=  "</tr>";
	foreach($result as $row)
	{
		$str .=  "<tr>";
		$str .=  "<td>$row[childname]</td>";
		$str .=  "<td>$row[guardianname]</td>";
		$str .=  "</tr>";
	}
	$str .=  "<tr>";
	$str .= "</table>";
	header("location:child-guardian-form.php?message=$str");
	exit();	
}
function SearchChildGuardian($childid, $guardianid, $conn)
{
	$sql = "select * from child_guardian where childid = $childid and guardianid = $guardianid";
	$stmt = $conn->query($sql);
	if ($stmt->rowCount() != 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function SearchTable($id1, $id2, $conn, $tablename)
{
	$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'childcare' 
	AND TABLE_NAME = '$tablename'";
	$stmt = $conn->query($sql); 
	$result = $stmt->fetchAll();
	//$columns = array();
	$i = 0;
	foreach($result as $row)
	{
		$columns[] =  $row[0];	
	}
	$sql = "select * from $tablename where $columns[0] = $id1 and $columns[1] = $id2";
	$stmt = $conn->query($sql);
	if ($stmt->rowCount() != 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}
?>

