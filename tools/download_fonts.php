<?php
$fonts = [
    'bootstrap-icons.woff2' => [
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/fonts/bootstrap-icons.woff2',
        'https://unpkg.com/bootstrap-icons@1.11.3/font/fonts/bootstrap-icons.woff2',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.woff2',
    ],
    'bootstrap-icons.woff' => [
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/fonts/bootstrap-icons.woff',
        'https://unpkg.com/bootstrap-icons@1.11.3/font/fonts/bootstrap-icons.woff',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.woff',
    ],
];
$destDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'fonts';
if (!is_dir($destDir)) mkdir($destDir, 0755, true);
foreach ($fonts as $name => $candidates) {
    $saved = false;
    foreach ($candidates as $url) {
        echo "Trying $url\n";
        $h = @get_headers($url, 1);
        if ($h !== false && isset($h[0]) && stripos($h[0], '200') !== false) {
            $content = @file_get_contents($url);
            if ($content !== false) {
                file_put_contents($destDir . DIRECTORY_SEPARATOR . $name, $content);
                echo "Saved $name to $destDir\n";
                $saved = true;
                break;
            }
        } else {
            echo "Failed: $url (" . ($h[0] ?? 'no headers') . ")\n";
        }
    }
    if (!$saved) echo "Could not download $name\n";
}
