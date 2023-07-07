<?php 
$server = "localhost";
$dbname="e-library";
$username = "root";
$password = "deepS@1234";
$port = "3306";
try
{
    $con = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo"Connected";
}
catch(PDOException $e)
{
    //echo"Connection Failed" .$e->getMessage();
}
?>