<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
} elseif ($_SESSION['usertype'] == 'customer') {
    header("location:login.php");
}

$host = "localhost";
$user = "root";
$password = "";
$db = "jewelrydb";

$data = mysqli_connect($host, $user, $password, $db);

if (isset($_POST['jewelry'])) {
    $jewelryid = $_POST['jewelryid'];
    $name = $_POST['name'];
    $material = $_POST['material'];
    $weight = $_POST['weight'];
    $price = $_POST['price'];
    $categoryid = $_POST['categoryid'];
    $usertype = "customer";

    $check = "SELECT * FROM user WHERE username='$username'";
    $check_user = mysqli_query($data, $check);

    $row_count = mysqli_num_rows($check_user);

    
        $sql = "INSERT INTO jewelry(jewelryid, name, material, weight, price,categoryid) VALUES ('$jewelryid', '$name', '$material', '$weight', '$price','$categoryid')";

        $result = mysqli_query($data, $sql);

        if ($result) {
            echo "<script type='text/javascript'>alert('data uploaded successfully');</script>";
        } else {
            echo "Upload fail";
        }
    
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>

    <style type="text/css">
        label {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .div_deg {
            background-color: lightpink;
            width: 400px;
            padding-top: 70px;
            padding-bottom: 70px;
        }
    </style>

    <?php
    include 'admin_css.php';
    ?>
</head>

<body>

    <?php
    include 'admin_sidebar.php';
    ?>

    <div class="content">
        <center>
            <h1>JEWELRY</h1>
            <div class="div_deg">
                <form action="#" method="POST">
                    <div>
                        <label>jewelryid</label>
                        <input type="text" name="jewelryid">
                    </div>
                    <div>
                        <label>name</label>
                        <input type="text" name="name">
                    </div>
                    <div>
                        <label>material</label>
                        <input type="text" name="material">
                    </div>
                    <div>
                        <label>weight</label>
                        <input type="text" name="weight">
                    </div>
                     <div>
                        <label>price</label>
                        <input type="number" name="price">
                    </div>
                    <div>
                        <label>categoryid</label>
                        <input type="text" name="categoryid">
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary" name="jewelry" value="jewelry">
                    </div>
                </form>
            </div>
        </center>
    </div>

</body>

</html>
