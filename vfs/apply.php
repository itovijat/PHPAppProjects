<?php
include_once 'head.php';

    include_once "db.php";

    $sql = "SELECT * FROM applyvisa";
    $result = $conn->query($sql);
    $amount = "";
    $msg = "";
    $bank = "";
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $amount = $row['amount'];
        $msg = $row['msg'];
        $bank = $row['bank'];
    }




?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  
    <div style="width:100%; height:250px; background-color: #103b5e;"></div>
    <div class="content" style="margin-top:-280px; color: white;">
        <h1 >Apply For a VISA</h1>
        <p >Unavailable for now</p>
 
    </div>
    
<!-- 
    <div style="display: flex; justify-content: center; align-items: center; margin-top: 100px; margin:20px;">
        <div style="width: 80%; background-color: white; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
           
            <style>
                form label{
                    display: block;
                    margin-bottom: 10px;
                    font-size: 18px;
                    color: #666;
                }
                form input, form select, form textarea{
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    margin-bottom: 20px;
                    box-sizing: border-box;
                }
            </style>
           
            <?php
            // if(isset($_POST['submit'])){
            //     $visacountry = $_POST['visacountry'];
            //     $title = $_POST['title'];
            //     $familyName = $_POST['familyName'];
            //     $givenName = $_POST['givenName'];
            //     $mobilePhone = $_POST['mobilePhone'];
            //     $dateOfBirth = $_POST['dateOfBirth'];
            //     $sex = $_POST['sex'];
            //     $maritalStatus = $_POST['maritalStatus'];
            //     $email = $_POST['email'];
            //     $confirmEmail = $_POST['confirmEmail'];
            //     $passportNo = $_POST['passportNo'];
            //     $passportIssueDate = $_POST['passportIssueDate'];
            //     $passportCountry = $_POST['passportCountry'];
            //     $passportExpireDate = $_POST['passportExpireDate'];
            //     $address = $_POST['address'];
            //     $suburbTown = $_POST['suburbTown'];
            //     $country = $_POST['country'];
               

            //     $datetime = date('YmdHis');
            //     $target_dir = "apply/";
            //     $target_file = $target_dir . $datetime . '.' . strtolower(pathinfo($_FILES["photo"]["name"],PATHINFO_EXTENSION));
            //     $uploadOk = 1;
            //     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            //     // Check if image file is a actual image or fake image
            //     $check = getimagesize($_FILES["photo"]["tmp_name"]);
            //     if($check !== false) {
            //         echo "File is an image - " . $check["mime"] . ".";
            //         $uploadOk = 1;
            //     } else {
            //         echo "File is not an image.";
            //         $uploadOk = 0;
            //     }
            //     // Check if file already exists
            //     if (file_exists($target_file)) {
            //         echo "Sorry, file already exists.";
            //         $uploadOk = 0;
            //     }
            //     // Check file size
            //     if ($_FILES["photo"]["size"] > 500000) {
            //         echo "Sorry, your file is too large.";
            //         $uploadOk = 0;
            //     }
            //     // Allow certain file formats
            //     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            //     && $imageFileType != "gif" ) {
            //         echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            //         $uploadOk = 0;
            //     }
            //     // Check if $uploadOk is set to 0 by an error
            //     if ($uploadOk == 0) {
            //         echo "Sorry, your file was not uploaded.";
            //     // if everything is ok, try to upload file
            //     } else {
            //         if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            //             echo "The file ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " has been uploaded.";
            //         } else {
            //             echo "Sorry, there was an error uploading your file.";
            //         }
            //     }
               

            //     $sql = "CREATE TABLE IF NOT EXISTS application (
            //         visacountry VARCHAR(255) NOT NULL,
            //         title VARCHAR(255) NOT NULL,
            //         familyName VARCHAR(255) NOT NULL,
            //         givenName VARCHAR(255) NOT NULL,
            //         mobilePhone VARCHAR(20) NOT NULL,
            //         dateOfBirth DATE NOT NULL,
            //         sex VARCHAR(255) NOT NULL,
            //         maritalStatus VARCHAR(255) NOT NULL,
            //         email VARCHAR(255) NOT NULL,
            //         confirmEmail VARCHAR(255) NOT NULL,
            //         passportNo VARCHAR(255) NOT NULL,
            //         passportIssueDate DATE NOT NULL,
            //         passportCountry VARCHAR(255) NOT NULL,
            //         passportExpireDate DATE NOT NULL,
            //         address VARCHAR(255) NOT NULL,
            //         suburbTown VARCHAR(255) NOT NULL,
            //         country VARCHAR(255) NOT NULL,
            //         file VARCHAR(255) NOT NULL
            //     )";
            //     if ($conn->query($sql) === TRUE) {
            //                      } else {
            //         echo "<script>alert('t e');</script>";
            //     }




            //     $sql = "INSERT INTO application (visacountry, title, familyName, givenName, mobilePhone, dateOfBirth, sex, maritalStatus, email, confirmEmail, passportNo, passportIssueDate, passportCountry, passportExpireDate, address, suburbTown, country, file) VALUES ('$visacountry', '$title', '$familyName', '$givenName', '$mobilePhone', '$dateOfBirth', '$sex', '$maritalStatus', '$email', '$confirmEmail', '$passportNo', '$passportIssueDate', '$passportCountry', '$passportExpireDate', '$address', '$suburbTown', '$country', '$target_file')";
            //     if ($conn->query($sql) === TRUE) {
            //         echo "<script>alert('".$msg." ');</script>";                 } 
            //         else {
            //             echo "<script>alert('d e');</script>";                }
                

            // }
            ?>
                      
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data"
             style="width: 100%; box-sizing: border-box; padding: 20px; border: 1px solid #ccc; border-radius: 10px;">
          
            
                <h2 style="text-align: center; color: #666; font-weight: bold; margin-bottom: 20px;">Application Form</h2>
                <p style="text-align: center; color: #666;">Apply for a visa or citizenship (including sponsorship and nomination)</p>
                <p style="text-align: center; color: #666;">Note: Please fill all required field</p>
                <div>
                    <label for="country">Visa Country</label>
                    <select name="visacountry" id="visacountry" required>
                    <?php
                        // $countries = array("Afghanistan","Albania","Algeria","Andorra","Angola","Antigua and Barbuda","Argentina","Armenia","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Brazil","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Central African Republic","Chad","Chile","China","Colombia","Comoros","Congo","Costa Rica","C te d'Ivoire","Croatia","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Fiji","Finland","France","Gabon","Gambia","Georgia","Germany","Ghana","Greece","Grenada","Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","North Korea","South Korea","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Lithuania","Luxembourg","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherlands","New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palau","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Qatar","Romania","Russia","Rwanda","Saint Kitts and Nevis","Saint Lucia","Saint Vincent and the Grenadines","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Sudan","Spain","Sri Lanka","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Tajikistan","Tanzania","Thailand","Timor-Leste","Togo","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Yemen","Zambia","Zimbabwe");
                        // foreach($countries as $country){
                        //     echo '<option value="'.$country.'">'.$country.'</option>';
                        // }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="title">Title</label>
                    <select name="title" id="title" required>
                        <option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                    </select>
                </div>

                <div>
                    <label for="familyName">Family name</label>
                    <input type="text" name="familyName" id="familyName" required>
                </div>

                <div>
                    <label for="givenNames">Given name</label>
                    <input type="text" name="givenName" id="givenName" required>
                </div>

                <div>
                    <label for="mobilePhone">Mobile phone</label>
                    <input type="text" name="mobilePhone" id="mobilePhone" required>
                </div>

                <div>
                    <label for="dateOfBirth">Date of Birth</label>
                    <input type="date" name="dateOfBirth" id="dateOfBirth" required>
                </div>

                <div>
                    <label for="sex">Sex</label>
                    <select name="sex" id="sex" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div>
                    <label for="maritalStatus">Marital Status</label>
                    <select name="maritalStatus" id="maritalStatus" required>
                        <option value="Married">Married</option>
                        <option value="Never Married">Never Married</option>
                        <option value="Divorced">Divorced</option>
                    </select>
                </div>

                <div>
                    <label for="email">Email address</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div>
                    <label for="confirmEmail">Confirm email address</label>
                    <input type="email" name="confirmEmail" id="confirmEmail" required>
                </div>

                <h2 style="text-align: center; color: #666; font-weight: bold; margin-bottom: 20px;">Passport Information</h2>

                <div>
                    <label for="passportNo">Passport No</label>
                    <input type="text" name="passportNo" id="passportNo" required>
                </div>

                <div>
                    <label for="passportIssueDate">Passport Issue Date</label>
                    <input type="date" name="passportIssueDate" id="passportIssueDate" required>
                </div>

                <div>
                    <label for="passportCountry">Passport Country</label>
                    <select name="passportCountry" id="passportCountry" required>
                    <?php
                        // $countries = array("Afghanistan","Albania","Algeria","Andorra","Angola","Antigua and Barbuda","Argentina","Armenia","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Brazil","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Central African Republic","Chad","Chile","China","Colombia","Comoros","Congo","Costa Rica","C te d'Ivoire","Croatia","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Fiji","Finland","France","Gabon","Gambia","Georgia","Germany","Ghana","Greece","Grenada","Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","North Korea","South Korea","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Lithuania","Luxembourg","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherlands","New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palau","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Qatar","Romania","Russia","Rwanda","Saint Kitts and Nevis","Saint Lucia","Saint Vincent and the Grenadines","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Sudan","Spain","Sri Lanka","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Tajikistan","Tanzania","Thailand","Timor-Leste","Togo","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Yemen","Zambia","Zimbabwe");
                        // foreach($countries as $country){
                        //     echo '<option value="'.$country.'">'.$country.'</option>';
                        // }
                        ?>
            </select>
                </div>

                <div>
                    <label for="passportExpireDate">Passport Expire Date</label>
                    <input type="date" name="passportExpireDate" id="passportExpireDate" required>
                </div>

                <h2 style="text-align: center; color: #666; font-weight: bold; margin-bottom: 20px;">Address details</h2>

                <div>
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" required>
                </div>

                <div>
                    <label for="suburbTown">Suburb/Town</label>
                    <input type="text" name="suburbTown" id="suburbTown" required>
                </div>

                <div>
                    <label for="country">Country</label>
                    <select name="country" id="country" required>
                    <?php
                        // $countries = array("Afghanistan","Albania","Algeria","Andorra","Angola","Antigua and Barbuda","Argentina","Armenia","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Brazil","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Central African Republic","Chad","Chile","China","Colombia","Comoros","Congo","Costa Rica","C te d'Ivoire","Croatia","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Fiji","Finland","France","Gabon","Gambia","Georgia","Germany","Ghana","Greece","Grenada","Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","North Korea","South Korea","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Lithuania","Luxembourg","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherlands","New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palau","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Qatar","Romania","Russia","Rwanda","Saint Kitts and Nevis","Saint Lucia","Saint Vincent and the Grenadines","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Sudan","Spain","Sri Lanka","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Tajikistan","Tanzania","Thailand","Timor-Leste","Togo","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Yemen","Zambia","Zimbabwe");
                        // foreach($countries as $country){
                        //     echo '<option value="'.$country.'">'.$country.'</option>';
                        // }
                        ?>
                    </select>
                </div>

                <h2 style="text-align: center; color: #666; font-weight: bold; margin-bottom: 20px;">Photo</h2>

                <div>
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" id="photo" accept="image/*" required>
                </div>

                <h2 style="text-align: center; color: #666; font-weight: bold; margin-bottom: 20px;">Payment Details</h2>

                <p style="text-align: center; color: #666;">Pay Amount  <?php echo $amount; ?> USD</p>

                <p style="text-align: center; color: #666;">Pay to <?php echo $bank; ?></p>

                <div style="display: flex; justify-content: center; align-items: center;">
                    <button name="submit" type="submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Submit</button>
                </div>
            </form>
        </div>
    </div> -->


   <?php
   include_once 'foot.php';
   ?>