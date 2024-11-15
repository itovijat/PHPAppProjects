<?php  

include_once "head1.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EOvijat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
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
        <div class="logout-icon">🔒</div>
    </header>
    <aside class="sidebar">
        <nav>
            <ul>
            <li><a href="index.php"><i class="fas fa-tv"></i> Dashboard</li>
            <li><a href="visit.php"><i class="fas fa-map-marker-alt"></i> Visit</li>
            <li><a href="visitlist.php"><i class="fas fa-map-marked-alt"></i> Visit List</li>

            <li><a href="orderlist.php"><i class="fas fa-list"></i> Order List</a></li>

            <li><a href="deliveryserial.php"><i class="fas fa-truck"></i> Delivery Serial</a></li>

            <li><a href="profile.php"><i class="fas fa-user-secret"></i> Profile</a></li>
            </ul>
        </nav>
    </aside>
    <main>
       




fhgdfh






    </main>
    <script>
        const menuIcon = document.querySelector('.menu-icon');
        const sidebar = document.querySelector('.sidebar');

        menuIcon.addEventListener('click', function() {
            if (sidebar.classList.contains('open')) {
                sidebar.classList.remove('open');
                menuIcon.textContent = '☰';
            } else {
                sidebar.classList.add('open');
                menuIcon.textContent = '✖';
            }
        });
    </script>

<script>
    const menuIcon = document.getElementById('menu-icon');
    const sidebar = document.getElementById('sidebar');

    menuIcon.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        menuIcon.classList.toggle('fa-bars');
        menuIcon.classList.toggle('fa-times');
    });

    document.addEventListener('click', (event) => {
        if (!sidebar.contains(event.target) && !menuIcon.contains(event.target)) {
            sidebar.classList.remove('open');
            menuIcon.classList.add('fa-bars');
            menuIcon.classList.remove('fa-times');
        }
    });

   

   
    </script>
</body>
</html>
