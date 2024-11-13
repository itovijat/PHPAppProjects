<?php include_once "head2.php"; ?>
<div class="content">
    <!-- Main content goes here -->

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header noPrint">
                <div class="row">
                    <div class="col-12 col-md-12"> <h1 >Orders' Serial:</h1></div>
                    <form class="form-inline">

                    
                    
                    <div class="col-6 col-md-4">
                        <input type="text" class="form-control" id="todate" name="todate"
                         pattern='[0-9]{4}\.[0-9]{2}\.[0-9]{2}' title='Year.Month.Day' value="<?php if (isset($_GET['todate']) )
                      {echo $_GET['todate'];}
                       else {echo date('Y.m.d', strtotime("+1 day"));} 
                       ?>" required>
                    </div>


                    <div class="col-0 col-md-0">
                        <input type="hidden" class="form-control" id="mo" name="mo"
                         <?php if (isset($_GET['mo']) && $_GET['mo'] != null)
                      {echo "value='".$_GET['mo']."'";}
                       else {echo "placeholder='all mo'";} 
                       ?> >
                    </div>

                    <div class="col-6 col-md-4">
                        <input type="text" class="form-control" id="route" name="route"
                         <?php if (isset($_GET['route']) && $_GET['route'] != null)
                      {echo "value='".$_GET['route']."'";}
                       else {echo "placeholder='all route'";} 
                       ?> >
                    </div>

                    

                    


                    <div class="col-12 mx-2 my-2 col-md-1 text-center">                            <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                    </form>

                </div>

               
                  
                        
                            
                           
                        
                            
                            
                     
                       
                </div>





                <div class="card-body">


                    
