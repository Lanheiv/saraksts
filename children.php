<?php 
require "Database.php";
$config = require("config.php");

$db = new DATABASE($config["database"]);

$child = $db->query("SELECT * FROM children")->fetchAll(PDO::FETCH_ASSOC);
$letter = $db->query("SELECT * FROM letters")->fetchAll(PDO::FETCH_ASSOC);
$gifts = $db->query("SELECT * FROM gifts")->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bērnu sarkasts</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Bērnu sarkasts</h1>
        <p>Bērnu sarkasts ziemassvētku vecītim.</p>
    </header>

    <div class="list">
        <?php
            foreach ($child as $kid) {
                echo "<div class='box'>";
                echo "<h2>$kid[id]. sīkais</h2>";
                echo "<p>Vārds: $kid[firstname] $kid[middlename]</p>";
                echo "<p>Uzvārds: $kid[surname]</p>";
                echo "<p>Vecums: $kid[age]</p>";
            
                echo "<button class='accordion'>Vēstule</button>";
                echo "<div class='panel'>";
            
                foreach ($letter as $snad) {
                    if ($snad['sender_id'] == $kid['id']) {
                        $letterText = $snad['letter_text'];

                        $matchedGifts = [];

                        foreach ($gifts as $gift) {
                            $giftName = $gift['name'];
                            $letterText = preg_replace('/\b(' . preg_quote($giftName, '/') . ')\b/i', '<span class="highlight">$1</span>', $letterText);
                            if (stripos($letterText, $gift['name']) !== false) {
                                $matchedGifts[] = $gift['name'];
                            }
                        }

                        echo "<p>" . $letterText . "</p>";
                        if (!empty($matchedGifts)) { // Pārbaude vai ir kautkas
                            echo "<p>Sīkais grib: " . implode(", ", array_unique($matchedGifts)) . "</p>";
                        }

                        break;
                    }
                }
                echo "</div>";
                echo "</div>";
            }
        ?>
    </div>
    <script src="script.js"></script>
</body>
</html>
