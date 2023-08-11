<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <h1><?php echo $_SESSION['username']; ?>'s Achievements</h1>
        <br>

        <table>
            <thead>
                <th>Game Played</th>
                <th>Speed(WPM)</th>
                <th>Correct Word</th>
                <th>Out Of</th>
                <th>Time Taken(sec)</th>
            </thead>
            <tbody id="response">
            <?php
            include 'connection.php';

            $q="select * from achievement";
            $query = mysqli_query($conn,$q);

            if(mysqli_num_rows($query)>0){
                while($result = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $result['Gameid'];?></td>
                        <td><?php echo $result['Speed'];?></td>
                        <td><?php echo $result['Correctword'];?></td>
                        <td><?php echo $result['Outof'];?></td>
                        <td><?php echo $result['TimeTaken'];?></td>
                    </tr>
                    <?php
                }
            }

            ?>
            </tbody>
        </table>
    </div>
</body>
</html>