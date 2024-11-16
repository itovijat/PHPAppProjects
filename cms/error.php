<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <style>
        body {
            background-color: #f1f1f1;
            font-family: Arial, sans-serif;
        }
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
            background-color: #fff;
            box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2);
        }
        h1 {
            color: #ff5252;
        }
        p {
            margin-bottom: 20px;
        }
        a {
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Error</h1>
        <?php if(isset($_GET['msg'])): ?>
        <p><?php echo $_GET['msg']; ?></p>
        <?php endif; ?>
        <p><a href="index.php">Go back</a></p>
    </div>
</body>
</html>
