<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content=
        "width=device-width, initial-scale=1.0" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.js"></script>
<style>


html, body {
     width:100%;
}

</style>


<style>



.buttons {
  display: flex;
  width: 380px;
  gap: 10px;
  --b: 5px;   /* the border thickness */
  --h: 1.8em; /* the height */
  margin-bottom:50px;
}

.buttons button {
  --_c: #88C100;
  flex: calc(1.25 + var(--_s,0));
  min-width: 0;
  font-size: 30px;
  font-weight: bold;
  height: var(--h);
  cursor: pointer;
  color: var(--_c);
  border: var(--b) solid var(--_c);
  background: 
    conic-gradient(at calc(100% - 1.3*var(--b)) 0,var(--_c) 209deg, #0000 211deg) 
    border-box;
  clip-path: polygon(0 0,100% 0,calc(100% - 0.577*var(--h)) 100%,0 100%);
  padding: 0 calc(0.288*var(--h)) 0 0;
  margin: 0 calc(-0.288*var(--h)) 0 0;
  box-sizing: border-box;
  transition: flex .4s;
}
.buttons button + button {
  --_c: #FF003C;
  flex: calc(.75 + var(--_s,0));
  background: 
    conic-gradient(from -90deg at calc(1.3*var(--b)) 100%,var(--_c) 119deg, #0000 121deg) 
    border-box;
  clip-path: polygon(calc(0.577*var(--h)) 0,100% 0,100% 100%,0 100%);
  margin: 0 0 0 calc(-0.288*var(--h));
  padding: 0 0 0 calc(0.288*var(--h));
}
.buttons button:focus-visible {
  outline-offset: calc(-2*var(--b));
  outline: calc(var(--b)/2) solid #000;
  background: none;
  clip-path: none;
  margin: 0;
  padding: 0;
}
.buttons button:focus-visible + button {
  background: none;
  clip-path: none;
  margin: 0;
  padding: 0;
}
.buttons button:has(+ button:focus-visible) {
  background: none;
  clip-path: none;
  margin: 0;
  padding: 0;
}
button:hover,
button:active:not(:focus-visible) {
  --_s: .75;
}
button:active {
  box-shadow: inset 0 0 0 100vmax var(--_c);
  color: #fff;
}




</style>

<?php 
        $notfound = false;
        include 'config.php';
                             $name = "N/A";
                            $id_no = "N/A";
                            $grade = "N/A";
                            $dob = "N/A";
                            $address = "N/A";
                            $email = "N/A";
                            $exp_date = "N/A";
                            $phone = "N/A";
                            $address = "N/A";
                            $image = "N/A";
                            $date = date('M d, Y', strtotime("N/A"));



        if(isset($_REQUEST['idgen'])){

             $id_no = $_REQUEST['idgen'];

             $sql = "Select * from cards where id_no='$id_no' ";

             $result = mysqli_query($conn, $sql);
 
 
             if(mysqli_num_rows($result)>0){
             $html="<div class='card' style=' padding:0;' >";
     
               $html.="";
                         while($row=mysqli_fetch_assoc($result)){
                             
                            $name = $row["name"];
                            $id_no = $row["id_no"];
                            $grade = $row['grade'];
                            $dob = $row['dob'];
                            $address = $row['address'];
                            $email = $row['email'];
                            $exp_date = $row['exp_date'];
                            $phone = $row['phone'];
                            $address = $row['address'];
                            $image = $row['image'];
                            $date = date('M d, Y', strtotime($row['date']));
                        
                        
                        }
                    }

                   
                }



              

                            ?>
<div class="buttons">
  <button id="demo" onclick="downloadtable()">Download</button>
  <button>Return</button>
</div>

<div id="mycard" style=" ">
<div style="margin-left: 50px; width:638px; height:1013px; background:green; float:left;"> Left </div>
<div style="width:638px; height:1013px; background:green; margin-left: 700px;"> Right </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script>

    function downloadtable() {
       
        var node = document.getElementById('mycard');

        domtoimage.toPng(node)
            .then(function (dataUrl) {
                var img = new Image();
                img.src = dataUrl;
                downloadURI(dataUrl, "staff-id-card.png")
            })
            .catch(function (error) {
                console.error('oops, something went wrong', error);
            });

    }



    function downloadURI(uri, name) {
        var link = document.createElement("a");
        link.download = name;
        link.href = uri;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        delete link;
    }



</script>