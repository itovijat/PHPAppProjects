<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tic Tac Toe Game</title>
    <style>
        .board { display: grid; grid-template-columns: repeat(3, 100px); grid-gap: 5px; }
        .cell { width: 100px; height: 100px; border: 1px solid #000; text-align: center; font-size: 2em; }
    </style>
</head>
<body>
    <h1>Tic Tac Toe</h1>
    <div class="board">
        <?php for ($i = 0; $i < 9; $i++): ?>
            <div class="cell" data-index="<?php echo $i; ?>"></div>
        <?php endfor; ?>
    </div>
    <script>
        let cells = document.querySelectorAll('.cell');
        cells.forEach(cell => {
            cell.addEventListener('click', function() {
                let index = this.getAttribute('data-index');
                // Add your game logic here
            });
        });
    </script>
</body>
</html>
