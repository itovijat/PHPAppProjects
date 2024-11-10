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






<div class="content">
    <!-- Main content goes here -->

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Visit List</h2>
                </div>
                <div class="card-body">
       
                    <?php
                    $sql = "SELECT * FROM visit WHERE mo='".$_SESSION['email']."' ORDER BY SN DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table class='table' id='myTable'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Action</th>";

                        echo "<th>SN</th>";
                        echo "<th>Date</th>";
                        echo "<th>Route</th>";
                        echo "<th>Shop</th>";
                        echo "<th>Phone</th>";
                        echo "<th>Reason</th>";
                        echo "<th>Memo</th>";
                        echo "<th>Action</th>";

                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            if($row['status'] == 0){
                                echo "<td><a href='visitedit.php?visitedit=".$row['SN']."' class='btn btn-primary'>Edit</a> <a href='order.php?order=".$row['SN']."' class='btn btn-primary'>Order</a></td>";
                            }
                            else if($row['status'] == 1){
                                echo "<td>Accepted <a href='order.php?order=".$row['SN']."' class='btn btn-primary'>View</a></td>";
                            } else if($row['status'] == 2){
                                echo "<td>Canceled <a href='order.php?order=".$row['SN']."' class='btn btn-primary'>View</a></td>";
                            }
                            else if($row['status'] == 3){
                                echo "<td>Delivered <a href='order.php?order=".$row['SN']."' class='btn btn-primary'>View</a></td>";
                            } else {
                                echo "<td></td>";
                            }
                            echo "<td>".$row['SN']."</td>";
                            echo "<td>".$row['date']."</td>";
                            echo "<td>".$row['route']."</td>";
                            echo "<td>".$row['shop']."</td>";
                            echo "<td>".$row['phone']."</td>";
                            echo "<td>".$row['reason']."</td>";
                            echo "<td>".$row['memo']."</td>";
                           
                            if($row['status'] == 0){
                                echo "<td> <a href='visitlist.php?ordercancel=".$row['SN']."' class='btn btn-primary'>Cancel</a></td>";
                            }
                             else {
                                echo "<td></td>";
                            }
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
