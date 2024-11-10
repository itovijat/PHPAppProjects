<?php include_once "head2.php"; ?>


<?php
$sql = "CREATE TABLE IF NOT EXISTS orders (
    SN INT AUTO_INCREMENT PRIMARY KEY,
    snvisit VARCHAR(10),
    pn VARCHAR(30),
    unit FLOAT,
    rate FLOAT,

    quantity FLOAT
)";
if (mysqli_query($conn, $sql)) {
    // echo "Table created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}


if (isset($_GET['orderdel'])) {
    $sql = "SELECT status FROM visit WHERE SN='".$_GET['order']."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['status'] == 0) {
            $sql = "DELETE FROM orders WHERE SN='".$_GET['orderdel']."'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Record deleted successfully');window.location.href='order.php?order=".$_GET['order']."';</script>";
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('Order already accepted or canceled. Can't delete.');</script>";
        }
    } else {
        echo "<script>alert('Order already accepted or canceled. Can't delete.');</script>";
    }
}
if (isset($_POST['pn'])) {
    $snvisit = $_POST['snvisit'];
    $pn = $_POST['pn'];
    $unit = $_POST['unit'];
    $rate = $_POST['rate'];
    $quantity = $_POST['quantity'];
    $sql = "INSERT INTO orders (snvisit, pn, unit, rate, quantity) VALUES ('$snvisit', '$pn', '$unit', '$rate', '$quantity')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        echo "<script>window.location.href='order.php?order=".$snvisit."';</script>";
        
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql = "UPDATE visit SET reason='order' WHERE SN='".$_POST['snvisit']."'";
    if (mysqli_query($conn, $sql)) {
        // echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}


?>


<div class="content">
    <!-- Main content goes here -->

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Order Add</h2>
                </div>
                <div class="card-body">


                    <?php
                    $sql = "SELECT * FROM visit WHERE SN='".$_GET['order']."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "SN Visit: ".$row['SN']."<br>";
                            echo "Date: ".$row['date']."<br>";
                            echo "Route: ".$row['route']."<br>";
                            echo "Shop: ".$row['shop']."<br>";
                            echo "Phone: ".$row['phone']."<br>";
                            echo "Latitude: ".$row['latitude']."<br>";
                            echo "Longitude: ".$row['longitude']."<br>";
                            echo "Reason: ".$row['reason']."<br>";
                           
                            $order = $_GET['order'];
                            if($row['status'] != 0){
                                echo "<form action='order.php?order=".$order."' method='POST'>";
                                echo "Memo: <input type='number' name='memo' value='".$row['memo']."' required readonly>";
                                echo " ODate: <input type='text' name='odate' value='".date('Y.m.d', strtotime($row['odate']))."' required pattern='[0-9]{4}\.[0-9]{2}\.[0-9]{2}' title='Year.Month.Day' readonly>";
                                echo " DDate: <input type='text' name='ddate' value='".date('Y.m.d', strtotime($row['ddate']))."' required pattern='[0-9]{4}\.[0-9]{2}\.[0-9]{2}' title='Year.Month.Day' readonly>";
                                echo " Comment: <input type='text' name='comment' value='".$row['comment']."' maxlength='20' readonly>";
                                echo "<input type='submit' value='Cant Update' disabled>";
                                echo "</form>";
                            } else {
                                echo "<form action='order.php?order=".$order."' method='POST'>";
                                echo "Memo: <input type='number' name='memo' value='".$row['memo']."' required>";
                                echo " ODate: <input type='text' name='odate' value='".date('Y.m.d', strtotime($row['odate']))."' required pattern='[0-9]{4}\.[0-9]{2}\.[0-9]{2}' title='Year.Month.Day'>";
                                echo " DDate: <input type='text' name='ddate' value='".date('Y.m.d', strtotime($row['ddate']))."' required pattern='[0-9]{4}\.[0-9]{2}\.[0-9]{2}' title='Year.Month.Day'>";
                                echo " Comment: <input type='text' name='comment' value='".$row['comment']."' maxlength='20' >";
                                echo "<input type='submit' value='Update'>";
                                echo "</form>";
                            }
                            echo "<br>";
                            
                        }
                    }

                    if (isset($_POST['memo'])) {
                        $sql = "UPDATE visit SET memo='".$_POST['memo']."', odate='".$_POST['odate']."', ddate='".$_POST['ddate']."', comment='".$_POST['comment']."' WHERE SN='".$_GET['order']."'";
                        if (mysqli_query($conn, $sql)) {
                            echo "Record updated successfully";
                            echo "<script>window.location.href='order.php?order=".$_GET['order']."';</script>";
                        } else {
                            echo "Error updating record: " . mysqli_error($conn);
                        }
                    }


                    $sql = "SELECT * FROM orders WHERE snvisit='".$_GET['order']."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table class='table'>";
                        echo "<thead>";
                        echo "<tr>";
                      
                        echo "<th>Product</th>";
                        
                        echo "<th>Unit</th>";
                        echo "<th>Rate</th>";
                        echo "<th>Quantity</th>";
                        echo "<th>Total</th>";
                        echo "<th>Action</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                      
                            echo "<td>".$row['pn']."</td>";
                            echo "<td>".$row['unit']."</td>";
                            echo "<td>".$row['rate']."</td>";
                            echo "<td>".$row['quantity']."</td>";
                            echo "<td>".($row['rate']*$row['quantity'])."</td>";
                            
                            echo "<td><a href='order.php?orderdel=".$row['SN']."&order=".$_GET['order']."' class='btn btn-danger'>Delete</a></td>";
                            
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";

                        
                    } else {
                        echo "No orders found";


                        $sql = "UPDATE visit SET reason='visit' WHERE SN='".$_GET['order']."'";
                        if (mysqli_query($conn, $sql)) {
                            // echo "Record updated successfully";
                        } else {
                            echo "Error updating record: " . mysqli_error($conn);
                        }
                    }
                    ?>
                
       
                    <?php
                    $sql = "SELECT status FROM visit WHERE SN='".$_GET['order']."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        if($row['status']=="0"){
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <div class="form-group" style="display:none;">
                            <label for="snvisit">SN Visit:</label>
                            <input type="text" class="form-control" id="snvisit" name="snvisit" value="<?php echo $_GET['order']; ?>" required>
                        </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="pn">PN:</label>
                            <input type="text" class="form-control" id="pn" name="pn" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="unit">Unit:</label>
                            <input type="number" class="form-control" id="unit" name="unit" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="rate">Rate:</label>
                            <input type="number" class="form-control" id="rate" name="rate" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="quantity">Quantity:</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="form-group col-md-1" style=" float: center;">
                        <button type="submit" class="btn btn-primary" style="height: 100%;">Add</button>

                        </div>
                    </div>
                    </form>
                    <?php
                        }

                        if($row['status']=="1"){
                            echo "<h3>Order Accepted</h3>";
                        }elseif($row['status']=="2"){
                            echo "<h3>Order Canceled</h3>";
                        }
                        
                    }
                    ?>
                    
            

                </div>
            </div>
        </div>
        
    </div>

<?php include_once "foot.php"; ?>
