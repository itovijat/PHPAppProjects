<?php include_once "head2.php"; ?>
<div class="content noPrint">
</div>
<div class="content2">

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header noPrint bg-success text-white">
                <div class="row">
                    <div class="col-12 col-md-12" style="text-align: center;"> <h1 >Location</h1></div>
                    <form class="form-inline">

                    <div class="col-6 col-md-2">
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
                    
                    <div class="col-6 col-md-2">
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
if (isset($_GET['fromdate']))
{

    $fromdate = $_GET['fromdate'];

}
else
{

    $fromdate = date('Y.m.d');
}
if (isset($_GET['todate']))
{

    $todate = $_GET['todate'];

}
else
{

    $todate = date('Y.m.d');
}

echo "<p id='up' style='text-align: center;'>Locations @ <b>" . $fromdate . "</b> to <b>" . $todate . "</b> " . $_SESSION['company'] . "</p><p style='text-align: center;'></p>";
$sql = "SELECT * FROM visit WHERE  company='" . $_SESSION['company'] . "'  AND  odate BETWEEN '" . $fromdate . "' AND '" . $todate . "'";

if (isset($_GET['mo']) && $_GET['mo'] != '')
{
    $sql .= " AND mo LIKE '%" . $_GET['mo'] . "%'";

}
if (isset($_GET['route']) && $_GET['route'] != '')
{
    $sql .= " AND route LIKE '%" . $_GET['route'] . "%'";
}

$sql .= " ORDER BY id DESC ";

// echo "<p style='text-align: center; font-size: 1.5em; color: red'>SQL: ".$sql."</p>";


$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0)
{

    echo "<div class='table-responsive text-center'><table class='table table-bordered mx-auto' id='orderTable'>";    echo "<tr><th>Status</th><th>MO</th><th>Route Shop</th><th>Location</th></tr>";
    while($row = mysqli_fetch_assoc($result))
    {
        echo "<tr>";
        echo "<td>ID:" . $row['id'] . " ";
        $statusText = '';
        switch ($row['status']) {
            case 0:
                $statusText = 'Pending';
                if ($row['reason'] == 'visit') $statusText = 'Empty';
                break;
            case 1:
                $statusText = 'Accepted';
                break;
            case 2:
                $statusText = 'Cancelled';
                break;
                case 3:
                    $statusText = 'Delivered';
                    break;
                    case 4:
                        $statusText = 'Rejected';
                        break;
                        case 5:
                            $statusText = 'Returned';
                            break;
            default:
                $statusText = 'Unknown';
        }
        echo "" . $statusText ." ". $row['reason'] . "</td>";
        
        echo "<td>" . $row['mo'] ."<br>".$row['date']. "</td>";
        echo "<td>" . $row['route'] . " " . $row['shop'] . "</td>";
        echo "<td><a href='https://www.google.com/maps/search/?api=1&query=" . $row['latitude'] . "," . $row['longitude'] . "' target='_blank'>" . $row['latitude'] . "," . $row['longitude'] . "</a></td>";
      
        echo "</tr>";
    }
    echo "</table> </div>";
}
else
{
    echo "<p style='text-align: center; font-size: 2em; color: red'>0 results</p>";
}
?>

    
      


            
     

    

    
   

<div class='noPrint' style="text-align: center; margin: 10px;">
            <button type="button" class="btn btn-primary" onclick="tableToExcel('orderTable', 'location<?=date('Ymd_His') ?>')"><i class="fas fa-file-excel"></i> Export to Excel</button>
            <button type="button" class="btn btn-primary" onclick="tableToCSV('orderTable', 'location<?=date('Ymd_His') ?>.csv')"><i class="fas fa-file-csv"></i> Export to CSV</button>
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

     
        var up = document.getElementById('up');

        // Create a new workbook and a worksheet
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

        // Adding additional content
        XLSX.utils.sheet_add_aoa(ws, [[up.innerText]], {origin: "A1"});
      

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
