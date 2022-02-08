<?php
session_start();
include "payment-connection.php";
include "validation-functions.php";

if (isset($_POST["search"]))
{
	$paymentid = $_SESSION["paymentid"] = $_POST["paymentid"];
	//$childid = $_SESSION["childid"] = $_POST["childid"];
	$valid = ValidateDropdownBox($paymentid);
	if (!$valid)
	{ 
		header("location:payment-form.php?error=Please select a payment ID to search");
		exit();
	}
	else
	{
	SearchPayment($paymentid, $conn);
	header("location:payment-form.php");
	exit();
	}
}
else
if (isset($_POST["delete"]))
{		
	if (empty($_POST["paymentid"]))
	{ 
		header("location:payment-form.php?error=Please select a payment ID to delete");
		exit();
	}
	$paymentid = $_POST["paymentid"];
	try
	{
		$sql = "delete from payment where paymentid = $paymentid";
		$conn->query($sql);
		header("location:payment-form.php?error=This payment has been deleted successfully");
		exit();
	}
	catch (PDOException $e)//$e is an object of the PDOException class
	{
		if ($e->errorInfo[1] == "1451" && strrpos($e->getMessage(), "child_allergy_ibfk_1"))//getMessage() is a method of PDOException class
		{
			header("location:child-form.php?message=This child has got allergies - Can't delete");
			exit();
		}
		else
		if ($e->errorInfo[1] == "1451" && strrpos($e->getMessage(), "child_guardian_ibfk_1"))//getMessage() is a method of PDOException class
		{
			header("location:child-form.php?message=This child has got guardians - Can't delete");
			exit();
		}
		else
		if ($e->errorInfo[1] == "1451" && strrpos($e->getMessage(), "child_allergy_ibfk_3"))//getMessage() is a method of PDOException class
		{
			header("location:child-form.php?message=This child has got payments - Can't delete");
			exit();
		}
	}
}
else
if (isset($_POST["add"]))
{
	$_SESSION["paymentstartdate"] = $paymentstartdate = $_POST["paymentstartdate"];
	$_SESSION["paymentenddate"] = $paymentenddate = $_POST["paymentenddate"];
	$_SESSION["paymentduedate"] = $paymentduedate = $_POST["paymentduedate"];
	$_SESSION["paymentamount"] =$paymentamount = $_POST["paymentamount"];
	$_SESSION["paymentdate"] = $paymentdate = $_POST["paymentdate"];
	$_SESSION["paymentmode"] = $paymentmode = $_POST["paymentmode"];
	$_SESSION["guardianid"] = $guardianid = $_POST["guardianid"];
	$_SESSION["childid"] = $childid = $_POST["childid"];
	$valid = ValidateEmpty($paymentstartdate);
	if (!$valid)
	{
		header("location:payment-form.php?error=Payment start date is required");
		exit();
	}
	$valid = validateDate($paymentstartdate);
	if (!$valid)
	{
		header("location:payment-form.php?error=Invalid payment start date format (YYYY-MM-DD)");
		exit();
	}
	$valid = ValidateEmpty($paymentenddate);
	if (!$valid)
	{
		header("location:payment-form.php?error=Payment end date is required");
		exit();
	}
	$valid = validateDate($paymentenddate);
	if (!$valid)
	{
		header("location:payment-form.php?error=Invalid payment end date format (YYYY-MM-DD)");
		exit();
	}
	$valid = validateDateDiff($paymentstartdate, $paymentenddate);
	if (!$valid)
	{
		header("location:payment-form.php?error=Payment end date must be 15 days after the start date");
		exit();
	}
	$valid = ValidateEmpty($paymentduedate);
	if (!$valid)
	{
		header("location:payment-form.php?error=Payment due date is required");
		exit();
	}
	$valid = validateDate($paymentduedate);
	if (!$valid)
	{
		header("location:payment-form.php?error=Invalid payment due date format (YYYY-MM-DD)");
		exit();
	}
	$valid = validateDueDate($paymentstartdate, $paymentduedate);
	if (!$valid)
	{
		header("location:payment-form.php?error=Payment start date can't be earlier than Payment due date");
		exit();
	}
	$valid = ValidateEmpty($paymentamount);
	if (!$valid)
	{
		header("location:payment-form.php?error=Payment amount is required");
		exit();
	}
	$valid = ValidateNumeric($paymentamount);
	if (!$valid)
	{
		header("location:payment-form.php?error=Payment amount must be a number");
		exit();
	}
	$valid = ValidateEmpty($paymentdate);
	if (!$valid)
	{
		header("location:payment-form.php?error=Payment date is required");
		exit();
	}
	$valid = ValidateDate($paymentdate);
	if (!$valid)
	{
		header("location:payment-form.php?error=Invalid payment date format (YYYY-MM-DD)");
		exit();
	}
	$valid = ValidatePaymentDate($paymentstartdate, $paymentdate);
	if (!$valid)
	{
		header("location:payment-form.php?error=Payment date can't be earlier than start date");
		exit();
	}
	/*$valid = ValidateRadioButton($paymentmode);
	if (!$valid)
	{
		header("location:payment-form.php?error=Select one of the payment modes");
		exit();
	}
	$valid = ValidateDropDownBox($guardianid);
	if (!$valid)
	{
		header("location:payment-form.php?error=Select a guardian");
		exit();
	}*/
	/*$valid = ValidateDropDownBox($childid);
	if (!$valid)
	{
		header("location:payment-form.php?error=Select a child ID to add");
		exit();
	}*/
	$sql = "insert into payment values (paymentid, '$paymentstartdate', '$paymentenddate', '$paymentduedate', $paymentamount, 
	'$paymentdate', $childid)";
	$conn->query($sql);
	header("location:payment-form.php?error=This payment has been added successfully");
	exit();
}
else
if (isset($_POST["update"]))
	{
		if (empty($_POST["paymentid"]))
		{
		   header("location:payment-form.php?error=Payment ID is required to update");
		   exit();
		}	
	}
