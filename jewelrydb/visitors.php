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

if (isset($_POST['visitors'])) {
    $visitid = mysqli_real_escape_string($data, $_POST['visitid']);
    $studentid = mysqli_real_escape_string($data, $_POST['studentid']);
    $visitorsname = mysqli_real_escape_string($data, $_POST['visitorsname']);
    $visitdate = mysqli_real_escape_string($data, $_POST['visitdate']);
    
    $sql = "INSERT INTO visitors (visitid, studentid, visitorsname, visitdate) 
            VALUES ('$visitid', '$studentid', '$visitorsname', '$visitdate')";

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
            <h1>visitors</h1>
            <div class="div_deg">
                <form action="#" method="POST">
                    <div>
                        <label>visitid</label>
                        <input type="text" name="visitid" required>
                    </div>
                    <div>
                        <label>studentid</label>
                        <input type="number" name="studentid" required>
                    </div>
                    <div>
                        <label>visitorsname</label>
                        <input type="text" name="visitorsname" required>
                    </div>
                    <div>
                        <label>visitdate</label>
                        <input type="text" name="visitdate" required>
                    </div>
                  
                    <div>
                        <input type="submit" class="btn btn-primary" name="visitors" value="add visitors">
                    </div>
                </form>
            </div>
        </center>
    </div>

</body>

</html>