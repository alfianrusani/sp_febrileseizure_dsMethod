<?php

// Arahkan penyimpanan temporary ke /tmp agar tidak terbentur read-only filesystem Vercel
$_ENV['APP_STORAGE'] = '/tmp';

require __DIR__ . '/../public/index.php';