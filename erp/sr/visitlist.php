<?php
include_once 'head2.php';

?>


<div style="text-align: center;">
    <form method="GET">
        <div class="form-group">
            <label for="fromdate">From:</label>
            <input type="date" id="fromdate" name="fromdate" value="<?php echo isset($_GET['fromdate']) ? $_GET['fromdate'] : date('Y-m-d'); ?>" required>
        </div>
        <div class="form-group">
            <label for="todate">To:</label>
            <input type="date" id="todate" name="todate" value="<?php echo isset($_GET['todate']) ? $_GET['todate'] : date('Y-m-d'); ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Search Visits</button>
    </form>
</div>
<br>
<?php
if (isset($_GET['fromdate']) && isset($_GET['todate'])) {
    $fromdate = $_GET['fromdate'] . ' 00:00:00';
    $todate = $_GET['todate'] . ' 23:59:59';
    $soid = $_SESSION['userid'];

    $sql = "SELECT * FROM visits WHERE soid = '$soid' AND orderdate BETWEEN '$fromdate' AND '$todate' ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='table-responsive'>";
        echo "<table class='table'>";
        echo "<thead>";
        echo "<tr><th>ID</th><th>Order Date</th><th>Delivery Date</th><th>Route</th><th>Shop</th><th>Comment</th><th>Status</th><th>Slip</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr onclick=\"window.location.href='order.php?id={$row['id']}'\">";
            echo "<td>{$row['id']} </td>";
            echo "<td>{$row['orderdate']}</td>";
            echo "<td>{$row['deliverydate']}</td>";
            echo "<td>{$row['route']}</td>";
            echo "<td>{$row['shop']}</td>";
            echo "<td>{$row['comment']}</td>";
            echo "<td>{$row['status']}</td>";
            echo "<td>{$row['deliveryslip']}</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p style='text-align: center; font-size: 2em; color: red'>0 results</p>";
    }
}

else {
    $soid = $_SESSION['userid'];
    $sql = "SELECT * FROM visits WHERE soid = '$soid' ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='table-responsive'>";
        echo "<table class='table'>";
        echo "<thead>";
        echo "<tr><th>ID</th><th>Order Date</th><th>Delivery Date</th><th>Route</th><th>Shop</th><th>Comment</th><th>Status</th><th>Slip</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        $row = mysqli_fetch_assoc($result);
        echo "<tr onclick=\"window.location.href='order.php?id={$row['id']}'\">";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['orderdate']}</td>";
        echo "<td>{$row['deliverydate']}</td>";
        echo "<td>{$row['route']}</td>";
        echo "<td>{$row['shop']}</td>";
        echo "<td>{$row['comment']}</td>";
        echo "<td>{$row['status']}</td>";
        echo "<td>{$row['deliveryslip']}</td>";
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p style='text-align: center; font-size: 2em; color: red'>0 results</p>";
    }
}


?>





<?php
include_once 'hfoot.php';

?>