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

?>
<style>
form {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

textarea {
    resize: vertical;
}

input[type="text"]:focus,
textarea:focus {
    border-color: #007bff;
    outline: none;
}

button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #0056b3;
}

</style>
<?php
if (isset($_POST["submit"])) {
    $refference = $_POST["refference"];
    $password = $_POST["password"];
    $officelogo = $_POST["officelogo"];
    $officename = $_POST["officename"];
    $countryflag = $_POST["countryflag"];
    $photo = $_POST["photo"];
    $name = $_POST["name"];
    $passport = $_POST["passport"];
    $nationality = $_POST["nationality"];
    $msg = $_POST["msg"];
    $PrimaryApplication = $_POST["PrimaryApplication"];
    $Sponsor = $_POST["Sponsor"];
    $Biometric = $_POST["Biometric"];
    $PoliceClearance = $_POST["PoliceClearance"];
    $MedicalTest = $_POST["MedicalTest"];
    $EVisaOnline = $_POST["EVisaOnline"];
    $AOthers = $_POST["AOthers"];
    $ApplicationForm = $_POST["ApplicationForm"];
    $ApprovalLetter = $_POST["ApprovalLetter"];
    $SponsorLetter = $_POST["SponsorLetter"];
    $BiometricAppointmentLetter = $_POST["BiometricAppointmentLetter"];
    $PoliceClearanceCertificate = $_POST["PoliceClearanceCertificate"];
    $MedicalTestCertificate = $_POST["MedicalTestCertificate"];
    $EVisaOnlineCopy = $_POST["EVisaOnlineCopy"];
    $ArrivalEAirTicket = $_POST["ArrivalEAirTicket"];
    $DOthers = $_POST["DOthers"];
    $ApplicationFee = $_POST["ApplicationFee"];
    $GovernmentVAT = $_POST["GovernmentVAT"];
    $VisaFee = $_POST["VisaFee"];
    $BiometricFee = $_POST["BiometricFee"];
    $TicketCost = $_POST["TicketCost"];
    $Otherscost = $_POST["Otherscost"];
    $td1 = $_POST["td1"];
    $tn1 = $_POST["tn1"];
    $ts1 = $_POST["ts1"];
    $td2 = $_POST["td2"];
    $tn2 = $_POST["tn2"];
    $ts2 = $_POST["ts2"];
    $td3 = $_POST["td3"];
    $tn3 = $_POST["tn3"];
    $ts3 = $_POST["ts3"];
    $td4 = $_POST["td4"];
    $tn4 = $_POST["tn4"];
    $ts4 = $_POST["ts4"];
    $td5 = $_POST["td5"];
    $tn5 = $_POST["tn5"];
    $ts5 = $_POST["ts5"];
    $td6 = $_POST["td6"];
    $tn6 = $_POST["td6"];
    $ts6 = $_POST["td6"];
 

    $sql = "SELECT refference FROM profile WHERE refference='{$refference}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sql = "UPDATE profile SET password='{$password}', officelogo='{$officelogo}', officename='{$officename}', countryflag='{$countryflag}', photo='{$photo}', name='{$name}', passport='{$passport}', nationality='{$nationality}', msg='{$msg}', PrimaryApplication='{$PrimaryApplication}', Sponsor='{$Sponsor}', Biometric='{$Biometric}', PoliceClearance='{$PoliceClearance}', MedicalTest='{$MedicalTest}', EVisaOnline='{$EVisaOnline}', AOthers='{$AOthers}', ApplicationForm='{$ApplicationForm}', ApprovalLetter='{$ApprovalLetter}', SponsorLetter='{$SponsorLetter}', BiometricAppointmentLetter='{$BiometricAppointmentLetter}', PoliceClearanceCertificate='{$PoliceClearanceCertificate}', MedicalTestCertificate='{$MedicalTestCertificate}', EVisaOnlineCopy='{$EVisaOnlineCopy}', ArrivalEAirTicket='{$ArrivalEAirTicket}', DOthers='{$DOthers}', ApplicationFee='{$ApplicationFee}', GovernmentVAT='{$GovernmentVAT}', VisaFee='{$VisaFee}', BiometricFee='{$BiometricFee}', TicketCost='{$TicketCost}', Otherscost='{$Otherscost}', td1='{$td1}', tn1='{$tn1}', ts1='{$ts1}', td2='{$td2}', tn2='{$tn2}', ts2='{$ts2}', td3='{$td3}', tn3='{$tn3}', ts3='{$ts3}', td4='{$td4}', tn4='{$tn4}', ts4='{$ts4}', td5='{$td5}', tn5='{$tn5}', ts5='{$ts5}', td6='{$td6}', tn6='{$tn6}', ts6='{$ts6}' WHERE refference='{$refference}'";
    } else {
        $sql = "INSERT INTO profile (refference, password, officelogo, officename, countryflag, photo, name, passport, nationality, msg, PrimaryApplication, Sponsor, Biometric, PoliceClearance, MedicalTest, EVisaOnline, AOthers, ApplicationForm, ApprovalLetter, SponsorLetter, BiometricAppointmentLetter, PoliceClearanceCertificate, MedicalTestCertificate, EVisaOnlineCopy, ArrivalEAirTicket, DOthers, ApplicationFee, GovernmentVAT, VisaFee, BiometricFee, TicketCost, Otherscost, td1, tn1, ts1, td2, tn2, ts2, td3, tn3, ts3, td4, tn4, ts4, td5, tn5, ts5, td6, tn6, ts6)
    VALUES ('{$refference}', '{$password}', '{$officelogo}', '{$officename}', '{$countryflag}', '{$photo}', '{$name}', '{$passport}', '{$nationality}', '{$msg}', '{$PrimaryApplication}', '{$Sponsor}', '{$Biometric}', '{$PoliceClearance}', '{$MedicalTest}', '{$EVisaOnline}', '{$AOthers}', '{$ApplicationForm}', '{$ApprovalLetter}', '{$SponsorLetter}', '{$BiometricAppointmentLetter}', '{$PoliceClearanceCertificate}', '{$MedicalTestCertificate}', '{$EVisaOnlineCopy}', '{$ArrivalEAirTicket}', '{$DOthers}', '{$ApplicationFee}', '{$GovernmentVAT}', '{$VisaFee}', '{$BiometricFee}', '{$TicketCost}', '{$Otherscost}', '{$td1}', '{$tn1}', '{$ts1}', '{$td2}', '{$tn2}', '{$ts2}', '{$td3}', '{$tn3}', '{$ts3}', '{$td4}', '{$tn4}', '{$ts4}', '{$td5}', '{$tn5}', '{$ts5}', '{$td6}', '{$tn6}', '{$ts6}')";
   

}

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New record created successfully'); window.location.href='profile_list.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}



