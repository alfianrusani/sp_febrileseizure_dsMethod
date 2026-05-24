<?php
$url = 'https://cdnjs.cloudflare.com/ajax/libs/tabler/1.0.0-beta20/css/tabler.min.css';
$h = @get_headers($url, 1);
if ($h === false) {
    echo "CDN_UNREACHABLE\n";
    exit(1);
}
echo "CDN_OK\n" . ($h[0] ?? '') . "\n";
