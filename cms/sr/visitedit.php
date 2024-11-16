<?php include_once "head2.php"; ?>






<div class="content">
  

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h2 style="text-align: center;">Visit Edit</h2>
                </div>
                <div class="card-body">
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display:none;" id="msg">
                        <strong>Success!</strong> Record updated successfully.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
if (isset($_POST['updatevisit']))
{
    $sql = "UPDATE visit SET route='" . $_POST['route'] . "', shop='" . $_POST['shop'] . "', phone='" . $_POST['phone'] . "', serial='" . $_POST['serial'] . "', memo='" . $_POST['memo'] . "' WHERE id='" . $_POST['visitedit'] . "'";
    if (mysqli_query($conn, $sql))
    {

        echo "<script>alert('Record updated successfully'); location.replace('visitlist.php');</script>";

    }
    else
    {
        echo "Error updating record: " . mysqli_error($conn);
    }

    $route = $_POST['route'];
    $shop = $_POST['shop'];
    $phone = $_POST['phone'];
    $company = $_SESSION['company'];

    $sql = "INSERT INTO route (name, company) SELECT '$route', '$company' FROM dual WHERE NOT EXISTS (SELECT 1 FROM route WHERE name='$route' AND company='$company')";
    if (mysqli_query($conn, $sql))
    {

    }
    else
    {
        echo "<script>alert('Error: $sql " . mysqli_error($conn) . "');</script>";
    }

    $sql = "INSERT INTO phone (name, company) SELECT '$phone', '$company' FROM 
    dual WHERE NOT EXISTS (SELECT 1 FROM phone WHERE name='$phone' AND company='$company')";
    if (mysqli_query($conn, $sql))
    {

    }
    else
    {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }

    $sql = "INSERT INTO shop (name, company) SELECT '$shop', '$company' FROM 
    dual WHERE NOT EXISTS (SELECT 1 FROM shop WHERE name='$shop' AND company='$company')";
    if (mysqli_query($conn, $sql))
    {

    }
    else
    {
        echo "<script>alert('Error: $sql " . mysqli_error($conn) . "');</script>";
    }
}

if (!isset($_GET['visitedit']))
{
    echo "<script>alert('No record found'); location.replace('visitlist.php');</script>";
    die();
}
$sql = "SELECT * FROM visit WHERE id='" . $_GET['visitedit'] . "'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{
    while ($row = mysqli_fetch_assoc($result))
    {
?>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                          
                             <div class="form-group">
        <label for="route">Route:</label>
        <select class="form-control select2" id="route" name="route" required>

        
            <?php
        echo "<option value='" . $row['route'] . "'>" . $row['route'] . "</option>";

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

    <div class="form-group">
        <label for="shop">Shop:</label>
        <select class="form-control select2" id="shop" name="shop" required>
            <?php
        echo "<option value='" . $row['shop'] . "'>" . $row['shop'] . "</option>";

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
        </select>    </div>
    <div class="form-group">
        <label for="phone">Phone:</label>
        <select class="form-control select2" id="phone" name="phone" required>
            <?php
        echo "<option value='" . $row['phone'] . "'>" . $row['phone'] . "</option>";

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
        </select>    </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-6">
                                    <label for="memo">Memo:</label>
                                    <input type="text" class="form-control" id="memo" name="memo" value="<?php echo $row['memo']; ?>" readonly>
                                </div>
                                <div class="form-group col-md-6 col-6">
                                    <label for="serial">Serial:</label>
                                    <input type="number" class="form-control" id="serial" name="serial" value="<?php echo $row['serial']; ?>" required>
                                </div>
                            </div>
                        

                            <input type="hidden" name="visitedit" value="<?php echo $_GET['visitedit']; ?>">
                            <div style="text-align: center;"><button type="button" onclick="window.history.back()" class="btn btn-secondary">Back</button> <button type="submit" name="updatevisit" class="btn btn-primary">Update</button></div>
                            </form>
                            <?php
    }
}
else
{
    echo "0 results";
}

?>
            

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
