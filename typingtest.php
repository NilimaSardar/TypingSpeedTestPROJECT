<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Typing Test</title>
    <style>
        *{
            padding: 0; margin: 0; box-sizing: border-box; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .mainDiv{
            width: 100%;
            height: 79vh;
            position: relative;
            background: #3a698b;
        }

        .centerDiv{
            position: absolute;
            top: 50%;
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
            padding: 10px 20px;
            border-radius: 30px;
            background: indianred;
            color: white;
            font-size: 20px;
            cursor: pointer;
        }

    </style>
 </head>
 <body>
    <div class="mainDiv">
        <div class="centerDiv">
            <h1>Welcome To Typing Speed Test</h1>
            <h2 id="msz"></h2>
            <br>
            <textarea id="myWords" cols="100" rows="10" placeholder="Remember, be nice!"></textarea>
            <br>
            <button id="btn" class="mainbtn">Start</button>
        </div>
    </div>
    <?php
    include 'footer1.php';
    ?>

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