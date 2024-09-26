
<?php
include_once 'ih.php';
?>
           <div style=""> 


    <p style="text-align: center;">Username: <?php echo $_SESSION['username']; ?> </p>

    <div style="display: flex; justify-content: center;"> 
        <div class="card" style="width: 50%; margin-top: 20px;">
            <div class="card-header">
            </div>
            <div class="card-body">
                <form action="<?php echo basename($_SERVER['PHP_SELF']);?>" method="POST" style="display: flex; flex-direction: column; align-items: center; background-color: #dff0d8; padding: 20px; border-radius: 10px;">
                    <div class="form-group" style="margin-bottom: 10px;">
                        <label for="oldpassword" style="display: block; text-align: center; color: #3e8e41;">Current Password</label>
                        <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Enter current password" required style="width: 100%; border-color: #3e8e41;">
                    </div>
                    <div class="form-group" style="margin-bottom: 10px;">
                        <label for="newpassword" style="display: block; text-align: center; color: #3e8e41;">New Password</label>
                        <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Enter new password" required style="width: 100%; border-color: #3e8e41;">
                    </div>
                    <button type="submit" class="btn btn-success" style="width: 200px; margin-top: 10px; background-color: #3e8e41; border-color: #3e8e41;">Update Password</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
    <?php
    if (isset($_POST['oldpassword']) && isset($_POST['newpassword'])) {
        $oldpassword = md5($_POST['oldpassword']);
        $newpassword = md5($_POST['newpassword']);


        $sql = "SELECT * FROM users WHERE username='".$_SESSION['username']."' AND password='$oldpassword'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            echo '<div class="popup" style="z-index: 9999; background-color: rgba(0, 0, 0, 0.7); position: fixed; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; ">
                    <div class="popup-content" style="margin-top: 10%;display: flex; justify-content: center;">
                        <h2 style="text-align: center;">Incorrect current password</h2>
                    </div>
                </div>
                <script>
                    function closePopup() {
                        document.querySelector(".popup").remove();
                    }
                    setTimeout(closePopup, 2000);
                    
                </script>';
        } else {


            $sql = "UPDATE users SET password='$newpassword' WHERE username='".$_SESSION['username']."'";
            $conn->query($sql);
            echo '<div class="popup" style="z-index: 9999; background-color: rgba(0, 0, 0, 0.7); position: fixed; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; ">
                    <div class="popup-content" style="margin-top: 10%;display: flex; justify-content: center;">
                        <h2 style="text-align: center;">Password updated successfully</h2>
                    </div>
                </div>
                <script>
                    function closePopup() {
                        document.querySelector(".popup").remove();
                    }
                    setTimeout(closePopup, 2000);
                    
                </script>';


        }
            

    
   
    }
    

    ?>
  
    <p style="text-align: center;">Coins: <?php echo $user['points']; ?> <br>1 Coin 1 Taka</p>
    <h1 class="coming-soon" style="animation: blink 1s infinite; text-align: center;">Coming Soon</h1>
    
</div>

<?php
include_once 'if.php';
?>
