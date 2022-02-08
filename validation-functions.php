<?php
function ValidateEmpty($str)
{
	if ($str == "")
	{
		return false;//boolean value (true/false)
	}
	else
	{
		return true;
	}
}

function ValidateLength($str)
{
	if (strlen($str) != 6)//Validating a string for number of characters//strlen is a function which accepts one argument
	{
		return false;//boolean value
	}
	else
	{
		return true;
	}
}

function ValidateNumeric($str)
{
	if (!is_numeric($str))//Validating student id for numeric using !
	{
		return false;
	}
	else
	{
		return true;
	}
}

function SearchStudent($str, $arr)
{
	$found = false;
	/*for ($i=0; $i<count($arr);$i++)//count function gives number of elements in the array
	{
		if ($str == $arr[$i])
		{
			$found = true;
			break;
		}
	}
	return $found;*/
	$i = 0;//initialisation of the counter
	while ($i < count($arr))
	{
		if ($str == $arr[$i])
		{
			$found = true;
			break;
		}
		$i++;//increment the counter
	}
	return $found;
	
}

function ValidateEmail($email)
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

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

function validateDateDiff($date1, $date2)
{
	$date1=date_create($date1);
	$date2=date_create($date2);
	$diff = $date2->diff($date1);
	if ($diff->days != 15)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function validateDueDate($date1, $date2)
{
	$date1=date_create($date1);
	$date2=date_create($date2);
	$diff=date_diff($date1,$date2);
	
	//print $diff->days;
	//exit();
	if ($diff->format("%R%a") >= 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function validatePaymentDate($date1, $date2)
{
	$date1=date_create($date1);
	$date2=date_create($date2);
	$diff=date_diff($date1,$date2);
	
	//print $diff->days;
	//exit();
	if ($diff->format("%R%a") >= 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

/*function viewAll($sql, $conn)
{
	
	$message = "<table border='1' align='center'>";
	$message .=  "<tr>";
	$data = array();
	$ctr = 0;
	$stmt = $conn->query($sql);
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if ($data)
	{
		if (isset($data[0])) 
		{
	  // there is at least one row - we can grab columns from it
			$columns = array_keys($data[0]);
		}
		for ($i=0; $i<count($columns); $i++)
		{
			$message .= "<td>$columns[$i]</td>";
		}
		$message .=  "</tr>";
		//$childid = $_POST["childid"];
		$ctr = 0;
		//$sql = "select * from child";
		$stmt = $conn->query($sql);
		//$count = $result->rowCount();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if ($data)
		{		
			foreach($data as $row)
			{
				$message .=  "<tr>";
				$ctr++;
				for ($i=0; $i<count($columns); $i++)
				{
					$column = $columns[$i];
					$message .=  "<td>$row[$column]</td>";
				}
				$message .=  "</tr>";
			}
			$message .=  "<tr>";
			$message .= "<td colspan='3' style='text-align:right'>Total number of rows</td>";
			$message .= "<td colspan='2' style='text-align:left'>" . $ctr . "</td>";
			$message .=  "</tr>";
			$message .= "</table>";
			return $message;
		}
	}
	else
	{
		$message .=  "<tr>";
		$message .= "<td colspan='5' style='color:red'>There are no payments</td>";
		$message .=  "</tr>";
		$message .= "</table>";
		return $message;
	}
	
	foreach ($data as $row)
	{
		foreach($row as $key => $value) 
		{
			$data[$key] = $value;
			print $key;
			print $value;
		}
	}
	//print_r($data);
}*/


function ValidateRadioButton($arr)
{
	if (isset($arr))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function ValidateDropDownBox($inp)
{
	if ($inp == 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}


$payment_start_date = "2002-9-30";
$payment_end_date = "2002-1-16";

$valid = validateDate($payment_start_date);
if ($valid)
{
	print "Valid Date";
}
else
{
	print "Invalid Date";
}

$valid = CalculateDateDiff($payment_start_date, $payment_end_date);
if ($valid)
{
	print "Valid End Date";
}
else
{
	print "Invalid End Date";
}

function CalculateDateDiff($date1, $date2)
{
	$date1=date_create($date1);
	$date2=date_create($date2);
	$diff = $date2->diff($date1);
	//print $diff->days;
	if ($diff->days != 15)
	{
		return false;
	}
	else
	{
		return true;
	}
}

/*function validateDate($date, $format = 'Y-m-d')
{    
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) === $date;   
}*/

?>