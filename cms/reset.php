<?php
include "dbconnect.php";

if (isset($_POST['password']) && $_POST['password'] != '')
{

    $sql = "SELECT password FROM user WHERE email='itovijat'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
        if (md5($_POST['password']) != $row['password'])
        {
            echo "<style>
            .error-box {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 50vh;
                background-color: #ffe6e6;
            }
            .error-box form {
                border: 1px solid #ff4d4d;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(255, 0, 0, 0.1);
            }
            </style>
            <div class='error-box'>
            <form action='' method='post' style='display: flex; justify-content: center; align-items: center'>
                <p style='color: #ff4d4d;'>Password error. Please try again.</p>
                <button type='submit' name='retry'>Retry</button>
            </form>
            </div>";
            die();

        }
    }
    else
    {
        die("User not found");
    }

    $sql = "SET FOREIGN_KEY_CHECKS = 0";
    mysqli_query($conn, $sql);
    $tables = array();
    $result = mysqli_query($conn, "SHOW TABLES");
    while ($row = mysqli_fetch_row($result))
    {
        $tables[] = $row[0];
    }
    foreach ($tables as $table)
    {
        $sql = "DROP TABLE $table";
        mysqli_query($conn, $sql);
    }
    $sql = "SET FOREIGN_KEY_CHECKS = 1";
    mysqli_query($conn, $sql);

    $sql = "
CREATE TABLE  IF NOT EXISTS user(
    
    email VARCHAR(10) NOT NULL PRIMARY KEY,
    password VARCHAR(32) NOT NULL,
    role VARCHAR(10) NOT NULL,
    company VARCHAR(10) NOT NULL,
    status BOOLEAN NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
";
    mysqli_query($conn, $sql);

    $pss = md5('KRkush5877');
    $sql = "
INSERT INTO user (email, password, role,company)
VALUES ('itovijat', '$pss','admin','None')
";
    mysqli_query($conn, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS route (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20),
    company VARCHAR(20)
)";

    if (mysqli_query($conn, $sql))
    {
        // echo "Table created successfully";
        
    }
    else
    {
        echo "Error creating table: " . mysqli_error($conn);
    }

    $sql = "CREATE TABLE IF NOT EXISTS shop (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    company VARCHAR(20)
)";

    if (mysqli_query($conn, $sql))
    {
        // echo "Table created successfully";
        
    }
    else
    {
        echo "Error creating table: " . mysqli_error($conn);
    }

    $sql = "CREATE TABLE IF NOT EXISTS phone (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20),
    company VARCHAR(20)
)";

    if (mysqli_query($conn, $sql))
    {
        // echo "Table created successfully";
        
    }
    else
    {
        echo "Error creating table: " . mysqli_error($conn);
    }
    $sql = "CREATE TABLE IF NOT EXISTS visit (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    mo VARCHAR(20),
    route VARCHAR(20),
    shop VARCHAR(50),
    phone VARCHAR(20),
    latitude DECIMAL(10,8),
    longitude DECIMAL(11,8),
    reason VARCHAR(5),
    memo bigint(20), 
    company VARCHAR(10),
    odate DATE,
    ddate DATE,
    comment VARCHAR(50),
     serial INT default 0,
    deliveryserial BOOLEAN default 0,
    dsmemo VARCHAR(20),
    
    status SMALLINT(1) DEFAULT 0
    )";
    if (mysqli_query($conn, $sql))
    {
        // echo "Table created successfully";
        
    }
    else
    {
        echo "Error creating table: " . mysqli_error($conn);
    }

    $sql = "CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idvisit INT,
    pn VARCHAR(30),
    unit FLOAT,
    rate FLOAT,

    quantity FLOAT
)";
    if (mysqli_query($conn, $sql))
    {
        // echo "Table created successfully";
        
    }
    else
    {
        echo "Error creating table: " . mysqli_error($conn);
    }

    $sql = "
CREATE TABLE  IF NOT EXISTS person(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL,
    company VARCHAR(10) NOT NULL,
    photo VARCHAR(20) NOT NULL,
    phone VARCHAR(11) NOT NULL,
    pid VARCHAR(5) NOT NULL,
    bloodgroup VARCHAR(2) NOT NULL,
    issuedate VARCHAR(10) NOT NULL,
    status BOOLEAN NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    post VARCHAR(30) NOT NULL,
     dept VARCHAR(30) NOT NULL
    )
";
    mysqli_query($conn, $sql);

    $sql = "
