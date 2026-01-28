
<?php
// save_settings.php - API để lưu cài đặt hệ thống
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

header('Content-Type: application/json; charset=utf-8');

try {
    // Kiểm tra POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Chỉ chấp nhận POST request');
    }
    
    // Lấy dữ liệu JSON
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input || !isset($input['paper_type'])) {
        throw new Exception('Dữ liệu không hợp lệ');
    }
    
    $paperType = $input['paper_type'];
    
    // Validate loại giấy
    if (!in_array($paperType, ['A4', 'A5'])) {
        throw new Exception('Loại giấy không hợp lệ');
    }
    
    // ========== KẾT NỐI DATABASE ==========
    require_once __DIR__ . '/database.php';
    $db = new Database();
    $conn = $db->connect();
    
    // Kiểm tra và tạo bảng Settings nếu chưa tồn tại
    $createTableSQL = "CREATE TABLE IF NOT EXISTS Settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        setting_key VARCHAR(50) NOT NULL UNIQUE,
        setting_value VARCHAR(100) NOT NULL,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $conn->exec($createTableSQL);
    
    // Lưu cài đặt
    $stmt = $conn->prepare("INSERT INTO Settings (setting_key, setting_value) VALUES ('paper_type', ?) 
                            ON DUPLICATE KEY UPDATE setting_value = ?, updated_at = CURRENT_TIMESTAMP");
    $stmt->execute([$paperType, $paperType]);
    
    // Trả về kết quả
    $response = [
        'success' => true,
        'message' => 'Đã lưu cài đặt loại giấy: ' . $paperType,
        'paper_type' => $paperType
    ];
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    error_log('ERROR in save_settings.php: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => '❌ Lỗi: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}