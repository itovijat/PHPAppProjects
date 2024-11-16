<?php include_once "head2.php"; ?>


<div class="content">
        <div id="up">
        <div class="d-flex justify-content-between align-items-center">
            <h2>KPL Data</h2>
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
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-truck"></i></span>
              </div>
              <input type="text" class="form-control" id="vname" placeholder="Vehicle Name" onkeyup="searchfilter()" aria-label="Username" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="col-12 col-md-4 hideonprint">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control" id="dname" placeholder="Driver Name" onkeyup="searchfilter()" aria-label="Username" aria-describedby="basic-addon1">
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
              <input type="text" class="form-control" id="ed1" placeholder="Entry Date From" onkeyup="searchfilter()" onchange="searchfilter()" aria-label="Username" aria-describedby="basic-addon1">
              <input type="text" class="form-control" id="ed2" placeholder="To" onkeyup="searchfilter()" onchange="searchfilter()" aria-label="Username" aria-describedby="basic-addon1">
            </div>
          </div>
          
          <div class="col-12 text-center mb-3 hideonprint">
            <button type="button" class="btn btn-outline-primary" onclick="location.reload()">Refresh</button>
            <button type="button" class="btn btn-outline-success" onclick="tableToExcel('kplTable', 'KPL Report')">Export to Excel</button>
            
            <script>
              function tableToExcel(tableID, filename = ''){
                var downloadLink;
                var dataType = 'application/vnd.ms-excel';
                var tableSelect = document.getElementById(tableID);
                var upDiv = document.getElementById('up');
                var tableHTML = upDiv.innerHTML + tableSelect.outerHTML.replace(/ /g, '%20');
                
                // Specify file name
                var d = new Date();
                filename = (filename ? filename : 'KPL Report') + '_'+ d.toLocaleString('en-GB').replace(/\/|,|\s/g,'') + '.xls';
                
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
        
        <table class="table table-striped table-bordered" id="kplTable">
          <thead class="thead-dark">
            <tr>
              <th>id</th>
              <th class="hideonprint">ID</th>
              <th>Vehicle Name</th>
              <th>Driver Name</th>
              <th>Entry Date</th>
              <th>Oil Quantity</th>
              <th>Oil Price</th>
              <th>Distance</th>
              <th>Remark</th>
            </tr>
          </thead>
          <tbody id="tbody">
            <?php
            $sql = "SELECT * FROM kpl WHERE company = '$_SESSION[company]' ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);
            $serial_number = 1;
            if (mysqli_num_rows($result) > 0) {
              // output data of each row
              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$serial_number."</td>";
                echo "<td class='hideonprint'>".$row['id']."</td>";
                echo "<td>".$row['vehicle_name']."</td>";
                echo "<td>".$row['driver_name']."</td>";
                echo "<td>".date('Y-m-d', strtotime($row['entry_date']))."</td>";
                echo "<td>".$row['oil_quantity']."</td>";
                echo "<td>".$row['oil_price']."</td>";
                echo "<td>".$row['distance']."</td>";
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
  
          </tfoot>
        </table>

        <script>
        $(function() {
          $('#ed1, #ed2').datepicker({
            dateFormat: 'yy-mm-dd'
          });
        });
        function searchfilter(){
          var vname = document.getElementById("vname").value;
          var dname = document.getElementById("dname").value;
          var remark = document.getElementById("remark").value;
          var ed1 = document.getElementById("ed1").value;
          var ed2 = document.getElementById("ed2").value;
          
          var tbody = document.getElementById("tbody");
          var tr = tbody.getElementsByTagName("tr");
          
          for (i = 0; i < tr.length; i++) {
            var td = tr[i].getElementsByTagName("td");
            var vnamefilter = td[2].innerHTML.toLowerCase().includes(vname.toLowerCase());
            var dnamefilter = td[3].innerHTML.toLowerCase().includes(dname.toLowerCase());
            var ed1filter = (ed1 == '') ? true : (new Date(td[4].innerHTML) >= new Date(ed1));
            var ed2filter = (ed2 == '') ? true : (new Date(td[4].innerHTML) <= new Date(ed2));
            var remarkfilter = td[8].innerHTML.toLowerCase().includes(remark.toLowerCase());
            if (vnamefilter && dnamefilter && ed1filter && ed2filter && remarkfilter) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }
          
          searchfilter2();
        }
        </script>
   
   <script>
        function searchfilter2(){
            var vname = document.getElementById("vname").value;
            var dname = document.getElementById("dname").value;
            var remark = document.getElementById("remark").value;
            var ed1 = document.getElementById("ed1").value;
            var ed2 = document.getElementById("ed2").value;
   
            var searchvalues = document.getElementById("searchvalues");

            searchvalues.style.display = "block";
          
            var html = "";
            if(vname) html += `<span class="badge badge-secondary m-1">Vehicle: ${vname} </span> `;
            if(dname) html += `-<span class="badge badge-secondary m-1">Driver: ${dname} </span> `;
            if(remark) html += `-<span class="badge badge-secondary m-1">Remark: ${remark} </span> `;
            if(ed1 && ed2) html += `-<span class="badge badge-secondary m-1">Entry: ${ed1} to ${ed2} </span> `;
          
            searchvalues.innerHTML = html;
        }
        </script>

<?php
include_once 'foot.php';
?>


