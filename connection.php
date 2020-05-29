<?php


$serverName = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($serverName,$username,$password);


$q = "create database databs";
$res = $conn->query($q);

include('createtable.php');
?>
