<?php
// debug.php - Test hệ thống
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo '<h2>System Information</h2>';
echo 'PHP Version: ' . phpversion() . '<br>';
echo 'OS: ' . PHP_OS . '<br>';
echo 'Server: ' . $_SERVER['SERVER_SOFTWARE'] . '<br>';
echo 'Document Root: ' . $_SERVER['DOCUMENT_ROOT'] . '<br>';

echo '<h2>PHP Extensions</h2>';
$extensions = ['zip', 'xml', 'mbstring', 'gd'];
foreach ($extensions as $ext) {
    echo $ext . ': ' . (extension_loaded($ext) ? '✓' : '✗') . '<br>';
}

echo '<h2>File Permissions</h2>';
$dirs = ['data', 'templates', '.'];
foreach ($dirs as $dir) {
    echo $dir . ': ' . (is_writable($dir) ? 'Writable ✓' : 'Not Writable ✗') . '<br>';
}

echo '<h2>Test PHPWord</h2>';
$vendorPath = __DIR__ . '/vendor/autoload.php';
if (file_exists($vendorPath)) {
    echo 'Vendor autoload: ✓<br>';
    
    require_once $vendorPath;
    echo 'PHPWord loaded: ✓<br>';
} else {
    echo 'Vendor autoload: ✗<br>';
    echo 'Run: composer require phpoffice/phpword<br>';
}

echo '<h2>Test exec()</h2>';
if (function_exists('exec')) {
    echo 'exec() function: Enabled ✓<br>';
    
    // Test simple command
    exec('echo "test"', $output, $returnCode);
    echo 'Test command: ' . ($returnCode === 0 ? 'Works ✓' : 'Failed ✗') . '<br>';
} else {
    echo 'exec() function: Disabled ✗<br>';
    echo 'Enable exec() in php.ini<br>';
}