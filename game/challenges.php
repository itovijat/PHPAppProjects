
<?php
include_once 'ih.php';
?>
       
        <style>
         

            #challenges, #players {
                display: block;
                width: 90%;
                margin: 0 auto;
                font-size: 18px;
            }

            #challenges {
                border: 2px solid #333;
                border-radius: 10px;
                padding: 10px;
                background-color: #444;
                margin-bottom: 10px;
            }

            #players {
                border: 2px solid #333;
                border-radius: 10px;
                padding: 10px;
                background-color: #333;
            }

            #challenges h2, #players h2 {
                margin-top: 0;
            }

            #challenges ul, #players ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            #challenges li, #players li {
                padding: 10px;
                border-bottom: 1px solid #666;
                display: flex;
                align-items: center;
            }

            #challenges li:last-child, #players li:last-child {
                border-bottom: none;
            }

            #challenges button, #players button {
                background-color: #4CAF50;
                color: #fff;
                padding: 10px 20px;
                border: none;
                cursor: pointer;
                margin-left: 10px;
            }

            #challenges button:hover, #players button:hover {
                background-color: #45a049;
            }
        </style>
        <div id="challenges"></div>
       
    
   
    <script>
      


        function checkChallenges() {
            fetch('check_challenges.php?username=<?php echo $username; ?>')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('challenges').innerHTML = data;
                });
        }

     
        function acceptChallenge(challengeId) {
            fetch('accept_challenge.php?challenge_id=' + challengeId)
                .then(response => response.text())
                .then(data => {
                    if (data.indexOf('game.php') === 0) {
                        window.location.href = data;
                    } else {
                        alert(data);
                    }
                 
                    checkChallenges(); // Refresh the challenge list after accepting a challenge
                });
        }

        setInterval(checkChallenges, 2000);
  
    </script>



<?php
include_once 'if.php';
?>
