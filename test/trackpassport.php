<?php

session_start();
if(!isset($_SESSION['refference'])){
  echo "<script>window.history.back();</script>";

    exit;
}



include_once "db.php";



$sql = "SELECT * FROM profile WHERE refference = '" . $_SESSION['refference'] . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $refference = $row["refference"];
        $password = $row["password"];
        $officelogo = $row["officelogo"];
        $officename = $row["officename"];
        $countryflag = $row["countryflag"];
        $photo = $row["photo"];
        $name = $row["name"];
        $passport = $row["passport"];
        $nationality = $row["nationality"];
        $msg = $row["msg"];
        $PrimaryApplication = $row["PrimaryApplication"];
        $Sponsor = $row["Sponsor"];
        $Biometric = $row["Biometric"];
        $PoliceClearance = $row["PoliceClearance"];
        $MedicalTest = $row["MedicalTest"];
        $EVisaOnline = $row["EVisaOnline"];
        $AOthers = $row["AOthers"];
        $ApplicationForm = $row["ApplicationForm"];
        $ApprovalLetter = $row["ApprovalLetter"];
        $SponsorLetter = $row["SponsorLetter"];
        $BiometricAppointmentLetter = $row["BiometricAppointmentLetter"];
        $PoliceClearanceCertificate = $row["PoliceClearanceCertificate"];
        $MedicalTestCertificate = $row["MedicalTestCertificate"];
        $EVisaOnlineCopy = $row["EVisaOnlineCopy"];
        $ArrivalEAirTicket = $row["ArrivalEAirTicket"];
        $DOthers = $row["DOthers"];
        $ApplicationFee = $row["ApplicationFee"];
        $GovernmentVAT = $row["GovernmentVAT"];
        $VisaFee = $row["VisaFee"];
        $BiometricFee = $row["BiometricFee"];
        $TicketCost = $row["TicketCost"];
        $Otherscost = $row["Otherscost"];
        $td1 = $row["td1"];
        $tn1 = $row["tn1"];
        $ts1 = $row["ts1"];
        $td2 = $row["td2"];
        $tn2 = $row["tn2"];
        $ts2 = $row["ts2"];
        $td3 = $row["td3"];
        $tn3 = $row["tn3"];
        $ts3 = $row["ts3"];
        $td4 = $row["td4"];
        $tn4 = $row["tn4"];
        $ts4 = $row["ts4"];
        $td5 = $row["td5"];
        $tn5 = $row["tn5"];
        $ts5 = $row["ts5"];
        $td6 = $row["td6"];
        $tn6 = $row["tn6"];
        $ts6 = $row["ts6"];

    }
} else {
  echo "<script>alert('connection error');</script>";
}


$sql = "CREATE TABLE IF NOT EXISTS reffile (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  refference VARCHAR(30) NOT NULL,
  file VARCHAR(50) NOT NULL,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    // echo "Table reffile created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}



if(isset($_POST['submit2'])){
  $refference = $_POST['refference'];
  $target_dir = "reffile/";
  $datetime = date('YmdHis');
  $target_file = $target_dir . $datetime . '.' . strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
  $uploadOk = 1;
  $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
      $uploadOk = 1;
  } 

  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }

  // Allow all known file types
  $allowed_file_types = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'doc', 'docx', 'txt', 'rtf', 'odt', 'xls', 'xlsx', 'ppt', 'pptx');
  if(!in_array($fileType, $allowed_file_types)) {
      echo "Sorry, only " . implode(', ', $allowed_file_types) . " files are allowed.";
      $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
      
          
         
          
          $sql = "INSERT INTO reffile (refference, file) VALUES ('$refference', '$target_file')";
          if ($conn->query($sql) === TRUE) {
              echo "<script>alert('New record created successfully');</script>";
          } else {
              echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
          }
          

       



      } else {
          echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
      }

    
     
  }
}
?>




<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>

.zoom{

width: 80%;


}
@media only screen and (max-width: 600px) {
    * {
        font-size: 3.5vw;
    }
}
</style>
<header style="display: flex; justify-content: center; align-items: center; background: #333; color: white; padding: 10px;">
  <?php if (strtolower(substr($officelogo, -2)) == 'na') { ?>
    <span style="height: 100px;  display: flex; justify-content: center; align-items: center;  margin: 0;"></span>
  <?php } else { ?>
    <img src="<?php echo $officelogo; ?>" style="height: 100px; ;  margin: 0;">
  <?php } ?>

  
  <?php if (strtolower(substr($officename, -2)) == 'na') { ?>
    <span style="height: 100px;  display: flex; justify-content: center; align-items: center;  margin: 0;"></span>
  <?php } else { ?>
    <h1 style="margin: 0 10px; font-size: clamp(1.25rem, 5vw, 30px);"><?php echo $officename; ?></h1>
  <?php } ?>
