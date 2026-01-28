<?php
// debug.php - Test hệ thống (READ-ONLY)
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo '<!DOCTYPE html>
<html>
<head>
    <title>System Debug Information (Read-Only Test)</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { background: #f0f0f0; padding: 10px; border-left: 5px solid #333; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .warning { color: orange; font-weight: bold; }
        .info { background: #e8f4fd; padding: 15px; margin: 10px 0; border: 1px solid #b6d4fe; }
        .code { background: #f5f5f5; padding: 10px; border: 1px solid #ddd; font-family: monospace; }
        table { border-collapse: collapse; width: 100%; margin: 10px 0; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
        tr:nth-child(even) { background: #f9f9f9; }
        .test-section { margin: 20px 0; padding: 15px; border: 1px solid #eee; }
        pre { background: #f8f8f8; padding: 10px; overflow: auto; }
        .data-table { width: 100%; margin: 10px 0; }
        .data-table th { background: #4CAF50; color: white; }
        .data-table tr:hover { background: #f5f5f5; }
        .readonly-badge { background: #2196F3; color: white; padding: 3px 8px; border-radius: 3px; font-size: 12px; }
    </style>
</head>
<body>
<div style="background: #e3f2fd; padding: 10px; border: 1px solid #2196F3; margin-bottom: 20px;">
    <strong>🔒 READ-ONLY MODE:</strong> This debug script will NOT create, modify, or delete any files or database records.
</div>

<h1>🔍 System Debug Information (Read-Only Test)</h1>';

echo '<div class="info">📅 Thời gian: ' . date('Y-m-d H:i:s') . '</div>';

// ====================
// 1. BASIC SYSTEM INFO
// ====================
echo '<div class="test-section">';
echo '<h2>📊 PHP Information</h2>';
echo '<table>';
echo '<tr><td>PHP Version</td><td>' . phpversion() . '</td></tr>';
echo '<tr><td>Operating System</td><td>' . PHP_OS . '</td></tr>';
echo '<tr><td>Server Software</td><td>' . htmlspecialchars($_SERVER['SERVER_SOFTWARE'] ?? 'N/A') . '</td></tr>';
echo '<tr><td>Document Root</td><td>' . htmlspecialchars($_SERVER['DOCUMENT_ROOT'] ?? 'N/A') . '</td></tr>';
echo '<tr><td>PHP Memory Limit</td><td>' . ini_get('memory_limit') . '</td></tr>';
echo '<tr><td>Max Execution Time</td><td>' . ini_get('max_execution_time') . ' seconds</td></tr>';
echo '<tr><td>Error Reporting</td><td>' . ini_get('error_reporting') . '</td></tr>';
echo '</table>';
echo '</div>';

// ====================
// 2. PHP EXTENSIONS
// ====================
echo '<div class="test-section">';
echo '<h2>🔌 PHP Extensions</h2>';
echo '<table>';
$extensions = [
    'zip' => 'ZIP Archive',
    'xml' => 'XML',
    'mbstring' => 'Multibyte String',
    'gd' => 'GD Image Library',
    'pdo_mysql' => 'PDO MySQL',
    'mysqli' => 'MySQLi',
    'curl' => 'cURL',
    'openssl' => 'OpenSSL',
    'fileinfo' => 'File Information',
    'json' => 'JSON'
];

foreach ($extensions as $ext => $name) {
    $status = extension_loaded($ext);
    echo '<tr>';
    echo '<td>' . $name . ' (' . $ext . ')</td>';
    echo '<td class="' . ($status ? 'success' : 'error') . '">';
    echo $status ? '✓ Đã cài đặt' : '✗ Chưa cài đặt';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
echo '</div>';

// ====================
// 3. FILE PERMISSIONS (READ-ONLY CHECK)
// ====================
echo '<div class="test-section">';
echo '<h2>📁 File Permissions (Read-Only Check)</h2>';
echo '<table>';
$dirs = [
    '.' => 'Current Directory',
    'data' => 'Data Directory',
    'templates' => 'Templates Directory'
];

foreach ($dirs as $dir => $description) {
    $exists = file_exists($dir);
    $readable = is_readable($dir);
    $writable = is_writable($dir);
    
    echo '<tr>';
    echo '<td>' . $description . ' (' . $dir . ')</td>';
    echo '<td>';
    echo $exists ? '✓ Tồn tại' : '✗ Không tồn tại';
    echo '<br>';
    echo $readable ? '✓ Có thể đọc' : '✗ Không thể đọc';
    echo '<br>';
    echo '<span class="' . ($writable ? 'warning' : 'success') . '">';
    echo $writable ? '⚠ Có thể ghi' : '✓ Chỉ đọc (an toàn)';
    echo '</span>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
echo '<div class="info"><strong>Lưu ý:</strong> Đối với debug, thư mục chỉ cần có quyền đọc là đủ.</div>';
echo '</div>';

// ====================
// 4. DATABASE CLASS TEST - READ-ONLY
// ====================
echo '<div class="test-section">';
echo '<h2>🗄️ Database Class Test (Read-Only)</h2>';

// Kiểm tra file database.php tồn tại
$dbFile = __DIR__ . '/database.php';
echo '<table>';
echo '<tr><td>Database Class File</td>';

if (file_exists($dbFile)) {
    echo '<td class="success">✓ database.php tồn tại</td></tr>';
    
    // Include và test class Database
    try {
        echo '<tr><td colspan="2"><div class="code">';
        echo '<strong>Testing Database class connection (READ-ONLY)...</strong><br><br>';
        
        // Include file database.php
        require_once $dbFile;
        
        echo '✓ File database.php loaded<br>';
        
        // Kiểm tra class Database tồn tại
        if (class_exists('Database')) {
            echo '✓ Class Database exists<br>';
            
            // Test kết nối database
            echo 'Attempting to connect to database (read-only test)...<br>';
            echo '----------------------------------------<br>';
            
            // Bắt đầu output buffering để chặn echo trong connect()
            ob_start();
            try {
                $database = new Database();
                $conn = $database->connect();
                $output = ob_get_clean();
                
                echo $output;
                
                if ($conn) {
                    echo '<span class="success">✓ Database connection successful</span><br><br>';
                    
                    // ========== READ-ONLY DATABASE CHECKS ==========
                    echo '<strong>1. Kiểm tra Database Information (Read-Only):</strong><br>';
                    
                    // Kiểm tra database hiện tại - CHỈ SELECT
                    $stmt = $conn->prepare("SELECT DATABASE() as current_db, USER() as db_user, VERSION() as db_version");
                    $stmt->execute();
                    $dbInfo = $stmt->fetch();
                    
                    echo 'Current database: <strong>' . htmlspecialchars($dbInfo['current_db'] ?? 'N/A') . '</strong><br>';
                    echo 'Database user: ' . htmlspecialchars($dbInfo['db_user'] ?? 'N/A') . '<br>';
                    echo 'MySQL version: ' . htmlspecialchars($dbInfo['db_version'] ?? 'N/A') . '<br>';
                    
                    // ========== READ-ONLY TABLE CHECK ==========
                    echo '<br><strong>2. Kiểm tra Tables (Read-Only):</strong><br>';
                    
                    // Lấy danh sách tables - CHỈ SELECT
                    $tablesStmt = $conn->prepare("SHOW TABLES");
                    $tablesStmt->execute();
                    $databaseTables = $tablesStmt->fetchAll(PDO::FETCH_COLUMN);
                    
                    echo 'Tổng số tables: <strong>' . count($databaseTables) . '</strong><br>';
                    
                    if (count($databaseTables) > 0) {
                        echo '<ul>';
                        foreach ($databaseTables as $table) {
                            echo '<li>' . htmlspecialchars($table);
                            
                            // Kiểm tra table HopDong cụ thể
                            if (strtolower($table) === 'hopdong') {
                                echo ' <span class="success">(Found!)</span>';
                                
                                // READ-ONLY: Chỉ xem cấu trúc, không xem dữ liệu
                                echo '<br><em>Table structure (read-only):</em><br>';
                                $structure = $conn->prepare("DESCRIBE " . $table);
                                $structure->execute();
                                $columns = $structure->fetchAll();
                                
                                echo '<table style="font-size: 12px; width: auto;">';
                                echo '<tr><th>Field</th><th>Type</th></tr>';
                                foreach ($columns as $col) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($col['Field']) . '</td>';
                                    echo '<td>' . htmlspecialchars($col['Type']) . '</td>';
                                    echo '</tr>';
                                }
                                echo '</table>';
                                
                                // READ-ONLY: Chỉ đếm số bản ghi, không xem nội dung
                                $countStmt = $conn->prepare("SELECT COUNT(*) as total FROM " . $table);
                                $countStmt->execute();
                                $countResult = $countStmt->fetch();
                                echo 'Total records: <strong>' . $countResult['total'] . '</strong>';
                            }
                            echo '</li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '<span class="warning">⚠ Database không có tables nào</span><br>';
                    }
                    
                    // ========== READ-ONLY PERMISSION CHECK ==========
                    echo '<br><strong>3. Kiểm tra Database Permissions (Read-Only):</strong><br>';
                    
                    try {
                        // Thử SELECT đơn giản để test read permission
                        $testStmt = $conn->prepare("SELECT 1 as test_value");
                        $testStmt->execute();
                        $testResult = $testStmt->fetch();
                        
                        if ($testResult && $testResult['test_value'] == 1) {
                            echo '<span class="success">✓ Có quyền đọc (SELECT) database</span><br>';
                        }
                        
                        // KHÔNG test INSERT/UPDATE/DELETE - ĐẢM BẢO READ-ONLY
                        echo '<span class="success">✓ Không thực hiện bất kỳ INSERT/UPDATE/DELETE nào</span><br>';
                        
                    } catch (Exception $e) {
                        echo '<span class="error">✗ Lỗi khi test read permissions: ' . htmlspecialchars($e->getMessage()) . '</span><br>';
                    }
                    
                    // ========== READ-ONLY CONNECTION INFO ==========
                    echo '<br><strong>4. Connection Information (Read-Only):</strong><br>';
                    
                    try {
                        $connInfo = $conn->getAttribute(PDO::ATTR_CONNECTION_STATUS);
                        echo 'Connection status: ' . htmlspecialchars($connInfo) . '<br>';
                        
                        $serverInfo = $conn->getAttribute(PDO::ATTR_SERVER_INFO);
                        echo 'Server info: ' . htmlspecialchars(substr($serverInfo, 0, 100)) . '...<br>';
                        
                    } catch (Exception $e) {
                        // Bỏ qua nếu không lấy được thông tin
                    }
                    
                } else {
                    echo '<span class="error">✗ Database connection failed (conn is null)</span><br>';
                }
                
            } catch (Exception $e) {
                ob_end_clean();
                echo '<span class="error">✗ Database connection error: ' . htmlspecialchars($e->getMessage()) . '</span><br>';
            }
            
        } else {
            echo '<span class="error">✗ Class Database not found in file</span><br>';
        }
        
        echo '</div></td></tr>';
        
    } catch (Exception $e) {
        echo '<tr><td>Database Test Error</td><td class="error">✗ ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
    }
    
} else {
    echo '<td class="error">✗ database.php không tồn tại</td></tr>';
    echo '<tr><td>Giải pháp</td><td>Tạo file database.php với class Database (không tự động tạo)</td></tr>';
}

echo '</table>';
echo '</div>';

// ====================
// 5. PHPWORD & COMPOSER CHECK
// ====================
echo '<div class="test-section">';
echo '<h2>📦 PHPWord & Composer Check</h2>';
$vendorPath = __DIR__ . '/vendor/autoload.php';
echo '<table>';
echo '<tr><td>Composer Vendor Path</td><td>' . htmlspecialchars($vendorPath) . '</td></tr>';

if (file_exists($vendorPath)) {
    echo '<tr><td>Vendor Autoload File</td><td class="success">✓ Tồn tại</td></tr>';
    
    try {
        // CHỈ kiểm tra, không require nếu không cần
        $vendorContent = file_get_contents($vendorPath);
        if (strpos($vendorContent, 'phpword') !== false || strpos($vendorContent, 'PhpWord') !== false) {
            echo '<tr><td>PHPWord trong composer.json</td><td class="success">✓ Đã khai báo</td></tr>';
        }
        
        // Kiểm tra class có tồn tại không (không khởi tạo)
        $classExists = false;
        $autoloadFiles = [
            __DIR__ . '/vendor/phpoffice/phpword/src/PhpWord/PhpWord.php',
            __DIR__ . '/vendor/phpoffice/phpword/bootstrap.php'
        ];
        
        foreach ($autoloadFiles as $file) {
            if (file_exists($file)) {
                $classExists = true;
                break;
            }
        }
        
        if ($classExists) {
            echo '<tr><td>PHPWord Files</td><td class="success">✓ Đã cài đặt</td></tr>';
        } else {
            echo '<tr><td>PHPWord Files</td><td class="warning">⚠ Files không tìm thấy (có thể chưa cài)</td></tr>';
        }
        
    } catch (Exception $e) {
        echo '<tr><td>PHPWord Check</td><td class="error">✗ Lỗi: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
    }
} else {
    echo '<tr><td>Vendor Autoload</td><td class="warning">⚠ Không tồn tại</td></tr>';
    echo '<tr><td>Giải pháp</td><td>Chạy: composer require phpoffice/phpword (thủ công)</td></tr>';
}
echo '</table>';
echo '</div>';

