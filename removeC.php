<?php
  include "connection.php";
  if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $q = "delete from phbook where id=$id";
    if($conn->query($q)) {
        header("Location:home.php");
    }else {
        echo "Error in deleting";
    }
  }  
?>