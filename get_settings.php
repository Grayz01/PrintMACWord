
<?php
// get_settings.php - API để lấy cài đặt hệ thống
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

header('Content-Type: application/json; charset=utf-8');

try {
    // ========== KẾT NỐI DATABASE ==========
    require_once __DIR__ . '/database.php';
    $db = new Database();
    $conn = $db->connect();
    
    // ========== LẤY CÀI ĐẶT LOẠI GIẤY ==========
    $paperType = 'A4'; // Mặc định
    
    try {
        $stmt = $conn->prepare("SELECT setting_value FROM Settings WHERE setting_key = 'paper_type'");
        $stmt->execute();
        $setting = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($setting && isset($setting['setting_value'])) {
            $paperType = $setting['setting_value'];
        } else {
            // Nếu chưa có cài đặt, tạo mới
            $stmt = $conn->prepare("INSERT INTO Settings (setting_key, setting_value) VALUES ('paper_type', ?)");
            $stmt->execute(['A4']);
        }
    } catch (Exception $e) {
        error_log('Không thể lấy cài đặt paper_type: ' . $e->getMessage());
        
        // Nếu bảng Settings chưa tồn tại, tạo bảng
        $createTableSQL = "CREATE TABLE IF NOT EXISTS Settings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            setting_key VARCHAR(50) NOT NULL UNIQUE,
            setting_value VARCHAR(100) NOT NULL,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        $conn->exec($createTableSQL);
        
        // Thêm cài đặt mặc định
        $stmt = $conn->prepare("INSERT IGNORE INTO Settings (setting_key, setting_value) VALUES ('paper_type', 'A4')");
        $stmt->execute();
    }
    
    // Trả về kết quả
    $response = [
        'success' => true,
        'paper_type' => $paperType
    ];
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    error_log('ERROR in get_settings.php: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => '❌ Lỗi: ' . $e->getMessage(),
        'paper_type' => 'A4' // Trả về giá trị mặc định khi có lỗi
    ], JSON_UNESCAPED_UNICODE);
}