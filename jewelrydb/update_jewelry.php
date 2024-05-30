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

// Update record in the Jewelry table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_jewelry'])) {
    $jewelryIdToUpdate = $_POST['update_jewelry'];
    $newJewelryName = $_POST['new_jewelry_name'];
    $newMaterial = $_POST['new_material'];
    $newWeight = $_POST['new_weight'];
    $newPrice = $_POST['new_price'];
    $newCategoryId = $_POST['new_category_id'];

    $updateJewelryQuery = "UPDATE jewelry SET name = '$newJewelryName', material = '$newMaterial', 
                            weight = '$newWeight', price = '$newPrice', categoryid = '$newCategoryId' 
                            WHERE jewelryid = '$jewelryIdToUpdate'";
    mysqli_query($data, $updateJewelryQuery);
    header("Refresh:0");
}

// Delete record from the Jewelry table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_jewelry'])) {
    $jewelryIdToDelete = $_POST['delete_jewelry'];
    $deleteJewelryQuery = "DELETE FROM jewelry WHERE jewelryid = '$jewelryIdToDelete'";
    mysqli_query($data, $deleteJewelryQuery);
    header("Refresh:0");
}

// Query for Jewelry table
$sqlJewelry = "SELECT * FROM jewelry";
$resultJewelry = mysqli_query($data, $sqlJewelry);

// Query for Categories table (to populate the dropdown in the update form)
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
                        <form method="post">
                            <input type="text" name="new_jewelry_name" placeholder="New Name" required>
                            <input type="text" name="new_material" placeholder="New Material" required>
                            <input type="text" name="new_weight" placeholder="New Weight" required>
                            <input type="text" name="new_price" placeholder="New Price" required>
                            <select name="new_category_id" required>
                                <?php
                                while ($category = $resultCategories->fetch_assoc()) {
                                    echo '<option value="' . $category['categoryid'] . '">' . $category['categoryname'] . '</option>';
                                }
                                ?>
                            </select>
                            <button type="submit" name="update_jewelry" value="<?php echo isset($info['jewelryid']) ? $info['jewelryid'] : ''; ?>">Update</button>
                        </form>
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
    </div>

</body>

</html>
