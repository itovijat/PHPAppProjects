<?php
// Database connection
include_once "head2.php";
  
$company=$_SESSION['company'];

// Handle form submission
if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $in_quantity = $_POST['in_quantity'];
    $out_quantity = $_POST['out_quantity'];
    $entry_date = $_POST['entry_date'];
    $person_name = $_POST['person_name'];
    $expiry_date = $_POST['expiry_date'];
    $remark = $_POST['remark'];
    $value = $_POST['value'];

    // Check if the product exists
    $product_check = $conn->query("SELECT id FROM products WHERE name='$product_name' AND company='$company' ");
    if ($product_check->num_rows == 0) {
        // Insert new product if it doeid't exist
        $conn->query("INSERT INTO products (name, company) VALUES ('$product_name', '$company')");
    }

     // Check if the product exists
     $person_check = $conn->query("SELECT id FROM persons WHERE name='$person_name' AND company='$company'");
     if ($person_check->num_rows == 0) {
         // Insert new product if it doeid't exist
         $conn->query("INSERT INTO persons (name, company) VALUES ('$person_name', '$company')");
     }

    $sql = "INSERT INTO inventory (product_name, in_quantity, out_quantity, entry_date, person_name, expiry_date, remark, value, company)
            VALUES ('$product_name', '$in_quantity', '$out_quantity', '$entry_date', '$person_name', '$expiry_date', '$remark', '$value', '$company' )";

    if ($conn->query($sql) === TRUE) {





       //alert
        echo "<script>alert('Record added successfully');</script>";

      // data to google sheet
    

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



// Fetch products for the select field
$product_result = $conn->query("SELECT name FROM products WHERE company='$company'");

// Fetch products for the select field
$person_result = $conn->query("SELECT name FROM persons WHERE company='$company'");

// Fetch inventory list
$inventory_result = $conn->query("SELECT * FROM inventory WHERE company='$company' ORDER BY id DESC LIMIT 10");
?>


   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleQuantityFields() {
            const inQuantity = document.getElementById('in_quantity');
            const outQuantity = document.getElementById('out_quantity');

            inQuantity.addEventListener('input', function() {
                if (this.value) {
                    outQuantity.value = 0.0;
                    outQuantity.readOnly = true;
                } else {
                    outQuantity.readOnly = false;
                }
            });

            outQuantity.addEventListener('input', function() {
                if (this.value) {
                    inQuantity.value = 0.0;
                    inQuantity.readOnly = true;
                } else {
                    inQuantity.readOnly = false;
                }
            });
        }

        $(document).ready(function() {
            toggleQuantityFields();

            // Initialize select2 for dynamic select fields
            $('#product_name, #person_name').select2({
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
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-4 d-flex justify-content-center">
                            <button type="button" class="btn btn-outline-primary" style="height: 100%;" onclick="stock()">Show Stock</button>
                        </div>
                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <div class="input-group mb-3 align-items-center justify-content-cente">
                              
                                <input type="text" class="form-control" placeholder="Stock" id="stock" style="height: 100%; font-size: calc(1em + 0.5vw);" aria-label="Username" aria-describedby="basic-addon1" readonly>
                            </div>
                        </div>

                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-outline-primary" style="height: 100%;" onclick="req()">+ Requisition</button>
                        </div>
                       
                    </div>
                    <br>
                  
                    <script>
                        function stock() {

                            var product_name = document.getElementById('product_name').value;
                            var xhr = new XMLHttpRequest();
                            xhr.open('GET', 'istock.php?product_name='+product_name, true);
                            xhr.onload = function() {
                                if (xhr.status === 200) {
                                    document.getElementById('stock').value = xhr.responseText;
                                }
                            }
                            xhr.send();
                        }

                        function req() {

                            var product_name = document.getElementById('product_name').value;
                          
                            window.location.href = 'itemreq.php?product_name='+product_name;
                           
                        }
                    </script>

                   
                   
                    <form method="post" action="">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Item</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product_name" class="control-label">Product Name</label>
                                    <select id="product_name" name="product_name" class="form-control">
                                        <?php while ($row = $product_result->fetch_assoc()): ?>
                                            <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="in_quantity" class="control-label">In Quantity</label>
                                            <input type="number" step="0.01" id="in_quantity" name="in_quantity" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="out_quantity" class="control-label">Out Quantity</label>
                                            <input type="number" step="0.01" id="out_quantity" name="out_quantity" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="value" class="control-label">Value</label>
                                            <input type="number" step="0.01" id="value" name="value" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entry_date" class="control-label">Entry Date</label>
                                            <input type="date" id="entry_date" name="entry_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="expiry_date" class="control-label">Expiry Date</label>
                                            <input type="date" id="expiry_date" name="expiry_date" class="form-control" value="<?php echo date('Y-m-d', strtotime('+6 months')); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="person_name" class="control-label">Person Name</label>
                                    <select id="person_name" name="person_name" class="form-control">
                                        <?php while ($row = $person_result->fetch_assoc()): ?>
                                            <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="remark" class="control-label">Remark</label>
                                    <input type="text" id="remark" name="remark" class="form-control">
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
                <div class="inventory-container" >
                    <h2>Inventory List</h2>
                    <div class="inventory-table-container">
                        <table class="inventory-table table table-striped table-bordered" id="myTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Product Name</th>
                                    <th>In Quantity</th>
                                    <th>Out Quantity</th>

                                    <th>Value</th>
                                    <th>Entry Date</th>
                                    <th>Person Name</th>
                                    <th>Expiry Date</th>
                                    <th>Remark</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $inventory_result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td><?php echo $row['in_quantity']; ?></td>
                                    <td><?php echo $row['out_quantity']; ?></td>

                                    <td><?php echo $row['value']; ?></td>
                                    <td><?php echo $row['entry_date']; ?></td>
                                    <td><?php echo $row['person_name']; ?></td>
                                    <td><?php echo $row['expiry_date']; ?></td>
                                    <td><?php echo $row['remark']; ?></td>
                                    <td>
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="deletebtn" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                        
                                    <?php 
                                        if (isset($_POST['deletebtn'])) {
                                            $id = $_POST['id'];
                                            $sql = "DELETE FROM inventory WHERE id='$id'";
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

