<?php include_once "head2.php"; ?>
<div class="content noPrint">
</div>
<div class="content2">
    <!-- Main content goes here -->

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header noPrint bg-success text-white">
                <div class="row">
                    <div class="col-12 col-md-12" style="text-align: center;"> <h1 >Order List</h1></div>
                    <form class="form-inline mx-2">

                    
                    <div class="col-6 col-md-6 mb-2">
                        <label for="fromdate">Order From</label>
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
                    <div class="col-6 col-md-6 mb-2">
                    <label for="fromdate">Order To</label>
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

                  
                    <div class="col-6 col-md-2">
                        <input type="text" class="form-control w-100" id="shop" name="shop"
                         <?php if (isset($_GET['shop']) && $_GET['shop'] != null)
{
    echo "value='" . $_GET['shop'] . "'";
}
else
{
    echo "placeholder='all shop/phone'";
}
?> >
                    </div>

                    <div class="col-6 col-md-2">
                        <input type="text" class="form-control w-100" id="route" name="route"
                         <?php if (isset($_GET['route']) && $_GET['route'] != null)
{
    echo "value='" . $_GET['route'] . "'";
}
else
{
    echo "placeholder='all route'";
}
?> >
                    </div>

                    <div class="col-6 col-md-2">
                        <input type="text" class="form-control w-100" id="memo" name="memo"
                         <?php if (isset($_GET['memo']) && $_GET['memo'] != null)
{
    echo "value='" . $_GET['memo'] . "'";
}
else
{
    echo "placeholder='all memo'";
}
?> >
                    </div>

                    <div class="col-6 col-md-2">
                        <input type="text" class="form-control w-100" id="product" name="product"
                         <?php if (isset($_GET['product']) && $_GET['product'] != null)
{
    echo "value='" . $_GET['product'] . "'";
}
else
{
    echo "placeholder='all product'";
}
?> >
                    </div>

                    <div class="col-6 col-md-2">
                        <input type="number" class="form-control w-100" id="id" name="id"
                         <?php if (isset($_GET['id']) && $_GET['id'] != null)
{
    echo "value='" . $_GET['id'] . "'";
}
else
{
    echo "placeholder='all id'";
}
?> >
                    </div>

                    <div class="col-6 col-md-2" style="width: 100%;">
                        <select class="form-control w-100" id="status" name="status">
                            <option value="" <?=!isset($_GET['status']) || $_GET['status'] === null ? 'selected' : ''; ?>>all status</option>
                            <option value="0" <?=isset($_GET['status']) && $_GET['status'] == '0' ? 'selected' : ''; ?>>Pending</option>
                            <option value="1" <?=isset($_GET['status']) && $_GET['status'] == '1' ? 'selected' : ''; ?>>Accepted</option>
                            <option value="3" <?=isset($_GET['status']) && $_GET['status'] == '3' ? 'selected' : ''; ?>>Delivered</option>
                            <option value="4" <?=isset($_GET['status']) && $_GET['status'] == '4' ? 'selected' : ''; ?>>Rejected</option>
                            <option value="5" <?=isset($_GET['status']) && $_GET['status'] == '5' ? 'selected' : ''; ?>>Returned</option>
                        </select>
                    </div>


                    <div class="col-12 mx-2 my-2 col-md-12 text-center">                           
                         <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i></button>
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
echo "<p id='up' style='text-align: center;'>Order List From: <b>" . $fromdate . "</b> To: <b>" . $todate . "</b> " . $_SESSION['company'] . "</p>";
$sql = "SELECT * FROM visit WHERE mo='" . $_SESSION['email'] . "' AND company='" . $_SESSION['company'] . "' AND reason='order' AND status != 2 AND odate BETWEEN '" . $fromdate . "' AND '" . $todate . "'";

if (isset($_GET['memo']) && $_GET['memo'] != '')
{
    $sql .= " AND memo LIKE '%" . $_GET['memo'] . "%'";
}
if (isset($_GET['shop']) && $_GET['shop'] != '')
{
    $sql .= " AND (shop LIKE '%" . $_GET['shop'] . "%' OR phone LIKE '%" . $_GET['shop'] . "%')";
}
if (isset($_GET['phone']) && $_GET['phone'] != '')
{
    $sql .= " AND phone LIKE '%" . $_GET['phone'] . "%'";

}
if (isset($_GET['route']) && $_GET['route'] != '')
{
    $sql .= " AND route LIKE '%" . $_GET['route'] . "%'";
}

if (isset($_GET['id']) && $_GET['id'] != '')
{
    $sql .= " AND id='" . $_GET['id'] . "'";

}
if (isset($_GET['status']) && $_GET['status'] != '')
{
    $sql .= " AND status='" . $_GET['status'] . "'";
}

$sql .= " ORDER BY id DESC";

// echo "<p style='text-align: center; font-size: 1.5em; color: red'>SQL: ".$sql."</p>";


