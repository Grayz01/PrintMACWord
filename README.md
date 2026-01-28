# Hệ thống Tạo Hợp Đồng Cầm Cố Tài Sản

## Yêu cầu hệ thống
- PHP 7.4 hoặc cao hơn
- XAMPP trên macOS
- Microsoft Word cho macOS
- Phần mềm Composer

Mỏ localhost/debug.php để kiểm tra

Khi đáp ứng đủ các yêu cầu của hệ thống
Clone dự án
Vào terminal dự án
chạy lệnh

composer require phpoffice/phpword

cấp quyền cho thư mục
chmod 777 .
chmod 777 data
chmod 777 template

mysql
-- Tạo database nếu chưa tồn tại
CREATE DATABASE IF NOT EXISTS Contract;
USE Contract;

-- Tạo table HopDong
CREATE TABLE HopDong (
    idHopDong INT(11) NOT NULL AUTO_INCREMENT,
    maHopDong VARCHAR(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (idHopDong),
    UNIQUE KEY (maHopDong)
);

-- Thêm bảng Settings để lưu cài đặt mặc định
CREATE TABLE IF NOT EXISTS Settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(50) NOT NULL UNIQUE,
    setting_value VARCHAR(100) NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Thêm cài đặt mặc định cho loại giấy
INSERT INTO Settings (setting_key, setting_value) 
VALUES ('paper_type', 'A4') 
ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value);

-- Thêm trường paper_type vào bảng HopDong nếu chưa có
ALTER TABLE HopDong 
ADD COLUMN IF NOT EXISTS paper_type VARCHAR(10) DEFAULT 'A4' AFTER maHopDong;