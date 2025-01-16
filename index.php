<?php
  include "dbconnection.php";
  $stmt = $conn->prepare("SELECT * FROM expense ORDER BY id DESC");
  $stmt -> execute();
  $result = $stmt->get_result();
?>
<?php include 'fetch_data.php'; ?>
<?php
session_start(); // Start the session
// Check if there is a message in the session
if (isset($_SESSION['message'])) {
    // echo '<p class="success-message">' . htmlspecialchars($_SESSION['message']) . '</p>';
    unset($_SESSION['message']); // Clear the message after displaying it
}
?>

<!DOCTYPE html>
<html lang="en">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

</head>
  <body>
    <header>
      <h1>
        Expense Tracker
      </h1>
    </header>

    <div class="flex-container">
      <!-- Add expenses -->
      <section class="Add">
          <h3>Add New Expenses</h3>
          <form action="submit.php" method="POST" onsubmit="window.location.reload();">
              <label for="description">Description</label><br>
              <input name="description" type="text" placeholder="Enter Expense Description"><br>

              <label for="amount">Amount</label><br>
              <input name="amount" type="number" placeholder="Enter Amount" step="0.01"><br>

              <div class="flex-row">
                  <div class="form-group">
                      <label for="category">Category</label>
                      <select name="category" id="category">
                          <option value="" disabled selected>Select Category</option>
                          <option value="food">Food</option>
                          <option value="transportation">Transportation</option>
                          <option value="utilities">Utilities</option>
                          <option value="entertainment">Entertainment</option>
                          <option value="others">Others</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="date">Date</label>
                      <input name="date" id="date" type="date">
                  </div>
              </div>

              <button type="submit" class="add">+ Add Expense</button>
          </form>
      </section>

      <!-- Expense List -->
      <section class="Add">
        <h3>Expense Lists</h3>
        <div>
            <?php 
            $totalAmount = 0; // Initialize total amount

            while ($row = $result->fetch_assoc()) { 
                // Validate that the amount is a non-negative number
                $amount = $row['amount'];
                if (is_numeric($amount) && $amount >= 0) {
                    $totalAmount += $amount; // Add valid amounts to total
            ?>
                  <div class="expense-group"> 
                      <div class="expense-description-price">
                          <p>
                              <strong>
                                  <?php echo htmlspecialchars(ucwords(strtolower($row['description']))); ?><br>
                              </strong>
                              <span>₱ <?php echo htmlspecialchars(number_format($amount, 2)); ?></span>
                          </p>
                          <p class="category">
                              <?php echo htmlspecialchars(ucwords(strtolower($row['category']))); ?>
                          </p>
                      </div>
                        <form action="delete_expense.php" method="POST" class="delete-expense-form">
                            <input type="hidden" name="expense_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this expense?');">
                                🗑️
                            </button>
                        </form>
                    </div>
            <?php 
                } 
            } 
            ?>
            <p class="total">
                Total: ₱ <?php echo number_format($totalAmount, 2); ?>
            </p>
        </div>
      </section>
    </div>

    <div>
      <h2 class="table-title">Expense Details</h2>
    </div>

    <div class="container">
    <div class="pie-chart">
        <canvas id="expensePieChart"></canvas>
    </div>

    <!-- Scrollable Table Wrapper -->
    <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Category</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT id, description, amount, category, date FROM expense";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo ucfirst($row['description']); ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo ucfirst($row['category']); ?></td>
                                <td><?php echo ($row['date']); ?></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='4' class='no-data'>No data found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <script src="chart.js"></script>
  </body>
</html>