$result = mysqli_query($conn, $sql);
$count = 1;
$totalpending = 0.0;
$totalaccepted = 0.0;
$totalrejected = 0.0;
$totalreturned = 0.0;
$totaldelivered = 0.0;
$totalamount = 0.0;
$units = array();
$totalQuantity = array();
$productQuantities = array();
if (mysqli_num_rows($result) > 0)
{
    echo "<div class='table-responsive text-center'><table class='table table-bordered' id='orderTable'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th class='noPrint'>Action</th>";
    echo "<th>Details</th>";
    echo "<th>Orders</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_assoc($result))
    {
        echo "<tr><td  class='noPrint' style='font-size:10px;'>";
        if ($row['status'] == 0)
        {
            echo "<a style='margin-bottom: 10px;; margin-right: 10px; width: 50px;' href='order.php?order=" . $row['id'] . "' class='btn btn-success'><i class='fas fa-shopping-cart'></i></a>";
        }
        else if ($row['status'] == 1)
        {
            echo "Accepted ";

        }
        else if ($row['status'] == 2)
        {
            echo "Canceled ";
        }
        else if ($row['status'] == 3)
        {
            echo "Delivered ";
        }
        else if ($row['status'] == 4)
        {
            echo "Rejected ";
        }
        else if ($row['status'] == 5)
        {
            echo "Returned ";
        }
        else
        {
            echo "";
        }

        echo "<a  style='margin-bottom: 10px;  width: 50px;' href='invoice.php?order=" . $row['id'] . "' class='btn btn-warning'><i class='fas fa-file-invoice'></i></a><br>ID:" . $row['id'] . " @" . $row['date'] . "</td>";

        echo "<td>" . $count . ". Memo: " . $row['memo'] . " Route: " . $row['route'] . "<br>Shop: " . $row['shop'] . " " . $row['phone'] . "<br>" . $row['mo'] . "@" . $row['odate'] . " Delivery: " . $row['ddate'] . " <i>";
        switch ($row['status'])
        {
            case 0:
                echo "Pending";
            break;
            case 1:
                echo "Accepted";
            break;
            case 3:
                echo "Delivered";
            break;
            case 4:
                echo "Rejected";
            break;
            case 5:
                echo "Returned";
            break;
            default:
                echo "Unknown";
        }
        echo "</i></td>";
        $count++;

        echo "<td>";
        $orderSql = "SELECT * FROM orders WHERE idvisit='" . $row['id'] . "'";

        if (isset($_GET['product']) && $_GET['product'] != '')
        {
            $orderSql = "SELECT * FROM orders WHERE idvisit='" . $row['id'] . "' AND pn LIKE '%" . $_GET['product'] . "%'";
        }
        $orderResult = mysqli_query($conn, $orderSql);
        $total = 0.0;
        if (mysqli_num_rows($orderResult) > 0)
        {

            while ($orderRow = mysqli_fetch_assoc($orderResult))
            {
                $productKey = $orderRow['pn'] . ' (' . $orderRow['unit'] . ")";

                if (!isset($units[$orderRow['unit']]))
                {
                    $units[$orderRow['unit']] = 1;
                    $totalQuantity[$orderRow['unit']] = $orderRow['quantity'];
                }
                else
                {
                    $units[$orderRow['unit']]++;
                    $totalQuantity[$orderRow['unit']] += $orderRow['quantity'];
                }

                if (!isset($productQuantities[$productKey]))
                {
                    $productQuantities[$productKey] = $orderRow['quantity'];
                }
                else
                {
                    $productQuantities[$productKey] += $orderRow['quantity'];
                }

                echo " " . $orderRow['pn'] . " (<i>" . $orderRow['unit'] . "</i>) " . $orderRow['quantity'] . "@" . $orderRow['rate'] . "=" . ($orderRow['rate'] * $orderRow['quantity']) . "/=   <span class='noPrint'><br><hr></span>";
                $total += $orderRow['rate'] * $orderRow['quantity'];;
            }

        }
        else
        {
            echo "No orders found";
        }
        echo "<div>Total: " . number_format($total, 2) . "/= <i style='font-size: 12px'>" . $row['comment'] . "</i></div>";
        $totalamount = $totalamount + $total;

        if ($row['status'] == 0)
        {
            $totalpending = $totalpending + $total;

        }
        else if ($row['status'] == 1)
        {
            $totalaccepted = $totalaccepted + $total;

        }
        else if ($row['status'] == 3)
        {
            $totaldelivered = $totaldelivered + $total;

        }
        else if ($row['status'] == 4)
        {
            $totalrejected = $totalrejected + $total;

        }
        elseif ($row['status'] == 5)
        {
            $totalreturned = $totalreturned + $total;

        }

        echo "</td>";

        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table></div>";
}
else
{
    echo "<p style='text-align: center; font-size: 2em; color: red'>0 results</p>";
}
?>

    <div style="display: flex; flex-direction: row; width: 100%; ">
        <div id="d1" style="flex: 1; margin-right: 10px;">

        <?php if (isset($_GET['status']) && $_GET['status'] == '0'): ?>
            <p>Pending =<?=number_format($totalpending, 2) ?>/=</p>
        <?php
elseif (isset($_GET['status']) && $_GET['status'] == '1'): ?>
            <p>Accepted =<?=number_format($totalaccepted, 2) ?>/=</p>
        <?php
elseif (isset($_GET['status']) && $_GET['status'] == '3'): ?>
            <p>Delivered =<?=number_format($totaldelivered, 2) ?>/=</p>
        <?php
elseif (isset($_GET['status']) && $_GET['status'] == '4'): ?>
            <p>Rejected =<?=number_format($totalrejected, 2) ?>/=</p>
        <?php
elseif (isset($_GET['status']) && $_GET['status'] == '5'): ?>
            <p>Returned =<?=number_format($totalreturned, 2) ?>/=</p>
        <?php
else: ?>
            <p>Pending =<?=number_format($totalpending, 2) ?>/=</p>
            <p>Accepted =<?=number_format($totalaccepted, 2) ?>/=</p>
            <p>Delivered =<?=number_format($totaldelivered, 2) ?>/=</p>
            <p>Rejected =<?=number_format($totalrejected, 2) ?>/=</p>
            <p>Returned =<?=number_format($totalreturned, 2) ?>/=</p>
        <?php
endif; ?>
       
        
     

        </div>
        <div id="d2" style="flex: 1; margin-left: 10px;">
            <p>Total =<?=number_format($totalamount, 2) ?>/=</p>
    
    
         <p><?php

ksort($productQuantities);
foreach ($productQuantities as $product => $quantity)
{
    echo "<i>" . $product . " = </i>" . $quantity . " <br>";
}

echo "</p><p>";
foreach ($units as $unit => $count)
{
    echo "<i>Unit " . $unit . " = </i>" . $totalQuantity[$unit] . " Bag <br>";
}
?>
         </p>
        </div>


    </div>
   



                </div>


        <div class='noPrint' style="text-align: center; margin: 10px;">
            <button type="button" class="btn btn-primary" onclick="tableToExcel('orderTable', 'OrderList_<?=date('Ymd_His') ?>')"><i class="fas fa-file-excel"></i> Export to Excel</button>
            <button type="button" class="btn btn-primary" onclick="tableToCSV('orderTable', 'OrderList_<?=date('Ymd_His') ?>.csv')"><i class="fas fa-file-csv"></i> Export to CSV</button>
        </div>

        <script>
              function tableToCSV(tableID, filename = ''){

                var csv = [];
                var rows = document.querySelectorAll('table#' + tableID + ' tr');
                
                var up = document.querySelector('#up').innerText;
                csv.push(up);
                for (var i = 0; i < rows.length; i++) {
                    var row = [], cols = rows[i].querySelectorAll('td, th');
                    
                    for (var j = 0; j < cols.length; j++) 
                        row.push(cols[j].innerText.replace(/<br\s*\/?>/g, ''));
                    
                    csv.push(row.join(','));        
                }
                var d1 = document.querySelector('#d1').innerText;
                var d2 = document.querySelector('#d2').innerText;
                csv.push(d1);
                csv.push(d2);
                
                
                // Download CSV file
                var csvContent = csv.join('\n');
                var blob = new Blob([csvContent], {type: 'text/csv;charset=utf-8;'});
                var link = document.createElement('a');
                if (link.download !== undefined) { // feature detection
                    // Browsers that support HTML5 download attribute
                    var url = URL.createObjectURL(blob);
                    link.setAttribute('href', url);
                    link.setAttribute('download', filename);
                    link.style.visibility = 'hidden';
                    document.body.appendChild(link);
                    link.click();
                    setTimeout(function() {
                        document.body.removeChild(link);
                    }, 0);
                }
            }
        </script>
       <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

<script>
    function tableToExcel(tableID, filename = '') {
        var table = document.getElementById(tableID);
        var ws = XLSX.utils.table_to_sheet(table);

        var Div1 = document.getElementById('d1');
        var Div2 = document.getElementById('d2');
        var up = document.getElementById('up');

        // Create a new workbook and a worksheet
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

        // Adding additional content
        XLSX.utils.sheet_add_aoa(ws, [[up.innerText]], {origin: "A1"});
        XLSX.utils.sheet_add_aoa(ws, [[Div1.innerText]], {origin: `A${table.rows.length + 2}`});
        XLSX.utils.sheet_add_aoa(ws, [[Div2.innerText]], {origin: `A${table.rows.length + 4}`});

        // Generate Excel file and trigger download
        filename = filename ? filename + '.xlsx' : 'Order_Report.xlsx';
        XLSX.writeFile(wb, filename);
    }
</script>
        
            </div>
        </div>
        
    </div>

<?php include_once "foot.php"; ?>
