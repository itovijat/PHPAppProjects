<?php
// Database connection
include_once "head2.php";
  
$company=$_SESSION['company'];

// Handle form submission
if (isset($_POST['submit'])) {
    $vehicle_name = $_POST['vehicle_name'];
    $oil_quantity = $_POST['oil_quantity'];
    $oil_price = $_POST['oil_price'];
    $entry_date = $_POST['entry_date'];
    $driver_name = $_POST['driver_name'];
    $km=$_POST['km'];
    $remark=$_POST['remark'];



    // Check if the product exists
    $vehocle_check = $conn->query("SELECT id FROM vehicles WHERE name='$vehicle_name' AND company='$company' ");
    if ($vehocle_check->num_rows == 0) {
        // Insert new product if it doeid't exist
        $conn->query("INSERT INTO vehicles (name, company) VALUES ('$vehicle_name', '$company')");
    }

     // Check if the product exists
     $person_check = $conn->query("SELECT id FROM persons WHERE name='$driver_name' AND company='$company'");
     if ($person_check->num_rows == 0) {
         // Insert new product if it doeid't exist
         $conn->query("INSERT INTO persons (name, company) VALUES ('$driver_name', '$company')");
     }

    // check if the vehicle is present in the kpl table, if yes then update the distance from the last entry
    $check_vehicle = $conn->query("SELECT id, km FROM kpl WHERE vehicle_name='$vehicle_name' AND company='$company' ORDER BY id DESC LIMIT 1");
    if ($check_vehicle->num_rows > 0) {
        $row = $check_vehicle->fetch_assoc();
        $last_km = $row['km'];
        if($last_km < $km){
            $distance = $km - $last_km;
            $conn->query("UPDATE kpl SET  distance='$distance' WHERE id=".$row['id']);
            $sql = "INSERT INTO kpl (vehicle_name, oil_quantity, oil_price, entry_date, driver_name,  company, km, remark)
        VALUES ('$vehicle_name', '$oil_quantity', '$oil_price', '$entry_date', '$driver_name', '$company' , '$km', '$remark' )";

if ($conn->query($sql) === TRUE) {
   //alert
    echo "<script>alert('Record added successfully');</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
        }else{
            echo "<script>alert('Last km is not less than current km');</script>";
         
        }
    } else{

        $sql = "INSERT INTO kpl (vehicle_name, oil_quantity, oil_price, entry_date, driver_name,  company, km, remark)
        VALUES ('$vehicle_name', '$oil_quantity', '$oil_price', '$entry_date', '$driver_name', '$company' , '$km', '$remark' )";

if ($conn->query($sql) === TRUE) {
   //alert
    echo "<script>alert('Record added successfully');</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    }

        

    


   
}



// Fetch vehicles for the select field
$vehicle_result = $conn->query("SELECT name FROM vehicles WHERE company='$company'");

// Fetch vehicles for the select field
$person_result = $conn->query("SELECT name FROM persons WHERE company='$company'");

// Fetch kpl list
$kpl_result = $conn->query("SELECT * FROM kpl  WHERE company='$company' ORDER BY id DESC LIMIT 10");
?>


   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    

        $(document).ready(function() {
            

            // Initialize select2 for dynamic select fields
            $('#vehicle_name, #driver_name').select2({
                tags: true,
                placeholder: 'Select or add an option',
                allowClear: true
            });
        });


        
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <div class="content">
        <div class="row">
            <div class="col">
                <div class="form-container">
                    <form method="post" action="">
                        <div class="card">
                            <div class="card-header">
                                KPL Entry Form
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="vehicle_name" class="control-label">Vehicle Name/Number</label>
                                    <select id="vehicle_name" name="vehicle_name" class="form-control">
                                        <?php while ($row = $vehicle_result->fetch_assoc()): ?>
                                            <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="oil_quantity" class="control-label">Oil Litre</label>
                                            <input type="number" step="0.01" id="oil_quantity" name="oil_quantity" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="oil_price" class="control-label">Price</label>
                                            <input type="number" step="0.01" id="oil_price" name="oil_price" class="form-control" required>
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="km" class="control-label">KM</label>
                                            <input type="number" step="0.01" id="km" name="km" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="entry_date" class="control-label">Entry Date</label>
                                            <input type="date" id="entry_date" name="entry_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="driver_name" class="control-label">Driver Name</label>
                                        <select id="driver_name" name="driver_name" class="form-control">
                                            <?php while ($row = $person_result->fetch_assoc()): ?>
                                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="remark" class="control-label">Remark</label>
                                        <input type="text" id="remark" name="remark" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name= "submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col">
                <div class="kpl-container" >
                    <h2>kpl List</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="myTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Vehicle</th>
                                    <th>Oil</th>
                                    <th>Price</th>
                                    <th>KM Reading</th>
                                    <th>Distance</th>
                                    <th>Entry</th>
                                    <th>Driver</th>
                                    <th>Remark</th>
                             
                               
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $kpl_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $row['vehicle_name']; ?></td>
                                        <td><?php echo $row['oil_quantity']; ?></td>
                                        <td><?php echo $row['oil_price']; ?></td>
                                        <td><?php echo $row['km']; ?></td>
                                        <td><?php echo $row['distance']; ?></td>
                                        <td><?php echo $row['entry_date']; ?></td>
                                        <td><?php echo $row['driver_name']; ?></td>
                                        <td><?php echo $row['remark']; ?></td>
                        
                                        <td>
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="deletebtn" class="btn btn-outline-danger">Delete</button>
                                            </form>
                                        
                                        <?php 
                                            if (isset($_POST['deletebtn'])) {
                                                $id = $_POST['id'];
                                                $sql = "DELETE FROM kpl WHERE id='$id'";
                                                if (mysqli_query($conn, $sql)) {
                                                  //alert
                                                  echo "<script>alert('Record deleted successfully');</script>";
                                                  //redirect
                                                  echo "  <script>location.replace('".basename($_SERVER['PHP_SELF'])."')</script>";
                                                  die();
                                                } else {
                                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                                }
                                            }
                                        ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                 
                </div>
            </div>
        </div>
    </div>

 


<?php
$conn->close();
include "foot.php";
?>

