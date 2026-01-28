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
CREATE TABLE HopDong(
    idHopDong INT AUTO_INCREMENT PRIMARY KEY
);