<?php include_once "head2.php"; ?>






<div class="content">
        <!-- Main content goes here -->

        <p style="text-align: center; color: red;">Welcome <b><?php echo $_SESSION['email']; ?></b> from <b><?php echo $_SESSION['company']; ?></b></p>




        
        <script>
            var text = "Sales Target ";

            var charIndex = 0;
            var finished = false;
            setInterval(function(){
                if (finished) {
                    charIndex = 0;
                    finished = false;
                    document.querySelector(".typing").innerHTML = "";
                }
                if (charIndex < text.length) {
                    document.querySelector(".typing").innerHTML += text[charIndex];
                    charIndex++;
                } else {
                    setTimeout(function(){ finished = true; }, 1000);
                }
            }, 100);
        </script>
        <h1 style="text-align: center; color: green;" class="typing"></h1>

        <div class="row" style="border: 2px solid white; background-color: red ; padding: 20px; color: white; text-align: center">
  

        

                    <div class="col-3 col-md-3">
                        Today
                        <br>

                        0/5
                    </div>
                    <div class="col-3 col-md-3">
                    Weekly
                        <br>

                        0/35
                    </div>
                    <div class="col-3 col-md-3">
                    Month
                        <br>

                        0/120
                    </div>
                    <div class="col-3 col-md-3">
                    Total
                        <br>

                        0
                    </div>
                </div>










        <div class="row">

            <div class="col-12 col-md-3" style="border: 2px solid white; background-color: green ; padding: 20px; color: white; text-align: center">
                <span style="color: white; font-size: 2em;">Visit</span>
                   
                <div class="row">
                    
                    <div class="col-3 col-md-3">
                        Today
                        <br>
                                    <?php
                                    $today = date('Y-m-d');
                                    $sql = "SELECT COUNT(*) AS total FROM visit WHERE mo='".$_SESSION['email']."' AND company='".$_SESSION['company']."' AND odate='$today' ";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['total'];
                                    ?>
                    </div>
                    <div class="col-3 col-md-3">
                    Weekly
                        <br>
                                    <?php
                                    $today = date('Y-m-d');
                                    $saturday = date('Y-m-d', strtotime('saturday last week'));
                                    $friday = date('Y-m-d', strtotime('friday this week'));
                                    $sql = "SELECT COUNT(*) AS total FROM visit WHERE mo='".$_SESSION['email']."' AND company='".$_SESSION['company']."' AND odate BETWEEN '$saturday' AND '$friday'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['total'];
                                    ?>
                    </div>
                    <div class="col-3 col-md-3">
                    Month
                        <br>
                                     <?php
                                    $today = date('Y-m-d');
                                    $firstday = date('Y-m-01');
                                    $lastday = date('Y-m-t');
                                    $sql = "SELECT COUNT(*) AS total FROM visit WHERE mo='".$_SESSION['email']."' AND company='".$_SESSION['company']."' AND odate BETWEEN '$firstday' AND '$lastday'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['total'];
                                    ?>
                    </div>
                    <div class="col-3 col-md-3">
                    Total
                        <br>
                                    <?php
                                    
                                  
                                    $sql = "SELECT COUNT(*) AS total FROM visit WHERE mo='".$_SESSION['email']."' AND company='".$_SESSION['company']."' ";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['total'];
                                    ?>
                    </div>
                </div>
            
            </div>

            <div class="col-12 col-md-3" style=" border: 2px solid white; background-color: green ; padding: 20px; color: white; text-align: center">
                <span style="color: white; font-size: 2em;">Order</span>
                   
                <div class="row">
                    
                    <div class="col-3 col-md-3">
                        Today
                        <br>
                                    <?php
                                    $today = date('Y-m-d');
                                    $sql = "SELECT COUNT(*) AS total FROM visit WHERE mo='".$_SESSION['email']."' AND status!=2 AND reason='order' AND  company='".$_SESSION['company']."' AND odate='$today'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['total'];
                                    ?>
                    </div>
                    <div class="col-3 col-md-3">
                    Weekly
                        <br>
                                    <?php
                                    $today = date('Y-m-d');
                                    $saturday = date('Y-m-d', strtotime('saturday last week'));
                                    $friday = date('Y-m-d', strtotime('friday this week'));
                                    $sql = "SELECT COUNT(*) AS total FROM visit WHERE mo='".$_SESSION['email']."' AND status!=2 AND reason='order' AND company='".$_SESSION['company']."' AND odate BETWEEN '$saturday' AND '$friday'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['total'];
                                    ?>
                    </div>
                    <div class="col-3 col-md-3">
                    Month
                        <br>
                                     <?php
                                    $today = date('Y-m-d');
                                    $firstday = date('Y-m-01');
                                    $lastday = date('Y-m-t');
                                    $sql = "SELECT COUNT(*) AS total FROM visit WHERE mo='".$_SESSION['email']."' AND status!=2 AND reason='order' AND company='".$_SESSION['company']."' AND odate BETWEEN '$firstday' AND '$lastday'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['total'];
                                    ?>
                    </div>
                    <div class="col-3 col-md-3">
                    Total
                        <br>
                                    <?php
                                    
                                  
                                    $sql = "SELECT COUNT(*) AS total FROM visit WHERE mo='".$_SESSION['email']."' AND status!=2 AND reason='order' AND company='".$_SESSION['company']."' ";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['total'];
                                    ?>
                    </div>
                </div>
            
            </div>

            <div class="col-12 col-md-3" style="border: 2px solid white; background-color: green ; padding: 20px; color: white; text-align: center">
                <span style="color: white; font-size: 2em;">Accepted</span>
                   
                <div class="row">
                    
                    <div class="col-3 col-md-3">
                        Today
                        <br>

                        0
                    </div>
                    <div class="col-3 col-md-3">
                    Weekly
                        <br>

                        0
                    </div>
                    <div class="col-3 col-md-3">
                    Month
                        <br>

                        0
                    </div>
                    <div class="col-3 col-md-3">
                    Total
                        <br>

                        0
                    </div>
                </div>
            
            </div>

            <div class="col-12 col-md-3" style="border: 2px solid white; background-color: green ; padding: 20px; color: white; text-align: center">
                <span style="color: white; font-size: 2em;">Delivered</span>
                   
                <div class="row">
                    
                    <div class="col-3 col-md-3">
                        Today
                        <br>

                        0
                    </div>
                    <div class="col-3 col-md-3">
                    Weekly
                        <br>

                        0
                    </div>
                    <div class="col-3 col-md-3">
                    Month
                        <br>

                        0
                    </div>
                    <div class="col-3 col-md-3">
                    Total
                        <br>

                        0
                    </div>
                </div>
            
            </div>

        </div>
       


            <!-- 3x3 grid of cards -->

            <br><br><br><br><br>





            












       

    </div>

    <?php include_once "foot.php"; ?>