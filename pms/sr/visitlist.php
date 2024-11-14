<?php include_once "head2.php"; 

if (isset($_GET['ordercancel'])) {
    $sql = "UPDATE visit SET status=2 WHERE SN='".$_GET['ordercancel']."'";
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
        echo "<script>window.location.href='visitlist.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>





<div class="content noPrint">
</div>
<div class="content2">
    <!-- Main content goes here -->

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
            <div class="card-header noPrint">
                <div class="row">
                    <div class="col-12 col-md-6"> <h1 >Visits' List Range:</h1></div>
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

echo "<p style='text-align: center;'>Visit List From: <b>".$fromdate."</b> To: <b>".
$todate."</b> For : ".$_SESSION['email']."</p>";
                    $sql = "SELECT * FROM visit WHERE mo='".$_SESSION['email']."' AND odate BETWEEN '".
$fromdate."' AND '".$todate."' ORDER BY SN DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table class='table' id='myTable'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th class='noPrint'>Action</th>";

                       
                        echo "<th>Route</th>";
                        echo "<th>Shop</th>";
                        echo "<th>Phone</th>";
                        echo "<th>Reason</th>";
                        echo "<th>Memo</th>";
                        echo "<th>SN</th>";
                        echo "<th>Date</th>";
                        echo "<th class='noPrint'>Action</th>";

                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            if($row['status'] == 0){
                                echo "<td class='noPrint'><a style='margin-bottom: 10px;' href='visitedit.php?visitedit=".$row['SN']."' class='btn btn-primary'>Edit</a> <a style='margin-bottom: 10px;' href='order.php?order=".$row['SN']."' class='btn btn-success'>Order</a></td>";
                            }
                            else if($row['status'] == 1){
                                echo "<td class='noPrint'>Accepted <a href='order.php?order=".$row['SN']."' class='btn btn-primary'>View</a></td>";
                            } else if($row['status'] == 2){
                                echo "<td class='noPrint'>Canceled <a href='order.php?order=".$row['SN']."' class='btn btn-primary'>View</a></td>";
                            } else if($row['status'] == 3){
                                echo "<td class='noPrint'>Delivered <a href='order.php?order=".$row['SN']."' class='btn btn-primary'>View</a></td>";
                            } else if($row['status'] == 4){
                                echo "<td class='noPrint'>Rejected <a href='order.php?order=".$row['SN']."' class='btn btn-primary'>View</a></td>";
                            } else if($row['status'] == 5){
                                echo "<td class='noPrint'>Returned <a href='order.php?order=".$row['SN']."' class='btn btn-primary'>View</a></td>";
                            } else {
                                echo "<td class='noPrint'></td>";
                            }

                            echo "<td>".$row['route']."</td>";
                            echo "<td>".$row['shop']."</td>";
                            echo "<td>".$row['phone']."</td>";
                            echo "<td>".$row['reason']."</td>";
                            echo "<td>".$row['memo']."</td>";
                            echo "<td>".$row['SN']."</td>";
                            echo "<td>".$row['date']."</td>";
                           
                            if($row['status'] == 0){
                                echo "<td class='noPrint'> <a href='visitlist.php?ordercancel=".$row['SN']."' class='btn btn-danger'>Cancel</a></td>";
                            }
                             else {
                                echo "<td></td>";
                            }
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
