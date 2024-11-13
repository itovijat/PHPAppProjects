<?php include_once "head2.php"; ?>
<div class="content">
    <!-- Main content goes here -->

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header noPrint">
                <div class="row">
                    <div class="col-12 col-md-12"> <h1 >Orders' List:</h1></div>
                    <form class="form-inline">

                    
                    <div class="col-6 col-md-1">
                    <input type="text" class="form-control " id="fromdate" name="fromdate" 
                    pattern='[0-9]{4}\.[0-9]{2}\.[0-9]{2}' title='Year.Month.Day' value="<?php if (isset($_GET['fromdate']) )
                      {echo $_GET['fromdate'];}
                       else {echo date('Y.m.d');} 
                       ?>" required>
                    </div>
                    <div class="col-6 col-md-1">
                        <input type="text" class="form-control" id="todate" name="todate"
                         pattern='[0-9]{4}\.[0-9]{2}\.[0-9]{2}' title='Year.Month.Day' value="<?php if (isset($_GET['todate']) )
                      {echo $_GET['todate'];}
                       else {echo date('Y.m.d');} 
                       ?>" required>
                    </div>


                    <div class="col-6 col-md-1">
                        <input type="text" class="form-control" id="shop" name="shop"
                         <?php if (isset($_GET['shop']) && $_GET['shop'] != null)
                      {echo "value='".$_GET['shop']."'";}
                       else {echo "placeholder='all shop/phone'";} 
                       ?> >
                    </div>

                    <div class="col-6 col-md-1">
                        <input type="text" class="form-control" id="route" name="route"
                         <?php if (isset($_GET['route']) && $_GET['route'] != null)
                      {echo "value='".$_GET['route']."'";}
                       else {echo "placeholder='all route'";} 
                       ?> >
                    </div>

                    <div class="col-6 col-md-1">
                        <input type="text" class="form-control" id="memo" name="memo"
                         <?php if (isset($_GET['memo']) && $_GET['memo'] != null)
                      {echo "value='".$_GET['memo']."'";}
                       else {echo "placeholder='all memo'";} 
                       ?> >
                    </div>

                    <div class="col-6 col-md-1">
                        <input type="text" class="form-control" id="product" name="product"
                         <?php if (isset($_GET['product']) && $_GET['product'] != null)
                      {echo "value='".$_GET['product']."'";}
                       else {echo "placeholder='all product'";} 
                       ?> >
                    </div>

                    <div class="col-6 col-md-1">
                        <input type="number" class="form-control" id="id" name="id"
                         <?php if (isset($_GET['id']) && $_GET['id'] != null)
                      {echo "value='".$_GET['id']."'";}
                       else {echo "placeholder='all id'";} 
                       ?> >
                    </div>

                    <div class="col-6 col-md-1">
                        <select class="form-control" id="status" name="status">
                            <option value="" <?= !isset($_GET['status']) || $_GET['status'] === null ? 'selected' : ''; ?>>all status</option>
                            <option value="0" <?= isset($_GET['status']) && $_GET['status'] == '0' ? 'selected' : ''; ?>>Pending</option>
                            <option value="1" <?= isset($_GET['status']) && $_GET['status'] == '1' ? 'selected' : ''; ?>>Accepted</option>
                          
                            <option value="3" <?= isset($_GET['status']) && $_GET['status'] == '3' ? 'selected' : ''; ?>>Delivered</option>
                            <option value="4" <?= isset($_GET['status']) && $_GET['status'] == '4' ? 'selected' : ''; ?>>Rejected</option>
                            <option value="5" <?= isset($_GET['status']) && $_GET['status'] == '5' ? 'selected' : ''; ?>>Returned</option>

                        </select>
                    </div>


                    <div class="col-12 mx-2 my-2 col-md-1 text-center">                            <button type="submit" class="btn btn-primary">Search</button>
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
$fromdate."' AND '".$todate."'";


if (isset($_GET['memo']) && $_GET['memo'] != '') {
    $sql .= " AND memo LIKE '%".$_GET['memo']."%'";
}
if (isset($_GET['shop']) && $_GET['shop'] != '') {
    $sql .= " AND (shop LIKE '%".$_GET['shop']."%' OR phone LIKE '%".$_GET['shop']."%')";
}
if (isset($_GET['phone']) && $_GET['phone'] != '') {
    $sql .= " AND phone LIKE '%".$_GET['phone']."%'";

}
if (isset($_GET['route']) && $_GET['route'] != '') {
    $sql .= " AND route LIKE '%".$_GET['route']."%'";
}

if (isset($_GET['id']) && $_GET['id'] != '') {
    $sql .= " AND SN='" . $_GET['id'] . "'";
    
}
if (isset($_GET['status']) && $_GET['status'] != '') {
    $sql .= " AND status='" . $_GET['status'] . "'";
}


$sql .= " ORDER BY SN DESC";

// echo "<p style='text-align: center; font-size: 1.5em; color: red'>SQL: ".$sql."</p>";
    






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
$totalpending=0.0;
$totalaccepted=0.0;
$totalrejected=0.0;
$totalreturned=0.0;
$totaldelivered=0.0;
$totalamount=0.0;
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

        if (isset($_GET['product']) && $_GET['product'] != '') {
            $orderSql = "SELECT * FROM orders WHERE snvisit='" . $row['SN'] . "' AND pn LIKE '%".$_GET['product']."%'";
        }
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
        $totalamount=$totalamount+$total;

        if($row['status'] == 0){
            $totalpending=$totalpending+$total;  
           
        }else if($row['status'] == 1){
            $totalaccepted=$totalaccepted+$total;  

        }else if($row['status'] == 3){
            $totaldelivered=$totaldelivered+$total;  

        }else if($row['status'] == 4){
            $totalrejected=$totalrejected+$total;  

        }
        elseif ($row['status'] == 5){
            $totalreturned=$totalreturned+$total;  

        }

        echo "</td>";

      
        

       
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p style='text-align: center; font-size: 2em; color: red'>0 results</p>";
}
?>

<p>Total Pending Amount=<?= $totalpending?>/=</p>
<p>Total Accepted Amount=<?= $totalaccepted?>/=</p>
<p>Total Delivered Amount=<?= $totaldelivered?>/=</p>
<p>Total Delivered Amount=<?= $totalrejected?>/=</p>
<p>Total Returned Amount=<?= $totalreturned?>/=</p>

<p>Total Amount=<?= $totalamount?>/=</p>



                </div>
            </div>
        </div>
        
    </div>

<?php include_once "foot.php"; ?>
