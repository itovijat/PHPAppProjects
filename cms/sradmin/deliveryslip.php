<?php include_once "head2.php"; ?>
<div class="content2">
    <!-- Main content goes here -->
   
    <div class="row g-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white text-center">
                    <h2>Delivery Slip</h2>
                </div>
                <div class="card-body">

                    


<?php


    if (isset($_GET['status']) && isset($_GET['id']) && isset($_GET['action']))
    {
        $sql = "UPDATE visit SET status='".$_GET['action']."' WHERE id='".$_GET['id']."'";
        if (mysqli_query($conn, $sql))
        {
            echo "<script>alert('Record updated successfully');</script>";

        }
        else
        {
            echo "<script>alert('Error');</script>";
        }
    }



    $sql = "SELECT DISTINCT dsmemo FROM visit WHERE status=1 AND deliveryserial=1 AND dsmemo!=''  AND company='".$_SESSION['company']."'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='table-responsive'>";

      
        
        echo "<table class='table'>";
        echo "<thead><tr><th>DSMemo</th></tr></thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            $sql2 = "SELECT * FROM visit WHERE dsmemo='".$row['dsmemo']."'  AND company='".$_SESSION['company']."' order by serial";
            $result2 = mysqli_query($conn, $sql2);
            if (mysqli_num_rows($result2) > 0) {
                echo "<tr><td> Delivery Slip Memo: ".$row['dsmemo'];

$sql3 = "SELECT DISTINCT route FROM visit WHERE dsmemo='".$row['dsmemo']."'  AND company='".$_SESSION['company']."'";
$result3 = mysqli_query($conn, $sql3);

if (mysqli_num_rows($result3) > 0) {
  
    while ($row3 = mysqli_fetch_assoc($result3)) {
        echo " Routes: " . $row3['route'] . " ";
    }

} else {
    
}

                $sql4 = "SELECT ddate, mo, id, status FROM visit WHERE dsmemo='".$row['dsmemo']."'  AND company='".$_SESSION['company']."' ORDER BY ddate ASC LIMIT 1";
                $result4 = mysqli_query($conn, $sql4);
                if (mysqli_num_rows($result4) > 0) {
                    $row4 = mysqli_fetch_assoc($result4);
                    echo " Marketing Officer: " . $row4['mo'] . " ";
                    echo " Delivery Date: " . $row4['ddate'] . " ";
                    
                                        
                    
                }

                echo "</td></tr><tr><td><table class='table'><tr><th>ID</th><th>Details</th><th>Orders</th></tr>";
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    echo "<tr><td>" . $row2['id'] . "</td><td>" . $row2['memo'] . "<br>" . $row2['route'] . "<br>" . $row2['shop'] . "<br>" . $row2['phone'] . "<br>" . $row2['odate'] .
                     "</td><td><table class='table'><thead><tr><th>Product</th><th>Unit</th><th>Quantity</th><th>Rate</th><th>Total</th></tr></thead><tbody>";
                    $sql3 = "SELECT * FROM orders WHERE idvisit='".$row2['id']."'";
                    $result3 = mysqli_query($conn, $sql3);
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        echo "<tr><td>" . $row3['pn'] . "</td><td>" . $row3['unit'] . "</td><td>" . $row3['quantity'] . "</td><td>" . $row3['rate'] . "</td><td>" . ($row3['quantity'] * $row3['rate']) . "</td></tr>";
                    }
                    echo "</tbody></table></td></tr>";
                }
                echo "</table></td></tr>";
            } else {
                echo "<tr><td>No visits found for this memo.</td></tr>";
            }

        }
        echo "</tbody></table></div>";
    } else {
        echo "<p>No visit memos found.</p>";
    }



                    ?>

                
                </div>
            </div>
        </div>
    
    </div>
</div>

<?php include_once "foot.php"; ?>
