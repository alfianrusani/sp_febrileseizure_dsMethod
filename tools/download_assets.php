<?php
$assets = [
    'css/tabler.min.css' => [
        'https://cdnjs.cloudflare.com/ajax/libs/tabler/1.0.0-beta20/css/tabler.min.css',
        'https://cdn.jsdelivr.net/npm/tabler@1.0.0-beta20/dist/css/tabler.min.css',
        'https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css',
        'https://unpkg.com/tabler@1.0.0-beta20/dist/css/tabler.min.css',
    ],
    'css/tabler-flags.min.css' => [
        'https://cdnjs.cloudflare.com/ajax/libs/tabler/1.0.0-beta20/css/tabler-flags.min.css',
        'https://cdn.jsdelivr.net/npm/tabler@1.0.0-beta20/dist/css/tabler-flags.min.css',
        'https://unpkg.com/tabler@1.0.0-beta20/dist/css/tabler-flags.min.css',
    ],
    'js/tabler.min.js' => [
        'https://cdnjs.cloudflare.com/ajax/libs/tabler/1.0.0-beta20/js/tabler.min.js',
        'https://cdn.jsdelivr.net/npm/tabler@1.0.0-beta20/dist/js/tabler.min.js',
        'https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/js/tabler.min.js',
        'https://unpkg.com/tabler@1.0.0-beta20/dist/js/tabler.min.js',
    ],
    'css/bootstrap-icons.min.css' => [
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
        'https://unpkg.com/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
    ],
];

if (!is_dir('public/css')) mkdir('public/css', 0755, true);
if (!is_dir('public/js')) mkdir('public/js', 0755, true);

foreach ($assets as $path => $candidates) {
    $saved = false;
    foreach ($candidates as $url) {
        echo "Trying: $url\n";
        $h = @get_headers($url, 1);
        if ($h !== false) {
            // parse status
            $status = $h[0] ?? '';
            if (stripos($status, '200') !== false) {
                echo "Downloading $url -> public/$path\n";
                $content = @file_get_contents($url);
                if ($content !== false) {
                    $fullpath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path);
                    $dir = dirname($fullpath);
                    if (!is_dir($dir)) mkdir($dir, 0755, true);
                    file_put_contents($fullpath, $content);
                    echo "Saved to $fullpath\n";
                    $saved = true;
                    break;
                } else {
                    echo "Failed to fetch content from $url\n";
                }
            } else {
                echo "Non-200 status: $status\n";
            }
        } else {
            echo "No headers for $url\n";
        }
    }
    if (!$saved) {
        echo "WARNING: Could not download asset for public/$path from any candidate URLs.\n";
    }
}

// clear caches
echo "Clearing Laravel caches...\n";
passthru('php artisan view:clear 2>&1');
passthru('php artisan cache:clear 2>&1');
passthru('php artisan config:clear 2>&1');

echo "Done.\n";
