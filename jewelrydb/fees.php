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

if (isset($_POST['fees'])) {
    $feesid = mysqli_real_escape_string($data, $_POST['feesid']);
    $studentid = mysqli_real_escape_string($data, $_POST['studentid']);
    $amount = mysqli_real_escape_string($data, $_POST['amount']);
    $paymentdate = mysqli_real_escape_string($data, $_POST['paymentdate']);
    
    $sql = "INSERT INTO fees (feesid, studentid, amount, paymentdate) 
            VALUES ('$feesid', '$studentid', '$amount', '$paymentdate')";

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
            <h1>Fees</h1>
            <div class="div_deg">
                <form action="#" method="POST">
                    <div>
                        <label>feesid</label>
                        <input type="text" name="feesid" required>
                    </div>
                    <div>
                        <label>studentid</label>
                        <input type="number" name="studentid" required>
                    </div>
                    <div>
                        <label>amount</label>
                        <input type="number" name="amount" required>
                    </div>
                    <div>
                        <label>paymentdate</label>
                        <input type="text" name="paymentdate" required>
                    </div>
                  
                    <div>
                        <input type="submit" class="btn btn-primary" name="fees" value="add fees">
                    </div>
                </form>
            </div>
        </center>
    </div>

</body>

</html>