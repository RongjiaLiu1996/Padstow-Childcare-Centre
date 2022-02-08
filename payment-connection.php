<?php
try
{
    $conn =new PDO("mysql:host=localhost;dbname=childcare", "root","");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    if ($e->getCode() == 1044)
    {
        print "Access denied for this database childcare";
    }
    exit();
}
?>