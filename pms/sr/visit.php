<?php include_once "head2.php"; ?>


<?php
$sql = "CREATE TABLE IF NOT EXISTS visit (
    SN INT AUTO_INCREMENT PRIMARY KEY,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    mo VARCHAR(20),
    route VARCHAR(20),
    shop VARCHAR(50),
    phone VARCHAR(20),
    latitude DECIMAL(10,8),
    longitude DECIMAL(11,8),
    reason VARCHAR(5),
    memo VARCHAR(10), 
    company VARCHAR(10),
    odate DATE,
    ddate DATE,
    comment VARCHAR(20),
    
    status SMALLINT(1) DEFAULT 0
    )";
if (mysqli_query($conn, $sql)) {
    // echo "Table created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}


if (isset($_POST['mo'])) {
    $mo = $_POST['mo'];
    $route = $_POST['route'];
    $shop = $_POST['shop'];
    $phone = $_POST['phone'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $reason = $_POST['reason'];
    $memo = $_POST['memo'];
    $company = $_SESSION['company'];
    $odate = date('Y.m.d');
    $ddate = date('Y.m.d', strtotime("+1 days"));
    $comment = $_POST['comment'];
    
    $sql = "INSERT INTO visit (mo, route, shop, phone, latitude, longitude, reason, memo, company, odate, ddate, comment) VALUES ('$mo', '$route', '$shop', '$phone', '$latitude', '$longitude', '$reason', '$memo', '$company', '$odate', '$ddate', '$comment')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        echo "<script>alert('New record created successfully');window.location.href='visitlist.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}



?>



<div class="content">
    <!-- Main content goes here -->

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Visit Details</h2>
                </div>
                <div class="card-body">
            
<form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="form-group">
        <label for="mo">MO:</label>
        <input type="text" class="form-control" id="mo" name="mo" placeholder="Enter MO" value="<?php echo $_SESSION['email']; ?>" readonly required>
    </div>
    <div class="form-group">
        <label for="route">Route:</label>
        <input type="text" class="form-control" id="route" name="route" placeholder="Enter Route" required>
    </div>
    <div class="form-group">
        <label for="shop">Shop:</label>
        <input type="text" class="form-control" id="shop" name="shop" placeholder="Enter Shop Name" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required>
    </div>
    <div class="form-group" style="display:none;">
        <label for="latitude">Latitude:</label>
        <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter Latitude" required>
    </div>
    <div class="form-group" style="display:none;">
        <label for="longitude">Longitude:</label>
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
    <div class="form-group">
        <label for="reason">Reason:</label>
        <select class="form-control" id="reason" name="reason" required>
            <option value="visit">visit</option>
            <option value="order">order</option>
        </select>
    </div>
    <div class="form-group">
        <label for="memo">Memo:</label>
        <input type="number" class="form-control" id="memo" name="memo" value="<?php echo time(); ?>" required>
    </div>
    <div class="form-group">
        <label for="comment">Comment:</label>
        <input type="text" class="form-control" id="comment" name="comment" placeholder="Enter comment">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>




                </div>
            </div>
        </div>
        
    </div>

<?php include_once "foot.php"; ?>
