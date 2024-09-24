
</div>







<script>
                function updateOnlineNotification() {
                    fetch('update_online_notification.php')
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('onlinenotification').innerHTML = '(' + data + ')';
                            if(data == 0) {
                                document.getElementById('onlinenotification').style.visibility = 'hidden';
                            } else {
                                document.getElementById('onlinenotification').style.visibility = 'visible';
                                document.getElementById('onlinenotification').style.display = 'inline-block';
                            }
                            
                        });
                }
                setInterval(updateOnlineNotification, 2000);

                function updateChallengesNotification() {
                    fetch('update_challenges_notification.php?username=<?php echo $username; ?>')
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('challengesnotification').innerHTML = '(' + data + ')';
                            if(data == 0) {
                                document.getElementById('challengesnotification').style.visibility = 'hidden';
                            } else {
                                document.getElementById('challengesnotification').style.visibility = 'visible';

                                document.getElementById('challengesnotification').style.display = 'inline-block';
                            }
                        });
                }
                setInterval(updateChallengesNotification, 2000);


            </script>

<script>
    



   
        function updatePlayersgame() {

            fetch('update_playersgame.php?username=<?php echo $username; ?>')
                .then(response => response.text())
                .then(data => {
                    if (data.indexOf('game.php') === 0) {
                        window.location.href = data;
                    } else {
                      
                    }
                  
                });
}

     
        setInterval(updatePlayersgame, 2000);
    </script>
</body>
</html>

