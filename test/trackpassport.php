<?php

session_start();
if(!isset($_SESSION['refference'])){
  echo "<script>window.history.back();</script>";

    exit;
}



include_once "db.php";


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
      echo "File is an image - " . $check["mime"] . ".";
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
          echo "<script>alert('The file ". htmlspecialchars( basename( $target_file)). " has been uploaded.');</script>";
          echo "<script>alert('Refference Number: $refference');</script>";
      
          
         
          
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
  <img src="https://www.homeaffairs.gov.au/AssetLibrary/dist/assets/images/logo.png" style="height: 50px;">
  <h1 style="margin: 0 10px; font-size: clamp(1.25rem, 5vw, 20px);">Immigration and Citizenship, Australia fhdfh dfhdf dfghdf fgdf</h1>
</header>

<div id="zoom">
<?php $flag = "au"; $country = "Department of Home Affairs, Australia"; ?>
<div class="content" style="display: flex; justify-content: space-between; align-items: center;  background: #f0f0f0; padding: 10px; border: 1px solid #ccc; ">
  <h2 style="margin: 0; font-size: 24px;">Reference No: <?php echo $_SESSION['refference']; ?></h2>


  <img src="https://flagcdn.com/<?php echo strtolower($flag); ?>.svg" style="height: 34px; width: 56px; border: 1px solid #ccc; margin: 0;">

</div>

<div  style="width: 100%; height: auto;  margin-bottom: 20px;">

  <div style="text-align: center; font-size: 20px; margin-top: 20px; color: #666; font-weight: bold;">Application Details of</div>
  <div style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; margin: 20px auto;">
    <img src="https://i.pravatar.cc/150?u=<?php echo rand(); ?>" style="width: 100%; height: 100%; object-fit: cover; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
  </div>
  <div style="text-align: center; font-size: 40px; margin-top: 20px; color: #666; font-weight: bold;">Hasan Ali Sarker</div>
  <div style="text-align: center; font-size: 25px; margin-top: 10px; color: #666; font-weight: bold;">Passport No: <?php echo $_SESSION['refference']; ?></div>
  <div style="text-align: center; font-size: 25px; margin-top: 10px; color: #666; font-weight: bold;">Nationality: <?php echo $_SESSION['refference']; ?></div>

  <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
    <button style="background-color: #4CAF50; font-size: 40px; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"
     type="button" >Msg Shown here</button>
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
        <span>Submitted</span>
      </li>
     
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Sponsor (Work Permit/LMI)</span>
        <span>Approved</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Biometric</span>
        <span>Rejected</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Police Clearance</span>
        <span>Received</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Medical Test</span>
        <span>-</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">E-Visa Online Copy</span>
        <span>-</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Others</span>
        <span>-</span>
      </li>
    </ul>
  </div>

  <div id="DocumentList" class="section">
    <h2>Document List</h2>
    <ul style="list-style: none; padding: 0; margin: 0; font-size: 35px;">
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style="font-weight: bold;">Application Form</span>
        <span>Download</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Approval Letter</span>
        <span>Pending</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Sponsor/LMI Letter</span>
        <span>Pending</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Biometric Appointment Letter</span>
        <span>Pending</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Police Clearance Certificate</span>
        <span>Pending</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Medical Test Certificate</span>
        <span>Pending</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">E-Visa Online Copy</span>
        <span>Pending</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Arrival/ E-Air Ticket</span>
        <span>Pending</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Others</span>
        <span>Pending</span>
      </li>
     <br>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Forwarded to</span>
        <span>Gmail</span>
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
        <span>Paid</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Government VAT </span>
        <span>Due</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Visa Fee</span>
        <span>Due</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Biometric Fee</span>
        <span>-</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Ticket Cost</span>
        <span>Due</span>
      </li>
      <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <span style=" font-weight: bold;">Others cost</span>
        <span>Due</span>
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
  <div class="timeline-item">
    <div class="timeline-icon">28 Jul 2024</div>
    <div class="timeline-content">  
      <p class="timeline-title">Application Submission</p>
      <p class="timeline-desc">Approved</p>
    </div>
  </div>

  <div class="timeline-item">
    <div class="timeline-icon">28 Jul 2024</div>
    <div class="timeline-content">
      <p class="timeline-title">Application Submission</p>
      <p class="timeline-desc">Approved</p>
    </div>
  </div>

  
  <div class="timeline-item">
    <div class="timeline-icon">28 Jul 2024</div>
    <div class="timeline-content">
      <p class="timeline-title">Application Submission</p>
      <p class="timeline-desc">Approved</p>
    </div>
  </div>

  
  <div class="timeline-item">
    <div class="timeline-icon">28 Jul 2024</div>
    <div class="timeline-content">
      <p class="timeline-title">Application Submission</p>
      <p class="timeline-desc">Approved</p>
    </div>
  </div>

  <div class="timeline-item">
    <div class="timeline-icon">28 Jul 2024</div>
    <div class="timeline-content">
      <p class="timeline-title">Application Submission</p>
      <p class="timeline-desc">Approved</p>
    </div>
  </div>

  
  <div class="timeline-item">
    <div class="timeline-icon">28 Jul 2024</div>
    <div class="timeline-content">
      <p class="timeline-title">Application Submission</p>
      <p class="timeline-desc">Approved</p>
    </div>
  </div>

  
</div>

</div>
 