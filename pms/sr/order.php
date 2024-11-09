<?php include_once "head2.php"; ?>


<?php
$sql = "CREATE TABLE IF NOT EXISTS visit (
    SN INT AUTO_INCREMENT PRIMARY KEY,
    date DATE DEFAULT CURRENT_TIMESTAMP,
    mo VARCHAR(20),
    route VARCHAR(20),
    shop VARCHAR(50),
    phone VARCHAR(20),
    latitude DECIMAL(10,8),
    longitude DECIMAL(11,8),
    reason VARCHAR(5),
    memo VARCHAR(10)
    )";
if (mysqli_query($conn, $sql)) {
    // echo "Table created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
?>



<div class="content">
    <!-- Main content goes here -->

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Shop Details</h2>
                </div>
                <div class="card-body">
            
                




                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Items</h2>
                </div>
                <div class="card-body">
                   
                </div>
            </div>
        </div>
    </div>

<?php include_once "foot.php"; ?>
