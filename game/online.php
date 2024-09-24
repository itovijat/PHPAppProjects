
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
     
        <div id="players"></div>
    


    <script>
        function updatePlayers() {



            fetch('update_players.php?username=<?php echo $username; ?>')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('players').innerHTML = data;
                });
        }



    

        function challenge(challenged) {
            fetch('challenge.php?challenger=<?php echo $username; ?>&challenged=' + challenged)
                .then(response => response.text())
                .then(data => {
                   


                  
                    var popup = document.createElement('div');
                    popup.style.position = 'fixed';
                    popup.style.bottom = '20px';
                    popup.style.left = '50%';
                    popup.style.transform = 'translateX(-50%)';
                    popup.style.backgroundColor = data.includes('success') ? 'green' : 'red';
                    popup.style.color = '#fff';
                    popup.style.padding = '10px';
                    popup.style.borderRadius = '5px';
                    popup.innerHTML = data;
                    document.body.appendChild(popup);
                    setTimeout(function() {
                        popup.remove();
                    }, 2000);

                    updatePlayers(); // Refresh the player list after setting a challenge
                });
        }



        setInterval(updatePlayers, 2000);
      
    </script>



<?php
include_once 'if.php';
?>
