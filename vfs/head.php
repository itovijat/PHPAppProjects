<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VFS Global</title>
    <link rel="shortcut icon" href="logo2.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
       
        }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            color: black;
            padding: 10px 20px;
            margin-left: 10%;
            margin-right: 10%;
        }
        .logo {
            font-size: 1.5em;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .sticky-header {
          
            position: sticky;
            top: 0;
            background-color: white;
            color: black;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }
        .sticky-header a {
            color: black;
            margin: 0 15px;
            text-decoration: none;
        }
        .sticky-header .logo {
                display: none;
            }
        .menu-bar {
            display: none;
            font-size: 1.5em;
            cursor: pointer;
        }
        .footer {
         
            background-color: white;
            color: black;
            text-align: center;
            padding: 10px 0;
        }
        .content {
            margin-left: 10%;
            margin-right: 10%;
            padding: 20px;
         
        }
        .content img {
            max-width: 100%;
            height: auto;
        }
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 10000;
            top: 0;
            right: 0;
            background-color:#103b5e;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 1.2em;
            color: white;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background-color: #575757;
        }
        .sidebar .closebtn {
            position: absolute;
            top: 10px;
            right: 25px;
            font-size: 2em;
        }

       .content h1 {
                font-size: 60px;
            }
            .content p {
                font-size: 30px;
            }
        @media (max-width: 568px) {

            .content h1 {
                font-size: 30px;
            }
            .content p {
                font-size: 20px;
            }
            .sticky-header, .content {
                margin-left: 0;
                margin-right: 0;
            }
            hr {
                display: none;
            }
            .topbar {
                display: none;
            }
            .sticky-header {
                justify-content: space-between;
            }
            .sticky-header a {
                display: none;
            }

            .sticky-header .logo {
                display: block;
            }
            .menu-bar {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="topbar">
        <div class="logo"><img src="logo.png" alt="Logo"></div>
        <div class="dropdown" style="border: 1px solid black; border-radius: 5px; padding: 5px;">
            <button class="dropbtn" style="border: none; background-color: white;">Individual</button>
            <div class="dropdown-content" style="border: 1px solid black; border-radius: 5px; padding: 5px;">
                <a href="#" style="display: block; padding: 5px;">Individual</a>
                <a href="#" style="display: block; padding: 5px;">Government</a>
        
            </div>
        </div>
    </div>
 
    <div class="sticky-header" >   
    
        
       
        
        <a style=" margin-left: 10%;"></a>
       
        <a href="index.php" style="text-decoration: none; transition: all 0.2s ease-in-out;" onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='#103b5e'; this.style.textDecorationThickness='5px'; this.style.textUnderlineOffset='5px'" onmouseout="this.style.textDecoration='none'">Home</a>
        <a href="apply.php" style="text-decoration: none; transition: all 0.2s ease-in-out;" onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='#103b5e'; this.style.textDecorationThickness='5px'; this.style.textUnderlineOffset='5px'" onmouseout="this.style.textDecoration='none'">Apply for a Visa</a>
        <a href="#" style="text-decoration: none; transition: all 0.2s ease-in-out;" onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='#103b5e'; this.style.textDecorationThickness='5px'; this.style.textUnderlineOffset='5px'" onmouseout="this.style.textDecoration='none'">Premium Services</a>
        <a href="#" style="text-decoration: none; transition: all 0.2s ease-in-out;" onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='#103b5e'; this.style.textDecorationThickness='5px'; this.style.textUnderlineOffset='5px'" onmouseout="this.style.textDecoration='none'">Attend a centre</a>
        <a href="track.php" style="text-decoration: none; transition: all 0.2s ease-in-out;" onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='#103b5e'; this.style.textDecorationThickness='5px'; this.style.textUnderlineOffset='5px'" onmouseout="this.style.textDecoration='none'">Track your application</a>
        <a href="loginimmi.php" style="text-decoration: none; transition: all 0.2s ease-in-out;" onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='#103b5e'; this.style.textDecorationThickness='5px'; this.style.textUnderlineOffset='5px'" onmouseout="this.style.textDecoration='none'">Login Immi Account</a>

        <a href="#" style="text-decoration: none; transition: all 0.2s ease-in-out;" onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='#103b5e'; this.style.textDecorationThickness='5px'; this.style.textUnderlineOffset='5px'" onmouseout="this.style.textDecoration='none'">Additional Services</a>
        <a style=" margin-right: 10%;"></a>



        <div class="logo"><img src="logo.png" alt="Logo"></div>
        <span class="menu-bar" onclick="openNav()">☰</span>
    </div>

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a style=" margin-left: 10%;"></a>
       
       <a href="index.php" style="text-decoration: none; transition: all 0.2s ease-in-out;" onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='#103b5e'; this.style.textDecorationThickness='5px'; this.style.textUnderlineOffset='5px'" onmouseout="this.style.textDecoration='none'">Home</a>
       <a href="apply.php" style="text-decoration: none; transition: all 0.2s ease-in-out;" onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='#103b5e'; this.style.textDecorationThickness='5px'; this.style.textUnderlineOffset='5px'" onmouseout="this.style.textDecoration='none'">Apply for a Visa</a>
       <a href="#" style="text-decoration: none; transition: all 0.2s ease-in-out;" onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='#103b5e'; this.style.textDecorationThickness='5px'; this.style.textUnderlineOffset='5px'" onmouseout="this.style.textDecoration='none'">Premium Services</a>
       <a href="#" style="text-decoration: none; transition: all 0.2s ease-in-out;" onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='#103b5e'; this.style.textDecorationThickness='5px'; this.style.textUnderlineOffset='5px'" onmouseout="this.style.textDecoration='none'">Attend a centre</a>
       <a href="track.php" style="text-decoration: none; transition: all 0.2s ease-in-out;" onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='#103b5e'; this.style.textDecorationThickness='5px'; this.style.textUnderlineOffset='5px'" onmouseout="this.style.textDecoration='none'">Track your application</a>
       <a href="loginimmi.php" style="text-decoration: none; transition: all 0.2s ease-in-out;" onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='#103b5e'; this.style.textDecorationThickness='5px'; this.style.textUnderlineOffset='5px'" onmouseout="this.style.textDecoration='none'">Login Immi Account</a>

       <a href="#" style="text-decoration: none; transition: all 0.2s ease-in-out;" onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='#103b5e'; this.style.textDecorationThickness='5px'; this.style.textUnderlineOffset='5px'" onmouseout="this.style.textDecoration='none'">Additional Services</a>
      
      
      
            <div class="dropdown-content2" style="margin-top: 100px; border: 1px solid black; border-radius: 5px; padding: 5px; display:flex; justify-content: center; align-items: center;">
                <a href="#" style="display: block; padding: 5px;">Individual</a>
                <a href="#" style="display: block; padding: 5px;">Government</a>
               
            </div>
            
     </div>