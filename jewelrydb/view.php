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

// Delete record from the categories table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_category'])) {
    $categoryIdToDelete = $_POST['delete_category'];
    $deleteCategoryQuery = "DELETE FROM categories WHERE categoryid = '$categoryIdToDelete'";
    mysqli_query($data, $deleteCategoryQuery);
    header("Refresh:0");
}

// Delete record from the customers table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_customer'])) {
    $customerIdToDelete = $_POST['delete_customer'];
    $deleteCustomerQuery = "DELETE FROM customers WHERE customerid = '$customerIdToDelete'";
    mysqli_query($data, $deleteCustomerQuery);
    header("Refresh:0");
}

// Delete record from the employees table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_employee'])) {
    $employeeIdToDelete = $_POST['delete_employee'];
    $deleteEmployeeQuery = "DELETE FROM employees WHERE employeeid = '$employeeIdToDelete'";
    mysqli_query($data, $deleteEmployeeQuery);
    header("Refresh:0");
}

// Delete record from the jewelry table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_jewelry'])) {
    $jewelryIdToDelete = $_POST['delete_jewelry'];
    $deleteJewelryQuery = "DELETE FROM jewelry WHERE jewelryid = '$jewelryIdToDelete'";
    mysqli_query($data, $deleteJewelryQuery);
    header("Refresh:0");
}

// Delete record from the orders table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_order'])) {
    $orderIdToDelete = $_POST['delete_order'];
    $deleteOrderQuery = "DELETE FROM orders WHERE orderid = '$orderIdToDelete'";
    mysqli_query($data, $deleteOrderQuery);
    header("Refresh:0");
}

// Delete record from the user table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $userIdToDelete = $_POST['delete_user'];
    $deleteUserQuery = "DELETE FROM user WHERE userid = '$userIdToDelete'";
    mysqli_query($data, $deleteUserQuery);
    header("Refresh:0");
}

// Query for categories table
$sqlCategories = "SELECT * FROM categories";
$resultCategories = mysqli_query($data, $sqlCategories);

// Query for customers table
$sqlCustomers = "SELECT * FROM customers";
$resultCustomers = mysqli_query($data, $sqlCustomers);

// Query for employees table
$sqlEmployees = "SELECT * FROM employees";
$resultEmployees = mysqli_query($data, $sqlEmployees);

// Query for jewelry table
$sqlJewelry = "SELECT * FROM jewelry";
$resultJewelry = mysqli_query($data, $sqlJewelry);

// Query for orders table
$sqlOrders = "SELECT * FROM orders";
$resultOrders = mysqli_query($data, $sqlOrders);

// Query for user table
$sqlUser = "SELECT * FROM user";
$resultUser = mysqli_query($data, $sqlUser);
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

        <h1>Categories</h1>
        <table class="clean-table">
            <tr>
                <th>Category ID</th>
                <th>Category Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            while ($info = $resultCategories->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo isset($info['categoryid']) ? $info['categoryid'] : ''; ?></td>
                    <td><?php echo isset($info['categoryname']) ? $info['categoryname'] : ''; ?></td>
                    <td>
                        <a href="update_categories.php?categoryid=<?php echo isset($info['categoryid']) ? $info['categoryid'] : ''; ?>">Edit</a>
                    </td>
                    <td>
                        <form method="post">
                            <button type="submit" name="delete_category" value="<?php echo isset($info['categoryid']) ? $info['categoryid'] : ''; ?>">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>

        <h1>Customers</h1>
        <table class="clean-table">
            <tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            while ($info = $resultCustomers->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo isset($info['customerid']) ? $info['customerid'] : ''; ?></td>
                    <td><?php echo isset($info['name']) ? $info['name'] : ''; ?></td>
                    <td><?php echo isset($info['contactnumber']) ? $info['contactnumber'] : ''; ?></td>
                    <td><?php echo isset($info['email']) ? $info['email'] : ''; ?></td>
                    <td>
                        <a href="update_customer.php?customerid=<?php echo isset($info['customerid']) ? $info['customerid'] : ''; ?>">Edit</a>
                    </td>
                    <td>
                        <form method="post">
                            <button type="submit" name="delete_customer" value="<?php echo isset($info['customerid']) ? $info['customerid'] : ''; ?>">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>

        <h1>Employees</h1>
        <table class="clean-table">
            <tr>
                <th>Employee ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Position</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            while ($info = $resultEmployees->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo isset($info['employeeid']) ? $info['employeeid'] : ''; ?></td>
                    <td><?php echo isset($info['firstname']) ? $info['firstname'] : ''; ?></td>
                    <td><?php echo isset($info['lastname']) ? $info['lastname'] : ''; ?></td>
                    <td><?php echo isset($info['position']) ? $info['position'] : ''; ?></td>
                    <td><?php echo isset($info['contactnumber']) ? $info['contactnumber'] : ''; ?></td>
                    <td><?php echo isset($info['email']) ? $info['email'] : ''; ?></td>
                    <td>
                        <a href="update_employees.php?employeeid=<?php echo isset($info['employeeid']) ? $info['employeeid'] : ''; ?>">Edit</a>
                    </td>
                    <td>
                        <form method="post">
                            <button type="submit" name="delete_employee" value="<?php echo isset($info['employeeid']) ? $info['employeeid'] : ''; ?>">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>

        <h1>Jewelry</h1>
        <table class="clean-table">
            <tr>
                <th>Jewelry ID</th>
                <th>Name</th>
                <th>Material</th>
                <th>Weight</th>
                <th>Price</th>
                <th>Category ID</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            while ($info = $resultJewelry->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo isset($info['jewelryid']) ? $info['jewelryid'] : ''; ?></td>
                    <td><?php echo isset($info['name']) ? $info['name'] : ''; ?></td>
                    <td><?php echo isset($info['material']) ? $info['material'] : ''; ?></td>
                    <td><?php echo isset($info['weight']) ? $info['weight'] : ''; ?></td>
                    <td><?php echo isset($info['price']) ? $info['price'] : ''; ?></td>
                    <td><?php echo isset($info['categoryid']) ? $info['categoryid'] : ''; ?></td>
                    <td>
                        <a href="update_jewelry.php?jewelryid=<?php echo isset($info['jewelryid']) ? $info['jewelryid'] : ''; ?>">Edit</a>
                    </td>
                    <td>
                        <form method="post">
                            <button type="submit" name="delete_jewelry" value="<?php echo isset($info['jewelryid']) ? $info['jewelryid'] : ''; ?>">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>

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
                        <a href="update_orders.php?orderid=<?php echo isset($info['orderid']) ? $info['orderid'] : ''; ?>">Edit</a>
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

        <h1>User</h1>
        <table class="clean-table">
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Phone</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Password</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            while ($info = $resultUser->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo isset($info['userid']) ? $info['userid'] : ''; ?></td>
                    <td><?php echo isset($info['username']) ? $info['username'] : ''; ?></td>
                    <td><?php echo isset($info['phone']) ? $info['phone'] : ''; ?></td>
                    <td><?php echo isset($info['email']) ? $info['email'] : ''; ?></td>
                    <td><?php echo isset($info['usertype']) ? $info['usertype'] : ''; ?></td>
                    <td><?php echo isset($info['password']) ? $info['password'] : ''; ?></td>
                    <td>
                        <a href="update_user.php?userid=<?php echo isset($info['userid']) ? $info['userid'] : ''; ?>">Edit</a>
                    </td>
                    <td>
                        <form method="post">
                            <button type="submit" name="delete_user" value="<?php echo isset($info['userid']) ? $info['userid'] : ''; ?>">Delete</button>
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
