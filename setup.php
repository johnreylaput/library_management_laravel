<?php
/**
 * InfinityFree / no-SSH Laravel setup script
 * 
 * IMPORTANT: Delete this file after use for security.
 * 
 * Usage: Visit https://your-domain.com/setup.php in your browser.
 */

$startTime = microtime(true);
$output = [];

function logStep($message) {
    global $output;
    $time = date('H:i:s');
    $output[] = "[{$time}] {$message}";
}

function displayOutput() {
    global $output, $startTime;
    $elapsed = round(microtime(true) - $startTime, 2);
    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel Setup</title>
    <style>
        body { font-family: monospace; background: #1e1e1e; color: #d4d4d4; padding: 20px; }
        .line { margin: 4px 0; }
        .success { color: #4ec9b0; }
        .error { color: #f48771; }
        .info { color: #9cdcfe; }
        .warning { color: #dcdcaa; }
        .box { background: #252526; border: 1px solid #3e3e42; padding: 15px; border-radius: 6px; margin-bottom: 15px; }
        a { color: #569cd6; }
    </style>
</head>
<body>
    <h1 class="info">Laravel InfinityFree Setup</h1>
    <div class="box">';
    foreach ($output as $line) {
        $class = '';
        if (str_contains($line, 'ERROR') || str_contains($line, 'failed')) $class = 'error';
        elseif (str_contains($line, 'successfully') || str_contains($line, 'Done')) $class = 'success';
        elseif (str_contains($line, 'WARNING')) $class = 'warning';
        echo "<div class='line {$class}'>{$line}</div>";
    }
    $class = ($elapsed < 30) ? 'success' : 'warning';
    echo "</div>
    <div class='box {$class}'>
        <strong>Total time: {$elapsed} seconds</strong><br>
        <strong>NEXT STEP:</strong> Delete this file (setup.php) from your server for security.
    </div>
</body>
</html>";
    exit;
}

set_time_limit(120);
ob_start();

// Step 1: Check Laravel installation
logStep('<span class="info">Step 1/5: Checking Laravel installation...</span>');
if (!file_exists(__DIR__ . '/artisan')) {
    logStep('<span class="error">ERROR: artisan file not found. Make sure setup.php is in the Laravel root folder.</span>');
    displayOutput();
}
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    logStep('<span class="error">ERROR: vendor/autoload.php not found. Did you run composer install locally?</span>');
    displayOutput();
}
logStep('<span class="success">Laravel installation verified.</span>');

// Step 2: Check .env
logStep('<span class="info">Step 2/5: Checking .env file...</span>');
if (!file_exists(__DIR__ . '/.env')) {
    logStep('<span class="warning">WARNING: .env not found. Copying from .env.example...</span>');
    if (file_exists(__DIR__ . '/.env.example')) {
        copy(__DIR__ . '/.env.example', __DIR__ . '/.env');
        logStep('<span class="success">Copied .env.example to .env</span>');
    } else {
        logStep('<span class="error">ERROR: .env.example not found. Create .env manually.</span>');
        displayOutput();
    }
} else {
    logStep('<span class="success">.env file exists.</span>');
}

// Step 3: Generate APP_KEY if missing
logStep('<span class="info">Step 3/5: Checking APP_KEY...</span>');
$envContent = file_get_contents(__DIR__ . '/.env');
if (!preg_match('/APP_KEY=base64:[^\\n]+/', $envContent)) {
    logStep('<span class="warning">APP_KEY not set. Generating...</span>');
    passthru('php ' . escapeshellarg(__DIR__ . '/artisan') . ' key:generate --force', $returnVar);
    if ($returnVar !== 0) {
        logStep('<span class="error">ERROR: key:generate failed. Run it manually via SSH later.</span>');
    } else {
        logStep('<span class="success">APP_KEY generated.</span>');
    }
} else {
    logStep('<span class="success">APP_KEY already set.</span>');
}

// Step 4: Run migrations
logStep('<span class="info">Step 4/5: Running database migrations...</span>');
passthru('php ' . escapeshellarg(__DIR__ . '/artisan') . ' migrate --force', $returnVar);
if ($returnVar !== 0) {
    logStep('<span class="error">ERROR: Migrations failed. Check your .env database settings.</span>');
} else {
    logStep('<span class="success">Migrations completed.</span>');
}

// Step 5: Optimize caches
logStep('<span class="info">Step 5/5: Optimizing caches...</span>');
passthru('php ' . escapeshellarg(__DIR__ . '/artisan') . ' config:cache', $returnVar);
$configOk = $returnVar === 0;
passthru('php ' . escapeshellarg(__DIR__ . '/artisan') . ' route:cache', $returnVar);
$routeOk = $returnVar === 0;
passthru('php ' . escapeshellarg(__DIR__ . '/artisan') . ' view:cache', $returnVar);
$viewOk = $returnVar === 0;

if ($configOk && $routeOk && $viewOk) {
    logStep('<span class="success">All caches optimized.</span>');
} else {
    logStep('<span class="warning">WARNING: Some cache commands failed. This may affect performance but the app should still work.</span>');
}

// Create storage link
logStep('<span class="info">Creating storage symlink...</span>');
passthru('php ' . escapeshellarg(__DIR__ . '/artisan') . ' storage:link', $returnVar);
if ($returnVar !== 0) {
    logStep('<span class="warning">WARNING: storage:link failed. Public file uploads may not work.</span>');
} else {
    logStep('<span class="success">Storage link created.</span>');
}

logStep('<span class="success">Setup complete! Delete this file immediately.</span>');
displayOutput();
