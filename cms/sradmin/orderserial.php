<?php include_once "head2.php"; ?>
<div class="content noPrint">
</div>
<div class="content2">

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header noPrint bg-success text-white">
                <div class="row">
                    <div class="col-12 col-md-6" style="text-align: center;"> <h1 >Order Serial</h1></div>
                    <form class="form-inline">

                    
                    
                    <div class="col-6 col-md-3">
                        <input type="text" class="form-control w-100" id="todate" name="todate"
                         pattern='[0-9]{4}\.[0-9]{2}\.[0-9]{2}' title='Year.Month.Day' value="<?php if (isset($_GET['todate']))
{
    echo $_GET['todate'];
}
else
{
    echo date('Y.m.d', strtotime("+1 day"));
}
?>" required>
                    </div>


                    <div class="col-6 col-md-3">
                        <input type="text" class="form-control w-100" id="mo" name="mo"
                         <?php if (isset($_GET['mo']) && $_GET['mo'] != null)
{
    echo "value='" . $_GET['mo'] . "'";
}
else
{
    echo "placeholder='all mo'";
}
?> >
                    </div>

                    <div class="col-6 col-md-3">
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

                    

                    


                    <div class="col-12 mx-2 my-2 col-md-1  text-center"> 
                                                   <button type="submit" class="btn btn-primary "><i class="fas fa-search"></i></button>
                    </div>
                    </form>

                </div>

               
                  
                        
                            
                           
                        
                            
                            
                     
                       
                </div>





                <div class="card-body">


                    
