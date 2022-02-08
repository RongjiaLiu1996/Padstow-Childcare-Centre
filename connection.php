<?php
try
{
    $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_CASE => PDO::CASE_NATURAL,
    PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
];
$conn = new PDO("mysql:host=localhost;dbname=childcare", "root", "", $options);//This statement is creating an object of the PDO class. root is user name and password is blank.
print "" . "<br>";
}
catch (PDOException $e)//PDOException is a class for catching exceptions/errors
{
print $e->getMessage();
exit();
}
?>