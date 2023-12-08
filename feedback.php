<?php
session_start();
$page_title="Feedback";

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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $rating = $_POST["rate"];
    $feedback = $_POST["feedback"];
    $username = $_SESSION['username'];

    // Check if the user has existing feedback
    $sql = "SELECT * FROM feedback WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Update the existing feedback
        $sql = "UPDATE feedback SET rating = '$rating', feedback = '$feedback' WHERE username = '$username'";
    } else {
        // Insert new feedback
        $sql = "INSERT INTO feedback (username, rating, feedback) VALUES ('$username', '$rating', '$feedback')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Feedback saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch existing feedback data (if any)
$username = $_SESSION['username'];
$sql = "SELECT * FROM feedback WHERE username = '$username'";
$result = $conn->query($sql);

$existingRating = "";
$existingFeedback = "";

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $existingRating = $row["rating"];
    $existingFeedback = $row["feedback"];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($page_title)){ echo "$page_title"; } ?> - Typing Speed Test</title>
    <link rel="stylesheet" href="css/form.css">
    <style>
        .star-container{
            position: relative;
            width: 400px;
            padding: 20px 30px;
            border: 1px solid #555;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            box-shadow: 0 0 10px 0 #555;
        }
        .star-container .post{
            display:none;
        }
        .star-container .text{
            font-size:25px;
            color: indianred;
            font-weight: 500;
        }
        .star-container .edit{
            position: absolute;
            padding: 10px 20px;
            right:10px;
            top: 5px;
            text-decoration: none;
            border-radius: 4px;
            background: indianred;
            color: white;
            letter-spacing: 3px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.4s;
        }
        .star-container .edit:hover{
            background: transparent;
            border:1px solid indianred;
            color: black;
        }
        .star-container .star-widget input{
            display: none;
        }
        .star-widget label{
            font-size: 40px;
            color: #fff;
            padding: 10px;
            float: right;
            transition: all 0.2s ease;
        }
        input:not(:checked) ~ label:hover,
        input:not(:checked) ~ label:hover ~ label{
            color:#fd4;
        }
        .star-widget input:disabled ~ label {
            pointer-events: none; /* Prevent hover and click events */
        }
        input:checked ~ label{
            color: #fd4;
        }
        input#rate-5:checked ~ label{
            color: #fd4;
            text-shadow: 0 0 20px #952;
        }
        #rate-1:checked ~ form h3:before{
            content: "I just hate it";
        }
        #rate-2:checked ~ form h3:before{
            content: "I don't like it";
        }
        #rate-3:checked ~ form h3:before{
            content: "It is good";
        }
        #rate-4:checked ~ form h3:before{
            content: "I just like it";
        }
        #rate-5:checked ~ form h3:before{
            content: "It is awesome I just love it";
        }
        .star-container form{
            display: none;
        }
        input:checked ~ form{
            display: block;
        }
        form h3{
            width: 100%;
            font-size: 25px;
            color: #fe7;
            font-weight: 500;
            margin: 5px 0 20px 0;
            text-align: center;
            transition: all 0.2s ease;
        }
        form .textarea{
            height: 100px;
            width: 100%;
            overflow: hidden;
        }
        form .textarea textarea{
            outline: none;
            color: #eee;
            border: 1px solid #333;
            font-size: 13px;
            resize: none;
            background:none;
            border: 2px solid #555;
            border-radius: 5px;
            box-shadow: 0 0 10px 0 #555;
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="container">
            <div class="top-header">
                <header>Send us your feedback here</header>
            </div>
            
            <div class="star-container">
                <div class="post">
                    <div class="edit">Edit</div>
                </div>
                <div class="star-widget">
                    <input type="radio" name="rate" id="rate-5">
                    <label for="rate-5" class="fa fa-star"></label>
                    <input type="radio" name="rate" id="rate-4">
                    <label for="rate-4" class="fa fa-star"></label>
                    <input type="radio" name="rate" id="rate-3">
                    <label for="rate-3" class="fa fa-star"></label>
                    <input type="radio" name="rate" id="rate-2">
                    <label for="rate-2" class="fa fa-star"></label>
                    <input type="radio" name="rate" id="rate-1">
                    <label for="rate-1" class="fa fa-star"></label>

                    <form action="">
                        <h3></h3>
                        <div class="textarea">
                            <textarea name="feedback" id="" cols="43" rows="5" placeholder="Describe your experience. ." ></textarea>
                        </div>
                        <span>
                            <button class="submit" type="submit">Done</button>
                        </span>
                    </form>

                </div>
            </div>

        </div>
    <div>

        <script>
            const btn = document.querySelector("button");
            const post = document.querySelector(".post");
            const form = document.querySelector("form");
            const editBtn = document.querySelector(".edit");
            const header = document.querySelector("header");
            
            btn.onclick = ()=>{
                form.style.display = "none";
                post.style.display = "block";
                editBtn.onclick = ()=>{
                    form.style.display="block";
                    post.style.display="none";
                    // When editing, change the header back to its original text
                    header.textContent = "Send us your feedback here";
                    enableRating();
                }
                header.textContent = "Thanks for rating!";
                disableRating();
                return false;
            }

            function enableRating() {
            const ratingInputs = document.querySelectorAll(".star-widget input");
            const textArea = document.querySelector(".textarea textarea");
            const submitButton = document.querySelector(".submit");

            ratingInputs.forEach(input => {
                input.disabled = false;
            });

            textArea.disabled = false;
            submitButton.disabled = false;
        }

        function disableRating() {
            const ratingInputs = document.querySelectorAll(".star-widget input");
            const textArea = document.querySelector(".textarea textarea");
            const submitButton = document.querySelector(".submit");

            ratingInputs.forEach(input => {
                input.disabled = true;
            });

            textArea.disabled = true;
            submitButton.disabled = true;
        }
        </script>

</body>
</html>