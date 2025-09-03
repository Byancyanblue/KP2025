<?php

if (!function_exists('cleanMarkdown')) {
    function cleanMarkdown($text) {
        // Bersihkan kombinasi heading + newline + tanda ":"
        $text = preg_replace('/(\n|^)\d\..*?\n\s*:\s*/', "$1", $text); // hapus : setelah judul
    
        // Bersihkan baris yang hanya tanda :
        $text = preg_replace('/^\s*:\s*$/m', '', $text); 
    
        // Markdown: bold dan italic
        $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);
        $text = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $text);
    
        // Markdown: bullet list
        $text = preg_replace('/(?:^|\n)[\*\-]\s*(.*?)(?=\n|$)/', '<li>$1</li>', $text);
        if (str_contains($text, '<li>')) {
            $text = '<ul>' . $text . '</ul>';
        }
    
        // Ganti newline dengan <br> di akhir
        $text = nl2br($text);
    
        return $text;
    }
    
}
