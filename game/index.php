<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiparu</title>
    <style>
        body {
            background-color: #1a1a1a;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            
    
                background-color: #1a1a1a;
                font-family: 'Press Start 2P', cursive;
                color: #fff;
        
        }
        
        .description {
            font-size: 1em;
            margin-top: 0;
            text-align: center;
        }
        .coming-soon {
            font-size: 1.2em;
            margin-top: 40px;
            text-align: center;
            animation: blink 1s infinite;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
        @keyframes pulse {
            0% {
                transform: scale(1);
                text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 20px #ff00ff, 0 0 30px #ff00ff, 0 0 40px #ff00ff, 0 0 50px #ff00ff, 0 0 60px #ff00ff, 0 0 70px #ff00ff;
            }
            50% {
                transform: scale(1.1);
                text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #ff00ff, 0 0 40px #ff00ff, 0 0 50px #ff00ff, 0 0 60px #ff00ff, 0 0 70px #ff00ff, 0 0 80px #ff00ff;
            }
            100% {
                transform: scale(1);
                text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 20px #ff00ff, 0 0 30px #ff00ff, 0 0 40px #ff00ff, 0 0 50px #ff00ff, 0 0 60px #ff00ff, 0 0 70px #ff00ff;
            }
        }
    </style>
</head>
<body>
<h1 style="font-size: 77px;"> <span class="coinlogo"style="display: inline-block; width: 100px; height: 100px; background-color: #ff9900; margin-left: -100px; border-radius: 50%; line-height: 90px; text-align: center;">tiparu</span> </h1>



    <div class="description">Play and Earn Money with your Tap</div>
    <div class="coming-soon">Coming Soon</div>

    <a href="login.php"><button style="
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 40px 2px;
        cursor: pointer;
        border-radius: 8px;
    ">Play Beta Version</button></a>
 


</html>
