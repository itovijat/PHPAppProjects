<?php include_once "head2.php"; 

$company=$_SESSION['company'];


$sql = "CREATE TABLE IF NOT EXISTS requisition (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(50) NOT NULL,
    shop_name VARCHAR(50) NOT NULL,
    quantity float NOT NULL,
    value float(10,2) NOT NULL,
    entry_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deadline DATE NOT NULL,
    req_remark VARCHAR(50)  NULL,
    status tinyint(1) default 0,
    admin_remark VARCHAR(50)  NULL,
    purchaser VARCHAR(10) NOT NULL,
    purchased_value float(10,2)  NULL,
    purchased_quantity float  NULL,
    purchaser_remark VARCHAR(50)  NULL,
    company VARCHAR(10) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    // echo "Table requisition created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}




if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $shop_name = $_POST['shop_name'];
    $quantity = $_POST['quantity'];
    $value = $_POST['value'];
    $deadline = $_POST['deadline'];
    $req_remark = $_POST['req_remark'];
    $purchaser = $_POST['purchaser'];
    

    $sql = "INSERT INTO requisition (product_name, shop_name, quantity, value, deadline, req_remark, purchaser, company) VALUES ('$product_name', '$shop_name', '$quantity', '$value', '$deadline', '$req_remark', '$purchaser', '$company' )";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record added successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<div class="content">
        <!-- Main content goes here -->

       
        
        <div class="row">
            <div class="col-md-4">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <?php
                        if (isset($_GET['product_name'])) {
                            echo "<input type='text' class='form-control' id='product_name' name='product_name' value='".$_GET['product_name']."' placeholder='Product Name' required>";
                        } else {
                            echo "<input type='text' class='form-control' id='product_name' name='product_name' placeholder='Product Name' required>";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="shop_name">Shop Name</label>
                        <input type="text" class="form-control" id="shop_name" name="shop_name" placeholder="Shop Name" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" step="0.01" class="form-control" id="quantity" name="quantity" placeholder="Quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="value">Value</label>
                        <input type="number"  step="0.01" class="form-control" id="value" name="value" placeholder="Value" required>
                    </div>
                    <div class="form-group">
                        <label for="deadline">Deadline</label>
                        <input type="date" class="form-control" id="deadline" name="deadline" required>
                    </div>
                    <div class="form-group">
                        <label for="purchaser">Purchaser</label>
                        <input type="text" class="form-control" id="purchaser" name="purchaser" placeholder="Purchaser" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="req_remark">Remark</label>
                        <input type="text" class="form-control" id="req_remark" name="req_remark" placeholder="Remark" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-8">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Shop Name</th>
                            <th>Quantity</th>
                            <th>Value</th>
                            <th>Entry Date</th>
                            <th>Deadline</th>
                            <th>Remark</th>
                            <th>Status</th>
                       
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM requisition WHERE company = '$company' ORDER BY id DESC limit 10";
                        $result = mysqli_query($conn, $sql);
                        $sl = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>".$sl."</td>";
                            echo "<td>".$row['id']."</td>";
                            echo "<td>".$row['product_name']."</td>";
                            echo "<td>".$row['shop_name']."</td>";
                            echo "<td>".$row['quantity']."</td>";
                            echo "<td>".$row['value']."</td>";
                            echo "<td>".date('Y-m-d', strtotime($row['entry_date']))."</td>";
                            echo "<td>".date('Y-m-d', strtotime($row['deadline']))."</td>";
                            echo "<td>".$row['req_remark']."</td>";
                            echo "<td>".$row['status']."</td>";
                           
                            if ($sl <= 5) {
                                echo "<td><a href='delete.php?id=".$row['id']."' class='btn btn-danger'>Delete</a></td>";
                            }
                            else {
                                echo "<td></td>";
                            }
                            echo "</tr>";
                            $sl++;
                        }
                        ?>
                    </tbody>
            </div>
        </div>






       

    </div>

    <?php include_once "foot.php"; ?>