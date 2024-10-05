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





?>

<div class="content">
        <!-- Main content goes here -->

        <div style="display: flex; justify-content: center; align-items: center;">
            <form style="margin-right: 10px;">
        <button type="submit" value='true' name="all" class="btn btn-primary" style="margin-left: 10px;">Refresh All</button>

</form>

            <form action="itemreqlist.php" method="get" style="margin-right: 10px;">
                <input required type="text" name="pdname" placeholder="Search by product name" value="<?php if(isset($_GET['pdname'])) echo $_GET['pdname']; ?>">
                <button type="submit" id="btnSearch" class="btn btn-primary">Search</button>

            </form>
        </div>
       
        
        <div class="row">
         
            <div class="col-md-12">
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
                            <th>Admin Remark</th>
                            <th>Purchaser</th>
                            <th>Purchased Value</th>
                            <th>Purchased Quantity</th>
                            <th>Purchaser Remark</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM requisition WHERE company = '$company' ORDER BY id DESC limit 10";


                        if(isset($_GET['pdname'])) {
                            $sql = "SELECT * FROM requisition WHERE company = '$company' 
                            AND product_name LIKE '%".$_GET['pdname']."%'
                             OR shop_name LIKE '%".$_GET['pdname']."%'
                              OR purchaser LIKE '%".$_GET['pdname']."%'
                            ORDER BY id DESC";
                        }

                  

                        if(isset($_GET['all'])) {
                            $sql = " SELECT * FROM requisition WHERE company = '$company' ORDER BY id DESC";
                        }

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
                            echo "<td>".$row['admin_remark']."</td>";
                            echo "<td>".$row['purchaser']."</td>";
                            echo "<td>".$row['purchased_value']."</td>";
                            echo "<td>".$row['purchased_quantity']."</td>";
                            echo "<td>".$row['purchaser_remark']."</td>";
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