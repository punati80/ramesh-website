<?php
session_start();
require('dbconn.php');

if (isset($_POST['signin'])) {
    $u = $_POST['RollNo'];
    $p = $_POST['Password'];
    $c = isset($_POST['BRANCH']) ? $_POST['BRANCH'] : '';

    $sql = "select * from LMS.user where RollNo='$u'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $x = $row['Password'];
    $y = $row['Type'];
    if (strcasecmp($x, $p) == 0 && !empty($u) && !empty($p)) {
        $_SESSION['RollNo'] = $u;

        if ($y == 'Admin') {
            header('location:admin/index.php');
            exit; // Add exit after header to prevent further execution
        } else {
            header('location:student/index.php');
            exit; // Add exit after header to prevent further execution
        }
    } else {
        echo "<script type='text/javascript'>alert('Failed to Login! Incorrect RollNo or Password')</script>";
    }
}

if (isset($_POST['signup'])) {
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $mobno = $_POST['PhoneNumber'];
    $rollno = $_POST['RollNo'];
    $BRANCH = isset($_POST['BRANCH']) ? $_POST['BRANCH'] : '';
    $type = 'Student';

    $sql = "insert into LMS.user (Name,Type,BRANCH,RollNo,EmailId,MobNo,Password) values ('$name','$type','$BRANCH','$rollno','$email','$mobno','$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>alert('Registration Successful')</script>";
    } else {
        echo "<script type='text/javascript'>alert('User Exists')</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Library Management System </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="Library Member Login Form Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <link href="//fonts.googleapis.com/css?family=Jasper:100,300,400,500,700,900" rel="stylesheet">

    <style>
        /* Add some styles for the rolling banner */
        #rolling-banner {
            overflow: hidden;
            white-space: nowrap;
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            font-size: 16px;
        }

        #rolling-text {
            display: inline-block;
            animation: roll 10s linear infinite;
        }

        @keyframes roll {
            from {
                transform: translateX(200%);
            }

            to {
                transform: translateX(-200%);
            }
        }

        /* Style for the header */
        h1 {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin: 0;
        }
    </style>

    <script>
        function updateTime() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();
            var day = now.getDate();
            var month = now.getMonth() + 1; // Month is zero-based
            var year = now.getFullYear();

            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            day = day < 10 ? '0' + day : day;
            month = month < 10 ? '0' + month : month;

            var timeString = hours + ':' + minutes + ':' + seconds;
            var dateString = day + '/' + month + '/' + year;

            document.getElementById('time').innerHTML = timeString;
            document.getElementById('date').innerHTML = dateString;
        }

        setInterval(updateTime, 1000);
    </script>

</head>

<body>

    <div id="rolling-banner">
        <div id="rolling-text">
            <p>Library Working Hours: 9 AM to 8:30 PM</p>
        </div>
    </div>

    <h1>LIBRARY MANAGEMENT SYSTEM</h1>

    <div id="datetime">
        <div id="time"></div>
        <div id="date"></div>
    </div>

    <div class="container">

        <div class="login">
            <h2>Sign In</h2>
            <form action="index.php" method="post">
                <input type="text" Name="RollNo" placeholder="RollNo" required="">
                <input type="password" Name="Password" placeholder="Password" required="">
                <div class="send-button">
                    <input type="submit" name="signin" value="Sign In">
                </div>
                <div class="clear"></div>
            </form>
        </div>

        <div class="register">
            <h2>Sign Up</h2>
            <form action="index.php" method="post">
                <input type="text" Name="Name" placeholder="Name" required>
                <input type="email" name="Email" placeholder="Email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Please enter a valid email address">
                <input type="password" Name="Password" placeholder="Password" required>
                <input type="text" Name="PhoneNumber" placeholder="Phone Number" required pattern="[0-9]{10}" title="Please enter a valid 10-digit phone number">
                <input type="text" Name="RollNo" placeholder="Roll Number" required="">
                <label for="BRANCH">Branch:</label>
                <select name="BRANCH" id="BRANCH">
                    <option value="CSE">CSE</option>
                    <option value="ECE">ECE</option>
                    <option value="EEE">EEE</option>
                    <option value="FT">FT</option>
                    <option value="OTHER">OTHER</option>
                </select>
                <br>
                <br>
                <div class="send-button">
                    <input type="submit" name="signup" value="Sign Up">
                </div>
                <div class="clear"></div>
            </form>
        </div>

        <div class="clear"></div>

    </div>

    <div class="footer w3layouts agileits">
        <p> &copy; 2024 Library Member Login by RAMESH. All Rights Reserved </p>
    </div>

    <?php
    if (isset($_POST['signin'])) {
        $u = $_POST['RollNo'];
        $p = $_POST['Password'];
        $c = $_POST['BRANCH'];

        $sql = "select * from LMS.user where RollNo='$u'";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $x = $row['Password'];
        $y = $row['Type'];
        if (strcasecmp($x, $p) == 0 && !empty($u) && !empty($p)) {
            $_SESSION['RollNo'] = $u;

            if ($y == 'Admin')
                header('location:admin/index.php');
            else
                header('location:student/index.php');
        } else {
            echo "<script type='text/javascript'>alert('Failed to Login! Incorrect RollNo or Password')</script>";
        }
    }

    if (isset($_POST['signup'])) {
        $name = $_POST['Name'];
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $mobno = $_POST['PhoneNumber'];
        $rollno = $_POST['RollNo'];
        $BRANCH = $_POST['BRANCH'];
        $type = 'Student';

        $sql = "insert into LMS.user (Name,Type,BRANCH,RollNo,EmailId,MobNo,Password) values ('$name','$type','$BRANCH','$rollno','$email','$mobno','$password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Registration Successful')</script>";
        } else {
            echo "<script type='text/javascript'>alert('User Exists')</script>";
        }
    }
    ?>

</body>
<!-- //Body -->

</html>
