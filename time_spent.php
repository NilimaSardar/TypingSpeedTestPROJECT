<?php

session_start();
$page_title="Time Spent";

if(!isset($_SESSION['username'])){
    ?>
        <script>
            alert('You are logged out');
            window.location = 'login.php';
        </script>
    <?php
}

include 'links.php';
include 'connection.php';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Calculate the start and end dates for the past week
    $endDate = date('Y-m-d');
    $startDate = date('Y-m-d', strtotime('-6 days', strtotime($endDate)));

    // Create an array for all days of the week
    $daysOfWeek = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

    // Retrieve the daily app usage for the past week
    $getUsageQuery = "SELECT DATE(login_time) AS login_date, SUM(daily_usage) AS daily_usage
                     FROM user_activity
                     WHERE username = '$username' AND DATE(login_time) BETWEEN '$startDate' AND '$endDate'
                     GROUP BY login_date
                     ORDER BY login_date";
    $result = mysqli_query($conn, $getUsageQuery);

    $dataPoints = array();

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $loginDate = $row['login_date'];
            $dailyUsage = $row['daily_usage'];

            // Get the day of the week for the login date
            $dayOfWeek = date('l', strtotime($loginDate));

            // Convert daily usage time to either seconds or minutes
            if ($dailyUsage < 60) {
                $usageValue = $dailyUsage . " sec";
            } elseif($dailyUsage>60 && $dailyUsage<3600) {
                $minutes = floor($dailyUsage / 60);
                $seconds = $dailyUsage % 60;
                $usageValue = $minutes . 'min'. $seconds . 'sec';
            }else{
                $hours = floor($dailyUsage / 3600);
                $minutes = floor(($dailyUsage - ($hours * 3600)) / 60);
                $usageValue = $hours . 'hr ' . $minutes . 'min';
            }

            // Add the data to the dataPoints array
            $dataPoints[] = array("y" => $dailyUsage, "label" => $dayOfWeek, "usageValue" => $usageValue);
        }
    }

    // Fill in missing days with a count of 0
    foreach ($daysOfWeek as $day) {
        $found = false;
        foreach ($dataPoints as $dataPoint) {
            if ($dataPoint['label'] === $day) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            $dataPoints[] = array("y" => 0, "label" => $day, "usageValue" => "0 sec");
        }
    }

    // Sort the dataPoints by day of the week
    usort($dataPoints, function ($a, $b) use ($daysOfWeek) {
        return array_search($a['label'], $daysOfWeek) - array_search($b['label'], $daysOfWeek);
    });

} else {
    echo "User is not logged in.";
}

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php if(isset($page_title)){ echo "$page_title"; } ?> - Typing Speed Test</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="css/index.css">
    <script src="JQuery.js"></script>
    <style>
        /* body{
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: "Roboto", sans-serif;
        background: #366a8d;
        } */
        .box{
            display:flex;
            justify-content: center;
            align-items: center;
            min-height: 85vh;
        }
        .container{
            width: 400px;
            display: flex;
            flex-direction: column;
            padding: 0 15px 0 15px;
        }
        .top-header h1{
            color: #fff;
            letter-spacing: 3.5px;
            font-size: 40px;
            font-weight: 600;
            display: flex;
            justify-content: center;
            padding: 10px 0 10px 0;
        }

        .chart{
        width: 600px;
        height: 300px;
        display: block;
        }

        .bars{
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        background: #366a8d;
        margin: 0;
        display: inline-block;
        width: 500px;
        height: 300px;
        border-radius: 5px;
        }

        .bars li{
        display: table-cell;
        width: 100px;
        height: 300px;
        position: relative;
        }

        .bars span{
        width: 100%;
        position: absolute;
        bottom: -30px;
        text-align: center;
        left: -55px;
        font-size: 14px;
        }

        .bars .bar{
        display: block;
        background: indianred;
        width: 60px;
        margin:10px;
        right: 50px;
        position: absolute;
        bottom: 0;
        border-radius: 4px;
        margin-left: 25px;
        text-align: center;
        transition: 0.5s;
        }

        .bars .bar:hover{
        background: #55EFC4;
        box-shadow: 0 0 10px 0 rgba(85, 239, 196, 0.5);
        cursor: pointer;
        }

        .bars .bar:before{
        color: #fff;
        content: attr(data-percentage);
        position: relative;
        bottom: 20px;
        opacity: 0;
        transition: opacity 0.3s;
        }

        .bars .bar:hover:before{
            opacity:1;
        }
    </style>
  </head>
  <body>
<!-- NAVBAR Section -->
<header>
        <nav>
            <div class="logo">
                Typing-test
            </div>
            <div class="menu">
                <a href="typingTest.php">Test</a>
                <a href="profile.php">My Profile</a>
                <a href="Achievement.php">Achievements</a>
                <a href="time_spent.php" class="active">Time Spent</a>
            </div>
            <div class="register">
                <div class="login_reg">
                    <a href="editprofile.php">Edit Profile</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Ends NAVBAR Section -->
  <div class="box">
        <div class="container">
            <div class="top-header">
                <h1>Time on Typing Speed Test</h1>
            </div>
            
            <div class="chart">
                <ul class="bars">
                    <?php foreach ($dataPoints as $dataPoint) : ?>
                        <li>
                            <div class="bar" style="height: <?php echo min($dataPoint['y'] / 10, 295); ?>px;" data-percentage="<?php echo $dataPoint['usageValue']; ?>"></div>
                            <span><?php echo $dataPoint['label']; ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

  </body>
</html>