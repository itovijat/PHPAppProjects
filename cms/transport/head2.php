<?php  

include_once "head1.php";
$currentPage = basename($_SERVER['PHP_SELF']);
$currentPage = basename($_SERVER['PHP_SELF']);
if(isset($_SESSION['cp']) && $_SESSION['cp'] == true && $currentPage != "profile.php")
{
    echo '<script>location.replace("profile.php");</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EOvijat <?php echo $_SESSION['company']; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon-16x16.png">
<link rel="manifest" href="../assets/site.webmanifest">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        header {
            position: sticky;
            top: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            z-index: 500;
        }
        header h1 {
            margin: 0;
        }
        .menu-icon, .logout-icon {
            cursor: pointer;
            width: 30px;
        }
        .sidebar {
            position: fixed;
            top: 50px;
            left: -200px;
            width: 200px;
            height: 100%;
            background-color: #444;
            color: white;
            padding-top: 20px;
            transition: left 0.3s;
            z-index: 1000;
            font-size: 20px;
        }
        .sidebar.open {
            left: 0;
        }
        .sidebar nav ul {
            list-style: none;
            padding: 0;
        }
        .sidebar nav ul li {
            padding: 10px;
        }
        .sidebar nav ul li a {
            color: white;
            text-decoration: none;
        }
        main {
            margin:0;
            padding: 20px;
        }

        .Print{
        display: none;

    }

    @media print {

        header,
        aside,
        .noPrint {
            display: none;
        }
        .Print{
            display: block;
        }
    }
    </style>
</head>
<body>
    <header>
        <div class="menu-icon">☰</div>
        <h1>EOvijat</h1>
        <div class="logout-icon" onclick="window.location.href='logout.php'"><i class="fas fa-power-off"></i></div>
    </header>
    <aside class="sidebar">
        <nav>
            <ul>
             <!-- Generate 50 demo menu items -->
                         <li><a href="index.php"><i class="fas fa-tv" style="width: 30px;"></i> Dashboard</a></li>
            <li><a href="profile.php"><i class="fas fa-user-secret" style="width: 30px;"></i> Profile</a></li>
         
            <li><a href="item.php"><i class="fas fa-box" style="width: 30px;"></i> Item</a></li>
            <li><a href="itemstock.php"><i class="fas fa-box" style="width: 30px;"></i> Item Stock</a></li>
            <li><a href="itemin.php?pdname=&ed1=<?php echo date('Y-m-d'); ?>&ed2=<?php echo date('Y-m-d'); ?>&submit="><i class="fas fa-box" style="width: 30px;"></i> Item In</a></li>
            <li><a href="itemout.php?pdname=&ed1=<?php echo date('Y-m-d'); ?>&ed2=<?php echo date('Y-m-d'); ?>&submit="><i class="fas fa-box" style="width: 30px;"></i> Item Out</a></li>
            <li><a href="itemsearch.php"><i class="fas fa-box" style="width: 30px;"></i> Item List</a></li>

            <li><a href="itemreq.php"><i class="fas fa-box" style="width: 30px;"></i> Item Requisition</a></li>
            <li><a href="itemreqlist.php"><i class="fas fa-box" style="width: 30px;"></i> Item Req list</a></li>
            <li><a href="itemreqsum.php"><i class="fas fa-box" style="width: 30px;"></i> Item Req Sum</a></li>
<hr>
          
            <li><a href="kpl.php"><i class="fas fa-car" style="width: 30px;"></i> KPL</a></li>
            <li><a href="kpllist.php"><i class="fas fa-car" style="width: 30px;"></i> KPL List</a></li>
            <li><a href="kplsum.php"><i class="fas fa-car" style="width: 30px;"></i> KPL Sum</a></li>
            </ul>
        </nav>
    </aside>
    <main>
       

