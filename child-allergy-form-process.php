<?php
include "connection.php";
if (isset($_POST["Add"]))
{
	if ($_POST["childid"] == 0)
	{
		header("location:child-allergy-form.php?message=Select a child");
		exit();
	}
	else
	if ($_POST["allergyid"] == 0)
	{
		header("location:child-allergy-form.php?message=Select a allergy");
		exit();
	}	
	else
	{
		try
		{
			$childid = $_POST["childid"];
			$allergyid = $_POST["allergyid"];
			$found = SearchChildAllergy($childid, $allergyid, $conn);
			if (!$found)
			{
				$sql = "insert into child_allergy values ($childid, $allergyid)";
				$stmt = $conn->query($sql);
				header("location:child-allergy-form.php?message=This child allergy has been added successfully");
				exit();	
			}
			else
			{
				header("location:child-allergy-form.php?message=This child allergy already exists");
				exit();	
			}
		}
		catch(PDOException $ex)//PDOException is a built-in class in PHP
		{
			
			if ($ex->errorInfo[1] == 1062)//infoError is a array property of the PDO class
			{
				header("location:child-allergy-form.php?message=PK - This child allergy already exists");
				exit();
			}
			else
			if ($ex->errorInfo[1] == 1452)//infoError is a array property of the PDO class
			{
				if (strstr($ex->getMessage(), "child_allergy_fk")) 
				{
					header("location:child-allergy-form.php?message=FK - This child does not exist");
					exit();
				}
				else
				if (strstr($ex->getMessage(), "allergy_child_fk")) 
				{
					header("location:child-allergy-form.php?message=FK - This allergy does not exist");
					exit();
				}
			}
			else
			{
				header("location:child-allergy-form.php?message=" . $ex->getMessage());
				exit();
			}			
		}
	}
}
else
if (isset($_POST["Delete"]))
{
	if ($_POST["childid"] == 0)
	{
		header("location:child-allergy-form.php?message=Select a child");
		exit();
	}
	else
	if ($_POST["allergyid"] == 0)
	{
		header("location:child-allergy-form.php?message=Select a allergy");
		exit();
	}	
	else
	{
		try
		{
			$childid = $_POST["childid"];
			$allergyid = $_POST["allergyid"];
			$found = SearchChildAllergy($childid, $allergyid, $conn);
			if ($found)
			{
				$sql = "delete from child_allergy where childid = 10 and allergyid = $allergyid";
				$stmt = $conn->query($sql);
				header("location:child-allergy-form.php?message=This child allergy has been deleted successfully");
				exit();	
			}
			else
			{
				header("location:child-allergy-form.php?message=This child allergy does not exist");
				exit();	
			}
		}
		catch(PDOException $ex)//PDOException is a built-in class in PHP
		{
			if ($ex->errorInfo[1] == 1146)//infoError is a array property of the PDO class
			{
				header("location:child-allergy-form.php?message=Delete - This table does not exist");
				exit();
			}
			else
			if ($ex->errorInfo[1] == 1054)//infoError is a array property of the PDO class
			{
				header("location:child-allergy-form.php?message=Delete - Invalid column name");
				exit();
			}
			if ($ex->errorInfo[1] == 1064)//infoError is a array property of the PDO class
			{
				header("location:child-allergy-form.php?message=Delete - SQL Statement syntax error");
				exit();
			}
			else
			{
				header("location:child-allergy-form.php?message=" . $ex->getMessage());
				exit();	
			}			
		}
	}
}
else
if (isset($_POST["Viewall"]))
{
	$sql = "select concat(childfirstname,' ',childfamilyname) as childname, allergyname from child, allergy, 
	child_allergy where child.childid = child_allergy.childid and
	allergy.allergyid = child_allergy.allergyid order by childfirstname";
	if (!empty($childid))
	{
		$sql .= " and child.childid = $childid";
	}
	else 
	if (!empty($allergyid))
	{
		$sql .= " and allergy.allergyid = $allergyid";
	}
	$stmt = $conn->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$str = "<table border=none align='center'>";
	$str .= "<caption style='color:red'><b>List of all children and allergies</caption>";
	$str .= "<tr>";
	$str .= "<th>";
	$str .= "Child name";
	$str .= "</th>";
	$str .= "<th>";
	$str .= "Allergy name";
	$str .= "</th>";
	$str .= "</tr>";	
	foreach($result as $row)
	{
		$str .=  "<tr>";
		$str .=  "<td>$row[childname]</td>";
		$str .=  "<td>$row[allergyname]</td>";
		$str .=  "</tr>";
	}
	$str .=  "<tr>";
	$str .= "</table>";
	header("location:child-allergy-form.php?message=$str");
	exit();
	
}

function SearchChildallergy($childid, $allergyid, $conn)
{
	$sql = "select * from child_allergy where childid = $childid and allergyid = $allergyid";
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