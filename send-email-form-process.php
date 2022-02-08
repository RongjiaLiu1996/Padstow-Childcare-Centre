<?php
session_start();
include "database-functions.php";
include "connection.php";
//include "validation-functions.php";
if (empty($_POST["childid"]))
{
	header("location:send-email-form.php?message=Select an item");
	exit();
}
if ($_POST["childid"] == "All")
{
    $to = "";
    $ctr = 0;
    $childid = $_POST["childid"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $headers = "From:padstowchildcare@gmail.com";
    $sql = "select guardianname, guardianemail from child, guardian, child_guardian where child.childid = child_guardian.childid and 
    guardian.guardianid = child_guardian.guardianid";
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row)
    {
       
        $to .= $row["guardianemail"] . ";";
        $ctr++;	
    }
    $message1 = "Dear $row[guardianname]\n\n" . $message;
    mail($to, $subject, $message, $headers);
    header("location:send-email-form.php?message=Number of emails sent = $ctr");
	exit();
		
}
else
{
    $to = "";
    $ctr = 0;
    $childid = $_POST["childid"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $headers = "From:padstowchildcare@gmail.com";
    $sql = "select childfirstname, childfamilyname, guardianname, guardianemail, guardianstatus from child, guardian, child_guardian where child.childid = child_guardian.childid and 
    guardian.guardianid = child_guardian.guardianid and child.childid = $childid";
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row)
    {
        if ($row["gurdianstatus"] == "p")
        {
            $to = $row["guardianstatus"];
        }
        else
        {
            $headers .= "cc:$row[guardianemail]";

        }
        $ctr++;	
    }
    $message1 = "Dear $row[guardianname]\n\n" . "Your child $row[childfirstname]" . " " . $row["childfamilyname"] . $message;
    mail($to, $subject, $message, $headers);
    header("location:send-email-form.php?message=Number of emails sent = $ctr");
	exit();
		
}
?>