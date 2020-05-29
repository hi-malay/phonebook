<?php

$serverName = "localhost";
$username = "root";
$password = "";
$dbname = "databs";
$conn = new mysqli($serverName,$username,$password,$dbname);

$q = "create table phbook(
    id int(100) primary key auto_increment,
    name varchar(50) not null,
    dob varchar(20) not null,
    mobile BIGINT(50) not null,
    mobile2 BIGINT(50),
    mobile3 BIGINT(50),
    email varchar(100) not null,
    email2 varchar(100),
    email3 varchar(100)
)";
$res = $conn->query($q);

?>