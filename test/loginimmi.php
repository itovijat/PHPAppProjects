<?php
include_once 'head.php';
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  
    <div style="width:100%; height:250px; background-color: #103b5e;"></div>
    <div class="content" style="margin-top:-280px; color: white;">
        <h1 >VFS Global Immi Account</h1>
        <p >VFS Global is the exclusive service provider for the Government of many countries, authorized to provide administrative support services to visa applicants.</p>
 
    </div>
    

    <div style="display: flex; justify-content: center; align-items: center; margin-top: 100px; margin:20px;">
        <div style="width: 500px; background-color: white; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
            <h2 style="text-align: center; color: #666; font-weight: bold; margin-bottom: 20px;">Login</h2>
            <form action="trackpassport.php" method="post" style="display: flex; flex-direction: column; align-items: center; margin-right: 20px;">
                <div class="form-group" style="width: 100%; margin-bottom: 20px;">
                    <label style="color: #666; display: block; text-align: center; margin-bottom: 10px;" for="refference">User Name:</label>
                    <input style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; width: 100%;" type="text" class="form-control" id="refference" name="refference" required>
                </div>
                <div class="form-group" style="width: 100%; margin-bottom: 20px;">
                    <label style="color: #666; display: block; text-align: center; margin-bottom: 10px;" for="password">Password:</label>
                    <div style="position: relative;">
                        <input style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; width: 100%;" type="password" class="form-control" id="password" name="password" required>
                        <i style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;" class="fa fa-eye" id="togglePassword"></i>
                    </div>
                </div>
                <script>
                    const togglePassword = document.querySelector('#togglePassword');
                    const password = document.querySelector('#password');
                    togglePassword.addEventListener('click', function (e) {
                        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                        password.setAttribute('type', type);
                        this.classList.toggle('fa-eye-slash');
                    });
                </script>
               
               
               <?php
                $rand1 = rand(1,10);
                $rand2 = rand(1,10);
                ?>
                <div class="form-group" style="width: 100%; margin-bottom: 20px;">
                    <label style="color: #666; display: block; text-align: center; margin-bottom: 10px;" for="check"><?php echo $rand1 ." + ". $rand2." = "; ?></label>
                    <input style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; width: 100%;" type="number" class="form-control" id="check" name="check" required oninput="checkValidation()">
                </div>

                <script>
                    function checkValidation(){
                        var check = document.getElementById("check").value;
                        var calc = <?php echo $rand1 + $rand2; ?>;
                        if(check != calc){
                            document.querySelector(".btn-primary").disabled = true;
                            document.getElementById("check").style.border = "1px solid red";
                        }else{
                            document.querySelector(".btn-primary").disabled = false;
                            document.getElementById("check").style.border = "1px solid #ccc";
                        }
                    }
                </script>



                <div style="display: flex; justify-content: center; align-items: center;" class="form-group">
                    <button style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>


   <?php
   include_once 'foot.php';
   ?>