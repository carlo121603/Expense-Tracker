<?php
include "dbconnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $description = $_POST['description'];
  $amount =  $_POST['amount'];
  $category =  $_POST['category'];
  $date =  $_POST['date'];
  $stmt = $conn->prepare("INSERT INTO expense (description, amount, category, date) VALUES (?, ?, ?, ?)");
  $stmt -> bind_param("sdss", $description, $amount, $category, $date);
  
  if ($stmt -> execute()) {
    echo "Record inserted successfully";
  }else{
    echo "Error inserting record";
  }
  header("Location: index.php");
exit();
}
?>