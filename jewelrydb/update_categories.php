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

// Update record in the Categories table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_category'])) {
    $categoryIdToUpdate = $_POST['update_category'];
    $newCategoryName = $_POST['new_category_name'];

    $updateCategoryQuery = "UPDATE categories SET categoryname = '$newCategoryName' WHERE categoryid = '$categoryIdToUpdate'";
    mysqli_query($data, $updateCategoryQuery);
    header("Refresh:0");
}

// Query for Categories table
$sqlCategories = "SELECT * FROM categories";
$resultCategories = mysqli_query($data, $sqlCategories);
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
                        <form method="post">
                            <input type="text" name="new_category_name" placeholder="New Category Name" required>
                            <button type="submit" name="update_category" value="<?php echo isset($info['categoryid']) ? $info['categoryid'] : ''; ?>">Update</button>
                        </form>
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
    </div>

</body>

</html>
