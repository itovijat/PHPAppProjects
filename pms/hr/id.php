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
        include 'head1.php';
        $name = "";
        $id = "";
        $post = "";
        $dept = "";
        $phone = "";
        $email = "";
        $issuedate = "";
        $bg = "";
        $photo = "";



        if(isset($_REQUEST['pid'])){

             $pid = $_REQUEST['pid'];

             $sql = "Select * from person where pid='$pid' ";

             $result = mysqli_query($conn, $sql);
 
 
             if(mysqli_num_rows($result)>0){
             $html="<div class='card' style=' padding:0;' >";
     
               $html.="";
                         while($row=mysqli_fetch_assoc($result)){
                             
                            $name = $row["name"];
                            $id = $row["pid"];
                            $post = $row['post'];
                            $dept = $row['dept'];
                            $phone = $row['phone'];
                            $email = $row['email'];
                            $issuedate = $row['issuedate'];
                            $bg = $row['bloodgroup'];
                            $photo = $row['photo'];
                        
                        
                        
                        }
                    }

                   
                }



              

                            ?>
<div style="display: flex; justify-content: center; align-items: center;">
  <div class="buttons">
    <button id="demo" onclick="downloadtable()">Download</button>
    <button onclick="window.history.back()">Return</button>
  </div>
</div>

<div id="mycard" style="">
  <div style=""><br></div>
  <div style="margin-left: 50px; width:638px; height:1013px; border: 1px solid black; border-radius: 20px; float:left;  display: flex;
            flex-direction: column; justifiy-content: center; align-items: center; background: white;
            "> 
  
        
             <div style="height: 50px; width: 100%; background: #ea2227; border-top-left-radius: 20px; border-top-right-radius: 20px;"></div>

             <div style="height: 5px; width: 100%; background: #8bc936;"></div>


             <img id="logo" src="../assets/img/logo.png" style="width: auto; height: 120px; margin:20px;">
            <img id="pp" src="../assets/person/<?php echo $photo; ?>" style="width: auto; height: 222px; border: 3px solid black; border-radius: 5%;">
            <h2 style="text-align: center; font-size: 40px; margin-top:10px;"><?php echo $name; ?></h2>
       
            <p style="text-align: center; font-size: 30px; margin-top:-20px;" class="post"><b><?php echo $post; ?><br>( <?php echo $dept; ?> )</b></p>
          
            <p style="text-align: center; font-size: 30px; margin-top:0px;"><?php echo $email; ?></p>
            <p style="text-align: center; font-size: 30px; margin-top:-20px;"><?php echo $phone; ?></p>

            <h2 style="text-align: center; font-size: 30px; margin-top:10px;">Ovijat Food & Beverage Industries Ltd.</h2>

            <div style=" height: 170px; width: 100%; background: black; color: white;">
            <p style="text-align: center; font-size: 40px; margin-top: 10px;">info@ovijatfood.com</p>
            <p style="text-align: center; font-size: 40px; margin-top: -40px;">www.ovijatfood.com</p>
            <p style="text-align: center; font-size: 40px; margin-top: -40px;">+88 02 951 3985</p>

            </div>
            <div style="  height: 5px; width: 100%; background: #8bc936;"></div>

            <div style=" bottom: 0; height: 50px; width: 100%; background: #ea2227; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;"></div>

     



  </div>


  <div style="width:638px; height:1013px; border: 1px solid black; border-radius: 20px; margin-left: 700px; display: flex;
            flex-direction: column; justifiy-content: center; align-items: center; background: white;"> 
  

  <div style="height: 50px; width: 100%; background: #ea2227; border-top-left-radius: 20px; border-top-right-radius: 20px;"></div>

<div style="height: 5px; width: 100%; background: #8bc936;"></div>


<img id="logo" src="../assets/img/logo.png" style="width: auto; height: 50px; margin-top:20px; margin-bottom: 20px;">
<img id="pp" src="../assets/img/qr.png" style="width: auto; height: 250px; border: 3px solid black;">
<p style="text-align: center; font-size: 25px; margin-top:0px;">This ID card is online generated.<br>Scan this QR or Visit: <b>www.ovijatfood.com/id</b></p>

<p style="text-align: center; font-size: 30px; margin-top:20px;" class="post"><b><?php echo $name; ?><br>Employee ID: <?php echo $pid; ?></b></p>

<p style="text-align: center; font-size: 30px; margin-top:-12px;">Blood Group: <?php echo $bg; ?></p>
<p style="text-align: center; font-size: 30px; margin-top:-20px;">Issue Date: <?php echo $issuedate; ?></p>

<div style="  height: 90px; width: 100%; background: #8bc936;">
<p style="text-align: center; font-size: 25px; margin-top: 15px; color: white;">Always carry this Card & it is non-transferable.<br>If found, please post it to the given address.</p>
</div>
<div style=" height: 170px; width: 100%; background: black; color: white;">
<p style="text-align: center; font-size: 32px; margin-top: 30px;">Ovijat Food & Beverage Industries Ltd.</p>
<p style="text-align: center; font-size: 23px; margin-top: -20px;">Sadharan Bima Bhaban 2, 139, Motijheel, Dhaka-1000</p>
<p style="text-align: center; font-size: 28px; margin-top: -20px;">Factory: Ramgonj, Nilphamari</p>

</div>
<div style="  height: 5px; width: 100%; background: #8bc936;"></div>

<div style=" bottom: 0; height: 50px; width: 100%; background: #ea2227; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;"></div>


  </div>

  <div><br></div>
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
                downloadURI(dataUrl, "<?php echo $name.$pid; ?>.png")
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