<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Dice</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        .dice-container {
            display: flex;
            gap: 20px;
            height: 400px;
        }
        .dice {
            width: 100px;
            height: 100px;
            perspective: 1000px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0px 3px 10px rgba(0,0,0,0.25);
        }
        .dice-inner {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            transform: rotateX(0deg) rotateY(0deg);
            transition: transform 1s;
        
        }



        .dice-face {
            position: absolute;
            width: 100px;
            height: 100px;
            background-color: red;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1em;
            color:white;
            box-shadow: 2px 2px 2px rgba(0,0,0,0.25);
        }






        
        .face1 { transform: rotateY(0deg) translateZ(50px); }
        .face2 { transform: rotateY(90deg) translateZ(50px); }
        .face3 { transform: rotateY(180deg) translateZ(50px); }
        .face4 { transform: rotateY(-90deg) translateZ(50px); }
        .face5 { transform: rotateX(90deg) translateZ(50px); }
        .face6 { transform: rotateX(-90deg) translateZ(50px); }
    </style>
</head>
<body>
    <div class="dice-container">
    <div style="display: flex; justify-content: center; align-items: center; text-align: center; position: absolute; top: 0; left: 50%; transform: translateX(-50%);">
        <span id="countdown-number" style="font-size: 3em;"></span>
    </div>
        <div class="dice" id="dice1">
            <div class="dice-inner">
                 <div class="dice-face face1">&#11044;</div>
                 <div class="dice-face face2">&#11044;&nbsp;&nbsp;&#11044;</div>
                <div class="dice-face face3">&#11044;&nbsp;&nbsp;&#11044;<br>&nbsp;&nbsp;&nbsp;&#11044;</div>
                <div class="dice-face face4">&#11044;&nbsp;&nbsp;&#11044;<br>&#11044;&nbsp;&nbsp;&#11044;</div>
                <div class="dice-face face5">&#11044;&nbsp;&nbsp;&#11044;<br>&nbsp;&nbsp;&nbsp;&#11044;<br>&#11044;&nbsp;&nbsp;&#11044;</div>
                <div class="dice-face face6">&#11044;&nbsp;&nbsp;&#11044;<br>&#11044;&nbsp;&nbsp;&#11044;<br>&#11044;&nbsp;&nbsp;&#11044;</div>
            </div>
        </div>
        <div class="dice" id="dice2">
            <div class="dice-inner">
            <div class="dice-face face1">&#11044;</div>
                 <div class="dice-face face2">&#11044;&nbsp;&nbsp;&#11044;</div>
                <div class="dice-face face3">&#11044;&nbsp;&nbsp;&#11044;<br>&nbsp;&nbsp;&nbsp;&#11044;</div>
                <div class="dice-face face4">&#11044;&nbsp;&nbsp;&#11044;<br>&#11044;&nbsp;&nbsp;&#11044;</div>
                <div class="dice-face face5">&#11044;&nbsp;&nbsp;&#11044;<br>&nbsp;&nbsp;&nbsp;&#11044;<br>&#11044;&nbsp;&nbsp;&#11044;</div>
                <div class="dice-face face6">&#11044;&nbsp;&nbsp;&#11044;<br>&#11044;&nbsp;&nbsp;&#11044;<br>&#11044;&nbsp;&nbsp;&#11044;</div>
            </div>
        </div>
        <div class="dice" id="dice3">
            <div class="dice-inner">
            <div class="dice-face face1">&#11044;</div>
                 <div class="dice-face face2">&#11044;&nbsp;&nbsp;&#11044;</div>
                <div class="dice-face face3">&#11044;&nbsp;&nbsp;&#11044;<br>&nbsp;&nbsp;&nbsp;&#11044;</div>
                <div class="dice-face face4">&#11044;&nbsp;&nbsp;&#11044;<br>&#11044;&nbsp;&nbsp;&#11044;</div>
                <div class="dice-face face5">&#11044;&nbsp;&nbsp;&#11044;<br>&nbsp;&nbsp;&nbsp;&#11044;<br>&#11044;&nbsp;&nbsp;&#11044;</div>
                <div class="dice-face face6">&#11044;&nbsp;&nbsp;&#11044;<br>&#11044;&nbsp;&nbsp;&#11044;<br>&#11044;&nbsp;&nbsp;&#11044;</div>
            </div>
        </div>
    </div>

   
    <script>
        function rollDice(dice, value) {
            const diceInner = dice.querySelector('.dice-inner');
            const rotations = [
                { x: 0, y: 0 }, // 1
                { x: 0, y: -90 }, // 4
                { x: 0, y: 180 }, // 3
              
                { x: 0, y: 90 }, // 2
                { x: -90, y: 0 }, // 6
                { x: 90, y: 0 } // 5
              
            ];
            const rotation = rotations[value - 1];
            diceInner.style.transform = `rotateX(${rotation.x}deg) rotateY(${rotation.y}deg)`;
        }

        function randomizeDice() {
            var dice1Value = Math.floor(Math.random() * 6) + 1;
            var dice2Value = Math.floor(Math.random() * 6) + 1;
            var dice3Value = Math.floor(Math.random() * 6) + 1;

            rollDice(document.getElementById('dice1'), dice1Value);
            rollDice(document.getElementById('dice2'), dice2Value);
            rollDice(document.getElementById('dice3'), dice3Value);

           
              
        }

        var counter = 0;
        var countdown = 5;
        var intervalId = setInterval(function() {


       





        
            
            if (counter < countdown) {
                document.getElementById('countdown-number').innerHTML = countdown - counter;
                randomizeDice();
                counter++;
            } else {
                clearInterval(intervalId);
                var newDice1Value = 1;
                var newDice2Value =1;
                var newDice3Value = 1;
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var result = JSON.parse(this.responseText);
                         newDice1Value = result.dice1;
                         newDice2Value = result.dice2;
                        newDice3Value = result.dice3;


                        
                rollDice(document.getElementById('dice1'), newDice1Value);
              
              rollDice(document.getElementById('dice2'), newDice2Value);
            
              rollDice(document.getElementById('dice3'), newDice3Value);

              var sum = newDice1Value + newDice2Value + newDice3Value;
              document.getElementById('countdown-number').innerHTML =newDice1Value +'+'+newDice2Value+'+' +newDice3Value +'='+sum;
                    }
                };
                xhttp.open("GET", "result.php", true);
                xhttp.send();


            

            }
        }, 1000);



        var dice1Value = Math.floor(Math.random() * 6) + 1;
            var dice2Value = Math.floor(Math.random() * 6) + 1;
            var dice3Value = Math.floor(Math.random() * 6) + 1;

            rollDice(document.getElementById('dice1'), dice1Value);
            rollDice(document.getElementById('dice2'), dice2Value);
            rollDice(document.getElementById('dice3'), dice3Value);
    </script>
</body>
</html>
