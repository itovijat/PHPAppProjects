<?php include_once "head2.php"; ?>


<div class="content">
        <div id="up">
        <div class="d-flex justify-content-between align-items-center">

        
            <h2>Store Item Data</h2>
            <div>
                <span class="mr-2"><?php echo $_SESSION['email']; ?></span>
                <span class="mr-2">(<?php echo $_SESSION['role']; ?>, <?php echo $_SESSION['company']; ?>)</span>
                <span class="mr-2"><?php echo date('Y-m-d H:i:s'); ?></span>
            </div>
        </div>
        <hr>
        <p id="searchvalues" style="display: none; text-align: center;"></p>

        </div>


       
        <div class="row justify-content-center">
        <div class="col-12 col-md-4 hideonprint">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-box"></i></span>
              </div>
              <input type="text" class="form-control" id="pdname" placeholder="Product Name" onkeyup="searchfilter()" aria-label="Username" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="col-12 col-md-4 hideonprint">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control" id="pname" placeholder="Person Name" onkeyup="searchfilter()" aria-label="Username" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="col-12 col-md-4 hideonprint">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-comment"></i></span>
              </div>
              <input type="text" class="form-control" id="remark" placeholder="Remark" onkeyup="searchfilter()" aria-label="Username" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="col-12 col-md-4 hideonprint">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-upload"></i></span>
              </div>
              <input type="text" class="form-control" id="ed1" placeholder=" Entry Date From" onkeyup="searchfilter()" onchange="searchfilter()" aria-label="Username" aria-describedby="basic-addon1">
              <input type="text" class="form-control" id="ed2" placeholder="To" onkeyup="searchfilter()" onchange="searchfilter()" aria-label="Username" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="col-12 col-md-4 hideonprint">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-ban"></i></span>
              </div>
              <input type="text" class="form-control" id="expd1" placeholder="Expiry Date From" onkeyup="searchfilter()" onchange="searchfilter()" aria-label="Username" aria-describedby="basic-addon1">
              <input type="text" class="form-control" id="expd2" placeholder="To" onkeyup="searchfilter()" onchange="searchfilter()" aria-label="Username" aria-describedby="basic-addon1">
            </div>
          </div>

          <div class="col-12 col-md-4 hideonprint">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-filter"></i></span>
              </div>
              <select class="form-control" id="quantitytype" onchange="searchfilter()">
                <option value="">Select Quantity Type</option>
                <option value="in">In Quantity</option>
                <option value="out">Out Quantity</option>
                <option value="both">Both</option>
              </select>
            </div>
          </div>
          
          <div class="col-12 text-center mb-3 hideonprint">
            <button type="button" class="btn btn-outline-primary" onclick="location.reload()">Refresh</button>
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
        
        <table class="table table-striped table-bordered" id="itemTable">
          <thead class="thead-dark">
            <tr>
              <th>id</th>
              <th class="hideonprint">ID</th>
              <th>Product Name</th>
              <th>In Quantity</th>
              <th>Out Quantity</th>

              <th>Entry Date</th>
              <th>Value</th>

              <th>Person Name</th>
              <th>Expiry Date</th>
              <th>Remark</th>
            </tr>
          </thead>
          <tbody id="tbody">
            <?php
            $sql = "SELECT * FROM inventory WHERE company = '".$_SESSION['company']."' ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);
            $serial_number = 1;
            if (mysqli_num_rows($result) > 0) {
              // output data of each row
              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$serial_number."</td>";
                echo "<td class='hideonprint'>".$row['id']."</td>";
                echo "<td>".$row['product_name']."</td>";
                echo "<td>".$row['in_quantity']."</td>";
                echo "<td>".$row['out_quantity']."</td>";

                echo "<td>".date('Y-m-d', strtotime($row['entry_date']))."</td>";
                echo "<td>".$row['value']."</td>";

                echo "<td>".$row['person_name']."</td>";
                echo "<td>".date('Y-m-d', strtotime($row['expiry_date']))."</td>";
                echo "<td>".$row['remark']."</td>";
                echo "</tr>";
                $serial_number++;
              }
            } else {
              echo "0 results";
            }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th></th>
              <th class="hideonprint"></th>
              <th id="totalproduct"><?php
              $sql = "SELECT COUNT(DISTINCT product_name) FROM inventory WHERE company = '".$_SESSION['company']."'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
              echo $row['COUNT(DISTINCT product_name)']." Items";
              ?></th>
              <th id="totalin"><?php
              $sql = "SELECT SUM(in_quantity) FROM inventory WHERE company = '".$_SESSION['company']."'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
              echo $row['SUM(in_quantity)'];
              ?></th>
              <th id="totalout"><?php
              $sql = "SELECT SUM(out_quantity) FROM inventory WHERE company = '".$_SESSION['company']."'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
              echo ' - '.$row['SUM(out_quantity)'];
              ?></th>
              <th id="totalbalance"><?php
              $sql = "SELECT SUM(in_quantity - out_quantity) FROM inventory WHERE company = '".$_SESSION['company']."'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
              echo "= ". $row['SUM(in_quantity - out_quantity)'];
              ?></th>
              <th id="totalvalue"><?php
              $sql = "SELECT SUM(value) AS total_value FROM inventory WHERE in_quantity  > 0 AND company = '".$_SESSION['company']."'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
              $total_in = $row['total_value'];
              
              $sql = "SELECT SUM(value) AS total_value FROM inventory WHERE out_quantity  > 0 AND company = '".$_SESSION['company']."'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
              $total_out = $row['total_value'];
              
              echo "= ". number_format($total_in - $total_out, 2);
              ?></th>
              <th id="totalperson"><?php
              $sql = "SELECT COUNT(DISTINCT person_name) FROM inventory WHERE company = '".$_SESSION['company']."'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
              echo $row['COUNT(DISTINCT person_name)']." Persons";
              ?></th>
            </tr>
          </tfoot>
        </table>

        <script>
        $(function() {
          $('#ed1, #ed2, #expd1, #expd2').datepicker({
            dateFormat: 'yy-mm-dd'
          });
        });
        function searchfilter(){
          var pname = document.getElementById("pname").value;
          var pdname = document.getElementById("pdname").value;
          var ed1 = document.getElementById("ed1").value;
          var ed2 = document.getElementById("ed2").value;
          var expd1 = document.getElementById("expd1").value;
          var expd2 = document.getElementById("expd2").value;
          var remark = document.getElementById("remark").value;
          var quantitytype = document.getElementById("quantitytype").value;
          
          var tbody = document.getElementById("tbody");
          var tr = tbody.getElementsByTagName("tr");
          var totalin = 0;
          var totalout = 0;
          var totalbalance = 0;
          var totalproduct = 0;
          var totalperson = 0;
          var id = 0;
          var products = [];
          var persons = [];
          
          for (i = 0; i < tr.length; i++) {
            var td = tr[i].getElementsByTagName("td");
            var pnamefilter = td[6].innerHTML.includes(pname);
            var pdnamefilter = td[2].innerHTML.includes(pdname);
            var ed1filter = (ed1 == '') ? true : (new Date(td[5].innerHTML) >= new Date(ed1));
            var ed2filter = (ed2 == '') ? true : (new Date(td[5].innerHTML) <= new Date(ed2));
            var expd1filter = (expd1 == '') ? true : (new Date(td[7].innerHTML) >= new Date(expd1));
            var expd2filter = (expd2 == '') ? true : (new Date(td[7].innerHTML) <= new Date(ed2));
            var remarkfilter = td[8].innerHTML.includes(remark);
            var quantitytypefilter = (quantitytype == "in") ? (parseInt(td[3].innerHTML) > 0) : (quantitytype == "out") ? (parseInt(td[4].innerHTML) > 0) : true;

            if (pnamefilter && pdnamefilter && ed1filter && ed2filter && expd1filter && expd2filter && remarkfilter && quantitytypefilter) {
              tr[i].style.display = "";
              totalin += parseInt(td[3].innerHTML);
              totalout += parseInt(td[4].innerHTML);
              totalbalance += parseInt(td[3].innerHTML) - parseInt(td[4].innerHTML);
              products.push(td[2].innerHTML);
              persons.push(td[6].innerHTML);
              id++;
              td[0].innerHTML = id;
            } else {
              tr[i].style.display = "none";
            }
          }
          document.getElementById("totalin").innerHTML = totalin;
          document.getElementById("totalout").innerHTML = totalout;
          document.getElementById("totalbalance").innerHTML = '= '+totalbalance;
          document.getElementById("totalproduct").innerHTML = [...new Set(products)].length+" Items";
          document.getElementById("totalperson").innerHTML = [...new Set(persons)].length+" Persons";
          searchfilter2();
        }
        </script>
     
     <script>
        function searchfilter2(){
            var pdname = document.getElementById("pdname").value;
            var pname = document.getElementById("pname").value;
            var remark = document.getElementById("remark").value;
            var ed1 = document.getElementById("ed1").value;
            var ed2 = document.getElementById("ed2").value;
            var expd1 = document.getElementById("expd1").value;
            var expd2 = document.getElementById("expd2").value;
            var quantitytype = document.getElementById("quantitytype").value;

            var searchvalues = document.getElementById("searchvalues");

            searchvalues.style.display = "block";
          
            searchvalues.innerHTML = [" ",
            quantitytype ? ` <span class="badge badge-secondary m-1"> <h2>${quantitytype}</h2> </span> ` : " ",
                pdname ? ` - <span class="badge badge-secondary m-1">Product: ${pdname} </span> ` : " ",
                pname ? ` - <span class="badge badge-secondary m-1">Person: ${pname} </span> ` : " ",
                remark ? ` - <span class="badge badge-secondary m-1">Remark: ${remark} </span> ` : " ",
                ed1 && ed2 ? ` - <span class="badge badge-secondary m-1">Entry: ${ed1} to ${ed2} </span> ` : " ",
                expd1 && expd2 ? ` - <span class="badge badge-secondary m-1">Expire: ${expd1} to ${expd2} </span> ` : " "
                
            ].filter(Boolean).join(" ");
        }
        </script>


<?php
include_once 'foot.php';
?>


