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

if (isset($_POST['customers'])) {
    $customerid = mysqli_real_escape_string($data, $_POST['customerid']);
    $name = mysqli_real_escape_string($data, $_POST['name']);
    $contactnumber = mysqli_real_escape_string($data, $_POST['contactnumber']);
    $email = mysqli_real_escape_string($data, $_POST['email']);
    $admissionid = mysqli_real_escape_string($data, $_POST['admissionid']);
    $userid = mysqli_real_escape_string($data, $_POST['userid']);

    $sql = "INSERT INTO customers (customerid, name, contactnumber, email) 
            VALUES ('$customerid', '$name', '$contactnumber', '$email')";

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
            <h1>CUSTOMERS</h1>
            <div class="div_deg">
                <form action="#" method="POST">
                    <div>
                        <label>customerid</label>
                        <input type="text" name="customerid" required>
                    </div>
                    <div>
                        <label>Name</label>
                        <input type="text" name="name" required>
                    </div>
                    <div>
                        <label>Contact Number</label>
                        <input type="number" name="contactnumber" required>
                    </div>
                    <div>
                        <label>email</label>
                        <input type="text" name="email" required>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary" name="student" value="Add Student">
                    </div>
                </form>
            </div>
        </center>
    </div>

</body>

</html>
