<?php
include_once 'head2.php';

?>


<script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
            }, function() {
                // if geolocation is blocked
                alert("Geolocation is blocked. Please allow geolocation permission in your browser settings to submit the form.");
                

            });
        } else {
            // if geolocation is not supported
                alert("Geolocation is not supported by this browser. Please allow geolocation permission in your browser settings to submit the form.");
            
        }
    </script>
<?php
if (!mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deliverydate` date NOT NULL,
  `route` varchar(20) NOT NULL,
  `shop` varchar(100) NOT NULL,
  `comment` varchar(50) NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `company` varchar(10) NOT NULL,
  `soid` int(11) NOT NULL,
  `status` tinyint(1) default 0,
  `deliveryslip` int(11) NULL,

  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci"))
{
    echo "Error creating table: " . mysqli_error($conn);
}

if(isset($_POST['submit'])){
    $deliverydate = $_POST['deliverydate'];
    $route = $_POST['route'];
    $shop = $_POST['shop'];

    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $company = $_SESSION['company'];
    $soid = $_SESSION['userid'];
    
    if (isset($_POST['comment']) && !empty($_POST['comment'])) {
    $comment = $_POST['comment'];
    $sql = "INSERT INTO visits (deliverydate, route, shop, comment, latitude, longitude, company, soid) VALUES ('$deliverydate', '$route', '$shop', '$comment', '$latitude', '$longitude', '$company', '$soid')";
}
else {
    $sql = "INSERT INTO visits (deliverydate, route, shop, latitude, longitude, company, soid) VALUES ('$deliverydate', '$route', '$shop', '$latitude', '$longitude', '$company', '$soid')";
}
   
    if (!mysqli_query($conn, $sql))
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    else
    {
        echo "<script>alert('Visit added successfully'); location.replace('visitlist.php');</script>";
    }
}

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white text-center">
                    <h2>Visit Shop</h2>
                </div>
                <div class="card-body">
                    <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="form-row">
                            

                            <div class="form-group col-md-6">
                                <label for="deliverydate">Delivery Date</label>
                                <input type="date" class="form-control" id="deliverydate" name="deliverydate" value="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="route">Route</label>
                                <input type="text" class="form-control" id="route" name="route" placeholder="Enter Route" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="shop">Shop</label>
                                <input type="text" class="form-control" id="shop" name="shop" placeholder="Enter Shop" required>
                            </div>
                      
                       
                            <div class="form-group col-md-12">
                                <label for="comment">Comment</label>
                                <input type="text" class="form-control" id="comment" name="comment" placeholder="Enter Comment" >
                            </div>
                        </div>
                        <div class="form-row d-none">
                            <div class="form-group col-md-6">
                                <label for="latitude">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter Latitude" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="longitude">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Enter Longitude" readonly>
                            </div>
                        </div>
                        <script>
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(function(position) {
                                    document.getElementById('latitude').value = position.coords.latitude;
                                    document.getElementById('longitude').value = position.coords.longitude;
                                });
                            } else {
                                alert("Geolocation is not supported by this browser.");
                               
                            
                            }
                        </script>
                       
                        
                        <button type="submit" name="submit" class="btn btn-success btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





<?php
include_once 'hfoot.php';

?>