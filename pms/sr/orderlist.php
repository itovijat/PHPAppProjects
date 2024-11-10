<?php include_once "head2.php"; ?>
<div class="content">
    <!-- Main content goes here -->

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Order List</h2>
                </div>
                <div class="card-body">
                    
<?php
$sql = "SELECT * FROM visit WHERE mo='" . $_SESSION['email'] . "' AND company='" . $_SESSION['company'] . "' AND reason='order' AND status != 2 ORDER BY SN DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Status</th>";

    echo "<th>Invoice</th>";
    echo "<th>Shop</th>";
    echo "<th>Orders</th>";


    echo "<th>ODate</th>";
    echo "<th>DDate</th>";

    echo "<th>Route</th>";
    echo "<th>Memo</th>";
    echo "<th>Comment</th>";
    echo "<th>SN</th>";

    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        if($row['status'] == 0){
            echo "<td><a href='order.php?order=".$row['SN']."' class='btn btn-primary'>Order</a></td>";
        } else if($row['status'] == 1){
            echo "<td>Accepted</td>";
        } else if($row['status'] == 2){
            echo "<td>Canceled</td>";
        } else if($row['status'] == 3){
            echo "<td>Delivered</td>";
        } else {
            echo "<td></td>";
        }

        echo "<td><a href='invoice.php?order=".$row['SN']."' class='btn btn-primary'>View</a></td>";

        echo "<td>".$row['shop']." ".$row['phone']."</td>";

echo "<td>";
        $orderSql = "SELECT * FROM orders WHERE snvisit='" . $row['SN'] . "'";
        $orderResult = mysqli_query($conn, $orderSql);

        if (mysqli_num_rows($orderResult) > 0) {
            while ($orderRow = mysqli_fetch_assoc($orderResult)) {
                echo "<div style='border: 1px solid #ccc'>".$orderRow['pn'] . " " . $orderRow['unit'] ." ". $orderRow['quantity'] . "@" . $orderRow['rate'] . "=" . ($orderRow['rate'] * $orderRow['quantity'])."/=</div>";
            }
            } else {
            echo "No orders found";
        }

        echo "</td>";

        echo "<td>".$row['odate']."</td>";

        echo "<td>".$row['ddate']."</td>";
        echo "<td>".$row['route']."</td>";
        echo "<td>".$row['memo']."</td>";
        echo "<td>".$row['comment']."</td>";

        echo "<td>".$row['SN']."</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "0 results";
}
?>



                </div>
            </div>
        </div>
        
    </div>

<?php include_once "foot.php"; ?>