<?php
if (isset($_GET['sn']) && isset($_GET['serial'])) {
   
    $sn = $_GET['sn'];
    $serial = $_GET['serial'];

    if (($serial == null) ) {
        $sql = "SELECT serial FROM visit WHERE SN='".$sn."'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $serial = $row['serial'] + 1;
    }


    $sql = "UPDATE visit SET serial='".$serial."' WHERE SN='".$sn."'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>window.location.href='orderserial.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
if (isset($_GET['todate'])) {
   
    $todate = $_GET['todate'];
   
} else {
  
    $todate = date('Y.m.d', strtotime("+1 day"));
}
echo "<p style='text-align: center;'>Order Serial for Delivery @ <b>".
$todate."</b> For : ".$_SESSION['email']."</p>";
$sql = "SELECT * FROM visit WHERE mo='" . $_SESSION['email'] .
"' AND company='" . $_SESSION['company'] . "' AND reason='order' AND status != 2 AND ddate = '".$todate."'";




if (isset($_GET['mo']) && $_GET['mo'] != '') {
    $sql .= " AND mo LIKE '%".$_GET['mo']."%'";

}
if (isset($_GET['route']) && $_GET['route'] != '') {
    $sql .= " AND route LIKE '%".$_GET['route']."%'";
}






$sql .= " ORDER BY serial ";

// echo "<p style='text-align: center; font-size: 1.5em; color: red'>SQL: ".$sql."</p>";
    






$result = mysqli_query($conn, $sql);
$count=1;

$totalamount=0.0;
$units = array();
$totalQuantity = array();
$productQuantities = array();
if (mysqli_num_rows($result) > 0) {
    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th class='noPrint'></th>";
    echo "<th>Details</th>";
    echo "<th>Orders</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";




    while ($row = mysqli_fetch_assoc($result)) {

    
        

        echo "<tr>";
     
            echo "<td  class='noPrint'>";
        

        echo "<a  style='margin-bottom: 10px;  width: 50px;' href='invoice.php?order=".
        $row['SN']."' class='btn btn-warning'><i class='fas fa-file-invoice'></i></a><br>ID:".
        $row['SN'];
        
        echo "<form action='orderserial.php' method='get'>
        <input type='hidden' name='sn' value='".$row['SN']."'>
      
        <input type='number' name='serial' placeholder='".$row['serial']."' style='width: 50px;' >
        <button type='submit' class='btn btn-primary'><i class='fas fa-arrow-alt-circle-down'></i></button>
        </form>";
        




        echo "</td>";





        echo "<td>".$count.". Memo: ".$row['memo']." Route: ".$row['route']."<br>Shop: ".$row['shop']." ".$row['phone'].
        "<br>".$row['mo']."@".$row['odate']." Delivery: ".$row['ddate']." <i>";

        echo "<i></td>"; $count++;

echo "<td>";
        $orderSql = "SELECT * FROM orders WHERE snvisit='" . $row['SN'] . "'";

        if (isset($_GET['product']) && $_GET['product'] != '') {
            $orderSql = "SELECT * FROM orders WHERE snvisit='" . $row['SN'] . "' AND pn LIKE '%".$_GET['product']."%'";
        }
        $orderResult = mysqli_query($conn, $orderSql);

        if (mysqli_num_rows($orderResult) > 0) {
           

            $total=0.0;




           
            while ($orderRow = mysqli_fetch_assoc($orderResult)) {
                $productKey = $orderRow['pn'] . ' (' . $orderRow['unit'].")";
                
                if (!isset($units[$orderRow['unit']])) {
                    $units[$orderRow['unit']] = 1;
                    $totalQuantity[$orderRow['unit']] = $orderRow['quantity'];
                } else {
                    $units[$orderRow['unit']]++;
                    $totalQuantity[$orderRow['unit']] += $orderRow['quantity'];
                }
                
                if (!isset($productQuantities[$productKey])) {
                    $productQuantities[$productKey] = $orderRow['quantity'];
                } else {
                    $productQuantities[$productKey] += $orderRow['quantity'];
                }
                
                echo "<div style='border: 1px solid #ccc'>".$orderRow['pn'] . " (<i>"
                 . $orderRow['unit'] ."</i>) ". $orderRow['quantity'] ;
                 echo  "<div class='noPrint'>@". $orderRow['rate'] ;
                 echo "=" . ($orderRow['rate'] * $orderRow['quantity'])."/=</div>";
                 echo "</div>";
                $total += $orderRow['rate'] * $orderRow['quantity'];
            }




            } else {
                         echo "No orders found";
                    }
        echo "<div>Total: " . number_format($total, 2) . "/= <i style='font-size: 12px'>".$row['comment']."</i></div>";
        $totalamount=$totalamount+$total;

     

        echo "</td>";

      
        

       
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p style='text-align: center; font-size: 2em; color: red'>0 results</p>";
}
?>

    <div style="display: flex; flex-direction: row; width: 100%; ">
                        <div style="flex: 1; margin-right: 10px;">

                    
                    
                        <h2>Total =<?= number_format($totalamount, 2)?>/=</h2>
                    
                <?php
                echo "<h5>";
                foreach ($units as $unit => $count) {
                    echo "<i>Unit ". $unit . " = </i>" . $totalQuantity[$unit] ." Bag <br>";
                }
                echo "<h5>";
                ?>
                        </div>
        <div style="flex: 1; margin-left: 10px;">
       
    
    
            <p><?php
            

                ksort($productQuantities);
                foreach ($productQuantities as $product => $quantity) {
                    echo "<i>" . $product . " = </i>" . $quantity . ". ";
                }

                echo "</p>";
                    ?>
      
        </div>
        <div style="flex: 1; margin-left: 10px;">
       
    
    
        <div style="display: flex; flex-direction: row; width: 100%; ">
            <div style="flex: 1; margin-right: 10px; border: "><p>PreparedBy</p></div>
            <div style="flex: 1; margin-right: 10px;"><p>AuthorizedBy</p></div>
            <div style="flex: 1; "><p>Supervisor</p></div>
        </div>
    
      </div>
     

    </div>
   



                </div>
            </div>
        </div>
        
    </div>

<?php include_once "foot.php"; ?>