if(isset($_GET["refference"])){
    $sql = "SELECT * FROM profile WHERE refference='".$_GET["refference"]."'";
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
        echo "0 results";
    }
}
?>


    <h2>Profile  Form</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">


        <div class="form-group">
            <label for="refference">Refference Number</label>
            <input type="text" class="form-control" id="refference" name="refference" placeholder="Enter Refference Number" value="<?php if(isset($_GET['refference'])) echo $refference; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password" value="<?php if(isset($_GET['refference'])) echo $password; else echo "na"; ?>" required>
        </div>
    
        <div class="form-group">
            <label for="officelogo">Office Logo</label>
            <input type="text" class="form-control" id="officelogo" name="officelogo" placeholder="Enter Office Logo" value="<?php if(isset($_GET['refference'])) echo $officelogo; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="officename">Office Name</label>
            <input type="text" class="form-control" id="officename" name="officename" placeholder="Enter Office Name" value="<?php if(isset($_GET['refference'])) echo $officename; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="countryflag">Country Flag</label>
            <input type="text" class="form-control" id="countryflag" name="countryflag" placeholder="Enter Country Flag" value="<?php if(isset($_GET['refference'])) echo $countryflag; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="text" class="form-control" id="photo" name="photo" placeholder="Enter Photo" value="<?php if(isset($_GET['refference'])) echo $photo; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?php if(isset($_GET['refference'])) echo $name; else echo ""; ?>" required>
        </div>
        <div class="form-group">
            <label for="passport">Passport</label>
            <input type="text" class="form-control" id="passport" name="passport" placeholder="Enter Passport" value="<?php if(isset($_GET['refference'])) echo $passport; else echo ""; ?>" required>
        </div>
        <div class="form-group">
            <label for="nationality">Nationality</label>
            <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Enter Nationality" value="<?php if(isset($_GET['refference'])) echo $nationality; else echo ""; ?>" required>
        </div>
        <div class="form-group">
            <label for="msg">Message</label>
            <textarea class="form-control" id="msg" name="msg" rows="4" cols="50" required><?php if(isset($_GET['refference'])) echo $msg; else echo "In Process"; ?></textarea>
        </div>
        <div class="form-group">
            <label for="PrimaryApplication">Primary Application</label>
            <input type="text" class="form-control" id="PrimaryApplication" name="PrimaryApplication" placeholder="Enter Primary Application" value="<?php if(isset($_GET['refference'])) echo $PrimaryApplication; else echo "Processing"; ?>" required>
        </div>
        <div class="form-group">
            <label for="Sponsor">Sponsor</label>
            <input type="text" class="form-control" id="Sponsor" name="Sponsor" placeholder="Enter Sponsor" value="<?php if(isset($_GET['refference'])) echo $Sponsor; else echo "Processing"; ?>" required>
        </div>
        <div class="form-group">
            <label for="Biometric">Biometric</label>
            <input type="text" class="form-control" id="Biometric" name="Biometric" placeholder="Enter Biometric" value="<?php if(isset($_GET['refference'])) echo $Biometric; else echo "Processing"; ?>" required>
        </div>
        <div class="form-group">
            <label for="PoliceClearance">Police Clearance</label>
            <input type="text" class="form-control" id="PoliceClearance" name="PoliceClearance" placeholder="Enter Police Clearance" value="<?php if(isset($_GET['refference'])) echo $PoliceClearance; else echo "Processing"; ?>" required>
        </div>
        <div class="form-group">
            <label for="MedicalTest">Medical Test</label>
            <input type="text" class="form-control" id="MedicalTest" name="MedicalTest" placeholder="Enter Medical Test" value="<?php if(isset($_GET['refference'])) echo $MedicalTest; else echo "Processing"; ?>" required>
        </div>
        <div class="form-group">
            <label for="EVisaOnline">EVisa Online</label>
            <input type="text" class="form-control" id="EVisaOnline" name="EVisaOnline" placeholder="Enter EVisa Online" value="<?php if(isset($_GET['refference'])) echo $EVisaOnline; else echo "Processing"; ?>" required>
        </div>
        <div class="form-group">
            <label for="AOthers">AOthers</label>
            <input type="text" class="form-control" id="AOthers" name="AOthers" placeholder="Enter AOthers" value="<?php if(isset($_GET['refference'])) echo $AOthers; else echo "Processing"; ?>" required>
        </div>



        <hr>
        <p style="text-align: center; font-weight: bold;">Keep "na" to hide</p>
        <div class="form-group">
            <label for="ApplicationForm">Application Form</label>
            <input type="text" class="form-control" id="ApplicationForm" name="ApplicationForm" placeholder="Enter Application Form" value="<?php if(isset($_GET['refference'])) echo $ApplicationForm; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="ApprovalLetter">Approval Letter</label>
            <input type="text" class="form-control" id="ApprovalLetter" name="ApprovalLetter" placeholder="Enter Approval Letter" value="<?php if(isset($_GET['refference'])) echo $ApprovalLetter; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="SponsorLetter">Sponsor Letter</label>
            <input type="text" class="form-control" id="SponsorLetter" name="SponsorLetter" placeholder="Enter Sponsor Letter" value="<?php if(isset($_GET['refference'])) echo $SponsorLetter; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="BiometricAppointmentLetter">Biometric Appointment Letter</label>
            <input type="text" class="form-control" id="BiometricAppointmentLetter" name="BiometricAppointmentLetter" placeholder="Enter Biometric Appointment Letter" value="<?php if(isset($_GET['refference'])) echo $BiometricAppointmentLetter; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="PoliceClearanceCertificate">Police Clearance Certificate</label>
            <input type="text" class="form-control" id="PoliceClearanceCertificate" name="PoliceClearanceCertificate" placeholder="Enter Police Clearance Certificate" value="<?php if(isset($_GET['refference'])) echo $PoliceClearanceCertificate; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="MedicalTestCertificate">Medical Test Certificate</label>
            <input type="text" class="form-control" id="MedicalTestCertificate" name="MedicalTestCertificate" placeholder="Enter Medical Test Certificate" value="<?php if(isset($_GET['refference'])) echo $MedicalTestCertificate; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="EVisaOnlineCopy">EVisa Online Copy</label>
            <input type="text" class="form-control" id="EVisaOnlineCopy" name="EVisaOnlineCopy" placeholder="Enter EVisa Online Copy" value="<?php if(isset($_GET['refference'])) echo $EVisaOnlineCopy; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="ArrivalEAirTicket">Arrival E Air Ticket</label>
            <input type="text" class="form-control" id="ArrivalEAirTicket" name="ArrivalEAirTicket" placeholder="Enter Arrival E Air Ticket" value="<?php if(isset($_GET['refference'])) echo $ArrivalEAirTicket; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="DOthers">DOthers</label>
            <input type="text" class="form-control" id="DOthers" name="DOthers" placeholder="Enter DOthers" value="<?php if(isset($_GET['refference'])) echo $DOthers; else echo "na"; ?>" required>
        </div>
        <hr>
        <div class="form-group">
            <label for="ApplicationFee">Application Fee</label>
            <input type="text" class="form-control" id="ApplicationFee" name="ApplicationFee" placeholder="Enter Application Fee" value="<?php if(isset($_GET['refference'])) echo $ApplicationFee; else echo "Due"; ?>" required>
        </div>
        <div class="form-group">
            <label for="GovernmentVAT">Government VAT</label>
            <input type="text" class="form-control" id="GovernmentVAT" name="GovernmentVAT" placeholder="Enter Government VAT" value="<?php if(isset($_GET['refference'])) echo $GovernmentVAT; else echo "Due"; ?>" required>
        </div>
        <div class="form-group">
            <label for="VisaFee">Visa Fee</label>
            <input type="text" class="form-control" id="VisaFee" name="VisaFee" placeholder="Enter Visa Fee" value="<?php if(isset($_GET['refference'])) echo $VisaFee; else echo "Due"; ?>" required>
        </div>
        <div class="form-group">
            <label for="BiometricFee">Biometric Fee</label>
            <input type="text" class="form-control" id="BiometricFee" name="BiometricFee" placeholder="Enter Biometric Fee" value="<?php if(isset($_GET['refference'])) echo $BiometricFee; else echo "Due"; ?>" required>
        </div>
        <div class="form-group">
            <label for="TicketCost">Ticket Cost</label>
            <input type="text" class="form-control" id="TicketCost" name="TicketCost" placeholder="Enter Ticket Cost" value="<?php if(isset($_GET['refference'])) echo $TicketCost; else echo "Due"; ?>" required>
        </div>
        <div class="form-group">
            <label for="Otherscost">Others cost</label>
            <input type="text" class="form-control" id="Otherscost" name="Otherscost" placeholder="Enter Others cost" value="<?php if(isset($_GET['refference'])) echo $Otherscost; else echo "Due"; ?>" required>
        </div>

        <hr>
        <p style="text-align: center; font-weight: bold;">Keep "na" to hide</p>
        <div class="form-group">
            <label for="td1">td1</label>
            <input type="text" class="form-control" id="td1" name="td1" placeholder="Enter td1" value="<?php if(isset($_GET['refference'])) echo $td1; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="tn1">tn1</label>
            <input type="text" class="form-control" id="tn1" name="tn1" placeholder="Enter tn1" value="<?php if(isset($_GET['refference'])) echo $tn1; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="ts1">ts1</label>
            <input type="text" class="form-control" id="ts1" name="ts1" placeholder="Enter ts1" value="<?php if(isset($_GET['refference'])) echo $ts1; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="td2">td2</label>    
            <input type="text" class="form-control" id="td2" name="td2" placeholder="Enter td2" value="<?php if(isset($_GET['refference'])) echo $td2; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="tn2">tn2</label>
            <input type="text" class="form-control" id="tn2" name="tn2" placeholder="Enter tn2" value="<?php if(isset($_GET['refference'])) echo $tn2; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="ts2">ts2</label>
            <input type="text" class="form-control" id="ts2" name="ts2" placeholder="Enter ts2" value="<?php if(isset($_GET['refference'])) echo $ts2; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="td3">td3</label>    
            <input type="text" class="form-control" id="td3" name="td3" placeholder="Enter td3" value="<?php if(isset($_GET['refference'])) echo $td3; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="tn3">tn3</label>
            <input type="text" class="form-control" id="tn3" name="tn3" placeholder="Enter tn3" value="<?php if(isset($_GET['refference'])) echo $tn3; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="ts3">ts3</label>
            <input type="text" class="form-control" id="ts3" name="ts3" placeholder="Enter ts3" value="<?php if(isset($_GET['refference'])) echo $ts3; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="td4">td4</label>    
            <input type="text" class="form-control" id="td4" name="td4" placeholder="Enter td4" value="<?php if(isset($_GET['refference'])) echo $td4; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="tn4">tn4</label>
            <input type="text" class="form-control" id="tn4" name="tn4" placeholder="Enter tn4" value="<?php if(isset($_GET['refference'])) echo $tn4; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="ts4">ts4</label>
            <input type="text" class="form-control" id="ts4" name="ts4" placeholder="Enter ts4" value="<?php if(isset($_GET['refference'])) echo $ts4; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="td5">td5</label>    
            <input type="text" class="form-control" id="td5" name="td5" placeholder="Enter td5" value="<?php if(isset($_GET['refference'])) echo $td5; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="tn5">tn5</label>
            <input type="text" class="form-control" id="tn5" name="tn5" placeholder="Enter tn5" value="<?php if(isset($_GET['refference'])) echo $tn5; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="ts5">ts5</label>
            <input type="text" class="form-control" id="ts5" name="ts5" placeholder="Enter ts5" value="<?php if(isset($_GET['refference'])) echo $ts5; else echo "na"; ?>" required>
        </div>
        <div class="form-group">
            <label for="td6">td6</label>    
            <input type="text" class="form-control" id="td6" name="td6" placeholder="Enter td6" value="<?php if(isset($_GET['refference'])) echo $td6; else echo "na"; ?>" required>
        </div>

        <div class="form-group">
            <label for="tn6">tn6</label>    
            <input type="text" class="form-control" id="tn6" name="tn6" placeholder="Enter tn6" value="<?php if(isset($_GET['refference'])) echo $tn6; else echo "na"; ?>" required>
        </div>

        <div class="form-group">
            <label for="ts6">ts6</label>    
            <input type="text" class="form-control" id="ts6" name="ts6" placeholder="Enter ts6" value="<?php if(isset($_GET['refference'])) echo $ts6; else echo "na"; ?>" required>
        </div>

        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </form>


