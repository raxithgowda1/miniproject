<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "jewelrydb";

$data = mysqli_connect($host, $user, $password, $db);

if (!isset($_SESSION['username'])) {
    header("location:login.php");
} elseif ($_SESSION['usertype'] == 'student') {
    header("location:login.php");
}

if (isset($_POST['categories'])) {
    $categoryid = mysqli_real_escape_string($data, $_POST['categoryid']);
    $categoryname = mysqli_real_escape_string($data, $_POST['categoryname']);
    
    $sql = "INSERT INTO categories (categoryid, categoryname) 
            VALUES ('$categoryid', '$categoryname')";

    $result = mysqli_query($data, $sql);

    if ($result) {
        echo "<script type='text/javascript'>alert('Data uploaded successfully');</script>";
    } else {
        echo "Upload fail: " . mysqli_error($data);
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
            <h1>CATEGORIES</h1>
            <div class="div_deg">
                <form action="#" method="POST">
                    <div>
                        <label>categoryid</label>
                        <input type="text" name="categoryid" required>
                    </div>
                    <div>
                        <label>categoryname</label>
                        <input type="text" name="categoryname" required>
                    </div>
                  
                    <div>
                        <input type="submit" class="btn btn-primary" name="categories" value="categories">
                    </div>
                </form>
            </div>
        </center>
    </div>

</body>

</html>