</header>

<div id="zoom">
<?php $flag = "au"; $country = "Department of Home Affairs, Australia"; ?>
<div class="content" style="display: flex; justify-content: space-between; align-items: center;  background: #f0f0f0; padding: 10px; border: 1px solid #ccc; ">
  <a href="index.php" style="text-decoration:none; color:black"><i class="fas fa-home" style="font-size:24px; margin-right:10px;"></i></a>
  <h2 style="margin: 0; font-size: 24px;">Reference No: <?php echo $_SESSION['refference']; ?></h2>


  <?php if (strtolower(substr($countryflag, -2)) == 'na') { ?>
    <span style="height: 34px; width: 56px; display: flex; justify-content: center; align-items: center;  margin: 0;"></span>
  <?php } else { ?>
    <img src="<?php echo $countryflag; ?>" style="height: 34px; width: 56px; border: 1px solid #ccc; margin: 0;">
  <?php } ?>

</div>

<div  style="width: 100%; height: auto;  margin-bottom: 20px;">

  <div style="text-align: center; font-size: 20px; margin-top: 20px; color: #666; font-weight: bold;">Application Details of</div>
  <div style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; margin: 20px auto;">
    <?php if (strtolower(substr($photo, -2)) == 'na') { ?>
      <span style="height: 150px; width: 150px; display: flex; justify-content: center; align-items: center;  margin: 0;"></span>
    <?php } else { ?>
      <img src="<?php echo $photo; ?>" style="width: 100%; height: 100%; object-fit: cover; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
    <?php } ?>
  </div>
  <div style="text-align: center; font-size: 40px; margin-top: 20px; color: #666; font-weight: bold;"><?php echo $name; ?></div>
  <div style="text-align: center; font-size: 25px; margin-top: 10px; color: #666; font-weight: bold;">Passport No: <?php echo $passport; ?></div>
  <div style="text-align: center; font-size: 25px; margin-top: 10px; color: #666; font-weight: bold;">Nationality: <?php echo $nationality; ?></div>

  <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
    <button style="background-color: #4CAF50; font-size: 40px; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"
     type="button" ><?php echo $msg; ?></button>
  </div>

</div>

