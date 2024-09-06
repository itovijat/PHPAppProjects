

<?php
if( !isset($_REQUEST['id'])){

    echo "<script> window.history.back(); </script>";
    die();


}
?>






<style>




.popup {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
        .popup h2 {
            margin: 0 0 10px;
            color: #ff6347; /* Tomato color */
        }
        .popup p {
            margin: 0 0 20px;
            color: #333;
        }
        .popup button {
            padding: 10px 20px;
            background-color: #ff6347; /* Tomato color */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .popup button:hover {
            background-color: #e5533d; /* Darker tomato color */
        }
    </style>

</style>



<?php 
      
        include '../dbconnect.php';
        $id = '';
        $name = '';
        $pid = '';
        $email = '';
        $phone = '';
        $company = '';
        $bloodgroup = '';
        $issuedate = '';
        $photo = '';
        $post = '';
        $dept = '';



        if(isset($_REQUEST['id'])){

             $id = $_REQUEST['id'];

            //sql query for select data from person table

             $sql = "Select * from person where pid='$id' ";
             $result = mysqli_query($conn, $sql);
             $row = mysqli_fetch_assoc($result);
             if($row){
                $name = $row['name'];
                $pid = $row['pid'];
                $email = $row['email'];
                $phone = $row['phone'];
                $company = $row['company'];
                $bloodgroup = $row['bloodgroup'];
                $issuedate = $row['issuedate'];
                $photo = $row['photo'];
                $post = $row['post'];
                $dept = $row['dept'];


                   
                }

                else{
                    
               echo ' <div class="popup">
        <h2>Not found</h2>
        <p>The person you are looking for does not exist.</p>
        <button onclick="window.location.href=\'../\'">Go to Home</button>
    </div>';
    die();
                }






            }


              

                            ?>
  <style>
        .mycard {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
        .id-card {
            width: 300px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .id-card img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .id-card h2 {
            margin: 0;
            font-size: 24px;
        }
        .id-card p {
            margin: 5px 0;
            font-size: 15px;
        }
        .id-card .details {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .id-card .details div {
            width: 45%;
        }
        .id-card .details p {
            margin: 5px 0;
        }
        .id-card .post, .id-card .dept {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>

<div id="mycard" style="width:100% ">
    <div style="width:100%; display:flex; justify-content:center; margin-bottom:20px;">
        <a href="../" style="background-color:#4CAF50; color:white; border-radius:5px; padding:10px 20px; text-decoration:none;
         font-size:16px;">Back to Home Page</a>
    </div>
  
  
    <div class="id-card">
        <img src="../assets/person/<?php echo $photo; ?>" alt="Profile Picture">
        <h2><?php echo $name; ?></h2>
        <p>ID: <?php echo $id; ?></p>
        <p class="post"><?php echo $post; ?>(<?php echo $dept; ?>)</p>
      
        <p><?php echo $email; ?></p>
        <p><?php echo $phone; ?></p>
        <div class="details">
            <div>
                <p>Blood Group: <?php echo $bloodgroup; ?></p>
            </div>
            <div>
                <p>Issue Date: <?php echo $issuedate; ?></p>
            </div>
        </div>
      
    </div>


</div>

  
