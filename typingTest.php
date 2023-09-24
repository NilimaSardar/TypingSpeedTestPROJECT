<?php
session_start();

if(!isset($_SESSION['username'])){
    echo "you are logged out";
    header('location:index.php');
}

include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="JQuery.js"></script>
    <style>
        body{
            font-family:  'Roboyo', sans-serif;
        }
        *{
            margin: 0;
            padding: 0;
            list-style: none;
            text-decoration: none;
        }
        
        .mainDiv{
            width: 100%;
            height: 100vh;
            position: relative;
            background: #366a8d;
        }

        .centerDiv{
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 2;
        }

        h1{
            text-transform: capitalize;
            margin-bottom: 30px;
            color: #ecf0f1;
            text-shadow: 1px 2px 3px #2980b9;
            font-size: 2.1rem;
        }

        h2{
            text-align: center;
        }

        textarea{
            background-color: #444;
            box-shadow: 0 0 1px rgba(0,0,0,0.2);
            border-radius: 10px 10px 0 0;
            border: 20px solid #34495e;
            color: white;
            font-size: 1.3rem;
        }

        .mainbtn{
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            font-size: 20px;
            background: indianred;
            cursor: pointer;
            border-radius: 8px;
            transition: 0.4s;
        }
        .mainbtn:hover{
            background: transparent;
            border:1px solid indianred;
            color: black;
        }
        .timer-div{
            width:100%;
            text-align: right;
            display: flex;
            justify-content: flex-end;
        }
        #show-time{
            font-size: 1.5rem;
            color: white;
            padding: 1.3rem;
            text-align: right;
            width: 3rem;
            height: 3rem;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            border: .3rem solid indianred;
        }
        .menu-container {
            position: fixed;
            top: 20px;
            left: 20px;
            width: 30px;
            height: 30px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            z-index: 999 ;
        }
        .menu-container.hidden{
            display: none;
        }
        .menu-container .bar{
            font-size: 30px;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 0;
            background: #3f5560;
            overflow: hidden;
            transition: height 0.5s ease;
            z-index: 998;
        }
        .sidebar.show {
            height: calc(50vh - 40px);
        }
        .sidebar ul {
            list-style: none;
            padding: 20px;
            margin: 0;
        }
        .sidebar ul li {
            margin-bottom: 20px;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 997;
        }
        .sidebar.show ~ .overlay {
            display: block;
        }

        .nav-bar {
            position: absolute;
            top: 20px;
            right: 70px; 
            display: flex;
            align-items: center;
            gap: 20px;
            z-index: 1;
        }

        .nav-item {
            display: flex;
            align-items: center;
            color: white;
            font-size: 18px;
        }

        .nav-item span {
            margin-right: 10px;
        }

    </style>
</head>
<body>
<div class="mainDiv">

<div class="menu-container" id="menuContainer" onclick="toggleSidebar()">
        <i class="fa fa-bars bar"></i>
    </div>
    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">My Profile</a></li>
            <li><a href="#">Task</a></li>
            <li><a href="Achievement.php">Achievements</a></li>
            <li><a href="#">Feedback</a></li>
            <li><a href="#">Setting</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="overlay" onclick="toggleSidebar()"></div>
    <script>
        var menuContainer = document.getElementById("menuContainer");

        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            var overlay = document.querySelector(".overlay");
            sidebar.classList.toggle("show");
            overlay.style.display = sidebar.classList.contains("show") ? "block" : "none";

            menuContainer.classList.toggle("hidden",sidebar.classList.contains("show"));
        }
    </script>
        <div class="centerDiv">
            <h1>Welcome To Typing Speed Test <?php echo $_SESSION['username']; ?></h1>

            <div class="timer-div">
                <p id="show-time"></p>
            </div>

            <h2 id="msz"></h2>
            <h2 id="score"></h2>
            <br>
            <textarea id="myWords" cols="80" rows="10" placeholder="Remember, be nice!" disabled></textarea>
            <br>
            <button id="btn" class="mainbtn">Start</button>
        </div>

        <?php
        include 'footer1.php';
        ?>
    </div>
</div>
<div class="nav-bar">
    <div class="nav-item">
        <span>Language:</span>
        <select id="languageSelect" onchange="updateLevel(this.value)">
            <option>Select Any one</option>
                        <?php
                        $q="select * from language";
                        $result = mysqli_query($conn,$q);
                        while($rows = mysqli_fetch_array($result)){
                            ?>
                            <option value="<?php echo $rows['Langid']; ?>"><?php echo $rows['language']; ?></option>
                            <?php
                        }
                        ?>
        </select>
    </div>
    <div class="nav-item">
        <span>Level:</span>
        <select id="levelSelect" onchange="updateSentences()">
            <option value="">Select Any one</option>
        </select>
    </div>