<?php
if (isset($_GET['id']) && isset($_GET['serial']))
{

    $id = $_GET['id'];
    $serial = $_GET['serial'];

    if (($serial == null))
    {
        $sql = "SELECT serial FROM visit WHERE id='" . $id . "'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $serial = $row['serial'] + 1;
    }

    $sql = "UPDATE visit SET serial='" . $serial . "' WHERE id='" . $id . "'";
    if (mysqli_query($conn, $sql))
    {

        $params = [];
        if (isset($_GET['todate'])) $params['todate'] = $_GET['todate'];
        if (isset($_GET['mo'])) $params['mo'] = $_GET['mo'];
        if (isset($_GET['route'])) $params['route'] = $_GET['route'];

        $query = http_build_query($params);
        $url = 'orderserial.php' . ($query ? '?' . $query : '');

        echo "<script>window.location.href='" . $url . "';</script>";
        die();

    }
    else
    {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
if (isset($_GET['todate']))
{

    $todate = $_GET['todate'];

}
else
{

    $todate = date('Y.m.d', strtotime("+1 day"));
}
echo "<p id='up' style='text-align: center;'>Order Serial for Delivery @ <b>" . $todate . "</b> " . $_SESSION['company'] . "</p><p style='text-align: center;'>First Delivery First</p>";
$sql = "SELECT * FROM visit WHERE status=1 AND mo='" . $_SESSION['email'] . "' AND company='" . $_SESSION['company'] . "' AND reason='order' AND status != 2 AND ddate = '" . $todate . "'";

if (isset($_GET['mo']) && $_GET['mo'] != '')
{
    $sql .= " AND mo LIKE '%" . $_GET['mo'] . "%'";

}
if (isset($_GET['route']) && $_GET['route'] != '')
{
    $sql .= " AND route LIKE '%" . $_GET['route'] . "%'";
}

$sql .= " ORDER BY serial ";

// echo "<p style='text-align: center; font-size: 1.5em; color: red'>SQL: ".$sql."</p>";


$result = mysqli_query($conn, $sql);
$idList = [];
$count = 1;

$totalamount = 0.0;
$units = array();
$totalQuantity = array();
$productQuantities = array();

if (mysqli_num_rows($result) > 0)
{

    echo "<div class='table-responsive text-center'><table class='table table-bordered mx-auto' id='orderTable'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th class='noPrint'></th>";
    echo "<th>Details</th>";
    echo "<th>Orders</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_assoc($result))
    {

        $idList[] = $row['id'];

        echo "<tr>";

        echo "<td  class='noPrint'>";

        echo "<a  style='margin-bottom: 10px;  width: 50px;' href='invoice.php?order=" . $row['id'] . "' class='btn btn-warning'><i class='fas fa-file-invoice'></i></a><br>ID:" . $row['id'];
        if (isset($_GET['todate']) && $_GET['todate'] != null) $todate = $_GET['todate'];
        else $todate = date('Y.m.d', strtotime("+1 day"));
        if (isset($_GET['mo']) && $_GET['mo'] != null) $mo = $_GET['mo'];
        else $mo = $_SESSION['email'];
        if (isset($_GET['route']) && $_GET['route'] != null) $route = $_GET['route'];
        else $route = "";

        echo "<form action='orderserial.php' method='get'>
        <input type='hidden' name='id' value='" . $row['id'] . "'>
         <input type='hidden' name='todate' value='" . $todate . "'>
         <input type='hidden' name='mo' value='" . $mo . "'>
         <input type='hidden' name='route' value='" . $route . "'>
      
        <input type='number' name='serial' placeholder='" . $row['serial'] . "' style='width: 50px;' >
        <button type='submit' class='btn btn-primary'><i class='fas fa-arrow-alt-circle-down'></i></button>
        </form>";

        echo "</td>";

        echo "<td>" . $count . ". <span class='noPrint'> Memo:</span>" . $row['memo'] . " <span class='noPrint'>Route: </span>(" . strtoupper($row['route']) . ")<span class='noPrint'><br>Shop:</span> " . strtoupper($row['shop']) . " " . $row['phone'] . " <span class='noPrint'><br></span>" . $row['mo'] . "@" . $row['odate'] . "<span class='noPrint'> Delivery: " . $row['ddate'] . " <i></span>";

        echo "<i></td>";
        $count++;

        echo "<td>";
        $orderSql = "SELECT * FROM orders WHERE idvisit='" . $row['id'] . "'";

        if (isset($_GET['product']) && $_GET['product'] != '')
        {
            $orderSql = "SELECT * FROM orders WHERE idvisit='" . $row['id'] . "' AND pn LIKE '%" . $_GET['product'] . "%'";
        }
        $orderResult = mysqli_query($conn, $orderSql);

        if (mysqli_num_rows($orderResult) > 0)
        {

            $total = 0.0;

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

                echo "" . $orderRow['pn'] . " (<i>" . $orderRow['unit'] . "</i>) " . $orderRow['quantity'];
                echo "<span class='noPrint'>@" . $orderRow['rate'];
                echo "=" . ($orderRow['rate'] * $orderRow['quantity']) . "/=</span> ";

                $total += $orderRow['rate'] * $orderRow['quantity'];
                echo "<span class='noPrint'> <br><hr></span>";
            }

        }
        else
        {
            echo "No orders found";
        }
        echo " <b>Total: " . number_format($total, 2) . "/=</b> <i style='font-size: 12px'>" . $row['comment'] . "</i>";
        $totalamount = $totalamount + $total;

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

    <div id='d1' style="display: flex; flex-direction: row; width: 100%; ">
                        <div style="flex: 1; margin-right: 10px;">

                    
                    
                        <p>Total =<?=number_format($totalamount, 2) ?>/=</p>
                    
                <?php
echo "<p>";
foreach ($units as $unit => $count)
{
    echo "<i>Unit " . $unit . " = </i>" . $totalQuantity[$unit] . " Bag <br>";
}
echo "<p>";
?>
                        </div>
        <div style="flex: 1; margin-left: 10px;">
       
    
    
            <p id='d2'><?php

ksort($productQuantities);
foreach ($productQuantities as $product => $quantity)
{
    echo "<i>" . $product . " = </i>" . $quantity . ". ";
}

echo "</p>";
?>
      
        </div>
      


            
     

    </div>

    <div class="Print" style="flex: 1; margin-left: 10px;">
       
    
    
       <div style="display: flex; flex-direction: row; width: 100%; ">
           <div style="flex: 1; height: 70px; margin-right: 10px; font-size: 12px; border: 1px solid #ccc; text-align: center; opacity: 0.5;"><p>PreparedBy</p></div>
           <div style="flex: 1; margin-right: 10px;font-size: 12px; border: 1px solid #ccc; text-align: center; opacity: 0.5"><p>AuthorizedBy</p></div>
           <div style="flex: 1; font-size: 12px; border: 1px solid #ccc; text-align: center; opacity: 0.5"><p>Supervisor</p></div>
       </div>
   
     </div>
     <div class="noPrint">
    <div  style="display: flex; justify-content: center; margin-top: 20px;">
                <button type="button" class="btn btn-success" onclick="gotoInvoice()">Print All Invoices</button>
                </div></div>


            <script>
                var idList = <?=json_encode($idList) ?>;
                function gotoInvoice() {
                    window.location.href = "invoice.php?order=" + idList.join(",");
                }
            </script>

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
        
    </div>

<?php include_once "foot.php"; ?>