else
if (isset($_POST["viewall"]))
{
    $sql = "select * from payment";
    $stmt = $conn->query($sql);//Execute the sql query 
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);//fetching data from table
    $str .= "<table style='color:navy' align='center' border='1'>";
    $str .= "<caption style='color:navy'>Pyament Details</caption>";
    $str .= "<tr>";
	$str .= "<th>Payment ID</th>";
	$str .= "<th>Payment Start Date</th>";
    $str .= "<th>Payment End Date</th>";
	$str .= "<th>Payment Due Date</th>";
	$str .= "<th>Payment Amount</th>";
	$str .= "<th>Payment Date</th>";
	$str .= "<th>Child ID</th>";
	$str .= "</tr>";
    foreach ($result as $row)//display the data from the table
    {
    $str .= "<tr>";
    $str .= "<td>$row[paymentid]</td>";
	$str .= "<td>$row[paymentstartdate]</td>";
	$str .= "<td>$row[paymentenddate]</td>";
	$str .= "<td>$row[paymentduedate]</td>";
	$str .= "<td>$row[paymentamount]</td>";
	$str .= "<td>$row[paymentdate]</td>";
	$str .= "<td>$row[childid]</td>";
	$str .= "</tr>";
    }
    $str .= "</table>";
	header("location:payment-form.php?error=$str");
	exit();
}
else 
if (isset($_POST["reset"]))
{
	$_SESSION["paymentid"] = "";
	$_SESSION["paymentstartdate"] = "";
	$_SESSION["paymentenddate"] = "";
	$_SESSION["paymentduedate"] = "";
	$_SESSION["paymentamount"] = "";
	$_SESSION["paymentdate"] = "";	
	header("location:payment-form.php");
	exit();
}


function SearchPayment($pid, $conn)
{
	$sql = "select paymentid, paymentstartdate, paymentenddate, paymentduedate, paymentamount, paymentdate, childid from payment where paymentid = ?";	
	$stmt = $conn->prepare($sql);
	$stmt->execute(array($pid));
	if ($stmt->rowcount() > 0)
	{
		$stmt->bindColumn('paymentid',$paymentid);//, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 32);
		$stmt->bindColumn('paymentstartdate',$paymentstartdate);//, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 32);
		$stmt->bindColumn('paymentenddate', $paymentenddate);//, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 32);
		$stmt->bindColumn('paymentduedate', $paymentduedate);//, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 32);
		$stmt->bindColumn('paymentamount', $paymentamount);//, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 32);
		$stmt->bindColumn('paymentdate', $paymentdate);//, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 32);
		$stmt->bindColumn('childid', $childid);//, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 32);
		
		while ($stmt->fetch(PDO::FETCH_BOUND)) 
		{
			$_SESSION["paymentid"] = $paymentid;
			$_SESSION["paymentstartdate"] = $paymentstartdate;
			$_SESSION["paymentenddate"] = $paymentenddate;
			$_SESSION["paymentduedate"] = $paymentduedate;
			$_SESSION["paymentamount"] = $paymentamount;
			$_SESSION["paymentdate"] = $paymentdate;
			$_SESSION["childid"] = $childid;		
		}
		return true;
	}
	else
	{
		$_SESSION["paymentid"] = "";
		$_SESSION["paymentstartdate"] = "";
		$_SESSION["paymentenddate"] = "";
		$_SESSION["paymentduedate"] = "";
		$_SESSION["paymentamount"] = "";
		$_SESSION["paymentdate"] = "";
		$_SESSION["childid"] = "";	
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