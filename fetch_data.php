<?php
// Database connection
$host = "localhost";
$user = "root";
$password = '';
$db_name = "expense_tracker";

$conn = mysqli_connect($host, $user, $password, $db_name);
if (mysqli_connect_errno()) {
    die("Failed to connect with MySQL: " . mysqli_connect_error());
}

// Fetch data for the expense list
$sql = "SELECT id, description, amount, category FROM expense";
$listResult = mysqli_query($conn, $sql);

// Fetch data for the pie chart
$sql = "SELECT category, SUM(amount) AS total FROM expense GROUP BY category";
$chartResult = mysqli_query($conn, $sql);

// Process list data
$expenses = [];
while ($row = mysqli_fetch_assoc($listResult)) {
    $expenses[] = $row;
}

// Process chart data
$categories = [];
$totals = [];
while ($row = mysqli_fetch_assoc($chartResult)) {
    $categories[] = $row['category'];
    $totals[] = $row['total'];
}

// Pass chart data to JavaScript
echo "<script>
        var categories = " . json_encode($categories) . ";
        var totals = " . json_encode($totals) . ";
      </script>";
?>