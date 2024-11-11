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
    echo "<th class='noPrint'>Action</th>";

  
    echo "<th>Details</th>";
    echo "<th>Orders</th>";



    

   
    echo "<th>Comment</th>";
    echo "<th class='noPrint'>SN</th>";

    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
$count=1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        if($row['status'] == 0){
            echo "<td  class='noPrint'><a style='margin-bottom: 10px;; margin-right: 10px; width: 50px;' href='order.php?order=".$row['SN']."' class='btn btn-success'><i class='fas fa-box-open'></i></a>";
        } else if($row['status'] == 1){
            echo "<td  class='noPrint'>Accepted";
        } else if($row['status'] == 2){
            echo "<td  class='noPrint'>Canceled";
        } else if($row['status'] == 3){
            echo "<td  class='noPrint'>Delivered";
        } else {
            echo "<td  class='noPrint'>";
        }

        echo "<a  style='margin-bottom: 10px;  width: 50px;' href='invoice.php?order=".$row['SN']."' class='btn btn-warning'><i class='fas fa-file-invoice'></i></a></td>";
        echo "<td>".$count.". Memo: ".$row['memo']." Route: ".$row['route']."<br>Shop: ".$row['shop']." ".$row['phone'].
        "<br>".$row['mo']."@".$row['odate']." Delivery: ".$row['ddate']." ";
        echo "</td>"; $count++;

echo "<td>";
        $orderSql = "SELECT * FROM orders WHERE snvisit='" . $row['SN'] . "'";
        $orderResult = mysqli_query($conn, $orderSql);

        if (mysqli_num_rows($orderResult) > 0) {
            $total=0.0;
            while ($orderRow = mysqli_fetch_assoc($orderResult)) {
                echo "<div style='border: 1px solid #ccc'>".$orderRow['pn'] . " "
                 . $orderRow['unit'] ." ". $orderRow['quantity'] . "@" . $orderRow['rate'] .
                  "=" . ($orderRow['rate'] * $orderRow['quantity'])."/=</div>";

                $total += $orderRow['rate'] * $orderRow['quantity'];
            }
            } else {
            echo "No orders found";
        }
        echo "<div>Total: " . number_format($total, 2) . "/=</div>";

        echo "</td>";

      
        echo "<td>".$row['comment']."</td>";

        echo "<td class='noPrint'>".$row['SN']."</td>";
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
