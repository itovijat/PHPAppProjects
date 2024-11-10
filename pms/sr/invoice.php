<?php include_once "head2.php"; 


if(!isset($_GET['order'])){
    echo "<script>window.location.href='index.php';</script>";
    exit();
}

?>




<div class="content">
    <!-- Main content goes here -->

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 style="text-align: center; color: green;">Ovijat E-Invoice</h2>
                </div>
                <div class="card-body">


                    <?php
                    $sql = "SELECT * FROM visit WHERE SN='".$_GET['order']."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div style='text-align: center; color: red;'>";
                            echo $_SESSION['company']." ".strtoupper($row['reason'])." ID: ".$row['memo']."<br>";
                            echo $_SESSION['email']." @ ".$row['date']."<br>";
                            
                            echo "Order: ".$row['odate']." Delivery: ".$row['ddate']."<br>";

                            echo "<span style='font-size:1.2em;'>".$row['shop']."</span> ";
                            echo "<span style='font-size:1.2em;'>".$row['phone']."</span> ";
                            echo "<span style='font-size:1.2em;'>".$row['route']."</span><br><br>";
                          
                            echo "<div style='text-align: center; border: 1px solid grey; color: green; max-width: 80%; margin: 0 auto;'>" . $row['comment'] . "</div>";
                            echo "</div>";
                           
                            
                            echo "<br>";
                            
                        }
                    }

                 


                    $sql = "SELECT * FROM orders WHERE snvisit='".$_GET['order']."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table class='table' style=' word-wrap: break-word;'>";
                        echo "<thead>";
                        echo "<tr style='text-align:center; font-size:1em;'>";
                      
                        echo "<th>Product</th>";
                        
                        
                        echo "<th>RateXQuantity</th>";
                       
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody style='text-align:center; font-size:1.2em;'>";
                        $tq=0;
                        $tp=0;
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                      
                            echo "<td>".$row['pn']." (".$row['unit'].")</td>";
                            echo "<td>".$row['rate']."X".$row['quantity']."=";
                            $tq+=$row['quantity'];
                            $tp+=($row['rate']*$row['quantity']);
                            echo ($row['rate']*$row['quantity'])."</td>";
                            
                            
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
                       
                       <td>=".$tq."</td>
                       <td>=".number_format($tp, 2, '.', ',')."/=</td>
                       </tr>
                    <tr style='text-align:center; font-size:0.8em;'><td colspan='2'>".$integerWords . " TAKA " . $decimalWords." PAISA</td></tr>
                     </tr>
                    <tr style='text-align:center; font-size:0.65em;'><td colspan='2'>".numberToWordsBangla($integerPart) . " টাকা " . numberToWordsBangla($decimalPart)." পয়সা</td></tr>
                       
                       ";
                        echo "</tbody>";
                        echo "</table>";

                        
                    } else {
                        echo "No orders found";


                       
                    }
                    ?>
                
       
                    
               
                    <div style="display:flex; justify-content:space-between; font-size:0.5em; opacity:0.8;">
                        <div style="width:30%; height:50px; padding:10px; border:1px solid #000; text-align:center; margin-right:2px;">Prepared By</div>
                        <div style="width:30%; padding:10px; border:1px solid #000; text-align:center; margin-right:2px;">Authorized By</div>
                        <div style="width:30%; padding:10px; border:1px solid #000; text-align:center;">Received By</div>
                    </div>
                    
            

                </div>
            </div>
        </div>
        
    </div>
   
<?php include_once "foot.php"; ?>
