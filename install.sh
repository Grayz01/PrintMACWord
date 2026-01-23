#!/bin/bash

# Script cài đặt tự động cho hệ thống hợp đồng

echo "========================================="
echo "Cài đặt Hệ thống Hợp đồng Cầm cố Tài sản"
echo "========================================="
echo ""

# Kiểm tra XAMPP
if [ ! -d "/Applications/XAMPP" ]; then
    echo "❌ XAMPP không được tìm thấy. Vui lòng cài đặt XAMPP trước."
    exit 1
fi

echo "✅ XAMPP đã được cài đặt"

# Kiểm tra Composer
if ! command -v composer &> /dev/null; then
    echo "❌ Composer không được tìm thấy. Vui lòng cài đặt Composer."
    echo "Hướng dẫn: https://getcomposer.org/download/"
    exit 1
fi

echo "✅ Composer đã được cài đặt"

# Tạo thư mục dự án
PROJECT_DIR="/Applications/XAMPP/htdocs/contract_system"
echo "Tạo thư mục dự án tại: $PROJECT_DIR"

mkdir -p "$PROJECT_DIR"
cd "$PROJECT_DIR"

# Sao chép các file
echo "Đang sao chép các file..."
# (Thêm các lệnh sao chép file ở đây)

# Cài đặt dependencies
echo "Đang cài đặt dependencies với Composer..."
composer install --no-dev

# Cấu hình quyền thư mục
echo "Cấu hình quyền thư mục..."
chmod 755 data
chmod 755 templates

# Tạo file log
touch php_errors.log
chmod 666 php_errors.log

# Kiểm tra template
if [ ! -f "templates/contract_template.docx" ]; then
    echo "⚠️  Chưa có template. Vui lòng đặt file contract_template.docx vào thư mục templates/"
fi

echo ""
echo "========================================="
echo "✅ Cài đặt hoàn tất!"
echo ""
echo "Truy cập ứng dụng tại:"
echo "http://localhost/contract_system/"
echo ""
echo "Đảm bảo Microsoft Word đã được cài đặt trên macOS."
echo "========================================="