<?php include_once "head2.php"; 

$company=$_SESSION['company'];






?>

<div class="content">
        <!-- Main content goes here -->

        <div style="display: flex; justify-content: center; align-items: center;">
            <form style="margin-right: 10px;">
        <button type="submit" value='true' name="all" class="btn btn-primary" style="margin-left: 10px;">Refresh All</button>

</form>

            <form  method="get" style="margin-right: 10px;">
                <input required type="text" name="pdname" placeholder="Search by product name" value="<?php if(isset($_GET['pdname'])) echo $_GET['pdname']; ?>">
                <button type="submit" id="btnSearch" class="btn btn-primary">Search</button>

            </form>
        </div>
       
        
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Purchaser</th>
                    <th>Quantity</th>
                    <th>Purchased Quantity</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_GET['pdname']))
                    {
                        $sql = "SELECT DISTINCT product_name, purchaser, SUM(quantity) AS quantity_sum, (SELECT SUM(purchased_quantity) FROM requisition WHERE company = '$company' AND product_name = r.product_name AND purchaser = r.purchaser) AS purchased_sum FROM requisition r WHERE company = '$company' AND (product_name LIKE '%".$_GET['pdname']."%' OR purchaser LIKE '%".$_GET['pdname']."%') GROUP BY product_name, purchaser";
                    }
                    else
                    {
                        $sql = "SELECT DISTINCT product_name, purchaser, SUM(quantity) AS quantity_sum, (SELECT SUM(purchased_quantity) FROM requisition WHERE company = '$company' AND product_name = r.product_name AND purchaser = r.purchaser) AS purchased_sum FROM requisition r WHERE company = '$company' GROUP BY product_name, purchaser";
                    }
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<tr><td>".$row['product_name']."</td><td>".$row['purchaser']."</td><td>".$row['quantity_sum']."</td><td>".$row['purchased_sum']."</td><td>".($row['quantity_sum']-$row['purchased_sum'])."</td></tr>";
                    }
                ?>
            </tbody>
        </table>






       

    </div>

    <?php include_once "foot.php"; ?>