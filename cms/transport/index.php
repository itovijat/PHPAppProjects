<?php include_once "head2.php"; ?>

<div class="content">
        <!-- Main content goes here -->

       
        



        <div class="row">
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body text-center">
                        <button type="button" class="btn btn-outline-light" onclick="window.location.href='item.php'">Add Item</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body text-center">
                        <button type="button" class="btn btn-outline-light" onclick="window.location.href='itemin.php'">View IN</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body text-center">
                        <button type="button" class="btn btn-outline-light" onclick="window.location.href='itemout.php'">View OUT</button>
                    </div>
                </div>
            </div>
       
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body text-center">
                        <button type="button" class="btn btn-outline-light" onclick="window.location.href='itemstock.php'">View Stock</button>
                    </div>
                </div>
            </div>
        </div>

<br>

        <div class="row">
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-header">Today</div>
                    <div class="card-body text-center">
                        <h1>
                            <?php
                            $sql = "SELECT COUNT(*) FROM inventory WHERE company = '".$_SESSION['company']."' AND entry_date	 = '".date('Y-m-d')."'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['COUNT(*)'];
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-header">This Month</div>
                    <div class="card-body text-center">
                        <h1>
                            <?php
                            $sql = "SELECT COUNT(*) FROM inventory WHERE company = '".$_SESSION['company']."' AND YEAR(entry_date) = YEAR(CURDATE()) AND MONTH(entry_date) = MONTH(CURDATE())";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['COUNT(*)'];
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-header">All Time</div>
                    <div class="card-body text-center">
                        <h1>
                            <?php
                            $sql = "SELECT COUNT(*) FROM inventory WHERE company = '".$_SESSION['company']."'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['COUNT(*)'];
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
<br>
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-danger text-white">
                    <div class="card-header">Total Products</div>
                    <div class="card-body text-center">
                        <h1>
                            <?php
                            $sql = "SELECT COUNT(DISTINCT product_name) FROM inventory WHERE company = '".$_SESSION['company']."'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['COUNT(DISTINCT product_name)'];
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger text-white">
                    <div class="card-header">Total In</div>
                    <div class="card-body text-center">
                        <h1>
                            <?php
                            $sql = "SELECT SUM(in_quantity) FROM inventory WHERE company = '".$_SESSION['company']."'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['SUM(in_quantity)'];
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger text-white">
                    <div class="card-header">Total Out</div>
                    <div class="card-body text-center">
                        <h1>
                            <?php
                            $sql = "SELECT SUM(out_quantity) FROM inventory WHERE company = '".$_SESSION['company']."'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['SUM(out_quantity)'];
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>








       

    </div>

    <?php include_once "foot.php"; ?>