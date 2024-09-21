<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit;
}
include_once "db.php";

?>



<header>
    <div class="username"><?php echo $_SESSION['username']; ?></div>
    <div class="logout"><a style="color:white;text-decoration:none" href="logout.php">Logout</a></div>
</header>

<style>
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background-color: #333;
        color: white;
    }

    .username {
        font-size: 20px;
    }

    .logout {
        cursor: pointer;
    }

    .logout i {
        font-size: 25px;
    }

    
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 300px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 4px 8px rgba(0, 0, 0, 0.1);
    }

/* Basic table styling */
table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #ccc;
  padding: 8px;
  text-align: left;
}

/* Zebra striping for rows */
tr:nth-of-type(odd) {
  background: #f9f9f9;
}

/* Responsive styling */
@media screen and (max-width: 1200px) {
  table, thead, tbody, th, td, tr {
    display: block;
  }

  thead tr {
    position: absolute;
    top: -9999px;
    left: -9999px;
  }

  tr {
    border: 1px solid #ccc;
    margin-bottom: 10px;
  }

  td {
    border: none;
    border-bottom: 1px solid #eee;
    position: relative;
    padding-left: 50%;
  }

  td:before {
    position: absolute;
    top: 6px;
    left: 6px;
    width: 45%;
    padding-right: 10px;
    white-space: nowrap;
    content: attr(data-label);
  }
}

/* Additional styling for more than 5 columns */
@media screen and (max-width: 1200px) {
  tr {
    display: flex;
    flex-wrap: wrap;
  }

  td {
    flex: 1 1 20%;
    box-sizing: border-box;
  }

  td:nth-of-type(n+6) {
    flex: 1 1 100%;
  }
}
</style>
<nav style="display: flex; justify-content: space-around; align-items: center; background-color: #333; color: white; padding: 10px; margin-bottom: 20px;">
<a style="color: white; text-decoration: none; font-size: 20px;" href="admin.php">Home</a>
<a style="color: white; text-decoration: none; font-size: 20px;" href="apply_visa.php">Apply Visa</a>
    <a style="color: white; text-decoration: none; font-size: 20px;" href="user_apply.php">User Apply</a>
    <a style="color: white; text-decoration: none; font-size: 20px;" href="profile_list.php">Profile List</a>
    <a style="color: white; text-decoration: none; font-size: 20px;" href="add_profile.php">Add New Profile</a>
    <a style="color: white; text-decoration: none; font-size: 20px;" href="user_file.php">User File</a>
    <a style="color: white; text-decoration: none; font-size: 20px;" href="doc.php">Doc</a>
    <a style="color: white; text-decoration: none; font-size: 20px;" href="photo.php">Photo</a>
</nav>
 

<?php

$sql = "CREATE TABLE IF NOT EXISTS profile (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  refference VARCHAR(255),
    password VARCHAR(255),

  officelogo VARCHAR(255),
  officename VARCHAR(255),
  countryflag VARCHAR(255),
  photo VARCHAR(255),
  name VARCHAR(255),
  passport VARCHAR(255),
  nationality VARCHAR(255),
  msg VARCHAR(255),
  PrimaryApplication VARCHAR(255),
  Sponsor VARCHAR(255),
  Biometric VARCHAR(255),
  PoliceClearance VARCHAR(255),
  MedicalTest VARCHAR(255),
  EVisaOnline VARCHAR(255),
  AOthers VARCHAR(255),
  ApplicationForm VARCHAR(255),
  ApprovalLetter VARCHAR(255),
  SponsorLetter VARCHAR(255),
  BiometricAppointmentLetter VARCHAR(255),
  PoliceClearanceCertificate VARCHAR(255),
  MedicalTestCertificate VARCHAR(255),
  EVisaOnlineCopy VARCHAR(255),
  ArrivalEAirTicket VARCHAR(255),
  DOthers VARCHAR(255),
  ApplicationFee VARCHAR(255),
  GovernmentVAT VARCHAR(255),
  VisaFee VARCHAR(255),
  BiometricFee VARCHAR(255),
  TicketCost VARCHAR(255),
  Otherscost VARCHAR(255),
  td1 VARCHAR(255),
  tn1 VARCHAR(255),
  ts1 VARCHAR(255),
  td2 VARCHAR(255),
  tn2 VARCHAR(255),
  ts2 VARCHAR(255),
  td3 VARCHAR(255),
  tn3 VARCHAR(255),
  ts3 VARCHAR(255),
  td4 VARCHAR(255),
  tn4 VARCHAR(255),
  ts4 VARCHAR(255),
  td5 VARCHAR(255),
  tn5 VARCHAR(255),
  ts5 VARCHAR(255),
  td6 VARCHAR(255),
  tn6 VARCHAR(255),
  ts6 VARCHAR(255))";
