<?php include_once "head2.php"; ?>


<?php

$sql = "CREATE TABLE IF NOT EXISTS route (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20),
    company VARCHAR(20)
)";

if (mysqli_query($conn, $sql)) {
    // echo "Table created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

$sql = "CREATE TABLE IF NOT EXISTS shop (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    company VARCHAR(20)
)";

if (mysqli_query($conn, $sql)) {
    // echo "Table created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

$sql = "CREATE TABLE IF NOT EXISTS phone (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20),
    company VARCHAR(20)
)";

if (mysqli_query($conn, $sql)) {
    // echo "Table created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
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
    memo VARCHAR(20), 
    company VARCHAR(10),
    odate DATE,
    ddate DATE,
    comment VARCHAR(50),
     serial INT default 0,
    
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


    $sql = "INSERT INTO route (name, company) SELECT '$route', '$company' FROM dual WHERE NOT EXISTS (SELECT 1 FROM route WHERE name='$route' AND company='$company')";
    if (mysqli_query($conn, $sql)) {
        // echo "New route created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql = "INSERT INTO phone (name, company) SELECT '$phone', '$company' FROM 
    dual WHERE NOT EXISTS (SELECT 1 FROM phone WHERE name='$phone' AND company='$company')";
    if (mysqli_query($conn, $sql)) {
        // echo "New route created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql = "INSERT INTO shop (name, company) SELECT '$shop', '$company' FROM 
    dual WHERE NOT EXISTS (SELECT 1 FROM shop WHERE name='$shop' AND company='$company')";
    if (mysqli_query($conn, $sql)) {
        // echo "New route created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}



?>



<div class="content">
    <!-- Main content goes here -->

    <div class="row">
        <div class="col-12 col-md-12" style="text-align: center;">
            <div class="card">
                <div class="card-header">
                    <h2>Visit Details</h2>
                </div>
                <div class="card-body">
            
<form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="form-row">
        <div class="form-group col-md-4 col-2">
            <label for="mo">MO:</label>
            <input type="text" class="form-control" id="mo" name="mo" placeholder="Enter MO" value="<?php echo $_SESSION['email']; ?>" readonly required>
        </div>
        <div class="form-group col-md-4 col-4">
            <label for="reason">Reason:</label>
            <select class="form-control" id="reason" name="reason" required>
                <option value="visit">visit</option>
                <option value="order">order</option>
            </select>
        </div>
   
        <div class="form-group col-md-4 col-6">
            <label for="memo">Memo:</label>
            <input type="text" class="form-control" id="memo"  name="memo"  value="<?php 
            
date_default_timezone_set('Asia/Dhaka');
            $t = time() ;

            
            function stringToInt($str) {
                $result = 0;
                
                for ($i = 0; $i < strlen($str); $i++) {
                    $result = $result + (ord($str[$i])*$i);  // ord() returns the ASCII value of the character
                 
                }
                return $result;
            }
            

            function intToAlphanumeric($num) {
                return strtoupper(base_convert($num, 10, 36)); // Converts a base-10 integer to a base-36 string and makes it uppercase
            }
            

            // Example usage:
            $t = intToAlphanumeric($t);
           
            


            $converted_value = intToAlphanumeric(stringToInt('Mehedi12Soft'));
            echo ($converted_value ."-". $t);
                    
            ?>" maxlength="10" required>
        </div>
    </div>





    

    <div class="form-group">
        <label for="shop">Shop with Address:</label>
        <select class="form-control select2" id="shop" name="shop" required>
        <option value="" selected>Select</option>

            <?php
                        $sql = "SELECT name FROM shop WHERE company='" . $_SESSION['company'] . "' ORDER BY id DESC";

            $shopResult = mysqli_query($conn, $sql);
            if (mysqli_num_rows($shopResult) > 0) {
                while ($shopRow = mysqli_fetch_assoc($shopResult)) {
                    echo "<option value='" . $shopRow['name'] . "'>" . $shopRow['name'] . "</option>";
                }
            }
            ?>
        </select>    
    </div>

    <div class="form-row">
        <div class="form-group col-md-6 col-6">
            <label for="route">Route:</label>
            <select class="form-control select2" id="route" name="route" required>
            <option value="" selected>Select</option>

                <?php
                $sql = "SELECT name FROM route WHERE company='" . $_SESSION['company'] . "' ORDER BY id DESC";
                $routeResult = mysqli_query($conn, $sql);
                if (mysqli_num_rows($routeResult) > 0) {
                    while ($routeRow = mysqli_fetch_assoc($routeResult)) {
                        echo "<option value='" . $routeRow['name'] . "'>" . $routeRow['name'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-6 col-6">
            <label for="phone">Phone:</label>
            <select class="form-control select2" id="phone" name="phone" required>
            <option value="" selected>Select</option>
                <?php
                $sql = "SELECT name FROM phone WHERE company='" . $_SESSION['company'] . "' ORDER BY id DESC";
                $phoneResult = mysqli_query($conn, $sql);
                if (mysqli_num_rows($phoneResult) > 0) {
                    while ($phoneRow = mysqli_fetch_assoc($phoneResult)) {
                        echo "<option value='" . $phoneRow['name'] . "'>" . $phoneRow['name'] . "</option>";
                    }
                }
                ?>
            </select>    
        </div>
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
        <label for="comment">Comment:</label>
        <input type="text" class="form-control" id="comment" name="comment" placeholder="Enter comment">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>




                </div>
            </div>
        </div>
        
    </div>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
       $(document).ready(function() {
           

            // Initialize select2 for dynamic select fields
            $('#route, #shop, #phone').select2({
                tags: true,
                placeholder: 'Select or add an option',
                allowClear: true
            });
        });
    </script>
<?php include_once "foot.php"; ?>
