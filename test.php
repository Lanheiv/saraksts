<?php
require "Database.php";

$db = new DATABASE($config["database"]);

$child = $db->query("SELECT * FROM children")->fetchAll(PDO::FETCH_ASSOC);
$gift = $db->query("SELECT `name` FROM gifts")->fetchAll(PDO::FETCH_ASSOC);

$text = "";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $text = $row['content'];
    }
}

$highlighted_text = $text;

if ($words_result->num_rows > 0) {
    while ($row = $words_result->fetch_assoc()) {
        $word = $row['word'];

        $highlighted_text = preg_replace('/\b' . preg_quote($word, '/') . '\b/i', '<span style="background-color: yellow;">' . $word . '</span>', $highlighted_text);
    }
}

foreach ($letter as $snad) {
    if ($snad['sender_id'] == $kid['id']) { // Iegūst īsto vēstuli
        $words = explode(" ", $snad['letter_text']); // sadala tekstu

        $matchedGifts = [];

        foreach ($words as $word) {
            foreach ($gifts as $gift) {
                if (stripos($word, $gift['name']) !== false) {
                    $matchedGifts[] = $gift['name'];
                    break;
                }
            }
        }

        echo "<p>" . $snad['letter_text'] . "</p>";

        if (!empty($matchedGifts)) { // Pārbaude vai ir kautkas
            echo "<p><strong>Sīkais grib: </strong>" . implode(", ", array_unique($matchedGifts)) . "</p>";
        }
        break;
    }
}