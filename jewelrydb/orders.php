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

if (isset($_POST['orders'])) {
    $orderid = mysqli_real_escape_string($data, $_POST['orderid']);
    $customerid = mysqli_real_escape_string($data, $_POST['customerid']);
    $date = mysqli_real_escape_string($data, $_POST['date']);
    $totalamount = mysqli_real_escape_string($data, $_POST['totalamount']);
    $employeeid = mysqli_real_escape_string($data, $_POST['employeeid']);
    
    $sql = "INSERT INTO orders (orderid, customerid, date, totalamount, employeeid) 
            VALUES ('$orderid', '$customerid', '$date', '$totalamount', '$employeeid')";

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
            <h1>ORDERS</h1>
            <div class="div_deg">
                <form action="#" method="POST">
                    <div>
                        <label>orderid</label>
                        <input type="text" name="orderid" required>
                    </div>
                    <div>
                        <label>customerid</label>
                        <input type="text" name="customerid" required>
                    </div>
                    <div>
                        <label>date</label>
                        <input type="text" name="date" required>
                    </div>
                    <div>
                        <label>totalamount</label>
                        <input type="number" name="totalamount" required>
                    </div>
                     <div>
                        <label>employeeid</label>
                        <input type="number" name="employeeid" required>
                    </div>
                  
                    <div>
                        <input type="submit" class="btn btn-primary" name="orders" value="orders">
                    </div>
                </form>
            </div>
        </center>
    </div>

</body>

</html>