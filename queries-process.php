<?php
include "connection.php";
include "database-functions.php";
session_start();

if ($_POST["queryid"] == 0)
    {
        header("location:query-form.php?message=Select a query");
    }
    else
    if ($_POST["queryid"] == 1)
    {
        $childid = $_POST["childid"];
        $sql = "select concat(childfirstname, ' ', childfamilyname) as childname,guardianname,guardianmobile,
        guardianemergencycontact from child, guardian, child_guardian where child.childid = child_guardian.childid and 
        guardian.guardianid = child_guardian.guardianid and child.childid = $childid";
        $childname = $conn->query("select concat(childfirstname, ' ', childfamilyname) from child where childid = $childid" )-> 

        $stmt = $conn->query($sql);
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $str = "<table style='color:navy' align='center' border='1'>";
        $str .= "<caption>List of number of children for guardians</caption>";
        $str .="<tr>";
        $str .="<td>Guardian Name</td>";
        $str .="<td>Guardian Mobile</td>";
        $str .="<td>Guardian Emergency Contact</td>";
        $str .="</tr>";
        foreach ($result as $row)
        {
            $str .="<tr>";
            $str .="<td>$row[guardianname]</td>";
            $str .="<td>$row[guardianmobile]</td>";
            $str .="<td>$row[guardianemergencycontact]</td>";
            $str .="</tr>";
        }
        $str .="</tr>";
        $str .="</table>";
        header("location:query-form.php?message=$str");
        exit();
    }
else 
if ($_POST["queryid"] == 2)
{
    $guardianid  = $_POST["guardianid"];
    $sql="select concat(childfirstname, ' ',childfamilyname) as childname, guardianname from child, guardian, 
    child_guardian where child.childid = child_guardian.childid and guardian.guardianid = child_guardian.guardianid 
    and guardian.guardianid = $guardianid";
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $str ="<table border='1' align='center'>"; 
    $str .="<caption>List of all children for a guardian</caption>";
    $str .="<tr>";
    $str .="<td>Child Name</td>";
    $str .="<td>Guardian Name</td>";
    $str .="</tr>";
    foreach ($result as $row)
    {
        $str .="<tr>";
        $str .="<td>$row[childname]</td>";
        $str .="<td>$row[guardianname]</td>";
        $str .="</tr>";
    }
    $str .="</tr>";
    $str .="</table>";
    header("location:query-form.php?message=$str");
    
}
else 
if ($_POST["queryid"] == 7)
{
    $sql = 'CALL ChildNumGuardian()';
    $stmt = $conn->query($sql);
    $result = $stmt->FETCHALL(PDO::FETCH_ASSOC);
    $str = "<table style='color:navy' align='center' border='1'>";
    $str .= "<caption>List of number of guardians for Children</caption>";
    $str .="<tr>";
    $str .="<td>Child ID</td>";
    $str .="<td>Number of Guardians</td>";
    $str .="</tr>";
    foreach ($result as $row)
    {
        $str .="<tr>";
        $str .="<td><a href='child-form.php?childid=$row[childid]'>$row[childname]</td>";
        $str .="<td>$row[NumberofGuardians]</td>";
        $str .="</tr>";
    }
    $str .="</tr>";
    $str .="</table>";
    header("location:query-form.php?message=$str");
    exit();

}
else
if ($_POST["queryid"] == 8)
{
    $sql = 'CALL GuardianForChildren()';
    $stmt = $conn->query($sql);
    $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $str = "<table style='color:navy' align='center' border='1'>";
    $str .= "<caption>List of number of children for guardians</caption>";
    $str .="<tr>";
    $str .="<td>Guardian ID</td>";
    $str .="<td>Number of Children</td>";
    $str .="</tr>";
    foreach ($result as $row)
    {
        $str .="<tr>";
        $str .="<td><a href='guardian-form.php?guardianid=$row[guardianid]'>$row[guardianname]</td>";
        $str .="<td>$row[NumberofChildren]</td>";
        $str .="</tr>";
    }
    $str .="</tr>";
    $str .="</table>";
    header("location:query-form.php?message=$str");
    exit();
}
else
if ($_POST["queryid"] == 9)
{
    $sql = 'call ChildTotalPayment();';
    $stmt = $conn->query($sql);
    $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $str = "<table style='color:navy' align='center' border='1'>";
    $str .= "<caption>List of all payments for children</caption>";
    $str .="<tr>";
    $str .="<td>Childname</td>";
    $str .="<td>Payment Amount</td>";
    $str .="<td>Payment Date</td>";
    $str .="</tr>";
    foreach ($result as $row)
    {
        $str .="<tr>";
        $str .="<td>$row[childname]</td>";
        $str .="<td>$row[paymentamount]</td>";
        $str .="<td>$row[paymentdate]</td>";
        $str .="</tr>";
    }
    $str .="</tr>";
    $str .="</table>";
    header("location:query-form.php?message=$str");
    exit();
}
else
if ($_POST["queryid"] == 10)
{
    $sql = 'call GuardianInfo();';
    $stmt = $conn->query($sql);
    $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $str = "<table >";
    $str .= "<caption>List of all payments for children</caption>";
    $str .="<tr>";
    $str .="<td>Child Name</td>";
    $str .="<td>Guardian Name</td>";
    $str .="<td>Guardian mobile</td>";
    $str .="<td>Guardian Emergency Conact</td>";
    $str .="</tr>";
    foreach ($result as $row)
    {
        $str .="<tr>";
        $str .="<td>$row[childname]</td>";
        $str .="<td>$row[guardianname]</td>";
        $str .="<td>$row[guardianmobile]</td>";
        $str .="<td>$row[guardianemergencycontact]</td>";
        $str .="</tr>";
    }
    $str .="</tr>";
    $str .="</table>";
    header("location:query-form.php?message=$str");
    exit();
}








?>