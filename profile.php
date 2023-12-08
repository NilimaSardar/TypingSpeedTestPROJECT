<?php
session_start();
$page_title="Profile";

if(!isset($_SESSION['username'])){
    ?>
        <script>
            alert('You are logged out');
            window.location = 'login.php';
        </script>
    <?php
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
    <title><?php if(isset($page_title)){ echo "$page_title"; } ?> - Typing Speed Test</title>
    <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" 
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" 
        crossorigin="anonymous" 
        referrerpolicy="no-referrer" 
    />
    <link rel="stylesheet" href="css/index.css">
    <style>
        html{
    font-size: 62.5%;
    /* 1rem=10px */
}
        .section-yourprofile{
    width:100%;
    height: 60vh;
    positive:relative;
}
.section-profile{
    position: absolute;
    padding: 12rem 0 8rem 30rem;
}
.section-common-subheading{
    color: #f3eeea;
    & span{
       color: #15133C;
       font-weight: 500;
    }
}

.section-chart{
    position: relative;
    width: 100%;
    height: 60vh;
}

#chartContainer{
height: 370px; 
width: 70%;
padding-left: 30rem;
}
.section-performance{
    width: 100%;
    height: 70vh;

    & .section-profile{
    position: absolute;
    padding: 4rem 0 8rem 30rem;
}
    
    & .section-performance--content{
        margin-bottom: 4rem;
    }

    & .delete{
        display: flex;
        flex-direction: column;

        & .login_reg{
            padding-bottom: 3.3rem;
        }
    }
}
    </style>
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
    <!-- NAVBAR Section -->
    <header>
        <nav>
            <div class="logo">
                Typing-test
            </div>
            <div class="menu">
                <a href="typingTest.php">Test</a>
                <a href="profile.php" class="active">My Profile</a>
                <a href="Achievement.php">Achievements</a>
                <a href="time_spent.php">Time Spent</a>
            </div>
            <div class="register">
                <div class="login_reg">
                    <a href="editprofile.php">Edit Profile</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Ends NAVBAR Section -->
        <div class="section-yourprofile">
            <div class="section-profile">
                <h1 class="section-common-heading">
                    YOUR PROFILE
                </h1>
                <div>
                    <p class="section-common-subheading"><span>Full Name: </span><?php echo $fullname; ?></p>
                    <p class="section-common-subheading"><span>Username: </span><?php echo $username; ?></p>
                    <p class="section-common-subheading"><span>Email: </span><?php echo $email; ?></p><br>
                </div>
            </div>
        </div>

      
            <?php
            // Check if the table exists
            $q = "SELECT * FROM test_data WHERE Username='$username'";
            $tableExistsResult = mysqli_query($conn, $q);
            if (mysqli_num_rows($tableExistsResult) > 0) {
            ?>
                <div id="chartContainer"></div>
            <?php
            }
            ?>
      

        <div class="section-performance">
        <div class="section-profile">
            <h1 class="section-common-heading">
                Typing Performance
            </h1>

            <div class="section-performance--content">
                <p class="section-common-subheading"><span>Tests Taken:</span> <?php echo $data['test_taken']; ?></p>
                <?php
                if ($tableExistsResult === false || mysqli_num_rows($tableExistsResult) === 0) {
                ?>
                    <p class="section-common-subheading"><span>Average Typing Speed (WPM):</span> <?php echo "0"; ?></p>
                    <p class="section-common-subheading"><span>Average Time taken to complete (sec):</span> <?php echo "0"; ?></p>
                <?php
                } else {
                    // Round the average speed and average time to 2 decimal places
                   $roundedAvgSpeed = round($data['avg_speed'], 2);
                   $roundedAvgTime = round($data['avg_time'], 2);
                ?>
                    <p class="section-common-subheading"><span>Average Typing Speed (WPM):</span> <?php echo $roundedAvgSpeed; ?> WPM</p>
                    <p class="section-common-subheading"><span>Average Time taken to complete (sec):</span> <?php echo $roundedAvgTime; ?> sec</p>
                <?php
                }
                ?>
            </div>
            <div class="delete">
                <div class="login_reg">
                    <a href="dltaccount.php">Delete Account</a><br>
                </div>
                <div class="login_reg">
                    <a href="removeRecords.php">Remove all previous records</a>
                </div>
            </div>
        </div>     
        </div>
    <!-- Footer Section -->
    <footer class="shiftFooter" data-aos="fade-up" data-aos-delay="300">
        <div class="footerContainer">
            <div class="socialIcons">
                <a href="https://www.facebook.com/neelima.sardar.792"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                <a href="https://instagram.com/______nilima____?igshid=NGVhN2U2NjQ0Yg=="><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="https://www.linkedin.com/in/nilima-sardar-8416b0283/"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                <a href="https://github.com/NilimaSardar"><i class="fa fa-github-square" aria-hidden="true"></i></a>
            </div>
            <div class="footerNav">
                <p class="copyright">Copyright &copy;2023; Designed by <span class="designer">Nilima & Archana</span></p>
            </div>
        </div>
    </footer>
    <!-- End Footer Section -->
</body>
</html>
