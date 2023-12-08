<?php
session_start();
$page_title="";

if(!isset($_SESSION['username'])){
    ?>
        <script>
            alert('You are logged out');
            window.location = 'login.php';
        </script>
    <?php
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
    <link rel="stylesheet" href="css/typingTest.css">
</head>
<body>
    <div class="container">
        <div class="head-of-page">

            <div class="menu-container hidden-element" id="menuContainer" onclick="toggleSidebar()">
                <i class="fa fa-bars bar"></i>
            </div>
            <div class="sidebar" id="sidebar">
                <ul>
                    <li>MENU</li>
                    <li><a href="profile.php"><i class="fa fa-user"></i>My Profile</a></li>
                    <li><a href="Achievement.php"><i class="fa fa-trophy"></i>Achievements</a></li>
                    <li><a href="feedback.php"><i class="fa fa-"><i class="fa fa-comment"></i>Feedback</a></li>
                    <li><a href="time_spent.php"><i class="fa fa-bar-chart"></i>Time Spent</a></li>
                    <li><a href="about.php"><i class="fa fa-question-circle"></i>About</a></li>
                    <li><a href="how_to.php"><i class="fa fa-spinner"></i>How to</a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
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


            <div class="heading">
            <h1>Welcome To Typing Speed Test</h1>
            </div>

            <div class="select-item">
                <div class="item">
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
                <div class="item">
                    <span>Level:</span>
                    <select id="levelSelect" onchange="updateSentences()">
                        <option value="">Select Any one</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="main-body">
            <div class="sentence">

                <div class="message">
                    <div class="showing-msz">
                        <h2 id="msz">Select Language and Level and click on start</h2>
                    </div>
                    <div class="timer-div">
                        <p id="show-time"></p>
                    </div>
                </div>

                <div class="showing-score">
                    <h2 id="score"></h2>
                </div>

            </div>

            <div class="actual-body">
                <div class="textarea">
                    <textarea id="myWords" cols="50" rows="3" placeholder="Remember, be nice!" disabled></textarea>
                </div>

                <div class="keyboard">
                    <ul class="row row-0">
                        <li class="pinky" id="backtick">`</li>
                        <li class="pinky" id="1">1</li>
                        <li class="ring" id="2">2</li>
                        <li class="middle" id="3">3</li>
                        <li class="pointer1st" id="4">4</li>
                        <li class="pointer2nd" id="5">5</li>
                        <li class="pointer2nd" id="6">6</li>
                        <li class="pointer1st" id="7">7</li>
                        <li class="middle" id="8">8</li>
                        <li class="ring" id="9">9</li>
                        <li class="pinky" id="10">0</li>
                        <li class="pinky" id="sub">-</li>
                        <li class="pinky" id="add">+</li>
                        <li class="pinky" id="back">backspace</li>
                    </ul>
                    <ul class="row row-1">
                        <li class="pinky" id="tab">tab</li>
                        <li class="pinky" id="Q">Q</li>
                        <li class="ring" id="W">W</li>
                        <li class="middle" id="E">E</li>
                        <li class="pointer1st" id="R">R</li>
                        <li class="pointer2nd" id="T">T</li>
                        <li class="pointer2nd" id="Y">Y</li>
                        <li class="pointer1st" id="U">U</li>
                        <li class="middle" id="I">I</li>
                        <li class="ring" id="O">O</li>
                        <li class="pinky" id="P">P</li>
                        <li class="pinky" id="open-bracket">[</li>
                        <li class="pinky" id="close-bracket">]</li>
                        <li class="pinky" id="slash">\</li>
                    </ul>
                    <ul class="row row-2">
                        <li class="pinky" id="caps">caps lock</li>
                        <li class="pinky" id="A">A</li>
                        <li class="ring" id="S">S</li>
                        <li class="middle" id="D">D</li>
                        <li class="pointer1st" id="F">F</li>
                        <li class="pointer2nd" id="G">G</li>
                        <li class="pointer2nd" id="H">H</li>
                        <li class="pointer1st" id="J">J</li>
                        <li class="middle" id="K">K</li>
                        <li class="ring" id="L">L</li>
                        <li class="pinky" id="colon">:</li>
                        <li class="pinky" id="colon2">"</li>
                        <li class="pinky" id="enter">enter</li>
                    </ul>
                    <ul class="row row-3">
                        <li class="pinky" id="left-shift">shift</li>
                        <li class="pinky" id="Z">Z</li>
                        <li class="ring" id="X">X</li>
                        <li class="middle" id="C">C</li>
                        <li class="pointer1st" id="V">V</li>
                        <li class="pointer2nd" id="B">B</li>
                        <li class="pointer2nd" id="N">N</li>
                        <li class="pointer1st" id="M">M</li>
                        <li class="middle" id="coma">,</li>
                        <li class="ring" id="dot">.</li>
                        <li class="pinky" id="semi-colon">;</li>
                        <li class="pinky" id="right-shift">shift</li>
                    </ul>
                    <ul class="row row-4">
                        <li class="pinky" id="ctrl">ctrl</li>
                        <li class="ring" id="win">win</li>
                        <li class="middle" id="alt">alt</li>
                        <li class="pointer1st" id="space">space</li>
                        <li class="middle" id="alt">alt</li>
                        <li class="ring" id="win">win</li>
                        <li class="pinky" id="ctrl">ctrl</li>
                    </ul>
                </div>

                <div class="main-btn">
                    <button id="btn" class="mainbtn">Start</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // Keybord

    // Function to handle Caps Lock
    function toggleCapsLock() {
        const capsLockKey = document.getElementById('caps');
        capsLockKey.classList.toggle('active');

        // Update keyboard keys to reflect Caps Lock state
        const keyboardKeys = document.querySelectorAll('.keyboard li');
        keyboardKeys.forEach(key => {
            const isLetter = /^[a-zA-Z]$/.test(key.innerText);
            if (isLetter) {
                key.innerText = capsLockKey.classList.contains('active') ? key.innerText.toUpperCase() : key.innerText.toLowerCase();
            }
        });
    }
    // Event listener for Caps Lock
    document.getElementById('caps').addEventListener('click', function () {
        toggleCapsLock();
    });

    // Event listener for keydown to handle Caps Lock and Shift
    document.addEventListener('keydown', function (event) {
        if (event.key === 'CapsLock') {
            toggleCapsLock();
        } else if (event.key === 'Shift') {
            toggleShift();
        }
    });

        function highlightKeys(currentChar) {
            // Remove previous highlights
            document.querySelectorAll('.keyboard li').forEach(key => {
                key.classList.remove('selected' ,'wrong');
            });

            // Highlight the current key
            const keyElement = document.getElementById(currentChar.toUpperCase());
                if (keyElement) {
                    keyElement.classList.add('selected');
                }
                // Special handling for spacebar
                if (currentChar === '.') {
                    const dotKey = document.getElementById('dot');
                    if (dotKey) {
                        dotKey.classList.add('selected');
                    }
                }
                // Update the ID in the JavaScript function
                if (currentChar === '`') {
                    const backtickKey = document.getElementById('backtick');
                    if (backtickKey) {
                        backtickKey.classList.add('selected');
                    }
                }

                if (currentChar === ' ') {
                    const spaceKey = document.getElementById('space');
                    if (spaceKey) {
                        spaceKey.classList.add('selected');
                    }
                }
    
        }
        
        
        let lastCorrectIndex = 0;

