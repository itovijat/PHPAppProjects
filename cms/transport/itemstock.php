<?php include_once "head2.php"; ?>


<div class="content">
        <div id="up">
        <div class="d-flex justify-content-between align-items-center">

        
            <h2>Store Item Stock</h2>
            <div>
                <span class="mr-2"><?php echo $_SESSION['email']; ?></span>
                <span class="mr-2">(<?php echo $_SESSION['role']; ?>, <?php echo $_SESSION['company']; ?>)</span>
                <span class="mr-2"><?php echo date('Y-m-d H:i:s'); ?></span>
            </div>
        </div>
        <hr>
        <?php
        if(isset($_GET['pdname']) || isset($_GET['ed1']) || isset($_GET['ed2'])){
          $message = "";
          if(isset($_GET['pdname']) && $_GET['pdname'] != ''){
            $message .= "Product Name: ".$_GET['pdname']." ";
          }
          if(isset($_GET['ed1']) && $_GET['ed1'] != '' && isset($_GET['ed2']) && $_GET['ed2'] != ''){
            $message .= "Entry Date: ".$_GET['ed1']." to ".$_GET['ed2']." ";
          }
          if($message != ''){
            echo "<p style='text-align: center;'>".$message."</p>";
          }
        
        }
        ?>
        </div>


       
        <div class="row justify-content-center" style="margin-bottom: 20px;">



        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get" class="form-inline hideonprint">
          <div class="form-group mr-2">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-box"></i></span>
              </div>
              <input type="text" class="form-control" id="pdname" name="pdname" placeholder="Product Name" value="<?php echo isset($_GET['pdname']) ? $_GET['pdname'] : ''; ?>" aria-label="Username" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="form-group mr-2">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-upload"></i></span>
              </div>
              <input type="text" class="form-control" id="ed1" name="ed1" placeholder=" Entry Date From" value="<?php echo isset($_GET['ed1']) ? $_GET['ed1'] : date('Y-m-01'); ?>" aria-label="Username" aria-describedby="basic-addon1" onkeyup="validateDate()" onchange="validateDate()" autocomplete="off">
              <input type="text" class="form-control" id="ed2" name="ed2" placeholder="To" value="<?php echo isset($_GET['ed2']) ? $_GET['ed2'] : date('Y-m-t'); ?>" aria-label="Username" aria-describedby="basic-addon1" onkeyup="validateDate()" onchange="validateDate()" autocomplete="off">
              <script>
                $(function() {
                  $('#ed1, #ed2').datepicker({
                    dateFormat: 'yy-mm-dd'
                  });
                });
                function validateDate(){
                  var ed1 = document.getElementById("ed1").value;
                  var ed2 = document.getElementById("ed2").value;
                  if((ed1 == '' && ed2 != '') || (ed1 != '' && ed2 == '')){
                    document.forms[0].submit.disabled = true;
                  }
                  else{
                    document.forms[0].submit.disabled = false;
                  }
                }
              </script>
            </div>
          </div>
          <button type="submit" name="submit" id="submit" class="btn btn-primary hideonprint">Search</button>
        </form>






        </div>
          <div class="col-12 text-center mb-3 hideonprint">
            <button type="button" class="btn btn-outline-primary" onclick="window.location.href=window.location.pathname">Refresh</button>
            <button type="button" class="btn btn-outline-success" onclick="tableToExcel('itemTable', 'Item Report')">Export to Excel</button>
            
            <script>
              function tableToExcel(tableID, filename = ''){
                var downloadLink;
                var dataType = 'application/vnd.ms-excel';
                var tableSelect = document.getElementById(tableID);
                var upDiv = document.getElementById('up');
                var tableHTML = upDiv.innerHTML + tableSelect.outerHTML.replace(/ /g, '%20');

                // Specify file name
                var d = new Date();
                filename = (filename ? filename : 'Item Report') + '_'+ d.toLocaleString('en-GB').replace(/\/|,|\s/g,'') + '.xls';

                // Create download link element
                downloadLink = document.createElement("a");

                document.body.appendChild(downloadLink);

                if(navigator.msSaveOrOpenBlob){
                    var blob = new Blob(['\ufeff', tableHTML], {
                        type: dataType
                    });
                    navigator.msSaveOrOpenBlob( blob, filename);
                }else{
                    // Create a link to the file
                    downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
                    
                    // Setting the file name
                    downloadLink.download = filename;
                    
                    //triggering the function
                    downloadLink.click();
                }
              }
            </script>
          </div>
        
        <table class="table table-striped table-bordered" id="itemTable" >
          <thead class="thead-dark">
            <tr>
              <th>id</th>
              <th>Product Name</th>
              <th>In Quantity</th>
              <th>Out Quantity</th>
              <th>Balance</th>
              <th>Total Value</th>
            </tr>
          </thead>
          <tbody id="tbody">
            <?php
            if(isset($_GET['submit']))
            {
              $pdname = $_GET['pdname'];
              $ed1 = $_GET['ed1'];
              $ed2 = $_GET['ed2'];
              if($pdname != '' && $ed1 != '' && $ed2 != '')
              {
                $sql = "SELECT product_name, SUM(in_quantity) AS in_quantity, SUM(out_quantity) AS out_quantity, SUM(value) AS total_value FROM inventory WHERE company = '".$_SESSION['company']."' AND product_name LIKE '%".$pdname."%' AND entry_date BETWEEN '".$ed1."' AND '".$ed2."' GROUP BY product_name ORDER BY product_name ASC";
              }
              else if($pdname != '' && $ed1 == '' && $ed2 == '')
              {
                $sql = "SELECT product_name, SUM(in_quantity) AS in_quantity, SUM(out_quantity) AS out_quantity, SUM(value) AS total_value FROM inventory WHERE company = '".$_SESSION['company']."' AND product_name LIKE '%".$pdname."%' GROUP BY product_name ORDER BY product_name ASC";
              }
              else if($pdname == '' && $ed1 != '' && $ed2 != '')
              {
                $sql = "SELECT product_name, SUM(in_quantity) AS in_quantity, SUM(out_quantity) AS out_quantity, SUM(value) AS total_value FROM inventory WHERE company = '".$_SESSION['company']."' AND entry_date BETWEEN '".$ed1."' AND '".$ed2."' GROUP BY product_name ORDER BY product_name ASC";
              }
              else
              {
                $sql = "SELECT product_name, SUM(in_quantity) AS in_quantity, SUM(out_quantity) AS out_quantity, SUM(value) AS total_value FROM inventory WHERE company = '".$_SESSION['company']."' GROUP BY product_name ORDER BY product_name ASC";
              }
            }
            else
            {
              $sql = "SELECT product_name, SUM(in_quantity) AS in_quantity, SUM(out_quantity) AS out_quantity, SUM(value) AS total_value FROM inventory WHERE company = '".$_SESSION['company']."' GROUP BY product_name ORDER BY product_name ASC";
            }
            $result = mysqli_query($conn, $sql);
            $serial_number = 1;
            if (mysqli_num_rows($result) > 0) {
              // output data of each row
              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$serial_number."</td>";
                echo "<td>".$row['product_name']."</td>";
                echo "<td>".$row['in_quantity']."</td>";
                echo "<td>".$row['out_quantity']."</td>";
                echo "<td>".($row['in_quantity'] - $row['out_quantity'])."</td>";
                echo "<td>".$row['total_value']."</td>";
                echo "</tr>";
                $serial_number++;
              }
            } else {
              echo "0 results";
            }
            ?>
          </tbody>
        </table>

       


<?php
include_once 'foot.php';
?>


