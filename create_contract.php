<?php
// create_contract.php - Phiên bản sửa theo cấu trúc process.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

header('Content-Type: application/json; charset=utf-8');

try {
    error_log('=== CREATE_CONTRACT START ===');
    
    // Kiểm tra PHPWord
    $vendorPath = __DIR__ . '/vendor/autoload.php';
    if (!file_exists($vendorPath)) {
        throw new Exception('PHPWord chưa được cài đặt. Vui lòng chạy: composer require phpoffice/phpword');
    }
    
    require_once $vendorPath;
    error_log('PHPWord loaded');
    
    // Kiểm tra POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Chỉ chấp nhận POST request');
    }
    
    // Lấy dữ liệu
    $ho_ten = $_POST['ho_ten'] ?? '';
    $nam_sinh = $_POST['nam_sinh'] ?? '';
    $so_dt = $_POST['so_dt'] ?? '';
    $cccd_so = $_POST['cccd_so'] ?? '';
    $ngay_cap = $_POST['ngay_cap'] ?? '';
    $noi_cap = $_POST['noi_cap'] ?? '';
    $noi_dktt = $_POST['noi_dktt'] ?? '';
    $ten_tai_san = $_POST['ten_tai_san'] ?? '';
    $so_tien = $_POST['so_tien'] ?? '';
    $bang_chu = $_POST['bang_chu'] ?? '';
    $gio = $_POST['gio'] ?? '';
    $phut = $_POST['phut'] ?? '';
    $ngay_cam = $_POST['ngay_cam'] ?? '';
    
    error_log("Data - ho_ten: $ho_ten, so_tien: $so_tien");
    
    // Validate
    if (empty($ho_ten)) throw new Exception('Vui lòng nhập họ tên');
    if (empty($cccd_so)) throw new Exception('Vui lòng nhập số CCCD');
    if (empty($so_tien)) throw new Exception('Vui lòng nhập số tiền');
    
    // Kiểm tra template
    $templatePath = __DIR__ . '/templates/contract_template.docx';
    if (!file_exists($templatePath)) {
        throw new Exception('Không tìm thấy file template');
    }
    
    // Kiểm tra thư mục data
    $dataDir = __DIR__ . '/data';
    if (!is_dir($dataDir)) {
        mkdir($dataDir, 0777, true);
        error_log("Created data directory");
    }
    
    // Kiểm tra thư mục temp
    $tempDir = __DIR__ . '/temp';
    if (!is_dir($tempDir)) {
        mkdir($tempDir, 0777, true);
        error_log("Created temp directory");
    }
    
    // Đặt thư mục temp cho hệ thống (tùy chọn)
    putenv("TMPDIR=" . $tempDir);
    
    // Format ngày dạng dd/MM/YYYY
    function formatDate($date) {
        if (empty($date)) return '';
        $timestamp = strtotime($date);
        return $timestamp ? date('d/m/Y', $timestamp) : $date;
    }
    
    // Format ngày full thành dd/MM/YYYY
    function formatDateFull($date) {
        if (empty($date)) return '';
        $timestamp = strtotime($date);
        if (!$timestamp) return $date;
        return date('d/m/Y', $timestamp);
    }
    
    // Tạo TemplateProcessor
    error_log('Creating TemplateProcessor...');
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);
    error_log('TemplateProcessor created');
    
    // Format số tiền
    $so_tien_num = intval(str_replace(['.', ','], '', $so_tien));
    
    // Điền dữ liệu
    $templateProcessor->setValue('ho_ten', $ho_ten);
    $templateProcessor->setValue('nam_sinh', $nam_sinh);
    $templateProcessor->setValue('so_dt', $so_dt);
    $templateProcessor->setValue('cccd_so', $cccd_so);
    $templateProcessor->setValue('ngay_cap', formatDate($ngay_cap));
    $templateProcessor->setValue('noi_cap', $noi_cap);
    $templateProcessor->setValue('noi_dktt', $noi_dktt);
    $templateProcessor->setValue('ten_tai_san', $ten_tai_san);
    $templateProcessor->setValue('so_tien', number_format($so_tien_num, 0, ',', '.'));
    $templateProcessor->setValue('bang_chu', $bang_chu);
    $templateProcessor->setValue('gio', str_pad($gio, 2, '0', STR_PAD_LEFT));
    $templateProcessor->setValue('phut', str_pad($phut, 2, '0', STR_PAD_LEFT));
    $templateProcessor->setValue('ngay_cam', formatDate($ngay_cam));
    $templateProcessor->setValue('ngay_cam_full', formatDateFull($ngay_cam));
    
    // Tạo tên file
    $timestamp = date('YmdHis');
    $cleanName = preg_replace('/[^a-zA-Z0-9_\x{00C0}-\x{1EF9}\s]/u', '', $ho_ten);
    $cleanName = str_replace(' ', '_', $cleanName);
    $filename = 'HopDong_' . $cleanName . '_' . $timestamp . '.docx';
    $filepath = $dataDir . '/' . $filename;
    
    // Lưu file
    error_log("Saving to: $filepath");
    $templateProcessor->saveAs($filepath);
    
    if (!file_exists($filepath)) {
        throw new Exception('Không thể tạo file hợp đồng');
    }
    
    $fileSize = filesize($filepath);
    error_log("File created: $fileSize bytes");
    
    // MỞ FILE BẰNG MICROSOFT WORD (macOS)
    error_log("Opening file with Microsoft Word...");
    
    $wordOpened = false;
    $openMessage = '';
    
    // Phương pháp 1: Sử dụng lệnh open
    $command = 'open -a "Microsoft Word" "' . $filepath . '" 2>&1';
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
        $altCommand = 'open "' . $filepath . '" 2>&1';
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
        'success' => true,
        'message' => '✅ Tạo hợp đồng thành công!',
        'filename' => $filename,
        'file_url' => 'data/' . $filename,
        'file_path' => $filepath,
        'file_size' => formatFileSize($fileSize),
        'word_opened' => $wordOpened,
        'open_message' => $openMessage
    ];
    
    error_log("Response sent: " . json_encode($response, JSON_UNESCAPED_UNICODE));
    error_log('=== CREATE_CONTRACT END ===');
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    error_log('ERROR in create_contract.php: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => '❌ Lỗi: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}

function formatFileSize($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } else {
        return $bytes . ' bytes';
    }
}