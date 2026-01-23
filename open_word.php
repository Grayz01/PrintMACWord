<?php
// open_word.php - Mở file bằng Microsoft Word
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

header('Content-Type: application/json; charset=utf-8');

try {
    error_log('=== OPEN_WORD START ===');
    
    // Kiểm tra POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Chỉ chấp nhận POST request');
    }
    
    // Lấy dữ liệu JSON
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    if (!isset($data['file_path'])) {
        throw new Exception('Thiếu thông tin file_path');
    }
    
    $file_path = $data['file_path'];
    
    // Kiểm tra file tồn tại
    if (!file_exists($file_path)) {
        throw new Exception('File không tồn tại: ' . $file_path);
    }
    
    // MỞ FILE BẰNG MICROSOFT WORD (macOS)
    error_log("Opening file with Microsoft Word: $file_path");
    
    $wordOpened = false;
    $openMessage = '';
    
    // Phương pháp 1: Sử dụng lệnh open
    $command = 'open -a "Microsoft Word" "' . $file_path . '" 2>&1';
    $output = [];
    $returnCode = 0;
    
    exec($command, $output, $returnCode);
    
    if ($returnCode === 0) {
        $wordOpened = true;
        $openMessage = 'File đã được mở bằng Microsoft Word';
        error_log("Word opened successfully");
    } else {
        error_log("Word open failed. Trying alternative method...");
        
        // Phương pháp 2: Sử dụng lệnh open không chỉ định app
        $altCommand = 'open "' . $file_path . '" 2>&1';
        exec($altCommand, $altOutput, $altReturnCode);
        
        if ($altReturnCode === 0) {
            $wordOpened = true;
            $openMessage = 'File đã được mở với ứng dụng mặc định';
            error_log("File opened with default application");
        } else {
            $openMessage = 'Không thể mở file tự động. Vui lòng mở thủ công từ thư mục data.';
            error_log("Failed to open file. Output: " . implode("\n", $output));
        }
    }
    
    // Response
    $response = [
        'success' => $wordOpened,
        'message' => $openMessage,
        'file_path' => $file_path,
        'word_opened' => $wordOpened
    ];
    
    error_log("Response sent: " . json_encode($response, JSON_UNESCAPED_UNICODE));
    error_log('=== OPEN_WORD END ===');
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    error_log('ERROR in open_word.php: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => '❌ Lỗi: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}