document.addEventListener("keyup", event => {
    // Check for the backspace key
    if (event.key === 'Backspace') {
        // Handle backspace logic here
        if (currentIndex > 0) {
            // Remove the 'selected' class from the current key
            const currentChar = showSentence.innerText[currentIndex];
            const currentKey = document.getElementById(currentChar.toUpperCase());
            if (currentKey) {
                currentKey.classList.remove('selected', 'wrong');
            }

            // Move the currentIndex back to the last correct index
            currentIndex = lastCorrectIndex;

            // Highlight the key for the current index without moving it
            const prevChar = showSentence.innerText[currentIndex];
            highlightKeys(prevChar);
        }
        return; // Don't proceed with the regular key handling
    }



            let keyPressed;

            // Check for the backtick key separately
            if (event.key === '`') {
                keyPressed = '`';
            } else {
                keyPressed = String.fromCharCode(event.keyCode);
            }
            // const keyPressed = String.fromCharCode(event.keyCode);
            const highlightedKey = document.querySelector(".selected");

            // Check if the correct key is pressed
                if (keyPressed === highlightedKey.innerHTML|| (keyPressed === ' ' && highlightedKey.id === 'space')){
                    // Increment the index
                    currentIndex++;

                    // Update the last correct index
                    lastCorrectIndex = currentIndex;

                    // Highlight the next key if there is one
                    if (currentIndex < showSentence.innerText.length) {
                        const nextChar = showSentence.innerText[currentIndex];
                        highlightKeys(nextChar);
                    } else{
                        // End the typing test when the sentence is complete
                        endTypingTest();
                    }
                }else {
                    // Add the 'wrong' class to the pressed key if there is a mistake
                    highlightedKey.classList.add('wrong');
                }
        });
        // Keybord
        
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

            // Hide the timer-div content
            document.querySelector('.timer-div').style.display = 'none';

            // showSentence.innerHTML = "";
            // typing_ground.value = "";

            // Disable the textarea
            typing_ground.setAttribute('disabled', 'true');

            // Remove the 'selected' class from all keys
            document.querySelectorAll('.keyboard li').forEach(key => key.classList.remove('selected','wrong'));
            
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

        let currentIndex = 0;

        const startTypingTest = () =>{
            currentIndex = 0;
            let randomNumber = Math.floor(Math.random()*sentences.length);
            //console.log(randomNumber);
            showSentence.innerHTML = sentences[randomNumber].sentence;

            // Highlight the first key
            const firstChar = showSentence.innerText[0];
            highlightKeys(firstChar);

            let date = new Date();
            startTime = date.getTime();

             // Enable the textarea
            typing_ground.removeAttribute('disabled');
            // Clear the previous content of the textarea
            typing_ground.value = "";
            // Focus on the textarea for user convenience
            typing_ground.focus();

            btn.innerText = "Done";
            score.innerHTML = "";

            // Hide the cursor after the test ends
    typing_ground.style.caretColor = 'transparent';

            // Show the timer-div content
            document.querySelector('.timer-div').style.display = 'flex';

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