<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "hosteldb";

$data = mysqli_connect($host, $user, $password, $db);

if (!isset($_SESSION['username'])) {
    header("location:login.php");
} elseif ($_SESSION['usertype'] == 'student') {
    header("location:login.php");
}

if (isset($_POST['rooms'])) {
    $roomnumber = mysqli_real_escape_string($data, $_POST['roomnumber']);
    $capacity = mysqli_real_escape_string($data, $_POST['capacity']);
    $occupancy = mysqli_real_escape_string($data, $_POST['occupancy']);
    $furnitureid = mysqli_real_escape_string($data, $_POST['furnitureid']);
    
    $sql = "INSERT INTO rooms (roomnumber, capacity, occupancy, furnitureid) 
            VALUES ('$roomnumber', '$capacity', '$occupancy', '$furnitureid')";

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
            <h1>Add Room</h1>
            <div class="div_deg">
                <form action="#" method="POST">
                    <div>
                        <label>Room Number</label>
                        <input type="number" name="roomnumber" required>
                    </div>
                    <div>
                        <label>capacity</label>
                        <input type="number" name="capacity" required>
                    </div>
                    <div>
                        <label>occupancy</label>
                        <input type="text" name="occupancy" required>
                    </div>
                    <div>
                        <label>furnitureid</label>
                        <input type="text" name="furnityreid" required>
                    </div>
                  
                    <div>
                        <input type="submit" class="btn btn-primary" name="rooms" value="Add room">
                    </div>
                </form>
            </div>
        </center>
    </div>

</body>

</html>