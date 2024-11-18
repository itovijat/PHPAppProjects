<?php include_once "head2.php"; ?>


<?php
function stringToInt($str)
{
    $result = 0;

    for ($i = 0;$i < strlen($str);$i++)
    {
        $result = $result + (ord($str[$i]) * $i);

    }
    return $result;
}
if (isset($_POST['submitvisit']))
{

    $idmi = stringToInt($_SESSION['email']);

    $mo = $_POST['mo'];
    $route = $_POST['route'];
    $shop = $_POST['shop'];
    $phone = $_POST['phone'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $reason = $_POST['reason'];
    $idm = $idmi . $_POST['memo'];
    $company = $_SESSION['company'];
    $odate = date('Y.m.d');
    $ddate = date('Y.m.d', strtotime("+1 days"));
    $comment = $_POST['comment'];
    $serial = $_POST['serial'];

    $sql = "INSERT INTO visit (mo, route, shop, phone, latitude, longitude, reason, memo, company, odate, ddate, comment, serial) VALUES ('$mo', '$route', '$shop', '$phone', '$latitude', '$longitude', '$reason', '$idm', '$company', '$odate', '$ddate', '$comment', '$serial')";
    if (mysqli_query($conn, $sql))
    {

        echo "<script>alert('New record created successfully');window.location.href='visitlist.php';</script>";
    }
    else
    {
        echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($conn) . "');</script>";
    }

    $sql = "INSERT INTO route (name, company) SELECT '$route', '$company' FROM dual WHERE NOT EXISTS (SELECT 1 FROM route WHERE name='$route' AND company='$company')";
    if (mysqli_query($conn, $sql))
    {

    }
    else
    {
        echo "<script>alert('Error: " . addslashes($sql) . "\\n" . addslashes(mysqli_error($conn)) . "');</script>";
    }

    $sql = "INSERT INTO phone (name, company) SELECT '$phone', '$company' FROM 
    dual WHERE NOT EXISTS (SELECT 1 FROM phone WHERE name='$phone' AND company='$company')";
    if (mysqli_query($conn, $sql))
    {

    }
    else
    {
        echo "<script>alert('Error: " . addslashes($sql) . "\\n" . addslashes(mysqli_error($conn)) . "');</script>";
    }

    $sql = "INSERT INTO shop (name, company) SELECT '$shop', '$company' FROM 
    dual WHERE NOT EXISTS (SELECT 1 FROM shop WHERE name='$shop' AND company='$company')";
    if (mysqli_query($conn, $sql))
    {

    }
    else
    {
        echo "<script>alert('Error: " . addslashes($sql) . "\\n" . addslashes(mysqli_error($conn)) . "');</script>";
    }
}

?>



<div class="content">


    <div class="row">
        <div class="col-12 col-md-12" style="text-align: center;">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h2>Shop Visit Details</h2>
                </div>
                <div class="card-body">
            
<form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="form-row">
        <div class="form-group col-md-6 col-6">
            <label for="mo">Marketing Officer</label>
            <select class="form-control" id="mo" name="mo" required>
                <option value="" selected >Select MO</option>
                <?php
                $sql = "SELECT email FROM user WHERE role='sr' OR role='sradmin' AND company='".$_SESSION['company']."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        echo "<option value='".$row['email']."'>".$row['email']."</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-0 col-0" style="display:none;">
            <label for="reason">Reason</label>
            <select class="form-control" id="reason" name="reason" required>
                <option value="visit">visit</option>
                
            </select>
        </div>
   
        <div class="form-group col-md-6 col-6">
            <label for="memo">Memo [Auto]</label>
            <input type="number" class="form-control" id="memo" name="memo" value="<?php
date_default_timezone_set('Asia/Dhaka');
$tm = date('ymdHis', strtotime('2024-11-01 00:00:00'));
$tn = date('ymdHis');
$t = $tn - $tm - 14001500;

echo ($t);

?>" required>
        </div>
        
    </div>





    

    <div class="form-group">
        <label for="shop">Shop with Address</label>
        <select class="form-control select2" id="shop" name="shop" required>
        <option value="" selected>Example Store, Place</option>

            <?php
$sql = "SELECT name FROM shop WHERE company='" . $_SESSION['company'] . "' ORDER BY id DESC";

$shopResult = mysqli_query($conn, $sql);
if (mysqli_num_rows($shopResult) > 0)
{
    while ($shopRow = mysqli_fetch_assoc($shopResult))
    {
        echo "<option value='" . $shopRow['name'] . "'>" . $shopRow['name'] . "</option>";
    }
}
?>
        </select>    
    </div>

    <div class="form-row">
        <div class="form-group col-md-6 col-6">
            <label for="route">Route</label>
            <select class="form-control select2" id="route" name="route" required>
            <option value="" selected>Name</option>

                <?php
$sql = "SELECT name FROM route WHERE company='" . $_SESSION['company'] . "' ORDER BY id DESC";
$routeResult = mysqli_query($conn, $sql);
if (mysqli_num_rows($routeResult) > 0)
{
    while ($routeRow = mysqli_fetch_assoc($routeResult))
    {
        echo "<option value='" . $routeRow['name'] . "'>" . $routeRow['name'] . "</option>";
    }
}
?>
            </select>
        </div>
        <div class="form-group col-md-6 col-6">
            <label for="phone">Phone with Name</label>
            <select class="form-control select2" id="phone" name="phone" required>
            <option value="" selected>017XX Name</option>
                <?php
$sql = "SELECT name FROM phone WHERE company='" . $_SESSION['company'] . "' ORDER BY id DESC";
$phoneResult = mysqli_query($conn, $sql);
if (mysqli_num_rows($phoneResult) > 0)
{
    while ($phoneRow = mysqli_fetch_assoc($phoneResult))
    {
        echo "<option value='" . $phoneRow['name'] . "'>" . $phoneRow['name'] . "</option>";
    }
}
?>
            </select>    
        </div>
    </div>


    <div class="form-group" style="display:none;">
        <label for="latitude">Latitude</label>
        <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter Latitude" required>
    </div>
    <div class="form-group" style="display:none;">
        <label for="longitude">Longitude</label>
        <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Enter Longitude" required>
    </div>
    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById("latitude").value = position.coords.latitude;
                document.getElementById("longitude").value = position.coords.longitude;
            });
        }
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                
            }, function() {
                // if geolocation is blocked
                document.querySelector("form").style.display = "none";
                alert("Geolocation is blocked. Please allow geolocation permission in your browser settings to submit the form.");

            });
        } else {
            // if geolocation is not supported
            document.querySelector("form").style.display = "none";
                alert("Geolocation is not supported by this browser. Please allow geolocation permission in your browser settings to submit the form.");
            
        }
    </script>

    <div class="form-row">
    <div class="form-group col-md-2 col-5">
        <label for="serial">Serial</label>
        <input type="number" class="form-control" id="serial" name="serial" placeholder="For Delivery">
    </div>

    <div class="form-group col-md-10 col-7">
        <label for="comment">Comment</label>
        <input type="text" class="form-control" id="comment" name="comment" placeholder="Keep Empty">
        </div>
    </div>
    
    <button type="submit" name="submitvisit" class="btn btn-primary">Submit</button>
</form>




                </div>
            </div>
        </div>
        
    </div>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  

    
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-theme@0.1.0-beta.10/dist/select2-bootstrap.min.css" rel="stylesheet" />
    <style>
        .select2-container--bootstrap .select2-selection--single,
        .select2-container--bootstrap .select2-selection--multiple {
            width: 100% !important;
        }
        .select2-dropdown--bootstrap {
            width: auto !important; 
            min-width: 100%;
        }
    </style>
  
  
    <script>
       $(document).ready(function() {
            $('#route, #shop, #phone').select2({
                tags: true,
               theme: 'bootstrap',
                allowClear: true
            });
        });
    </script>
<?php include_once "foot.php"; ?>
