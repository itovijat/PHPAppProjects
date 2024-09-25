
</div>







<script>
                function updateOnlineNotification() {
                    fetch('update_online_notification.php')
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('onlinenotification').innerHTML = 'Online (' + data + ')';
                            document.getElementById('onlineblink').style.animation = 'blink 1s infinite';

                            if(data == 0) {
                                document.getElementById('onlinenotification').innerHTML = 'Online';
                             
                                document.getElementById('onlineblink').style.backgroundColor = 'red';
                                document.getElementById('onlineblink').style.animation = '';

                            
                            } else {
                                document.getElementById('onlinenotification').style.visibility = 'visible';
                                document.getElementById('onlinenotification').style.display = 'inline-block';
                                document.getElementById('onlineblink').style.backgroundColor = 'green';

                            }
                            
                        });
                }
                updateOnlineNotification();
                setInterval(updateOnlineNotification, 2000);

                function updateChallengesNotification() {
                    fetch('update_challenges_notification.php?username=<?php echo $username; ?>')
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('challengesnotification').innerHTML = 'Challenges (' + data + ')';
                            document.getElementById('challengesnotify').style.animation = 'blink 1s infinite';

                            if(data == 0) {
                                document.getElementById('challengesnotification').innerHTML = 'Challenges';
                                document.getElementById('challengesnotify').style.animation = '';
                            } else {
                                document.getElementById('challengesnotification').style.visibility = 'visible';

                                document.getElementById('challengesnotification').style.display = 'inline-block';
                            }
                        });
                }
                updateChallengesNotification();
setInterval(updateChallengesNotification, 2000);

   
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

updatePlayersgame();
        setInterval(updatePlayersgame, 2000);
    </script>
</body>
</html>

