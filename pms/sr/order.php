<?php include_once "head2.php"; ?>


<?php
$sql = "CREATE TABLE IF NOT EXISTS orders (
    SN INT AUTO_INCREMENT PRIMARY KEY,
    snvisit VARCHAR(10),
    pn VARCHAR(30),
    unit FLOAT,
    rate FLOAT,

    quantity FLOAT
)";
if (mysqli_query($conn, $sql)) {
    // echo "Table created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}


if (isset($_GET['orderdel'])) {
    $sql = "SELECT status FROM visit WHERE SN='".$_GET['order']."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['status'] == 0) {
            $sql = "DELETE FROM orders WHERE SN='".$_GET['orderdel']."'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Record deleted successfully');window.location.href='order.php?order=".$_GET['order']."#productform';</script>";
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('Order already accepted or canceled. Can't delete.');</script>";
        }
    } else {
        echo "<script>alert('Order already accepted or canceled. Can't delete.');</script>";
    }
}
if (isset($_POST['pn'])) {
    $snvisit = $_POST['snvisit'];
    $pn = $_POST['pn'];
    $unit = $_POST['unit'];
    $rate = $_POST['rate'];
    $quantity = $_POST['quantity'];
    $sql = "INSERT INTO orders (snvisit, pn, unit, rate, quantity) VALUES ('$snvisit', '$pn', '$unit', '$rate', '$quantity')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        echo "<script>window.location.href='order.php?order=".$snvisit."#productform';</script>";
        
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql = "UPDATE visit SET reason='order' WHERE SN='".$_POST['snvisit']."'";
    if (mysqli_query($conn, $sql)) {
        // echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

$company = $_SESSION['company'];
    $sql = "INSERT INTO products (name, company) SELECT '$pn', '$company' FROM 
    dual WHERE NOT EXISTS (SELECT 1 FROM products WHERE name='$pn' AND company='$company')";
    if (mysqli_query($conn, $sql)) {
        // echo "New route created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}


?>


<div class="content">
    <!-- Main content goes here -->

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Order Add</h2>
                </div>
                <div class="card-body">


                    <?php
                    $sql = "SELECT * FROM visit WHERE SN='".$_GET['order']."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='row justify-content-center'>";
                            echo "<div class=' col-12 text-center'>".$row['reason']." ";

                            echo "".$row['SN']." @ ";

                            echo "".$row['date']."</div>";
                            echo "<div class=' col-12 text-center'>".$row['shop']." ";
                           
                            echo "".$row['phone']." ";
                            echo "".$row['route']." MarketingOfficer_".$row['mo']."</div>";
                            echo "</div>";
                           
                            $order = $_GET['order'];
                            if($row['status'] != 0){
                                echo "Memo: ".$row['memo'];
                                echo " ODate: ".date('Y.m.d', strtotime($row['odate']));
                                echo " DDate: ".date('Y.m.d', strtotime($row['ddate']));
                                echo " Comment: ".$row['comment'];
                            } else {
                                echo "<form style='background-color: #f1f1f1' action='order.php?order=".$order."' method='POST' class='d-flex flex-wrap p-2 border'>";
                                echo "<div class='d-flex flex-wrap'>";
                                echo "<div class='col-12 col-md-3 p-2'><div class='d-flex flex-row'><div><label>Memo:</label></div><div><input type='text' name='memo' value='".$row['memo']."' required class='form-control'></div></div></div>";
                                echo "<div class='col-6 col-md-3 p-2'><div class='d-flex flex-row'><div><label>O</label></div><div><input type='text' name='odate' value='".date('Y.m.d', strtotime($row['odate']))."' required pattern='[0-9]{4}\.[0-9]{2}\.[0-9]{2}' title='Year.Month.Day' class='form-control'></div></div></div>";
                                echo "<div class='col-6 col-md-3 p-2'><div class='d-flex flex-row'><div><label>D</label></div><div><input type='text' name='ddate' value='".date('Y.m.d', strtotime($row['ddate']))."' required pattern='[0-9]{4}\.[0-9]{2}\.[0-9]{2}' title='Year.Month.Day' class='form-control'></div></div></div>";
                                echo "<div class='col-12 col-md-3 p-2'><div class='d-flex flex-row'><div><label>Note:</label></div><div><input type='text' name='comment' value='".$row['comment']."' maxlength='50' class='form-control'></div></div></div>";
                                echo "</div>";
                                echo "<div class='text-center mx-auto my-auto'><input type='submit' value='Update' class='btn btn-primary'></div>";
                                echo "</form>";
                            }
                            echo "<br>";
                            
                        }
                    }

                    if (isset($_POST['memo'])) {
                        $sql = "UPDATE visit SET memo='".$_POST['memo']."', odate='".$_POST['odate']."', ddate='".$_POST['ddate']."', comment='".$_POST['comment']."' WHERE SN='".$_GET['order']."'";
                        if (mysqli_query($conn, $sql)) {
                            echo "Record updated successfully";
                            echo "<script>window.location.href='order.php?order=".$_GET['order']."';</script>";
                        } else {
                            echo "Error updating record: " . mysqli_error($conn);
                        }
                    }




                
                    $sql = "SELECT status FROM visit WHERE SN='".$_GET['order']."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        if($row['status']=="0"){
                    ?>
                    <form id="productform" style='background-color: #f1f1f1' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <div class="form-group" style="display:none;">
                            <label for="snvisit">SN Visit:</label>
                            <input type="text" class="form-control" id="snvisit" name="snvisit" value="<?php echo $_GET['order']; ?>" required>
                        </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="pn">Product: (Ovijat Miniket)</label>
                            <select class="form-control" id="pn" name="pn" required>
                                <option value="">Select Product</option>
                            <?php
                            $sql = "SELECT name FROM products WHERE company='".$_SESSION['company']."'";
                            $result2 = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result2) > 0) {
                                while($row2 = mysqli_fetch_assoc($result2)) {
                                    echo "<option value='".$row2['name']."'>".$row2['name']."</option>";
                                }
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-3 col-md-2">
                            <label for="unit">Per Unit:</label>
                            <input type="number" class="form-control" id="unit" name="unit" step="0.01" required>
                        </div>
                        <div class="form-group col-4 col-md-2">
                            <label for="quantity">Quantity:</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" step="0.01" required>
                        </div>
                        <div class="form-group col-5 col-md-2">
                            <label for="rate">Rate:</label>
                            <input type="number" class="form-control" id="rate" name="rate" step="0.01" required>
                        </div>
                      
                        <div class="form-group col-md-12 text-center col-12" style=" float: center;">
                        <button type="submit" class="btn btn-primary" style="height: 100%; width: 100%;">+Add This Product</button>

                        </div>
                    </div>
                    </form>
                    <?php
                        }

                        if($row['status']=="1"){
                            echo "<h3>Order Accepted</h3>";
                        }elseif($row['status']=="2"){
                            echo "<h3>Order Canceled</h3>";
                        }
                        
                    }
                   







                    $sql = "SELECT * FROM orders WHERE snvisit='".$_GET['order']."' ORDER BY SN DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table style='background-color:  green; color: white'  class='table'>";
                        echo "<thead>";
                        echo "<tr>";
                      
                        echo "<th>Products</th>";
                        
                        
                        echo "<th></th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        $tq=0;
                        $tp=0;
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            $tq+=$row['quantity'];
                            $tp+=($row['rate']*$row['quantity']);
                            echo "<td>".$row['pn']." ";
                            echo " (".$row['unit'].") ";
                            echo " ".$row['rate']."X";
                            echo "".$row['quantity']."=";
                            
                            echo "".($row['rate']*$row['quantity'])."/=</td>";
                            
                            echo "<td><a href='order.php?orderdel=".$row['SN']."&order=".$_GET['order']."' class='btn btn-danger'>X</a></td>";
                            
                            echo "</tr>";
                        }

                        function numberToWords($num) {
                            $ones = array(
                                0 => "zero", 1 => "one", 2 => "two", 3 => "three", 4 => "four", 
                                5 => "five", 6 => "six", 7 => "seven", 8 => "eight", 9 => "nine", 
                                10 => "ten", 11 => "eleven", 12 => "twelve", 13 => "thirteen", 
                                14 => "fourteen", 15 => "fifteen", 16 => "sixteen", 17 => "seventeen", 
                                18 => "eighteen", 19 => "nineteen"
                            );
                        
                            $tens = array(
                                0 => "", 2 => "twenty", 3 => "thirty", 4 => "forty", 
                                5 => "fifty", 6 => "sixty", 7 => "seventy", 8 => "eighty", 
                                9 => "ninety"
                            );
                        
                            $places = array("", "thousand", "lakh", "crore");
                        
                            if ($num < 20) {
                                return $ones[$num];
                            } elseif ($num < 100) {
                                return $tens[intval($num / 10)] . (($num % 10 != 0) ? " " . $ones[$num % 10] : "");
                            } elseif ($num < 1000) {
                                return $ones[intval($num / 100)] . " hundred" . (($num % 100 != 0) ? " and " . numberToWords($num % 100) : "");
                            } else {
                                $numStr = strval($num);
                                $numLength = strlen($numStr);
                                $segments = [];
                        
                                // Properly handle lakh and crore segmentation
                                while ($numLength > 0) {
                                    $segmentLength = ($numLength > 3 && count($segments) == 0) ? 3 : 2; // First segment may have 3 digits
                                    $segments[] = substr($numStr, -$segmentLength, $segmentLength);
                                    $numStr = substr($numStr, 0, -$segmentLength);
                                    $numLength -= $segmentLength;
                                }
                        
                                $segments = array_reverse($segments);
                                $words = "";
                                $placeIndex = count($segments) - 1;
                        
                                foreach ($segments as $segment) {
                                    $partNum = intval($segment);
                                    if ($partNum > 0) {
                                        $words .= numberToWords($partNum) . " " . $places[$placeIndex--] . " ";
                                    } else {
                                        $placeIndex--;
                                    }
                                }
                        
                                return trim($words);
                            }
                        }
                        
                     
                        
                        
                        
                        
                        
                        // Example usage:
                      
                     
                        function numberToWordsBangla($num) 
                        {
                           
                            $ones = array(
                                0 => "শুণ্য", 1 => "এক", 2 => "দুই", 3 => "তিন", 4 => "চার", 5 => "পাঁচ", 6 => "ছয়", 7 => "সাত", 8 => "আট", 9 => "নয়", 
                                10 => "দশ", 11 => "এগারো", 12 => "বারো", 13 => "তেরো", 14 => "চৌদ্দ", 15 => "পনেরো", 16 => "ষোলো", 17 => "সতেরো", 
                                18 => "আঠারো", 19 => "উনিশ", 20 => "বিশ", 21 => "একুশ", 22 => "বাইশ", 23 => "তেইশ", 24 => "চব্বিশ", 25 => "পঁচিশ", 
                                26 => "ছাব্বিশ", 27 => "সাতাশ", 28 => "আটাশ", 29 => "ঊনত্রিশ", 30 => "ত্রিশ", 31 => "একত্রিশ", 32 => "বত্রিশ", 
                                33 => "তেত্রিশ", 34 => "চৌত্রিশ", 35 => "পঁয়ত্রিশ", 36 => "ছত্রিশ", 37 => "সাইত্রিশ", 38 => "আটত্রিশ", 39 => "ঊনচল্লিশ", 
                                40 => "চল্লিশ", 41 => "একচল্লিশ", 42 => "বিয়াল্লিশ", 43 => "তেতাল্লিশ", 44 => "চুয়াল্লিশ", 45 => "পঁয়তাল্লিশ", 
                                46 => "ছেচল্লিশ", 47 => "সাতচল্লিশ", 48 => "আটচল্লিশ", 49 => "ঊনপঞ্চাশ", 50 => "পঞ্চাশ", 51 => "একান্ন", 52 => "বাহান্ন", 
                                53 => "তিপ্পান্ন", 54 => "চুয়ান্ন", 55 => "পঞ্চান্ন", 56 => "ছাপ্পান্ন", 57 => "সাতান্ন", 58 => "আটান্ন", 59 => "ঊনষাট", 
                                60 => "ষাট", 61 => "একষট্টি", 62 => "বাষট্টি", 63 => "তেষট্টি", 64 => "চৌষট্টি", 65 => "পঁয়ষট্টি", 66 => "ছেষট্টি", 
                                67 => "সাতষট্টি", 68 => "আটষট্টি", 69 => "ঊনসত্তর", 70 => "সত্তর", 71 => "একাত্তর", 72 => "বাহাত্তর", 73 => "তিয়াত্তর", 
                                74 => "চুয়াত্তর", 75 => "পঁচাত্তর", 76 => "ছিয়াত্তর", 77 => "সাতাত্তর", 78 => "আটাত্তর", 79 => "ঊনআশি", 80 => "আশি", 
                                81 => "একাশি", 82 => "বিরাশি", 83 => "তিরাশি", 84 => "চুরাশি", 85 => "পঁচাশি", 86 => "ছিয়াশি", 87 => "সাতাশি", 88 => "আটাশি", 
                                89 => "ঊননব্বই", 90 => "নব্বই", 91 => "একানব্বই", 92 => "বিরানব্বই", 93 => "তিরানব্বই", 94 => "চুরানব্বই", 95 => "পঁচানব্বই", 
                                96 => "ছিয়ানব্বই", 97 => "সাতানব্বই", 98 => "আটানব্বই", 99 => "নিরানব্বই"
                            );
                            
                            $tens = array(
                                0 => "", 2 => "বিশ", 3 => "ত্রিশ", 4 => "চল্লিশ", 
                                5 => "পঞ্চাশ", 6 => "ষাট", 7 => "সত্তর", 8 => "আশি", 9 => "নব্বই"
                            );
                            
                            $places = array("", "হাজার", "লক্ষ", "কোটি");
                        
                            if ($num < 100) {
                                return $ones[$num];
                            } elseif ($num < 100) {
                                return $tens[intval($num / 10)] . (($num % 10 != 0) ? " " . $ones[$num % 10] : "");
                            } elseif ($num < 1000) {
                                return $ones[intval($num / 100)] . " শত" . (($num % 100 != 0) ? " এবং " . numberToWordsBangla($num % 100) : "");
                            } else {
                                $numStr = strval($num);
                                $numLength = strlen($numStr);
                                $segments = [];
                        
                                // Properly handle lakh and crore segmentation
                                while ($numLength > 0) {
                                    $segmentLength = ($numLength > 3 && count($segments) == 0) ? 3 : 2; // First segment may have 3 digits
                                    $segments[] = substr($numStr, -$segmentLength, $segmentLength);
                                    $numStr = substr($numStr, 0, -$segmentLength);
                                    $numLength -= $segmentLength;
                                }
                        
                                $segments = array_reverse($segments);
                                $words = "";
                                $placeIndex = count($segments) - 1;
                        
                                foreach ($segments as $segment) {
                                    $partNum = intval($segment);
                                    if ($partNum > 0) {
                                        $words .= numberToWordsBangla($partNum) . " " . $places[$placeIndex--] . " ";
                                    } else {
                                        $placeIndex--;
                                    }
                                }
                        
                                return trim($words);
                            }
                        }
                       
                       
                        $integerPart = intval($tp);
                         $decimalPart = round(($tp - $integerPart) * 100); 
                         $integerWords = numberToWords($integerPart); 
                         $decimalWords = numberToWords($decimalPart);                       
                        echo" 
                       <tr>
                      
                       <td colspan='2' style='text-align: center'>=".$tq." =".number_format($tp, 2, '.', ',')."/=</td>
                      
                       </tr>
                    <tr><td colspan='2'>".$integerWords . " TAKA " . $decimalWords." PAISA</td></tr>
                     </tr>
                    <tr><td colspan='2'>".numberToWordsBangla($integerPart) . " <b>টাকা</b> " .
                     numberToWordsBangla($decimalPart)." <b>পয়সা</b></td></tr>
                       
                       ";
                        echo "</tbody>";
                        echo "</table>";

                        
                    } else {
                        echo "No orders found";


                        $sql = "UPDATE visit SET reason='visit' WHERE SN='".$_GET['order']."'";
                        if (mysqli_query($conn, $sql)) {
                            // echo "Record updated successfully";
                        } else {
                            echo "Error updating record: " . mysqli_error($conn);
                        }
                    }
                    ?>
                
                <div style="text-align: center;">
                    <a href="orderlist.php" class="btn btn-danger">Finish</a>
                    &nbsp;&nbsp;
                    <a href="invoice.php?order=<?php echo $_GET['order']; ?>" class="btn btn-primary">Invoice</a>
                </div>
                    
                    
            

                </div>
            </div>
        </div>
        
    </div>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
       $(document).ready(function() {
           

            // Initialize select2 for dynamic select fields
            $('#pn').select2({
                tags: true,
                placeholder: 'Select or add an option',
                allowClear: true
            });
        });
    </script>
<?php include_once "foot.php"; ?>
