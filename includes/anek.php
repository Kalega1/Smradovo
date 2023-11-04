<?php
$base_url = 'https://anekdoty.ru/pro-govno/';
$keyword = 'говно';
$max_page = 10; // Максимальное количество страниц для поиска

$filtered_jokes = [];

for ($page = 1; $page <= $max_page; $page++) {
  $url = $base_url . '?page=' . $page;
  $html = file_get_contents($url);
  
  preg_match_all("/<p>(.*?)<\/p>/", $html, $matches);
  
  $jokes = $matches[1];
  
  $current_filtered_jokes = array_filter($jokes, function($joke) use ($keyword) {
    return stripos($joke, $keyword) !== false;
  });
  
  $filtered_jokes = array_merge($filtered_jokes, $current_filtered_jokes);
}

$total_joke_count = count($filtered_jokes);

if ($total_joke_count > 0) {
  $random_joke_number = mt_rand(0, $total_joke_count - 1);
  $random_joke = $filtered_jokes[$random_joke_number];
  
  $random_joke = strip_tags($random_joke);
  
  echo $random_joke;
} else {
  echo 'Я устал, заходи попозже, друг!';
}

?>