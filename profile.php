<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo "You are logged out.";
    header('Location: index.php');
    exit;
}

include 'connection.php';

// Fetch user data from session
$username = $_SESSION['username'];
$fullname = $_SESSION['fullname'];
$email = $_SESSION['email'];

$test = array();

$count = 0;
$q = "SELECT Speed, TimeTaken FROM test_data WHERE Username='$username'";
$res = mysqli_query($conn, $q);
while ($row = mysqli_fetch_array($res)) {
    $test[$count]["label"] = $row["TimeTaken"];
    $test[$count]["y"] = $row["Speed"];
    $count = $count + 1;
}

$showquery = "SELECT * FROM registration WHERE username='$username'";
$showdata = mysqli_query($conn, $showquery);

$arrdata = mysqli_fetch_array($showdata);

$queryavg = "SELECT COUNT(*) AS test_taken, AVG(Speed) AS avg_speed, AVG(TimeTaken) AS avg_time 
              FROM test_data WHERE Username='$username'";

$showavg = mysqli_query($conn, $queryavg);
$data = mysqli_fetch_array($showavg);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script>
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Performance Over Time Chart"
                },
                axisX: {
                    title: "TimeTaken in sec",
                    crosshair: {
                        enabled: true,
                        snapToDataPoint: true
                    }
                },
                axisY: {
                    title: "Speed(WPM)",
                    includeZero: true,
                    crosshair: {
                        enabled: true,
                        snapToDataPoint: true
                    }
                },
                toolTip: {
                    enabled: false
                },
                data: [{
                    type: "area",
                    dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        }
    </script>
</head>
<body>
    <h1>YOUR PROFILE</h1>
    <div>
        <p><span>Full Name: </span><?php echo $fullname; ?></p>
        <p><span>Username: </span><?php echo $username; ?></p>
        <p><span>Email: </span><?php echo $email; ?></p><br>
        <a href="editprofile.php" class="edit">Edit Profile</a>
    </div>
    <?php
    // Check if the table exists
    $q = "SELECT * FROM test_data WHERE Username='$username'";
    $tableExistsResult = mysqli_query($conn, $q);
    if (mysqli_num_rows($tableExistsResult) > 0) {
    ?>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <?php
    }
    ?>
    <div>
        <h2>Typing Performance</h2>
        <p><strong>Tests Taken:</strong> <?php echo $data['test_taken']; ?></p>
        <?php
        if ($tableExistsResult === false || mysqli_num_rows($tableExistsResult) === 0) {
        ?>
            <p><strong>Average Typing Speed (WPM):</strong> <?php echo "0"; ?></p>
            <p><strong>Average Time taken to complete (sec):</strong> <?php echo "0"; ?></p>
        <?php
        } else {
        ?>
            <p><strong>Average Typing Speed (WPM):</strong> <?php echo $data['avg_speed']; ?></p>
            <p><strong>Average Time taken to complete (sec):</strong> <?php echo $data['avg_time']; ?></p>
        <?php
        }
        ?>
    </div>
    <div>
        <a href="dltaccount.php">Delete Account</a><br>
        <a href="removeRecords.php">Remove all previous records</a>
    </div>
</body>
</html>
