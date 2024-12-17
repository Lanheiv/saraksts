<?php
require "Database.php";
$config = require("config.php");

$db = new DATABASE($config["database"]);
$post = $db->query("SELECT * FROM gifts")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dāvanu noliktava</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Dāvanu saraksts</h1>
        <p>Dāvanas kas ir noliktavā.</p>
    </header>


    <div class="list">
        <?php
            foreach ($post as $present) {
                echo "<div class='box'>";
                echo "<h2>$present[id]. dāvanu tips</h2>";
                echo "<p>Dāvanu nosaukums: $present[name]</p>";
                echo "<p>Noliktavā: $present[count_available]</p>";
                echo "</div>";
            }
        ?>
    </div>
    <script src="snow.js"></script>
</body>
</html>