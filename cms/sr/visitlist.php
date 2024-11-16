<?php include_once "head2.php";

if (isset($_GET['ordercancel']))
{
    $sql = "UPDATE visit SET status=2 , reason='visit' WHERE id='" . $_GET['ordercancel'] . "'";
    if (mysqli_query($conn, $sql))
    {
        $sql = "DELETE FROM orders WHERE idvisit='" . $_GET['ordercancel'] . "'";
        if (mysqli_query($conn, $sql))
        {

        }
        else
        {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
    else
    {
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
            <div class="card-header noPrint bg-success text-white">
                <div class="row">
                    <div class="col-12 col-md-6" style="text-align: center;"> <h1 >Visit List</h1></div>
                    <form class="form-inline">
                    <div class="col-5 col-md-4">
                    <input type="text" class="form-control w-100" id="fromdate" name="fromdate" 
                    pattern='[0-9]{4}\.[0-9]{2}\.[0-9]{2}' title='Year.Month.Day' value="<?php if (isset($_GET['fromdate']))
{
    echo $_GET['fromdate'];
}
else
{
    echo date('Y.m.d');
}
?>" required>
                    </div>
                    <div class="col-5 col-md-4">
                        <input type="text" class="form-control w-100" id="todate" name="todate"
                         pattern='[0-9]{4}\.[0-9]{2}\.[0-9]{2}' title='Year.Month.Day' value="<?php if (isset($_GET['todate']))
{
    echo $_GET['todate'];
}
else
{
    echo date('Y.m.d');
}
?>" required>
                    </div>
                    <div class="col-2 col-md-1" style="width:20px;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    </form>

                </div>

               
                  
                        
                            
                           
                        
                            
                            
                     
                       
                </div>
                <div class="card-body">
       
                    <?php

if (isset($_GET['fromdate']) && isset($_GET['todate']))
{
    $fromdate = $_GET['fromdate'];
    $todate = $_GET['todate'];

}
else
{
    $fromdate = date('Y.m.d');
    $todate = date('Y.m.d');
}

echo "<p style='text-align: center;'>Visit List From: <b>" . $fromdate . "</b> To: <b>" . $todate . "</b> " . $_SESSION['company'] . "</p>";
$sql = "SELECT * FROM visit WHERE mo='" . $_SESSION['email'] . "' AND odate BETWEEN '" . $fromdate . "' AND '" . $todate . "' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{
    echo "<div class='table-responsive'>";
    echo "<table class='table' id='myTable'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th class='noPrint'>Action</th>";

    echo "<th>Route</th>";
    echo "<th>Shop</th>";
    echo "<th>Phone</th>";
    echo "<th>Reason</th>";
    echo "<th>Memo</th>";
    echo "<th>id</th>";
    echo "<th>Date</th>";
    echo "<th class='noPrint'>Action</th>";

    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_assoc($result))
    {
        echo "<tr>";
        if ($row['status'] == 0)
        {
            echo "<td class='noPrint'><a style='margin-bottom: 10px;' href='order.php?order=" . $row['id'] . "' class='btn btn-success'><i class='fas fa-shopping-cart'></i></a> <a style='margin-bottom: 10px;' href='visitedit.php?visitedit=" . $row['id'] . "' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>";
        }
        else if ($row['status'] == 1)
        {
            echo "<td class='noPrint' style='font-size:10px;'>Accepted <a href='order.php?order=" . $row['id'] . "' class='btn btn-warning'><i class='fas fa-file-invoice'></i></a></td>";
        }
        else if ($row['status'] == 2)
        {
            echo "<td class='noPrint' style='font-size:10px;'>Canceled <a href='order.php?order=" . $row['id'] . "' class='btn btn-warning'><i class='fas fa-file-invoice'></i></a></td>";
        }
        else if ($row['status'] == 3)
        {
            echo "<td class='noPrint' style='font-size:10px;'>Delivered <a href='order.php?order=" . $row['id'] . "' class='btn btn-warning'><i class='fas fa-file-invoice'></i></a></td>";
        }
        else if ($row['status'] == 4)
        {
            echo "<td class='noPrint style='font-size:10px;'Rejected <a href='order.php?order=" . $row['id'] . "' class='btn btn-warning'><i class='fas fa-file-invoice'></i></a></td>";
        }
        else if ($row['status'] == 5)
        {
            echo "<td class='noPrint' style='font-size:10px;'>Returned <a href='order.php?order=" . $row['id'] . "' class='btn btn-warning'><i class='fas fa-file-invoice'></i></a></td>";
        }
        else
        {
            echo "<td class='noPrint'></td>";
        }

        echo "<td>" . $row['route'] . " <br>Serial:" . $row['serial'] . "</td>";
        echo "<td>" . $row['shop'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['reason'] . "</td>";
        echo "<td>" . $row['memo'] . "</td>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";

        if ($row['status'] == 0)
        {
            echo "<td class='noPrint'> <a href='visitlist.php?ordercancel=" . $row['id'] . "' class='btn btn-danger'>X</a></td>";
        }
        else
        {
            echo "<td></td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}
else
{
    echo "<p style='text-align: center; font-size: 2em; color: red'>0 results</p>";
}
?>


                </div>
            </div>
        </div>
        
    </div>

<?php include_once "foot.php"; ?>
