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

// Update record in the Users table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $userIdToUpdate = $_POST['update_user'];
    $newUsername = $_POST['new_username'];
    $newPhone = $_POST['new_phone'];
    $newEmail = $_POST['new_email'];
    $newUserType = $_POST['new_user_type'];

    $updateUserQuery = "UPDATE users SET username = '$newUsername', phone = '$newPhone', 
                        email = '$newEmail', usertype = '$newUserType' 
                        WHERE userid = '$userIdToUpdate'";
    mysqli_query($data, $updateUserQuery);
    header("Refresh:0");
}

// Delete record from the Users table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $userIdToDelete = $_POST['delete_user'];
    $deleteUserQuery = "DELETE FROM users WHERE userid = '$userIdToDelete'";
    mysqli_query($data, $deleteUserQuery);
    header("Refresh:0");
}

// Query for Users table
$sqlUsers = "SELECT * FROM users";
$resultUsers = mysqli_query($data, $sqlUsers);
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

        <h1>Users</h1>
        <table class="clean-table">
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Phone</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            while ($info = $resultUsers->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo isset($info['userid']) ? $info['userid'] : ''; ?></td>
                    <td><?php echo isset($info['username']) ? $info['username'] : ''; ?></td>
                    <td><?php echo isset($info['phone']) ? $info['phone'] : ''; ?></td>
                    <td><?php echo isset($info['email']) ? $info['email'] : ''; ?></td>
                    <td><?php echo isset($info['usertype']) ? $info['usertype'] : ''; ?></td>
                    <td>
                        <form method="post">
                            <input type="text" name="new_username" placeholder="New Username" required>
                            <input type="text" name="new_phone" placeholder="New Phone" required>
                            <input type="email" name="new_email" placeholder="New Email" required>
                            <input type="text" name="new_user_type" placeholder="New User Type" required>
                            <button type="submit" name="update_user" value="<?php echo isset($info['userid']) ? $info['userid'] : ''; ?>">Update</button>
                        </form>
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
