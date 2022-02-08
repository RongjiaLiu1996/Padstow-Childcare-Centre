<?php
session_start();
include "connection.php";
if(isset($_POST["userid"]))
{
    $userid = $_POST["userid"];
    if (empty($userid))
    {
        header("location:login.php?message=User ID is required");
	    exit();
    }
    /*else 
    if (strlen($userid) != 1)
    {
        header("location:login.php?message=User ID must contain one characters only");
	    exit();
    }*/
}

if (isset($_POST["password"]))
{
    $password = $_POST["password"];
    if (empty($password))
    {
        header("location:login.php?message=Password is required");
	    exit();
    }
    else 
    if (strlen($password) != 4)
    {
        header("location:login.php?message=Password must contain four characters only");
	    exit();
    }
}

$userid =$_POST["userid"];
$password =$_POST["password"];
$sql="select * from user where userid = '$userid' and password ='$password'";
$stmt= $conn->query($sql);
if ($stmt->rowCount () > 0)
{
    $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
    foreach ($result as $row)
   { 
       $_SESSION["userid"] = $row["userid"]; 
       $_SESSION["username"] = $row["username"];
       $_SESSION["password"] = $row["password"];    
   }
   header("location:child-form.php");
   exit();
}
else 
{
	header("location:login.php?message=Invalid password or userid");
	exit();
}


if (isset($_POST["login"]))
{
    if (empty($_POST["password"]))
    {
        header("location:login.php?message=Password is required");
	    exit();
    }
    if (empty($_POST["userid"]))
    {
        header("location:login.php?message=User ID is required");
	    exit();
    }
}
?>