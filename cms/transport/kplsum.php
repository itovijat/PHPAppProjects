<?php include_once "head2.php"; ?>

<div class="content">
        <!-- Main content goes here -->

       
        


    <div id="up">
        <div class="d-flex justify-content-between align-items-center">
        <h2>KPL Data Summary</h2> 
            <div>
                <span class="mr-2"><?php echo $_SESSION['email']; ?></span>
                <span class="mr-2">(<?php echo $_SESSION['role']; ?>, <?php echo $_SESSION['company']; ?>)</span>
                <span class="mr-2"><?php echo date('Y-m-d H:i:s'); ?></span>
            </div>
         
           
        </div>

        <hr>
        <p id="searchvalues" style="display: none; text-align: center;"></p>


    </div>
        <div class="d-flex justify-content-center align-items-center flex-wrap hideonprint">
            <div class="input-group mb-3 mr-3 hideonprint">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-truck"></i></span>
                </div>
                <input type="text" class="form-control" id="vname" placeholder="Vehicle Name" onkeyup="searchfilter()" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <button type="button" class="btn btn-outline-primary mb-3 mr-3 hideonprint" onclick="location.reload()">Refresh</button>
            <button type="button" class="btn btn-outline-success mb-3 hideonprint" onclick="tableToExcel('tt', 'KPL Report')">Export to Excel</button>
        </div>
        
       
        <table class="table table-striped table-bordered" id="tt">
            <thead class="thead-dark">
                <tr>
                    <th>id</th>
                    <th>Vehicle</th>
                    <th>Oil Quantity</th>
                    <th>Oil Price</th>
                    <th>Distance</th>
                    <th>Avg Oil/Km</th>
                    <th>Avg Price/Km</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php
                    $vehicle_name = '';
                    if (isset($_POST['vehicle_name'])) {
                        $vehicle_name = $_POST['vehicle_name'];
                    }
                    $sql = "SELECT vehicle_name, SUM(oil_quantity) AS oil_quantity, SUM(oil_price) AS oil_price, SUM(distance) AS distance 
                    FROM kpl WHERE company='".$_SESSION['company']."' AND id != (SELECT MAX(id) FROM kpl) AND vehicle_name LIKE '%$vehicle_name%' GROUP BY vehicle_name";

                    $result = mysqli_query($conn, $sql);
                    $serial_number = 1;
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $avg_oil_km = $row['oil_quantity'] / $row['distance'];
                            $avg_price_km = $row['oil_price'] / $row['distance'];
                            echo "<tr>";
                            echo "<td>".$serial_number."</td>";
                            echo "<td>".$row['vehicle_name']."</td>";
                            echo "<td>".number_format($row['oil_quantity'], 2)."</td>";
                            echo "<td>".number_format($row['oil_price'], 2)."</td>";
                            echo "<td>".number_format($row['distance'], 2)."</td>";
                            echo "<td>".number_format($avg_oil_km, 2)."</td>";
                            echo "<td>".number_format($avg_price_km, 2)."</td>";
                            echo "</tr>";
                            $serial_number++;
                        }
                    } else {
                        echo "0 results";
                    }
                ?>
            </tbody>
        </table>

     

    </div>




    <script>
        function searchfilter(){
            var vname = document.getElementById("vname").value;
            
            var tbody = document.getElementById("tbody");
            var tr = tbody.getElementsByTagName("tr");
            
            for (i = 0; i < tr.length; i++) {
                var td = tr[i].getElementsByTagName("td");
                var vnamefilter = td[1].innerHTML.toLowerCase().includes(vname.toLowerCase());
                if (vnamefilter) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }

            searchfilter2();
        }


        function searchfilter2(){
            var vname = document.getElementById("vname").value;
   
            var searchvalues = document.getElementById("searchvalues");

            searchvalues.style.display = "block";
          
            var html = "";
            if(vname) html += `<span class="badge badge-secondary m-1">Vehicle: ${vname} </span> `;
          
            searchvalues.innerHTML = html;
        }


        function tableToExcel(tableID, filename = ''){
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var upDiv = document.getElementById('up');
            var tableHTML = upDiv.innerHTML + tableSelect.outerHTML.replace(/ /g, '%20');
            
            // Specify file name
            var d = new Date();
            filename = (filename ? filename : 'KPL Sum Report') + '_'+ d.toLocaleString('en-GB').replace(/\/|,|\s/g,'') + '.xls';
            
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


    <?php include_once "foot.php"; ?>