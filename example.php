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
            <h2 id="msz"></h2>
            <br>
            <textarea id="myWords" cols="80" rows="10" placeholder="Remember, be nice!"></textarea>
            <br>
            <button id="btn" class="mainbtn">Start</button>
        </div>

        <?php
        include 'footer1.php';
        ?>
    </div>
</div>

<script>
        const setOfWords = ["The quick brown fox jumps over the lazy dog.",
         "Now is the time for all good men to come to the aid of their country.",
        "Adle was I ere I saw Elba."];

        const msz = document.getElementById('msz');
        const typeWords = document.getElementById('myWords');
        const btn = document.getElementById('btn');
        let startTime, endTime;

        const playGame = () =>{
            let randomNumber = Math.floor(Math.random()*setOfWords.length);
            msz.innerText = setOfWords[randomNumber];
            let date = new Date();
            startTime = date.getTime();
            btn.innerText = "Done";
        }

        const endGame = () =>{
            let date = new Date();
            endTime = date.getTime();
            let totalTime = ((endTime - startTime)/ 1000);
            //console.log(totalTime);

            let totalStr = typeWords.value;
            let wordCount = wordCounter(totalStr);

            let speed = Math.round((wordCount / totalTime)*60);

            let finalMsg = "You typed total at " + speed + " words per minutes ";

            finalMsg += compareWords(msz.innerText,totalStr);

            msz.innerText = finalMsg;
        }

        const compareWords = (str1, str2) =>{
            let words1 = str1.split(" ");
            let words2 = str2.split(" ");
            let cnt = 0;

            /*arrayName then foreach then it will take whole
            function with the value and index no. of that array*/
            words1.forEach(function(item, index){
                if (item == words2[index]){
                    cnt++;
                }
            })

            let errorWords = ( words1.length -cnt );
            return (cnt + " correct out of " + words1.length + " words and the total number of error are " + errorWords + ".");
        }

        const wordCounter = (str) =>{
            let response = str.split(" ").length;
            //console.log(response);
            return response;
        }

        btn.addEventListener('click', function(){
            if(this.innerText == 'Start'){
                typeWords.disabled = false;
                playGame();
            }else if(this.innerText == 'Done'){
                typeWords.disabled = true;
                btn.innerText = "Start";
                endGame();
            }
        })
    </script>

</body>
</html>