CREATE TABLE IF NOT EXISTS products  (
  id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(50) NOT NULL,
  company VARCHAR(10) NOT NULL
)";

    if ($conn->query($sql) === true)
    {

    }
    else
    {
        echo "Error creating table: " . $conn->error;
    }

    $sql = "
 CREATE TABLE IF NOT EXISTS persons  (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(50) NOT NULL,
  company VARCHAR(10) NOT NULL
)";

    if ($conn->query($sql) === true)
    {

    }
    else
    {
        echo "Error creating table: " . $conn->error;
    }

    $sql = "
CREATE TABLE IF NOT EXISTS inventory   (
 id INT AUTO_INCREMENT PRIMARY KEY,
 product_name VARCHAR(50) NOT NULL,
 in_quantity float,
 out_quantity float,
  value float,
 entry_date DATE,
 person_name VARCHAR(50),
 expiry_date DATE,
 remark TEXT,
company VARCHAR(10) NOT NULL
)";

    if ($conn->query($sql) === true)
    {

    }
    else
    {
        echo "Error creating table: " . $conn->error;
    }
    $sql = "
CREATE TABLE IF NOT EXISTS kpl (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_name VARCHAR(50) NOT NULL,
    driver_name VARCHAR(50) NOT NULL,
    entry_date DATE NOT NULL,
    oil_quantity FLOAT NOT NULL,
    oil_price FLOAT NOT NULL,
    distance FLOAT NOT NULL,
    km FLOAT NOT NULL,
     remark VARCHAR(20) NULL,
  company VARCHAR(10) NOT NULL
)";

    if ($conn->query($sql) === true)
    {

    }
    else
    {
        echo "Error creating table: " . $conn->error;
    }

    $sql = "
 CREATE TABLE IF NOT EXISTS vehicles  (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
   company VARCHAR(10) NOT NULL
 )";

    if ($conn->query($sql) === true)
    {

    }
    else
    {
        echo "Error creating table: " . $conn->error;
    }

    echo "<script>alert('Done');</script>";

    function addDemoData($conn)
    {
        $number = $_POST['number'];

        if ($number != 0)
        {
            for ($i = 0; $i < $number; $i++)
            {
                $sql = "INSERT INTO user (email, password, role,company) VALUES ('demo" . ($i + 1) . "','" . md5('demo') . "', 'admin','None')";
                $conn->query($sql);
                $sql = "INSERT INTO route (name, company) VALUES ('Demo Route" . ($i + 1) . "','None')";
                $conn->query($sql);
                $sql = "INSERT INTO phone (name, company) VALUES ('Demo Phone" . ($i + 1) . "','None')";
                $conn->query($sql);
                $sql = "INSERT INTO visit (date, mo, route, shop, phone, latitude, longitude, reason, memo, company, odate, ddate, comment, serial, status) VALUES (now(),'Demo MO" . ($i + 1) . "','Demo Route" . ($i + 1) . "','Demo Shop" . ($i + 1) . "','Demo Phone" . ($i + 1) . "',0,0,'demo',0,'None',now(),now(),'Demo comment" . ($i + 1) . "',0,0)";
                $conn->query($sql);
                $sql = "INSERT INTO orders (idvisit, pn, unit, rate, quantity) VALUES (" . ($i + 2) . ",'Demo PN" . ($i + 1) . "',1,1,1)";
                $conn->query($sql);
                $sql = "INSERT INTO inventory (product_name, in_quantity, out_quantity, value, entry_date, person_name, expiry_date, remark, company) VALUES ('Demo Product" . ($i + 1) . "',1,0,1,now(),'Demo Person" . ($i + 1) . "',now(),'Demo Remark" . ($i + 1) . "','None')";
                $conn->query($sql);
                $sql = "INSERT INTO kpl (vehicle_name, driver_name, entry_date, oil_quantity, oil_price, distance, km, remark, company) VALUES ('Demo Vehicle" . ($i + 1) . "','Demo Driver" . ($i + 1) . "',now(),1,1,1,1,'Demo Remark" . ($i + 1) . "','None')";
                $conn->query($sql);
                $sql = "INSERT INTO vehicles (name, company) VALUES ('Demo Vehicle" . ($i + 1) . "','None')";
                $conn->query($sql);
            }
        }
    }
    addDemoData($conn);

}

?>

<div style="display: flex; justify-content: center; align-items: center; height: 50vh;">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="border: 1px solid #ccc; padding: 10px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 300px;">
        <h2 style="text-align: center;">Reset Database</h2>
        <label for="number">Number</label>
        <input type="number" name="number" value="0" required style="width: 100%; padding: 10px; margin-bottom: 10px;">
        <label for="password">Password</label>
        <input type="password" name="password" required style="width: 100%; padding: 10px; margin-bottom: 10px;">
        <input type="submit" value="Submit" style="width: 100%; background-color: #4CAF50; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer;">
    </form>
 

    
</div>
<div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
        <a href="index.php" style="background-color: #4CAF50; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Go to Index</a>
    </div>
