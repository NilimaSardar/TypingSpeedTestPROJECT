<?php
session_start();

if(!isset($_SESSION['username'])){
    echo "you are logged out";
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        .sidebar{
            position: fixed;
            left: -250px;
            width: 250px;
            height: 100%;
            background: #3f5560;
            transition: all .5s ease;
        }
        .sidebar header{
            font-size: 22px;
            color: white;
            text-align: center;
            line-height: 70px;
            background: #2a5268;
            user-select: none;
        }
        .sidebar ul a{
            display: block;
            height: 100%; 
            width: 100%;
            line-height:50px;
            font-size: 20px;
            color: white;
            padding-left: 40px;
            box-sizing: border-box;
            border-top: 1px solid rgba(255,255,255,.1);
            transition: .4s;
            position: relative;
        }
        ul li:hover a{
            padding-left: 50px;
        }
        .sidebar ul a i{
            margin-right: 16px;
        }
        #check{
            display: none;
        }
        label #btnn,label #cancel{
            position: absolute;
            cursor: pointer;
            border-radius: 3px;
        }
        label #btnn{
            left: 20px;
            top: 25px;
            font-size: 27px;
            color: white;
            opacity: .6;
            padding: 6px 12px;
            transition: all .5s;
        }
        label #cancel{
            z-index: 1111;
            left: -195px;
            top: 17px;
            font-size: 27px;
            color: white;
            opacity: .6;
            padding: 4px 9px;
            transition: all .5s ease;
        }
        #check:checked ~ .sidebar{
            left:0;
        }
        #check:checked ~ label #btnn{
            left: 250px;
            opacity: 0;
            pointer-events: none;
        }
        #check:checked ~ label #cancel{
            left: 195px;
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
    </style>
</head>
<body>
<div class="mainDiv">
    <div class="sidebar-show">
    <input type="checkbox" id="check">
    <label for="check">
        <i class="fa fa-bars" aria-hidden="true" id="btnn"></i>
        <i class="fa fa-times" aria-hidden="true" id="cancel"></i>
    </label>
    <div class="sidebar">
        <header>Menu</header>
        <ul>
            <li><a href=""><i class="fa fa-qrcode" aria-hidden="true"></i>Dashboard</a></li>
            <li><a href=""><i class="fa fa-user" aria-hidden="true"></i>My Profile</a></li>
            <li><a href=""><i class="fa fa-tasks" aria-hidden="true"></i>Task</a></li>
            <li><a href=""><i class="fa fa-star" aria-hidden="true"></i>Achievements</a></li>
            <li><a href=""><i class="fa fa-comments-o" aria-hidden="true"></i>Feedback</a></li>
            <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i>Setting</a></li>
            <div class="bottom-shift">
            <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
            </div>
            </ul>
    </div>
    </div>
    
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
    <script>
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

        const sentences = ['hello my name is nilima',
                        'hello my name is nilima1',
                        'hello my name i s nilima2',
                        'hello my name is nilima3']

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

            if(actualWords !== 0){
                let typing_speed = (actualWords/totalTimeTaken)*60;
                typing_speed = Math.round(typing_speed);
                score.innerHTML = `Your typing speed is ${typing_speed} words per minutes & you wrote ${actualWords} correct words out of ${sentence_to_write.length} & time taken ${totalTimeTaken} sec`;
            }else{
                score.innerHTML = `Your typing speed is 0 words per minutes & TIME TAKEN ${totalTimeTaken}  sec`;
            }
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
            showSentence.innerHTML = sentences[randomNumber];

            let date = new Date();
            startTime = date.getTime();

            btn.innerText = "Done";
            score.innerHTML = "";

            //adding Timer
            showTimer();
        }

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
    </script>
</body>
</html>