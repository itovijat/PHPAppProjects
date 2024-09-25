
<?php
include_once 'ih.php';
?>
       
        <style>
         

         

        </style>

<br>




        <div style="display: flex; justify-content: center; align-items: center;">
                         <button type="button" class="btn btn-outline-success" style="background-color: green; color: white;" onclick="location.reload()">Refresh</button>
                         <input type="text" id="search_username" name="search_username" placeholder="Username" style="margin: 0 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                         <button type="button" class="btn btn-outline-success" style="background-color: green; color: white;" onclick="searchFormValidate()">Search</button>
        </div>
        
        
        <br>
        <div id="players" style="text-align: center;">Getting Players</div>


    <script>
var sname="";
        function searchFormValidate() {
            sname = document.getElementById("search_username").value;
            if (sname) {
                alert(sname);
            }
        }
        function updatePlayers() {



            fetch('update_players.php?sname='+sname)
                .then(response => response.text())
                .then(data => {
                    if(data) {
                   

                        document.getElementById('players').innerHTML = data;

                    }
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



        setInterval(updatePlayers, 1000);
      
    </script>



<?php
include_once 'if.php';
?>
