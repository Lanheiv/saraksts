<?php

function highlightWords($text, $words) {
    $escapedWords = array_map('preg_quote', $words);
    $pattern = '/\b(' . implode('|', $escapedWords) . ')\b/i';
    
    $highlightedText = preg_replace($pattern, '<mark>$1</mark>', $text);

    return $highlightedText;
}

// Example usage
$text = "This is a simple test. The test is important, and the quick brown fox jumps over the lazy dog.";
$words = ["test", "quick", "dog"];
$highlightedText = highlightWords($text, $words);

echo $highlightedText;
