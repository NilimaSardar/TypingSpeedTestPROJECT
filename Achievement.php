<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achievements</title>
    <style>
        *{
            box-sizing: border-box;
        }
        body{
            margin: 40px;
            font-family: 'Roboto', sans-serif;
        }
        .table_responsive{
            max-width: 900px;
            border: 1px solid #00bcd4;
            background-color: #efefef33;
            padding: 15px;
            overflow: auto;
            margin: auto;
            border-radius: 4px;
        }
        h1{
            text-transform: capitalize;
            margin-bottom: 30px;
            color: black;
            text-shadow: 1px 2px 3px #2980b9;
            font-size: 2.1rem;
            text-align: center;
        }
        table{
            width: 100%;
            font-size: 15px;
            color: #444;
            white-space: nowrap;
            border-collapse: collapse;
        }
        table>thead{
            background-color: #00bcd4;
            color: #fff;
        }
        table>thead th{
            padding: 15px;
        }
        table th,
        table td{
            border: 1px solid #00000017;
            padding: 10px 15px;
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
    <h1><?php echo $_SESSION['username']; ?>'s Achievements</h1>
    <br>
    <div class="table_responsive">
        <?php
        include 'connection.php';
        
        $username = $_SESSION['username'];
        
        // Check if the table exists
        $q = "SHOW TABLES LIKE 'game_data'";
        $tableExistsResult = mysqli_query($conn, $q);

        if ($tableExistsResult === false) {
            echo "<p>Error checking for table: " . mysqli_error($conn) . "</p>";
        } else {
            if (mysqli_num_rows($tableExistsResult) === 0) {
                echo "<p>No achievements available for $username.</p>";
            } else {
                $q = "SELECT * FROM game_data WHERE Username='$username'";
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
                    <td><?php if( $result['Lang']==1){
                                    echo "English";
                                }else{
                                    echo "Nepali";
                                }
                        ?>
                    </td>
                    <td><?php if($result['Level']==1 || $result['Level']==4){
                                    echo "Easy";
                                }elseif($result['Level']==2 || $result['Level']==5){
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