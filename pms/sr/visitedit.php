<?php include_once "head2.php"; ?>






<div class="content">
    <!-- Main content goes here -->

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Visit Edit</h2>
                </div>
                <div class="card-body">
       
                    <?php

if(isset($_POST['route'])){
    $sql = "UPDATE visit SET route='".$_POST['route']."', shop='".$_POST['shop']."', phone='".$_POST['phone']."', reason='".$_POST['reason']."', memo='".$_POST['memo']."' WHERE SN='".$_POST['visitedit']."'";
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
        echo "<script>alert('Record updated successfully'); location.replace('visitlist.php');</script>";

    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}


if(!isset($_GET['visitedit'])){
    echo "<script>alert('No record found'); location.replace('visitlist.php');</script>";
    die();
}
                    $sql = "SELECT * FROM visit WHERE SN='".$_GET['visitedit']."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                          
                            <div class="form-group">
                                <label for="route">Route:</label>
                                <input type="text" class="form-control" id="route" name="route" value="<?php echo $row['route']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="shop">Shop:</label>
                                <input type="text" class="form-control" id="shop" name="shop" value="<?php echo $row['shop']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="memo">Memo:</label>
                                <input type="number" class="form-control" id="memo" name="memo" value="<?php echo $row['memo']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="reason">Reason:</label>
                                <select class="form-control" id="reason" name="reason" required>
                                    <option value="visit" <?php if($row['reason']=="visit"){echo "selected";}?>>visit</option>
                                    <option value="order" <?php if($row['reason']=="order"){echo "selected";}?>>order</option>
                                </select>
                            </div>

                            <input type="hidden" name="visitedit" value="<?php echo $_GET['visitedit']; ?>">
                            <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                            <?php
                        }
                    } else {
                        echo "0 results";
                    }

               
                    ?>
            

                </div>
            </div>
        </div>
        
    </div>

<?php include_once "foot.php"; ?>
