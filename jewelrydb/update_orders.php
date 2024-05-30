<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
} elseif ($_SESSION['usertype'] == 'student') {
    header("location: login.php");
}

$host = "localhost";
$user = "root";
$password = "";
$db = "jewelrydb";

$data = mysqli_connect($host, $user, $password, $db);

// Check connection
if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

// Update record in the Orders table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_order'])) {
    $orderIdToUpdate = $_POST['update_order'];
    $newCustomerId = $_POST['new_customer_id'];
    $newDate = $_POST['new_date'];
    $newTotalAmount = $_POST['new_total_amount'];
    $newEmployeeId = $_POST['new_employee_id'];

    $updateOrderQuery = "UPDATE orders SET customerid = '$newCustomerId', date = '$newDate', 
                         totalamount = '$newTotalAmount', employeeid = '$newEmployeeId' 
                         WHERE orderid = '$orderIdToUpdate'";
    mysqli_query($data, $updateOrderQuery);
    header("Refresh:0");
}

// Delete record from the Orders table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_order'])) {
    $orderIdToDelete = $_POST['delete_order'];
    $deleteOrderQuery = "DELETE FROM orders WHERE orderid = '$orderIdToDelete'";
    mysqli_query($data, $deleteOrderQuery);
    header("Refresh:0");
}

// Query for Orders table
$sqlOrders = "SELECT * FROM orders";
$resultOrders = mysqli_query($data, $sqlOrders);

// Query for Customers table (to populate the dropdown in the update form)
$sqlCustomers = "SELECT * FROM customers";
$resultCustomers = mysqli_query($data, $sqlCustomers);

// Query for Employees table (to populate the dropdown in the update form)
$sqlEmployees = "SELECT * FROM employees";
$resultEmployees = mysqli_query($data, $sqlEmployees);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">

    <?php
    include 'admin_css.php';
    ?>
</head>

<body>

    <?php
    include 'admin_sidebar.php';
    ?>

    <div class="content">

        <h1>Orders</h1>
        <table class="clean-table">
            <tr>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Date</th>
                <th>Total Amount</th>
                <th>Employee ID</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            while ($info = $resultOrders->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo isset($info['orderid']) ? $info['orderid'] : ''; ?></td>
                    <td><?php echo isset($info['customerid']) ? $info['customerid'] : ''; ?></td>
                    <td><?php echo isset($info['date']) ? $info['date'] : ''; ?></td>
                    <td><?php echo isset($info['totalamount']) ? $info['totalamount'] : ''; ?></td>
                    <td><?php echo isset($info['employeeid']) ? $info['employeeid'] : ''; ?></td>
                    <td>
                        <form method="post">
                            <select name="new_customer_id" required>
                                <?php
                                while ($customer = $resultCustomers->fetch_assoc()) {
                                    echo '<option value="' . $customer['customerid'] . '">' . $customer['customerid'] . '</option>';
                                }
                                ?>
                            </select>
                            <input type="text" name="new_date" placeholder="New Date" required>
                            <input type="text" name="new_total_amount" placeholder="New Total Amount" required>
                            <select name="new_employee_id" required>
                                <?php
                                while ($employee = $resultEmployees->fetch_assoc()) {
                                    echo '<option value="' . $employee['employeeid'] . '">' . $employee['employeeid'] . '</option>';
                                }
                                ?>
                            </select>
                            <button type="submit" name="update_order" value="<?php echo isset($info['orderid']) ? $info['orderid'] : ''; ?>">Update</button>
                        </form>
                    </td>
                    <td>
                        <form method="post">
                            <button type="submit" name="delete_order" value="<?php echo isset($info['orderid']) ? $info['orderid'] : ''; ?>">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

</body>

</html>
