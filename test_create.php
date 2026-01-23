<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json; charset=utf-8');

try {
    // Test 1: Check vendor
    $vendorPath = __DIR__ . '/vendor/autoload.php';
    if (!file_exists($vendorPath)) {
        throw new Exception('PHPWord chưa được cài đặt');
    }
    
    require_once $vendorPath;
    
    // Test 2: Check template
    $templatePath = __DIR__ . '/templates/contract_template.docx';
    if (!file_exists($templatePath)) {
        throw new Exception('Không tìm thấy template');
    }
    
    // Test 3: Check data directory
    $dataDir = __DIR__ . '/data';
    if (!is_dir($dataDir)) {
        mkdir($dataDir, 0755, true);
    }
    
    if (!is_writable($dataDir)) {
        throw new Exception('Thư mục data không có quyền ghi');
    }
    
    echo json_encode([
        'success' => true,
        'message' => 'Tất cả đều OK',
        'checks' => [
            'vendor' => 'OK',
            'template' => 'OK',
            'data_dir' => 'OK',
            'writable' => 'OK'
        ]
    ], JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}