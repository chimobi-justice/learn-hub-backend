<?php 

namespace App\Helpers;

use Illuminate\Support\Str;

class EstimatedReadTime {
    public static function readTime(string $text, int $wordsPerMinutes = 300): string {
        $wordCount = str_word_count(strip_tags($text));

        $minute = ceil($wordCount / $wordsPerMinutes);

        return $minute . ' ' . Str::plural('min', $minute) . ' ' . 'read'; 
    }
}