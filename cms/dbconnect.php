<?php
session_start();

if (!isset($_SESSION['email'])) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? ($_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['HTTP_CLIENT_IP']);
    $_SESSION['email'] = $ip;
    
    $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip"));
    if ($geo['geoplugin_countryCode'] !== 'BD' && $ip !== '::1') {
        echo "<script>window.location.href='error.php?msg=Access%20denied%20from%20IP%3A%20$ip,%20Location%3A%20" . $geo['geoplugin_city'] . ",%20" . $geo['geoplugin_countryName'] . "';</script>";
        exit;
    }
}

date_default_timezone_set('Asia/Dhaka');

if ($_SERVER['SERVER_NAME'] === 'localhost' || strpos($_SERVER['SERVER_NAME'], 'ngrok-free.app') !== false) {
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'cms';
} else {
    $servername = 'localhost';
    $username = 'ovijattt_adminush';
    $password = 'IGQyDmcP!gi1';
    $dbname = 'ovijattt_pms';
}

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo '<style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            text-align: center;
            width: 50%;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 20px;
            background-color: #f1f1f1;
            box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2);
            animation: shake 3s infinite cubic-bezier(.36,.07,.19,.97) both;
            transform: translate3d(0, 0, 0);
            backface-visibility: hidden;
            perspective: 1000px;
        }
        .error { color: #FF5252; }
        h3 { margin-top: 0; }
        p { margin-bottom: 20px; }
        a { color: #4CAF50; }
        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }
    </style>
    <div class="container">
        <i style="font-size: 5em;" class="fas fa-exclamation-triangle"></i>
        <h1>EOvijat.com</h1>
        <h3 class="error">Database Connection Error</h3>
        <p>Something went wrong. Please contact the administrator.</p>
        <p>Call IT Engineer for help.</p>
        <p><a href="tel:01632950179">01632950179</a></p>
        <button style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="location.reload()">Refresh</button>
    </div>';
    die();
}
?>