<div class="content sec3"  >
  <div style="display: flex; justify-content: space-around; align-items: center; background-color: #f0f0f0; border: 1px solid #ccc; border-radius: 5px; padding: 10px; ">
    <button class="tablinks" style="margin:5px;background-color: grey; color: white; font-size: 35px; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="openSection(event, 'ApplicationInfo')">Application Info <i class="fa fa-angle-right"></i></button>
    <button class="tablinks" style="margin:5px;background-color: grey; color: white; font-size: 35px; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="openSection(event, 'DocumentList')">Document List <i class="fa fa-angle-right"></i></button>
    <button class="tablinks" style="margin:5px;background-color: grey; color: white; font-size: 35px; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="openSection(event, 'PaymentHistory')">Payment History <i class="fa fa-angle-right"></i></button>
  </div>

  <div id="ApplicationInfo" class="section">
    <h2>Application Info</h2>
    <ul style="list-style: none; padding: 0; margin: 0; font-size: 35px;">
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style="font-weight: bold;">Primary Application</span>
        <span><?php echo $PrimaryApplication; ?></span>
      </li>
     
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Sponsor (Work Permit/LMI)</span>
        <span><?php echo $Sponsor; ?></span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Biometric</span>
        <span><?php echo $Biometric; ?></span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Police Clearance</span>
        <span><?php echo $PoliceClearance; ?></span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Medical Test</span>
        <span><?php echo $MedicalTest; ?></span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">E-Visa Online Copy</span>
        <span><?php echo $EVisaOnline; ?></span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Others</span>
        <span><?php echo $AOthers; ?></span>
      </li>
    </ul>
  </div>

  <div id="DocumentList" class="section">
    <h2>Document List</h2>
    <ul style="list-style: none; padding: 0; margin: 0; font-size: 35px;">
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style="font-weight: bold;">Application Form</span>
        <span>
          <?php
            if(strtolower(substr($ApplicationForm,-2)) == 'na') {
              echo "Pending";
            } else {
              echo "<a href='".$ApplicationForm."' style=' text-decoration: none; color: #4CAF50' download><i class='fa fa-download'></i> Download</a>";
            }
          ?>
        </span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Approval Letter</span>
        <span>     <?php
            if(strtolower(substr($ApprovalLetter,-2)) == 'na') {
              echo "Pending";
            } else {
              echo "<a href='".$ApprovalLetter."' style=' text-decoration: none; color: #4CAF50' download><i class='fa fa-download'></i> Download</a>";
            }
          ?></span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Sponsor/LMI Letter</span>
        <span>     <?php
            if(strtolower(substr($SponsorLetter,-2)) == 'na') {
              echo "Pending";
            } else {
              echo "<a href='".$SponsorLetter."' style=' text-decoration: none; color: #4CAF50' download><i class='fa fa-download'></i> Download</a>";
            }
          ?></span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Biometric Appointment Letter</span>
        <span>     <?php
            if(strtolower(substr($BiometricAppointmentLetter,-2)) == 'na') {
              echo "Pending";
            } else {
              echo "<a href='".$BiometricAppointmentLetter."' style=' text-decoration: none; color: #4CAF50' download><i class='fa fa-download'></i> Download</a>";
            }
          ?></span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Police Clearance Certificate</span>
        <span>     <?php
            if(strtolower(substr($PoliceClearanceCertificate,-2)) == 'na') {
              echo "Pending";
            } else {
              echo "<a href='".$PoliceClearanceCertificate."' style=' text-decoration: none; color: #4CAF50' download><i class='fa fa-download'></i> Download</a>";
            }
          ?></span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Medical Test Certificate</span>
        <span>     <?php
            if(strtolower(substr($MedicalTestCertificate,-2)) == 'na') {
              echo "Pending";
            } else {
              echo "<a href='".$MedicalTestCertificate."' style=' text-decoration: none; color: #4CAF50' download><i class='fa fa-download'></i> Download</a>";
            }
          ?></span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">E-Visa Online Copy</span>
        <span>     <?php
            if(strtolower(substr($EVisaOnlineCopy,-2)) == 'na') {
              echo "Pending";
            } else {
              echo "<a href='".$EVisaOnlineCopy."' style=' text-decoration: none; color: #4CAF50' download><i class='fa fa-download'></i> Download</a>";
            }
          ?></span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Arrival/ E-Air Ticket</span>
        <span>     <?php
            if(strtolower(substr($ArrivalEAirTicket,-2)) == 'na') {
              echo "Pending";
            } else {
              echo "<a href='".$ArrivalEAirTicket."' style=' text-decoration: none; color: #4CAF50' download><i class='fa fa-download'></i> Download</a>";
            }
          ?></span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Others</span>
        <span>     <?php
            if(strtolower(substr($DOthers,-2)) == 'na') {
              echo "Pending";
            } else {
              echo "<a href='".$DOthers."' style=' text-decoration: none; color: #4CAF50' download><i class='fa fa-download'></i> Download</a>";
            }
          ?></span>
      </li>
     <br>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Forwarded to</span>
        <span>Your Email</span>
      </li>
    </ul>
    <button id="show_button" style="display: block; margin: 0 auto; font-size: 30px; background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="show_div()">Submitions</button>

    <div id="submit_div" style="display: none; margin-top: 20px; text-align: center;">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data" style="width: 100%; display: flex; justify-content: center; align-items: center; flex-direction: column;">
        <p style="font-size: 30px; font-weight: bold; margin-bottom: 10px;">Submit a document</p>
        <input type="hidden" name="refference" value="<?php echo $_SESSION['refference']; ?>">
        
        <input type="file" name="fileToUpload" id="fileToUpload" style="margin: 0 auto; font-size: 30px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 300px;" required>
        <input type="submit" value="Submit" name="submit2" style="margin-top: 10px; font-size: 30px; padding: 10px; border: none; border-radius: 5px; background-color: #4CAF50; color: white; cursor: pointer;">
      </form>
      <h2 style="text-align: center; margin-top: 20px;">Your Submitted Files</h2>
    <?php
    $sql = "SELECT * FROM reffile WHERE refference = '" . $_SESSION['refference'] . "' ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table style='width:100%; font-size:30px; margin: 0 auto;'><tr><th>ID</th><th>File</th><th>Date</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td style='text-align: center;'>".$row["id"]."</td><td style='text-align: center;'><a href='".$row["file"]."' download>Download</a></td><td style='text-align: center;'>".$row["date"]."</td></tr>";
        }
        echo "</table>";
    } else {
       
    }
    ?>
  
    </div>

    
    <script>
      function show_div(){
        document.getElementById("submit_div").style.display = "block";
        document.getElementById("show_button").style.display = "none";
      }
    </script>
  </div>

  <div id="PaymentHistory" class="section">
    <h2>Payment History</h2>
    <ul style="list-style: none; padding: 0; margin: 0; font-size: 35px;">
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style="font-weight: bold;">Application Fee</span>
        <span><?php echo $ApplicationFee; ?></span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Government VAT </span>
        <span><?php echo $GovernmentVAT; ?></span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Visa Fee</span>
        <span><?php echo $VisaFee; ?></span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Biometric Fee</span>
        <span><?php echo $BiometricFee; ?></span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Ticket Cost</span>
        <span><?php echo $TicketCost; ?></span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Others cost</span>
        <span><?php echo $Otherscost; ?></span>
      </li>
    </ul>
  </div>

  <style>
    @media(max-width: 767px){
      .section{
        margin-top: 20px;
        font-size: 12px;
      }
    }
  </style>

  <script>
    function openSection(event, sectionName) {
      var i, section, tablinks;
      section = document.getElementsByClassName("section");
      for (i = 0; i < section.length; i++) {
        section[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(sectionName).style.display = "block";
      event.currentTarget.className += " active";
      event.currentTarget.style.backgroundColor = "#32CD32";
      for (i = 0; i < tablinks.length; i++) {
        if(tablinks[i] != event.currentTarget){
          tablinks[i].style.backgroundColor = "grey";
        }
      }
    }
    // hide all sections on load
    openSection(event, 'none');
  </script>
</div>


<h1 style="text-align: center; margin-bottom: 20px;">Application Timeline</h1>
<style>
  .timeline {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    margin-top: 20px;
  }
  .timeline-item {
    position: relative;
    margin-bottom: 20px;
    font-size: 25px;
  }
  .timeline-icon {
    width: 250px;
    height: 50px;
    background-color: #666;
    border-radius: 10px;
    position: absolute;
    top: 0;
    bottom: 30px;
    left: -10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 22px;

  }
  .timeline-content {
    margin-top: 90px;
    padding-left: 20px;
    border-left: 2px solid #666;
  }
  .timeline-title {
  
    font-size: 22px;
    font-weight: bold;
  }
  .timeline-date {
    font-size: 24px;
    color: #666;
   
  }
  .timeline-desc {
    font-size: 20px;
    color: #666;
    margin-top: 10px;
  }
  @media(max-width: 767px){
   
  }
</style>

<div class="timeline">

  <?php if (strtolower(substr($td1, -2)) != 'na') { ?>
<div class="timeline-item">
    <div class="timeline-icon"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $td1); ?></div>
    <div class="timeline-content">  
      <p class="timeline-title"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $tn1); ?></p>
      <p class="timeline-desc"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $ts1); ?></p>
    </div>
  </div>

  <?php } ?>
  <?php if (strtolower(substr($td2, -2)) != 'na') { ?>
  <div class="timeline-item">
    <div class="timeline-icon"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $td2); ?></div>
    <div class="timeline-content">  
      <p class="timeline-title"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $tn2); ?></p>
      <p class="timeline-desc"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $ts2); ?></p>
    </div>
  </div>
  <?php } ?>
  <?php if (strtolower(substr($td3, -2)) != 'na') { ?>
  <div class="timeline-item">
    <div class="timeline-icon"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $td3); ?></div>
    <div class="timeline-content">  
      <p class="timeline-title"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $tn3); ?></p>
      <p class="timeline-desc"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $ts3); ?></p>
    </div>
  </div>
  <?php } ?>
  <?php if (strtolower(substr($td4, -2)) != 'na') { ?>
  <div class="timeline-item">
    <div class="timeline-icon"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $td4); ?></div>
    <div class="timeline-content">  
      <p class="timeline-title"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $tn4); ?></p>
      <p class="timeline-desc"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $ts4); ?></p>
    </div>
  </div>
  <?php } ?>
  <?php if (strtolower(substr($td5, -2)) != 'na') { ?>
  <div class="timeline-item">
    <div class="timeline-icon"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $td5); ?></div>
    <div class="timeline-content">  
      <p class="timeline-title"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $tn5); ?></p>
      <p class="timeline-desc"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $ts5); ?></p>
    </div>
  </div>
  <?php } ?>
  <?php if (strtolower(substr($td6, -2)) != 'na') { ?>
  <div class="timeline-item">
    <div class="timeline-icon"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $td6); ?></div>
    <div class="timeline-content">  
      <p class="timeline-title"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $tn6); ?></p>
      <p class="timeline-desc"><?php echo (strtolower(substr($td1, -2)) == 'na' ? '' : $ts6); ?></p>
    </div>
  </div>
  <?php } ?>



  
</div>

</div>
 