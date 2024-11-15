<style>
    .box {
        background-color: #fff;
        border: 1px solid #ddd;
        padding: 20px;
        margin: 20px auto;
        width: 50%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .call {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
</style>

<?php
if(isset($_REQUEST['msg'])){
$msg=$_REQUEST['msg'];
echo "<br><br><center><div class='box'><h1 style='color: green; font-size: 2em'>".$msg."</h1></div></center>";
echo '
    <div class="box" style="text-align: center;">
        <h3 style="color: red;"><a href="tel:+8801632950179">Call IT Engineer 01632950179</a></h3>
    </div>
';
if($msg=="database error"){
echo "<div class='box' style='text-align: center;'><h3>Redirecting to dashboard in <span id='countdowntimer'>5</span> seconds...</h3></div>
<script>
var timeleft = 5;
var downloadTimer = setInterval(function(){
  document.getElementById('countdowntimer').innerHTML = timeleft;
  timeleft -= 1;
  if(timeleft <= 0){
    clearInterval(downloadTimer);
    window.location.href = '../index.php';
  }
}, 1000);
</script>";
}

}
?>


