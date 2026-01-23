<?php
// open_word.php - Mở file bằng Microsoft Word
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json; charset=utf-8');

try {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input || !isset($input['file_path'])) {
        throw new Exception('Thiếu thông tin file_path');
    }
    
    $filePath = $input['file_path'];
    
    if (!file_exists($filePath)) {
        throw new Exception('File không tồn tại');
    }
    
    // Mở file bằng Microsoft Word
    $command = 'open -a "Microsoft Word" "' . $filePath . '" 2>&1';
    exec($command, $output, $returnCode);
    
    if ($returnCode === 0) {
        $response = [
            'success' => true,
            'message' => 'Đang mở file bằng Microsoft Word'
        ];
    } else {
        // Thử phương pháp khác
        $altCommand = 'open "' . $filePath . '" 2>&1';
        exec($altCommand, $altOutput, $altReturnCode);
        
        if ($altReturnCode === 0) {
            $response = [
                'success' => true,
                'message' => 'Đang mở file'
            ];
        } else {
            throw new Exception('Không thể mở file');
        }
    }
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => '❌ ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}