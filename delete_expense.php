<?php
include "dbconnection.php";
session_start(); // Start the session to store the message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expense_id = $_POST['expense_id'];

    $stmt = $conn->prepare("DELETE FROM expense WHERE id = ?");
    $stmt->bind_param("i", $expense_id);

    if ($stmt->execute()) {
        // Store the success message in the session
        $_SESSION['message'] = "Expense Deleted";
    } else {
        // Store an error message in the session
        $_SESSION['message'] = "Error Deleting Expense";
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the main page
    header("Location: index.php");
    exit();
}
?>
