
<?php
include_once 'ih.php';
?>
           <style>
            .search-container {
                display: flex;
                justify-content: center;
                align-items: center;
          
            }

            .search-container button {
                background-color: green;
                color: white;
                font-size: 2em;
            }

            .search-container input[type="text"] {
                margin: 0 10px;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 2em;
            }
        </style>
        
        <style>
            @media only screen and (max-width: 600px) {
           

            .search-container button {
                font-size: 1em;
            }

            .search-container input[type="text"] {
               
                font-size: 0.5em;
            }
              
            }
        </style>
        <style>
    .online-player {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-left: 0%;
        margin-right: 0%;
        margin-bottom: 10px;
    }

    .online-player > span:nth-child(1) {
        font-size: 30px;
        width: 40%;
    }

    .online-player > span:nth-child(2) {
        font-size: 25px;
        width: 30%;
    }

    .online-player > span:nth-child(3) {
        margin-top: 5px;
        color: #888;
        width: 30%;
    }

    .online-player > button {
        border: none;
        background-color: #4CAF50;
        color: #fff;
        margin-top: 5px;
        padding: 5px 5px;
        border-radius: 5px;
        cursor: pointer;
        width: 30%;
    }

    .online-player > a {
        text-decoration: none;
        color: white;
    }

    .online-player > a > span {
        font-size: 25px;
        width: 30%;
    }


    @media only screen and (max-width: 600px) {
        .online-player > span:nth-child(1) {
            font-size: 15px;
        }
        .online-player > span:nth-child(2) {
            font-size: 12px;
        }
        .online-player > span:nth-child(3) {
            font-size: 10px;
        }
        .online-player > button {
            font-size: 10px;
        }
        .online-player > a > span {
            font-size: 15px;
        }
        
        
    }
</style>
     

<br>






        <div class="search-container">
            <button type="button" class="btn btn-outline-success" onclick="location.reload()">Refresh</button>
            <input type="text" id="search_username" name="search_username" placeholder="Username">
            <button type="button" class="btn btn-outline-success" onclick="searchFormValidate()">Search</button>
        </div>
        
        <br>
        <div id="players" style="text-align: center; overflow-y: scroll; height: 500px;">Getting Players</div>


    <script>
var sname="";
        function searchFormValidate() {
            sname = document.getElementById("search_username").value;
            if (sname) {
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
