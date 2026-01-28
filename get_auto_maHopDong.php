<?php
// get_auto_maHopDong.php - API để lấy mã hợp đồng tự động
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
    
    // ========== LẤY MÃ HỢP ĐỒNG TỰ ĐỘNG ==========
    // 1. Tìm mã hợp đồng gần nhất
    $stmt = $conn->prepare("SELECT maHopDong FROM HopDong WHERE maHopDong REGEXP '^HD[0-9]+$' ORDER BY CAST(SUBSTRING(maHopDong, 3) AS UNSIGNED) DESC LIMIT 1");
    $stmt->execute();
    $latestContract = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $autoMaHopDong = 'HD001'; // Mặc định - LUÔN CÓ 3 CHỮ SỐ
    
    if ($latestContract && isset($latestContract['maHopDong'])) {
        $latestCode = $latestContract['maHopDong'];
        
        // Trích xuất số từ mã (HD001 -> 001)
        if (preg_match('/HD(\d+)/', $latestCode, $matches)) {
            $latestNumber = intval($matches[1]);
            $newNumber = $latestNumber + 1;
            
            // Format về dạng HD001, HD010, HD100 - LUÔN CÓ 3 CHỮ SỐ
            // 1 -> 001, 9 -> 009, 10 -> 010, 99 -> 099, 100 -> 100
            $autoMaHopDong = 'HD' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            // Nếu mã không đúng định dạng, vẫn tăng số
            $autoMaHopDong = 'HD' . str_pad(1, 3, '0', STR_PAD_LEFT);
        }
    }
    
    // Kiểm tra xem mã này đã tồn tại chưa
    $stmt = $conn->prepare("SELECT idHopDong FROM HopDong WHERE maHopDong = ?");
    $stmt->execute([$autoMaHopDong]);
    $existing = $stmt->fetch();
    
    // Nếu đã tồn tại, tìm mã tiếp theo
    $attempts = 0;
    while ($existing && $attempts < 10) {
        if (preg_match('/HD(\d+)/', $autoMaHopDong, $matches)) {
            $latestNumber = intval($matches[1]);
            $newNumber = $latestNumber + 1;
            // LUÔN GIỮ 3 CHỮ SỐ
            $autoMaHopDong = 'HD' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $autoMaHopDong = 'HD' . str_pad(1, 3, '0', STR_PAD_LEFT);
        }
        
        $stmt->execute([$autoMaHopDong]);
        $existing = $stmt->fetch();
        $attempts++;
    }
    
    // Trả về kết quả
    $response = [
        'success' => true,
        'maHopDong' => $autoMaHopDong,
        'auto_generated' => true
    ];
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    error_log('ERROR in get_auto_maHopDong.php: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => '❌ Lỗi: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}