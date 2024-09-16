<?php
include_once 'head.php';
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


 



<?php $flag = "au"; $country = "Department of Home Affairs, Australia"; ?>
<div class="content" style="display: flex; justify-content: space-between; align-items: center;  background: #f0f0f0; padding: 10px; border: 1px solid #ccc; ">
  <h2 style="margin: 0; font-size: 14px;"><?php echo $country; ?></h2>


  <img src="https://flagcdn.com/<?php echo strtolower($flag); ?>.svg" style="height: 24px; width: 56px; border: 1px solid #ccc; margin: 0;">

</div>

<div  style="width: 100%; height: auto;  margin-bottom: 20px;">

  <div style="text-align: center; font-size: 20px; margin-top: 20px; color: #666; font-weight: bold;">Application Details of</div>
  <div style="text-align: center; font-size: 15px; margin-top: 10px; color: #666; font-weight: bold;">Reference No: <?php echo $_POST['refference']; ?></div>
  <div style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; margin: 20px auto;">
    <img src="https://i.pravatar.cc/150?u=<?php echo rand(); ?>" style="width: 100%; height: 100%; object-fit: cover; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
  </div>
  <div style="text-align: center; font-size: 30px; margin-top: 20px; color: #666; font-weight: bold;">Hasan Ali Sarker</div>
  <div style="text-align: center; font-size: 15px; margin-top: 10px; color: #666; font-weight: bold;">Passport No: <?php echo $_POST['refference']; ?></div>
  <div style="text-align: center; font-size: 15px; margin-top: 10px; color: #666; font-weight: bold;">Nationality: <?php echo $_POST['refference']; ?></div>

  <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
    <button style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"
     type="button" >In Process</button>
  </div>

</div>

<div class="content sec3"  >
  <div style="display: flex; justify-content: space-around; align-items: center; background-color: #f0f0f0; border: 1px solid #ccc; border-radius: 5px; padding: 10px; ">
    <button class="tablinks" style="margin:5px;background-color: grey; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="openSection(event, 'ApplicationInfo')">Application Info <i class="fa fa-angle-right"></i></button>
    <button class="tablinks" style="margin:5px;background-color: grey; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="openSection(event, 'DocumentList')">Document List <i class="fa fa-angle-right"></i></button>
    <button class="tablinks" style="margin:5px;background-color: grey; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="openSection(event, 'PaymentHistory')">Payment History <i class="fa fa-angle-right"></i></button>
  </div>

  <div id="ApplicationInfo" class="section">
    <h2>Application Info</h2>
    <ul style="list-style: none; padding: 0; margin: 0;">
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
    <ul style="list-style: none; padding: 0; margin: 0;">
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
    
  </div>

  <div id="PaymentHistory" class="section">
    <h2>Payment History</h2>
    <ul style="list-style: none; padding: 0; margin: 0;">
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
  }
  .timeline-icon {
    width: 150px;
    height: 20px;
    background-color: #666;
    border-radius: 10px;
    position: absolute;
    top: 0;
    left: -10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 12px;

  }
  .timeline-content {
    margin-top: 30px;
    padding-left: 20px;
    border-left: 2px solid #666;
  }
  .timeline-title {
  
    font-size: 16px;
    font-weight: bold;
  }
  .timeline-date {
    font-size: 14px;
    color: #666;
   
  }
  .timeline-desc {
    font-size: 14px;
    color: #666;
    margin-top: 10px;
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


   <?php
   include_once 'foot.php';
   ?>