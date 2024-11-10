<?php include_once "head2.php"; ?>






<div class="content">
    <!-- Main content goes here -->

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Visit Edit</h2>
                </div>
                <div class="card-body">
       
                    <?php

if(isset($_POST['route'])){
    $sql = "UPDATE visit SET route='".$_POST['route']."', shop='".$_POST['shop']."', phone='".$_POST['phone']."', reason='".$_POST['reason']."', memo='".$_POST['memo']."' WHERE SN='".$_POST['visitedit']."'";
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
        echo "<script>alert('Record updated successfully'); location.replace('visitlist.php');</script>";

    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    $route = $_POST['route'];
    $shop = $_POST['shop'];
    $phone = $_POST['phone'];
    $company = $_SESSION['company'];

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


if(!isset($_GET['visitedit'])){
    echo "<script>alert('No record found'); location.replace('visitlist.php');</script>";
    die();
}
                    $sql = "SELECT * FROM visit WHERE SN='".$_GET['visitedit']."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                          
                             <div class="form-group">
        <label for="route">Route:</label>
        <select class="form-control select2" id="route" name="route" required>

        
            <?php

echo "<option value='" . $row['route'] . "'>" . $row['route']  . "</option>";

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

    <div class="form-group">
        <label for="shop">Shop:</label>
        <select class="form-control select2" id="shop" name="shop" required>
            <?php

echo "<option value='" . $row['shop'] . "'>" . $row['shop']  . "</option>";

                                    $sql = "SELECT name FROM shop WHERE company='" . $_SESSION['company'] . "' ORDER BY id DESC";

            $shopResult = mysqli_query($conn, $sql);
            if (mysqli_num_rows($shopResult) > 0) {
                while ($shopRow = mysqli_fetch_assoc($shopResult)) {
                    echo "<option value='" . $shopRow['name'] . "'>" . $shopRow['name'] . "</option>";
                }
            }
            ?>
        </select>    </div>
    <div class="form-group">
        <label for="phone">Phone:</label>
        <select class="form-control select2" id="phone" name="phone" required>
            <?php
            echo "<option value='" . $row['phone'] . "'>" . $row['phone']  . "</option>";

            $sql = "SELECT name FROM phone WHERE company='" . $_SESSION['company'] . "' ORDER BY id DESC";
            $phoneResult = mysqli_query($conn, $sql);
            if (mysqli_num_rows($phoneResult) > 0) {
                while ($phoneRow = mysqli_fetch_assoc($phoneResult)) {
                    echo "<option value='" . $phoneRow['name'] . "'>" . $phoneRow['name'] . "</option>";
                }
            }
            ?>
        </select>    </div>
                            <div class="form-group">
                                <label for="memo">Memo:</label>
                                <input type="text" class="form-control" id="memo" name="memo" value="<?php echo $row['memo']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="reason">Reason:</label>
                                <select class="form-control" id="reason" name="reason" required>
                                    <option value="visit" <?php if($row['reason']=="visit"){echo "selected";}?>>visit</option>
                                    <option value="order" <?php if($row['reason']=="order"){echo "selected";}?>>order</option>
                                </select>
                            </div>

                            <input type="hidden" name="visitedit" value="<?php echo $_GET['visitedit']; ?>">
                            <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                            <?php
                        }
                    } else {
                        echo "0 results";
                    }

               
                    ?>
            

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
