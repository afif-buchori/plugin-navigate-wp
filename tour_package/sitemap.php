<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
function enx_get_page_content($data)
{
  $urls = $data ?? [];
  header('Content-Type: application/xml; charset=UTF-8');

  echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
  echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

  foreach ($urls as $item) {
    $newUrl = home_url();
    foreach (explode("/", htmlspecialchars($item->loc, ENT_XML1)) as $keyUrl => $url) {
      if ($keyUrl > 4) {
        $newUrl .= "/" . $url;
      }
    }
    echo '  <url>' . PHP_EOL;
    echo '    <loc>' . htmlspecialchars($newUrl, ENT_XML1) . '</loc>' . PHP_EOL;
    echo '    <lastmod>' . $item->lastmod . '</lastmod>' . PHP_EOL;
    echo '    <changefreq>' . $item->changefreq . '</changefreq>' . PHP_EOL;
    echo '    <priority>' . $item->priority . '</priority>' . PHP_EOL;
    echo '  </url>' . PHP_EOL;
  }

  echo '</urlset>';

  exit;
}
