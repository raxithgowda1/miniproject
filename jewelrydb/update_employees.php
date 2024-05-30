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

// Update record in the Employees table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_employee'])) {
    $employeeIdToUpdate = $_POST['update_employee'];
    $newFirstName = $_POST['new_first_name'];
    $newLastName = $_POST['new_last_name'];
    $newPosition = $_POST['new_position'];
    $newContactNumber = $_POST['new_contact_number'];
    $newEmail = $_POST['new_email'];

    $updateEmployeeQuery = "UPDATE employees SET firstname = '$newFirstName', lastname = '$newLastName', 
                            position = '$newPosition', contactnumber = '$newContactNumber', email = '$newEmail' 
                            WHERE employeeid = '$employeeIdToUpdate'";
    mysqli_query($data, $updateEmployeeQuery);
    header("Refresh:0");
}

// Delete record from the Employees table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_employee'])) {
    $employeeIdToDelete = $_POST['delete_employee'];
    $deleteEmployeeQuery = "DELETE FROM employees WHERE employeeid = '$employeeIdToDelete'";
    mysqli_query($data, $deleteEmployeeQuery);
    header("Refresh:0");
}

// Query for Employees table
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
                        <form method="post">
                            <input type="text" name="new_first_name" placeholder="New First Name" required>
                            <input type="text" name="new_last_name" placeholder="New Last Name" required>
                            <input type="text" name="new_position" placeholder="New Position" required>
                            <input type="text" name="new_contact_number" placeholder="New Contact Number" required>
                            <input type="text" name="new_email" placeholder="New Email" required>
                            <button type="submit" name="update_employee" value="<?php echo isset($info['employeeid']) ? $info['employeeid'] : ''; ?>">Update</button>
                        </form>
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
    </div>

</body>

</html>
