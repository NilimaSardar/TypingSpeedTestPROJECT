<?php
session_start();
$page_title="Achievements";

if(!isset($_SESSION['username'])){
    ?>
        <script>
            alert('You are logged out');
            window.location = 'login.php';
        </script>
    <?php
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($page_title)){ echo "$page_title"; } ?> - Typing Speed Test</title>
    <link rel="stylesheet" href="css/index.css">
    <style>
        .table{
            max-width: 1000px;
            /* border: 1px solid #00bcd4; */
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            padding: 10px;
            overflow: auto;
            margin: auto;
            border-radius: 7px;
        }
        h1{
            font-size: 4rem;
            font-weight: 700;
            text-transform: capitalize;
            margin:30px 0 30px 0;
            color: #1A1A40;
            font-size: 3.8rem;
            text-align: center;
        }
        table{
            width: 100%;
            font-size: 20px;
            white-space: nowrap;
            border-collapse: collapse;
            table-layout: fixed;
        }
        table>thead{
            background-color: indianred;
            color: #fff;
            border: 1px solid #00000017;
        }
        table>thead th{
            padding: 15px 20px 15px 0;
        }
        table th,
        table td{
            border: 1px solid #00000017;
            padding: 10px 40px;
        }
        table>tbody>tr{
            background-color: #fff;
            transition: 0.3s ease-in-out;
        }

        table>tbody>tr:nth-child(even){
            background-color: rgb(238, 238, 238);
        }

        table>tbody>tr:hover{
            filter: drop-shadow(0px 2px 6px #0002);
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
                <a href="Achievement.php" class="active">Achievements</a>
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
    <h1><?php echo $_SESSION['username']; ?>'s Achievements</h1>
    <br>
    <div class="table">
        <?php
        include 'connection.php';
        
        $username = $_SESSION['username'];
        
        // Check if the table exists
        $q = "SHOW TABLES LIKE 'test_data'";
        $tableExistsResult = mysqli_query($conn, $q);

        if ($tableExistsResult === false) {
            echo "<p>Error checking for table: " . mysqli_error($conn) . "</p>";
        } else {
            if (mysqli_num_rows($tableExistsResult) === 0) {
                echo "<p>No achievements available for $username.</p>";
            } else {
                $q = "SELECT * FROM test_data WHERE Username='$username'";
                $query = mysqli_query($conn, $q);

                if ($query === false) {
                    echo "<p>Error retrieving achievements for $username: " . mysqli_error($conn) . "</p>";
                } elseif (mysqli_num_rows($query) > 0) {
        ?>
        <table>
            <thead>
                <th>Game Played</th>
                <th>Speed(WPM)</th>
                <th>Correct Word</th>
                <th>Out Of</th>
                <th>Time Taken(sec)</th>
                <th>Language</th>
                <th>Level</th>
            </thead>
            <tbody id="response">
            <?php
                    $gameCounter = 1;
                    while ($result = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?php echo $gameCounter . "."; ?></td>
                    <td><?php echo $result['Speed']; ?></td>
                    <td><?php echo $result['Correctword']; ?></td>
                    <td><?php echo $result['Outof']; ?></td>
                    <td><?php echo $result['TimeTaken']; ?></td>
                    <td><?php if( $result['Langid']==1){
                                    echo "English";
                                }else{
                                    echo "Nepali";
                                }
                        ?>
                    </td>
                    <td><?php if($result['Levelid']==1 || $result['Levelid']==4){
                                    echo "Easy";
                                }elseif($result['Levelid']==2 || $result['Levelid']==5){
                                    echo "Medium";
                                }else{
                                    echo "Hard";
                                }
                        ?>
                    </td>
                </tr>
            <?php
                    $gameCounter++;
                    }
            ?>
            </tbody>
        </table>
        <?php
                } else {
                    echo "<p>No achievements found for $username.</p>";
                }
            }
        }
        ?>
    </div>
</body>
</html>