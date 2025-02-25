<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
           
        }
        
        .admin-panel {
            max-width: 100%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        
        nav {
            background-color: #007bff;
            padding: 10px;
            text-align: center;
        }
        
        nav a {
            color: #fff;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }
        
        nav a:hover {
            text-decoration: underline;
        }
        
        h1 {
            text-align: center;
            margin-top: 0;
        }
        
        form {
            margin-bottom: 20px;
        }
        
        form input, form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        
        form button:hover {
            background-color: #0056b3;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        table, th, td {
            border: 1px solid #ccc;
        }
        
        th, td {
            padding: 10px;
            text-align: left;
        }
        
        th {
            background-color: #007bff;
            color: #fff;
        }
        .dropbtn {
            display: none;
            color: white;
           
            font-size: 16px;
            border: none;
            cursor: pointer;
            
        }
        
        @media only screen and (max-width: 768px) {
            .admin-panel {
                width: 100%;
                padding: 10px;
            }
            .dropbtn {
                display: block;
            }
            nav {
                padding: 5px;
            }
            
            .nav-dropdown {
                position: relative;
                display: inline-block;
            }
            
            .nav-dropdown-content {
                display: none;
                position: absolute;
                background-color: #007bff;
                padding: 10px;
               
            }
            
            .nav-dropdown:hover .nav-dropdown-content {
                display: block;
            }
            
            .nav-dropdown-content a {
                color: #fff;
                padding: 10px;
                display: block;
            }
            
            .nav-dropdown-content a:hover {
                background-color: #0056b3;
            }
            
            form {
                margin-bottom: 10px;
            }
            
            form input, form textarea {
                padding: 5px;
                margin: 5px 0;
            }
            
            form button {
                padding: 5px 10px;
            }
            
            table {
                margin-top: 10px;
            }
            
            th, td {
                padding: 5px;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-dropdown">
            <h1>Librariam.com Admin Panel</h1>
            <a class="dropbtn" href="#">Menu</a>
            <div class="nav-dropdown-content">
                <a href="#">Users</a>
                <a href="#">POS</a>
                <a href="#">Orders</a>
                <a href="#">Books</a>
                <a href="#">Publishers</a>
                <a href="#">Authors</a>
                <a href="#">Genres</a>
                <a href="#">Reviews</a>
                <a href="#">Stock</a>
                <a href="#">Reports</a>
                <a href="#">Logout</a>
            </div>
        </div>
    </nav>
    <div class="admin-panel">
       