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

if (isset($_POST['employees'])) {
    $employeeid = mysqli_real_escape_string($data, $_POST['employeeid']);
    $firstname = mysqli_real_escape_string($data, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($data, $_POST['lastname']);
    $position = mysqli_real_escape_string($data, $_POST['position']);
    $contactnumber = mysqli_real_escape_string($data, $_POST['contactnumber']);
    $email = mysqli_real_escape_string($data, $_POST['email']);

    $sql = "INSERT INTO employees (employeeid, firstname, lastname, position, contactnumber, email) 
            VALUES ('$employeeid', '$firstname', '$lastname', '$position', '$contactnumber', '$email')";

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
            <h1>EMPLOYEES</h1>
            <div class="div_deg">
                <form action="#" method="POST">
                    <div>
                        <label>employeeid</label>
                        <input type="text" name="employeeid" required>
                    </div>
                    <div>
                        <label>firstname</label>
                        <input type="text" name="firstname" required>
                    </div>
                    <div>
                        <label>lastname</label>
                        <input type="text" name="lastname" required>
                    </div>
                     <div>
                        <label>position</label>
                        <input type="text" name="position" required>
                    </div>
                    <div>
                        <label>contactnumber</label>
                        <input type="number" name="contactnumber" required>
                    </div>
                    <div>
                        <label>email</label>
                        <input type="text" name="email" required>
                    </div>
                    
                  
                    <div>
                        <input type="submit" class="btn btn-primary" name="employees" value="employees">
                    </div>
                </form>
            </div>
        </center>
    </div>

</body>

</html>