if ($conn->query($sql) === TRUE) {
    // echo "Table applyvisa created successfully";
} else {
    echo "<script>alert('error');</script>";
}
$sql = "SELECT * FROM profile ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div style=''><table class='table table-bordered'>";
    echo "<tr><th>ID</th><th>Reference</th><th>Password</th><th>Office Logo</th><th>Office Name</th><th>Country Flag</th><th>Photo</th><th>Name</th><th>Passport</th><th>Nationality</th><th>Msg</th><th>PrimaryApplication</th><th>Sponsor</th><th>Biometric</th><th>PoliceClearance</th><th>MedicalTest</th><th>EVisaOnline</th><th>AOthers</th><th>ApplicationForm</th><th>ApprovalLetter</th><th>SponsorLetter</th><th>BiometricAppointmentLetter</th><th>PoliceClearanceCertificate</th><th>MedicalTestCertificate</th><th>EVisaOnlineCopy</th><th>ArrivalEAirTicket</th><th>DOthers</th><th>ApplicationFee</th><th>GovernmentVAT</th><th>VisaFee</th><th>BiometricFee</th><th>TicketCost</th><th>Otherscost</th><th>td1</th><th>tn1</th><th>ts1</th><th>td2</th><th>tn2</th><th>ts2</th><th>td3</th><th>tn3</th><th>ts3</th><th>td4</th><th>tn4</th><th>ts4</th><th>td5</th><th>tn5</th><th>ts5</th><th>td6</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td><a href='add_profile.php?refference=".$row["refference"]."'>Edit </a> ".$row["refference"]."</td><td>".$row["password"]."</td><td>";
        if(strtolower(substr($row["officelogo"],-2)) == 'na') {
            echo "not uploaded";
        } else {
            echo "<img src='".$row["officelogo"]."' style='width:100px;height:100px;'>";
        }
        echo "</td><td>".$row["officename"]."</td><td>";
        if(strtolower(substr($row["countryflag"],-2)) == 'na') {
            echo "not uploaded";
        } else {
            echo "<img src='".$row["countryflag"]."' style='width:100px;height:100px;'>";
        }
        echo "</td><td>";
        if(strtolower(substr($row["photo"],-2)) == 'na') {
            echo "not uploaded";
        } else {
            echo "<img src='".$row["photo"]."' style='width:100px;height:100px;'>";
        }
        echo "</td><td>".$row["name"]."</td><td>".$row["passport"]."</td><td>".$row["nationality"]."</td><td>".$row["msg"]."</td><td>".$row["PrimaryApplication"]."</td><td>".$row["Sponsor"]."</td><td>".$row["Biometric"]."</td><td>".$row["PoliceClearance"]."</td><td>".$row["MedicalTest"]."</td><td>".$row["EVisaOnline"]."</td><td>".$row["AOthers"]."</td><td>";
        if(strtolower(substr($row["ApplicationForm"],-2)) == 'na') {
            echo "not uploaded";
        } else {
            echo "<a href='".$row["ApplicationForm"]."' download>Download Application Form</a>";
        }
        echo "</td><td>";
        if(strtolower(substr($row["ApprovalLetter"],-2)) == 'na') {
            echo "not uploaded";
        } else {
            echo "<a href='".$row["ApprovalLetter"]."' download>Download Approval Letter</a>";
        }
        echo "</td><td>";
        if(strtolower(substr($row["SponsorLetter"],-2)) == 'na') {
            echo "not uploaded";
        } else {
            echo "<a href='".$row["SponsorLetter"]."' download>Download Sponsor Letter</a>";
        }
        echo "</td><td>";
        if(strtolower(substr($row["BiometricAppointmentLetter"],-2)) == 'na') {
            echo "not uploaded";
        } else {
            echo "<a href='".$row["BiometricAppointmentLetter"]."' download>Download Biometric Appointment Letter</a>";
        }
        echo "</td><td>";
        if(strtolower(substr($row["PoliceClearanceCertificate"],-2)) == 'na') {
            echo "not uploaded";
        } else {
            echo "<a href='".$row["PoliceClearanceCertificate"]."' download>Download Police Clearance Certificate</a>";
        }
        echo "</td><td>";
        if(strtolower(substr($row["MedicalTestCertificate"],-2)) == 'na') {
            echo "not uploaded";
        } else {
            echo "<a href='".$row["MedicalTestCertificate"]."' download>Download Medical Test Certificate</a>";
        }
        echo "</td><td>";
        if(strtolower(substr($row["EVisaOnlineCopy"],-2)) == 'na') {
            echo "not uploaded";
        } else {
            echo "<a href='".$row["EVisaOnlineCopy"]."' download>Download EVisa Online Copy</a>";
        }
        echo "</td><td>";
        if(strtolower(substr($row["ArrivalEAirTicket"],-2)) == 'na') {
            echo "not uploaded";
        } else {
            echo "<a href='".$row["ArrivalEAirTicket"]."' download>Download Arrival EAirticket</a>";
        }
        echo "</td><td>";
        if(strtolower(substr($row["DOthers"],-2)) == 'na') {
            echo "not uploaded";
        } else {
            echo "<a href='".$row["DOthers"]."' download>Download DOthers</a>";
        }
        echo "</td><td>".$row["ApplicationFee"]."</td><td>".$row["GovernmentVAT"]."</td><td>".$row["VisaFee"]."</td><td>".$row["BiometricFee"]."</td><td>".$row["TicketCost"]."</td><td>".$row["Otherscost"]."</td><td>".$row["td1"]."</td><td>".$row["tn1"]."</td><td>".$row["ts1"]."</td><td>".$row["td2"]."</td><td>".$row["tn2"]."</td><td>".$row["ts2"]."</td><td>".$row["td3"]."</td><td>".$row["tn3"]."</td><td>".$row["ts3"]."</td><td>".$row["td4"]."</td><td>".$row["tn4"]."</td><td>".$row["ts4"]."</td><td>".$row["td5"]."</td><td>".$row["tn5"]."</td><td>".$row["ts5"]."</td><td>".$row["td6"]."</td><td><a href='profile_list.php?del=".$row["refference"]."'>Delete</a></td></tr>";


    } echo "</table></div>";}
 else {
    echo "0 results";
}

if (isset($_GET['del'])) {
    $sql = "DELETE FROM profile WHERE refference='".$_GET['del']."'";
    if ($conn->query($sql) === TRUE) {
        echo '<script>window.location.href="profile_list.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>