</div>
    <script type="text/javascript">
        //STEP 1
        // selecting the neccessary elements using their respective
        // ids and creating variables to store the start Time,
        // end time and total timeTaken.

        const typing_ground = document.getElementById("myWords");
        const btn =document.getElementById("btn");
        const score = document.getElementById("score");
        const showSentence = document.getElementById("msz");
        const showTime = document.getElementById("show-time");
        //const showTime = document.querySelector('#show-time');

        let startTime, endTime, totalTimeTaken, sentence_to_write;

        function updateLevel(selectedLang) {
            $.ajax({
                url: 'get_levels.php',
                type: 'POST',
                data: { lang: selectedLang },
                dataType: 'json', // Set expected data type to JSON
                success: function(response) {
                    console.log(response);
                    $('#levelSelect').html(""); // Clear previous options
                    $('#levelSelect').append($('<option>', {
                        value: "", // Adding an empty option as the default
                        text: "Select Any one"
                    }));
                    // Append new options
                    $.each(response, function(key, value) {
                        $('#levelSelect').append($('<option>', {
                            value: value.id,
                            text: value.level
                        }));
                    });
                }
            });
        }

        let sentences = [];

        function updateSentences() {
            const selectedLang = $('#languageSelect').val();
            const selectedLevel = $('#levelSelect').val();

            $.ajax({
                url: 'get_sentences.php',
                type: 'POST',
                data: { lang: selectedLang, level: selectedLevel },
                dataType: 'JSON', //Expect JSON response

                success: function(response) {
                    console.log("Sentences received:", response);
                    sentences = response;
                },
                error: function(xhr, status, error) {
                    console.log("AJAX request failed");
                    console.log("Error:", error);
                }
            });
        }
        
        //STEP 7
        const errorChecking = (words) => {
            console.log(words);

            let num = 0;
            sentence_to_write = showSentence.innerHTML;
            sentence_to_write = sentence_to_write.trim().split(" ");
            //console.log(sentence_to_write);

            for(let i=0; i<words.length;i++){
                if(words[i] === sentence_to_write[i]){
                    num++;
                }
            }
            return num;
        }

        //STEP 5
        //Defining a function calculateTypingSpeed to calculate the typing 
        //speed.Get the value of the textarea,remove any leading or trailing 
        //white spaces,split the text into an array of words, and calculate 
        //the number of words. If the number of words is not 0,calculate the 
        //typing speed and display it in the score div. Otherwise, display 0 
        //as the typing speed.

        const calculateTypingSpeed = (totalTimeTaken) =>{
            let totalWords = typing_ground.value.trim();
            let actualWords = totalWords === '' ? 0 : totalWords.split(" ");

            //errorChecking
            actualWords = errorChecking(actualWords);

            let typing_speed = (actualWords/totalTimeTaken)*60;
                typing_speed = Math.round(typing_speed);
                sentence_to_write = sentence_to_write.length;

            if(actualWords !== 0){
                score.innerHTML = `Your typing speed is ${typing_speed} words per minutes & you wrote ${actualWords} correct words out of ${sentence_to_write} & time taken ${totalTimeTaken} sec`;
            }else{
                score.innerHTML = `Your typing speed is 0 words per minutes & TIME TAKEN ${totalTimeTaken}  sec`;
            }

            //Storing all records into database
            $.ajax({
                url:'StoringValueajax.php',
                method: 'post',
                data:{
                    speed:typing_speed,
                    correct_Word:actualWords,
                    Outof:sentence_to_write,
                    totaltime:totalTimeTaken,
                },
                success: function(response){
                    console.log(response);
                }
            });  

        }


        //STEP 4
        //Definning a function endTypingTest to run when the user clicks the
        //"Done"button. In this function,get the end time, calculate the 
        //totalTimeTaken, call the calculateTypingSpeed Function, clear the 
        //showSentence div and the textarea.

        const endTypingTest = () =>{
            btn.innerText = "Start";
            //adding Timer
            showTimer();

            let date = new Date();
            endTime = date.getTime();

            totalTimeTaken = (endTime-startTime) / 1000;
            //console.log(totalTimeTaken);

            calculateTypingSpeed(totalTimeTaken);

            showSentence.innerHTML = "";
            typing_ground.value = "";
            
        }
        //STEP 6
        let intervalID, elapsedTime = 0;

        const showTimer = () =>{
            if(btn.innerText==="Done"){
                intervalID = setInterval(() =>{
                    elapsedTime++;
                    showTime.innerHTML = elapsedTime;
                },1000)
            }else if(btn.innerText==="Start"){
                elapsedTime = 0;
                clearInterval(intervalID);
                showTime.innerHTML = "";
            }
        }

        //STEP 3
        //Defining a function startTypingTest to generate a random sentence
        //from an array of sentences, show the sentence in the show_sentence
        //div. get the startime and change the button text to "Done".

        const startTypingTest = () =>{
            let randomNumber = Math.floor(Math.random()*sentences.length);
            //console.log(randomNumber);
            showSentence.innerHTML = sentences[randomNumber].sentence;

            let date = new Date();
            startTime = date.getTime();

            btn.innerText = "Done";
            score.innerHTML = "";

            //adding Timer
            showTimer();
        }

        // Attaching a keydown event listener to the textarea
        typing_ground.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent default Enter key behavior
                if (btn.innerText.toLowerCase() === "done") {
                    endTypingTest();
                } else if (btn.innerText.toLowerCase() === "start") {
                    startTypingTest();
                }
            }
        });

        //STEP 2
        //Attaching a click eventlistener to the button.
        //When the user clicks the button,check if the text is
        //"Start" or "Done".
        //if it is "Start", enable the textarea and call the 
        //startTypingTest function. If it is "Done",disable the 
        //textarea and call the endTypingTest function.

        btn.addEventListener('click',() =>{
            switch(btn.innerText.toLowerCase()){
                case "start":
                    typing_ground.removeAttribute('disabled');
                    startTypingTest();
                    break;

                case "done":
                    typing_ground.setAttribute('disabled','true');
                    endTypingTest();
                    break;
            }
        })

        //To show the data from database on clicking Achievement
        $(document).ready(function(){
            $('#display_achievements').click(function(){
                $.ajax({
                    url: 'Achievement.php',
                    type: 'post',

                    success:function(responsedata){
                        console.log(responsedata);
                    }
                });
            });
        });
    </script>
</body>
</html>