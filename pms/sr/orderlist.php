<?php include_once "head2.php"; ?>
<div class="content">
    <!-- Main content goes here -->

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header noPrint">
                <div class="row">
                    <div class="col-12 col-md-6"> <h1 >Orders' List Range:</h1></div>
                    <form class="form-inline">
                    <div class="col-5 col-md-3">
                    <input type="text" class="form-control " id="fromdate" name="fromdate" 
                    pattern='[0-9]{4}\.[0-9]{2}\.[0-9]{2}' title='Year.Month.Day' value="<?php if (isset($_GET['fromdate']) )
                      {echo $_GET['fromdate'];}
                       else {echo date('Y.m.d');} 
                       ?>" required>
                    </div>
                    <div class="col-5 col-md-3">
                        <input type="text" class="form-control" id="todate" name="todate"
                         pattern='[0-9]{4}\.[0-9]{2}\.[0-9]{2}' title='Year.Month.Day' value="<?php if (isset($_GET['todate']) )
                      {echo $_GET['todate'];}
                       else {echo date('Y.m.d');} 
                       ?>" required>
                    </div>
                    <div class="col-2 col-md-2">                            <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                    </form>

                </div>

               
                  
                        
                            
                           
                        
                            
                            
                     
                       
                </div>





                <div class="card-body">


                    
<?php

if (isset($_GET['fromdate']) && isset($_GET['todate'])) {
    $fromdate = $_GET['fromdate'];
    $todate = $_GET['todate'];
   
} else {
    $fromdate = date('Y.m.d');
    $todate = date('Y.m.d');
}
echo "<p style='text-align: center;'>Order List From: <b>".$fromdate."</b> To: <b>".
$todate."</b> For : ".$_SESSION['email']."</p>";
$sql = "SELECT * FROM visit WHERE mo='" . $_SESSION['email'] .
"' AND company='" . $_SESSION['company'] . "' AND reason='order' AND status != 2 AND odate BETWEEN '".
$fromdate."' AND '".$todate."' ORDER BY SN DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th class='noPrint'>Action</th>";

  
    echo "<th>Details</th>";
    echo "<th>Orders</th>";



    

   
   

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

        echo "<a  style='margin-bottom: 10px;  width: 50px;' href='invoice.php?order=".
        $row['SN']."' class='btn btn-warning'><i class='fas fa-file-invoice'></i></a><br>ID:".$row['SN']."</td>";
        echo "<td>".$count.". Memo: ".$row['memo']." Route: ".$row['route']."<br>Shop: ".$row['shop']." ".$row['phone'].
        "<br>".$row['mo']."@".$row['odate']." Delivery: ".$row['ddate']." ";
        echo "</td>"; $count++;

echo "<td>";
        $orderSql = "SELECT * FROM orders WHERE snvisit='" . $row['SN'] . "'";
        $orderResult = mysqli_query($conn, $orderSql);

        if (mysqli_num_rows($orderResult) > 0) {
            $total=0.0;
            while ($orderRow = mysqli_fetch_assoc($orderResult)) {
                echo "<div style='border: 1px solid #ccc'>".$orderRow['pn'] . " (<i>"
                 . $orderRow['unit'] ."</i>) ". $orderRow['quantity'] . "@" . $orderRow['rate'] .
                  "=" . ($orderRow['rate'] * $orderRow['quantity'])."/=</div>";

                $total += $orderRow['rate'] * $orderRow['quantity'];
            }
            } else {
            echo "No orders found";
        }
        echo "<div>Total: " . number_format($total, 2) . "/= <i style='font-size: 12px'>".$row['comment']."</i></div>";

        echo "</td>";

      
        

       
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p style='text-align: center; font-size: 2em; color: red'>0 results</p>";
}
?>



                </div>
            </div>
        </div>
        
    </div>

<?php include_once "foot.php"; ?>
