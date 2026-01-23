<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hợp Đồng Cầm Cố Tài Sản - Bản quyền: Vnitech - 0944947411</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        /* CSS styles giữ nguyên */
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 20px;
            padding-bottom: 50px;
        }
        
        .form-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin: 30px auto;
            max-width: 1200px;
        }
        
        .form-title {
            color: #2c3e50;
            font-weight: 700;
            padding-bottom: 15px;
            border-bottom: 3px solid #3498db;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .section-title {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            padding: 12px;
            border-radius: 8px;
            margin: 25px 0;
            font-size: 18px;
        }
        
        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 18px;
            border-radius: 10px;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #2980b9, #1f6395);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #27ae60, #219653);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 18px;
            border-radius: 10px;
            transition: all 0.3s;
        }
        
        .btn-success:hover {
            background: linear-gradient(135deg, #219653, #1e8749);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
        }
        
        label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }
        
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        
        .loading-content {
            background: white;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            max-width: 400px;
            width: 90%;
        }
        
        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .alert-custom {
            border-radius: 10px;
            border-left: 5px solid;
            font-weight: 500;
        }
        
        .alert-info {
            border-left-color: #3498db;
            background-color: #e8f4fc;
        }
        
        .alert-success {
            border-left-color: #27ae60;
            background-color: #e8f6f0;
        }
        
        .alert-danger {
            border-left-color: #e74c3c;
            background-color: #fdedec;
        }
        
        .success-box {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border: 2px solid #28a745;
            border-radius: 10px;
            padding: 25px;
            margin-top: 30px;
            animation: fadeIn 0.5s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .file-info {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
            border-left: 4px solid #3498db;
            margin-bottom: 20px;
        }
        
        .toast-container {
            animation: slideInRight 0.3s ease-out;
        }
        
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .is-invalid {
            border-color: #dc3545 !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        .is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }
        
        .btn-outline-primary, .btn-outline-success {
            padding: 10px 20px;
            font-weight: 500;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            color: #6c757d;
            font-size: 14px;
            border-top: 1px solid #dee2e6;
        }
        
        .copyright {
            color: #3498db;
            font-weight: 600;
        }
        
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
                margin: 15px;
            }
            
            .section-title {
                font-size: 16px;
                padding: 10px;
            }
            
            .btn-primary, .btn-success {
                padding: 10px 20px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="loading-spinner"></div>
            <div class="loading-text" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">ĐANG XỬ LÝ...</div>
            <div class="loading-subtext" style="color: #666;">Đang tạo hợp đồng, vui lòng chờ</div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="form-container">
            <h2 class="form-title">
                <i class="bi bi-file-earmark-text me-2"></i>HỢP ĐỒNG CẦM CỐ TÀI SẢN
            </h2>
            
            <!-- Thông báo -->
            <div class="alert alert-info alert-custom mb-4">
                <i class="bi bi-info-circle me-2"></i>
                <strong>Lưu ý:</strong> Hệ thống sẽ tạo file DOCX và mở bằng Microsoft Word để in. 
                Đảm bảo Microsoft Word đã được cài đặt trên máy Mac.
            </div>

            <form id="contractForm">
                <!-- Thông tin cá nhân -->
                <h5 class="section-title">
                    <i class="bi bi-person-badge me-2"></i>THÔNG TIN CÁ NHÂN
                </h5>
                
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">HỌ VÀ TÊN</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ho_ten" id="ho_ten" required placeholder="Nhập họ và tên đầy đủ">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">NĂM SINH</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="nam_sinh" id="nam_sinh" required placeholder="VD: 1990">
                    </div>
                    <label class="col-sm-2 col-form-label">SỐ ĐIỆN THOẠI</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="so_dt" id="so_dt" required placeholder="VD: 0901234567">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">SỐ CCCD</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="cccd_so" id="cccd_so" required placeholder="12 số">
                    </div>
                    <label class="col-sm-2 col-form-label">NGÀY CẤP</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="ngay_cap" id="ngay_cap" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">NƠI CẤP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="noi_cap" id="noi_cap" required placeholder="VD: Công an thành phố Cần Thơ">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">NƠI ĐĂNG KÝ THƯỜNG TRÚ</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="noi_dktt" id="noi_dktt" required placeholder="Nhập địa chỉ đăng ký thường trú">
                    </div>
                </div>

                <!-- Thông tin tài sản -->
                <h5 class="section-title">
                    <i class="bi bi-box-seam me-2"></i>THÔNG TIN TÀI SẢN CẦM CỐ
                </h5>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">TÊN TÀI SẢN CẦM</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="ten_tai_san" id="ten_tai_san" rows="3" required placeholder="Nhập mô tả chi tiết tài sản cầm cố (VD: Xe máy Honda Wave RSX, biển số 65-B1 12345, màu đen, đời 2022)"></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">SỐ TIỀN CẦM</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="so_tien" id="so_tien" placeholder="VD: 5,000,000" required>
                        <small class="text-muted">Nhập số tiền (chỉ số)</small>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">BẰNG CHỮ:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="bang_chu" id="bang_chu" readonly style="background-color: #f8f9fa; font-weight: bold;">
                        <small class="text-muted">Số tiền bằng chữ tự động chuyển đổi</small>
                    </div>
                </div>

                <!-- Thời gian cầm cố -->
                <h5 class="section-title">
                    <i class="bi bi-calendar-check me-2"></i>THỜI GIAN CẦM CỐ
                </h5>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">THỜI ĐIỂM CẦM:</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="gio" id="gio" placeholder="GIỜ" min="0" max="23" required>
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="phut" id="phut" placeholder="PHÚT" min="0" max="59" required>
                    </div>
                    <label class="col-sm-2 col-form-label">NGÀY CẦM</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="ngay_cam" id="ngay_cam" required>
                    </div>
                </div>

                <!-- Nút điều khiển -->
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-primary btn-lg" id="createBtn">
                        <i class="bi bi-file-earmark-plus me-2"></i>TẠO HỢP ĐỒNG
                    </button>
                </div>

                <!-- Kết quả -->
                <div id="resultSection" class="mt-4" style="display: none;">
                    <div class="success-box">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-success me-3" style="font-size: 2rem;"></i>
                            <div style="width: 100%;">
                                <h5 id="successMessage" class="mb-1">✅ Tạo hợp đồng thành công!</h5>
                                <p id="successDetail" class="mb-2">File DOCX đã được tạo và mở bằng Microsoft Word.</p>
                                <div class="file-info">
                                    <strong><i class="bi bi-file-word me-2"></i>Tên file:</strong> 
                                    <span id="fileName" class="fw-bold text-primary"></span><br>
                                    <strong><i class="bi bi-folder me-2"></i>Vị trí lưu:</strong> 
                                    <span id="filePath" class="text-muted"></span><br>
                                    <strong><i class="bi bi-hdd me-2"></i>Kích thước:</strong> 
                                    <span id="fileSize" class="text-muted"></span>
                                </div>
                                <div class="mt-3">
                                    <div class="alert alert-info alert-custom mb-3">
                                        <i class="bi bi-info-circle me-2"></i>
                                        <strong>Hướng dẫn:</strong> Sử dụng Microsoft Word để in hợp đồng (File → Print)
                                    </div>
                                    <button type="button" class="btn btn-outline-primary me-2" id="openWordBtn">
                                        <i class="bi bi-microsoft me-2"></i>Mở lại bằng Word
                                    </button>
                                    <button type="button" class="btn btn-outline-success me-2" id="createAnotherBtn">
                                        <i class="bi bi-plus-circle me-2"></i>Tạo hợp đồng khác
                                    </button>
                                    <a href="#" class="btn btn-outline-secondary" id="downloadBtn" style="display: none;">
                                        <i class="bi bi-download me-2"></i>Tải về
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
            <!-- Footer -->
            <div class="footer">
                <div class="copyright">
                    <i class="bi bi-c-circle me-1"></i>Bản quyền: Vnitech - 0944947411
                </div>
                <div class="mt-2">
                    Hệ thống tạo hợp đồng cầm cố tự động
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Hệ thống hợp đồng cầm cố đã sẵn sàng!');
            
            // Biến lưu trữ thông tin file hiện tại
            let currentFilePath = null;
            let currentFileName = null;
            let currentFileUrl = null;
            
            // ========== HÀM HIỂN THỊ LOADING ==========
            function showLoading() {
                const overlay = document.getElementById('loadingOverlay');
                if (overlay) {
                    overlay.style.display = 'flex';
                }
                
                const createBtn = document.getElementById('createBtn');
                if (createBtn) {
                    createBtn.disabled = true;
                    createBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> ĐANG XỬ LÝ...';
                }
            }
            
            // ========== HÀM ẨN LOADING ==========
            function hideLoading() {
                const overlay = document.getElementById('loadingOverlay');
                if (overlay) {
                    overlay.style.display = 'none';
                }
                
                const createBtn = document.getElementById('createBtn');
                if (createBtn) {
                    createBtn.disabled = false;
                    createBtn.innerHTML = '<i class="bi bi-file-earmark-plus me-2"></i>TẠO HỢP ĐỒNG';
                }
            }
            
            // ========== HÀM HIỂN THỊ THÔNG BÁO TOAST ==========
            function showToast(message, type = 'success') {
                // Xóa toast cũ nếu có
                const oldToasts = document.querySelectorAll('.toast-container');
                oldToasts.forEach(toast => toast.remove());
                
                const toast = document.createElement('div');
                toast.className = 'toast-container position-fixed top-0 end-0 p-3';
                toast.style.zIndex = '9999';
                
                const bgColor = type === 'success' ? 'bg-success' : 
                               type === 'warning' ? 'bg-warning' : 'bg-danger';
                const icon = type === 'success' ? 'bi-check-circle-fill' : 
                            type === 'warning' ? 'bi-exclamation-triangle-fill' : 'bi-exclamation-triangle-fill';
                const title = type === 'success' ? 'Thành công' : 
                             type === 'warning' ? 'Cảnh báo' : 'Lỗi';
                
                toast.innerHTML = `
                    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header ${bgColor} text-white">
                            <i class="bi ${icon} me-2"></i>
                            <strong class="me-auto">${title}</strong>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            ${message}
                        </div>
                    </div>
                `;
                
                document.body.appendChild(toast);
                
                // Thêm sự kiện đóng toast
                const closeBtn = toast.querySelector('.btn-close');
                if (closeBtn) {
                    closeBtn.addEventListener('click', function() {
                        toast.remove();
                    });
                }
                
                // Tự động xóa toast sau 5 giây
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 5000);
            }
            
            // ========== HÀM HIỂN THỊ KẾT QUẢ ==========
            function showResult(data) {
                try {
                    const resultSection = document.getElementById('resultSection');
                    const successMessage = document.getElementById('successMessage');
                    const successDetail = document.getElementById('successDetail');
                    const fileName = document.getElementById('fileName');
                    const filePath = document.getElementById('filePath');
                    const fileSize = document.getElementById('fileSize');
                    const downloadBtn = document.getElementById('downloadBtn');
                    
                    // Kiểm tra các phần tử tồn tại
                    if (!resultSection || !successMessage || !successDetail || !fileName || !filePath || !fileSize) {
                        console.error('Không tìm thấy các phần tử DOM cần thiết');
                        showToast(data.message || '✅ Tạo hợp đồng thành công!', 'success');
                        return;
                    }
                    
                    // Cập nhật thông báo
                    successMessage.textContent = data.message || '✅ Tạo hợp đồng thành công!';
                    
                    if (data.word_opened) {
                        successDetail.textContent = data.open_message || 'File DOCX đã được tạo và mở bằng Microsoft Word.';
                    } else {
                        successDetail.textContent = data.open_message || 'File DOCX đã được tạo nhưng không thể mở tự động. Vui lòng mở thủ công từ thư mục data.';
                    }
                    
                    // Cập nhật thông tin file
                    fileName.textContent = data.filename || 'Không xác định';
                    filePath.textContent = data.file_path || 'Không xác định';
                    fileSize.textContent = data.file_size || 'Không xác định';
                    
                    // Lưu thông tin file
                    currentFilePath = data.file_path;
                    currentFileName = data.filename;
                    currentFileUrl = data.file_url;
                    
                    // Hiển thị nút download nếu có URL
                    if (downloadBtn && data.file_url) {
                        downloadBtn.href = data.file_url;
                        downloadBtn.download = data.filename || 'hop_dong.docx';
                        downloadBtn.style.display = 'inline-block';
                    }
                    
                    // Hiển thị section kết quả
                    resultSection.style.display = 'block';
                    setTimeout(() => {
                        resultSection.scrollIntoView({ 
                            behavior: 'smooth', 
                            block: 'center' 
                        });
                    }, 300);
                    
                } catch (error) {
                    console.error('Lỗi trong hàm showResult:', error);
                    showToast('✅ Tạo hợp đồng thành công! File đã được mở bằng Microsoft Word.', 'success');
                }
            }
            
            // ========== HÀM ẨN KẾT QUẢ ==========
            function hideResult() {
                const resultSection = document.getElementById('resultSection');
                if (resultSection) {
                    resultSection.style.display = 'none';
                }
                
                // Reset biến
                currentFilePath = null;
                currentFileName = null;
                currentFileUrl = null;
                
                // Ẩn nút download
                const downloadBtn = document.getElementById('downloadBtn');
                if (downloadBtn) {
                    downloadBtn.style.display = 'none';
                }
            }
            
            // ========== HÀM ĐẶT LẠI FORM ==========
            function resetForm() {
                const contractForm = document.getElementById('contractForm');
                if (contractForm) {
                    contractForm.reset();
                }
                
                // Đặt ngày hiện tại
                const today = new Date().toISOString().split('T')[0];
                const dateFields = ['ngay_cap', 'ngay_cam'];
                dateFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (field) {
                        field.value = today;
                    }
                });
                
                // Đặt giờ phút hiện tại
                const now = new Date();
                const gioInput = document.getElementById('gio');
                const phutInput = document.getElementById('phut');
                
                if (gioInput) gioInput.value = now.getHours().toString().padStart(2, '0');
                if (phutInput) phutInput.value = now.getMinutes().toString().padStart(2, '0');
                
                // Reset số tiền thành chữ
                const bangChuInput = document.getElementById('bang_chu');
                if (bangChuInput) {
                    bangChuInput.value = '';
                }
                
                // Focus vào trường đầu tiên
                setTimeout(() => {
                    const hoTenInput = document.getElementById('ho_ten');
                    if (hoTenInput) {
                        hoTenInput.focus();
                    }
                }, 100);
            }
            
            // ========== HÀM CHUYỂN SỐ THÀNH CHỮ ==========
            function numberToWords(num) {
    if (num === 0) return 'không đồng';
    
    const ones = ['', 'một', 'hai', 'ba', 'bốn', 'năm', 'sáu', 'bảy', 'tám', 'chín'];
    const tens = ['', '', 'hai mươi', 'ba mươi', 'bốn mươi', 'năm mươi', 'sáu mươi', 'bảy mươi', 'tám mươi', 'chín mươi'];
    
    function convertLessThanOneThousand(n, isFirst = true) {
        if (n === 0) return '';
        
        let result = '';
        
        // Hàng trăm
        if (n >= 100) {
            const hundreds = Math.floor(n / 100);
            result += ones[hundreds] + ' trăm ';
            n %= 100;
            
            // Thêm "lẻ" nếu hàng chục = 0 và hàng đơn vị > 0
            if (n > 0 && n < 10) {
                result += 'lẻ ';
            }
        }
        
        // Hàng chục và đơn vị
        if (n >= 10) {
            const tensDigit = Math.floor(n / 10);
            const onesDigit = n % 10;
            
            if (tensDigit === 1) {
                // Số từ 10-19
                result += 'mười ';
                if (onesDigit > 0) {
                    if (onesDigit === 5) {
                        result += 'lăm ';
                    } else {
                        result += ones[onesDigit] + ' ';
                    }
                }
            } else {
                // Số từ 20-99
                result += tens[tensDigit] + ' ';
                if (onesDigit > 0) {
                    if (onesDigit === 5) {
                        result += 'lăm ';
                    } else if (onesDigit === 1) {
                        result += 'mốt ';
                    } else {
                        result += ones[onesDigit] + ' ';
                    }
                }
            }
        } else if (n > 0) {
            // Số từ 1-9 (chỉ hàng đơn vị)
            result += ones[n] + ' ';
        }
        
        return result.trim();
    }
    
    let result = '';
    
    // Tách số thành các phần: tỷ, triệu, nghìn, trăm
    const billion = Math.floor(num / 1000000000);
    const million = Math.floor((num % 1000000000) / 1000000);
    const thousand = Math.floor((num % 1000000) / 1000);
    const remainder = num % 1000;
    
    // Hàng tỷ
    if (billion > 0) {
        result += convertLessThanOneThousand(billion, true) + ' tỷ ';
    }
    
    // Hàng triệu
    if (million > 0) {
        result += convertLessThanOneThousand(million, false) + ' triệu ';
    } else if (billion > 0 && (thousand > 0 || remainder > 0)) {
        // Nếu có tỷ nhưng không có triệu, cần thêm xử lý
    }
    
    // Hàng nghìn
    if (thousand > 0) {
        result += convertLessThanOneThousand(thousand, false) + ' nghìn ';
    } else if ((billion > 0 || million > 0) && remainder > 0 && remainder < 100) {
        // Thêm "không trăm" nếu cần
    }
    
    // Hàng trăm, chục, đơn vị
    if (remainder > 0) {
        result += convertLessThanOneThousand(remainder, false);
    }
    
    // Chuẩn hóa kết quả
    result = result.trim().replace(/\s+/g, ' ');
    
    return result + ' đồng';
}
            
            // ========== HÀM VALIDATE FORM ==========
            function validateForm() {
                const requiredFields = [
                    'ho_ten', 'nam_sinh', 'so_dt', 'cccd_so', 
                    'ngay_cap', 'noi_cap', 'noi_dktt', 
                    'ten_tai_san', 'so_tien', 'gio', 'phut', 'ngay_cam'
                ];
                
                let isValid = true;
                let firstInvalidField = null;
                
                // Xóa tất cả class invalid cũ
                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (field) {
                        field.classList.remove('is-invalid');
                    }
                });
                
                // Kiểm tra từng trường bắt buộc
                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (field && !field.value.trim()) {
                        isValid = false;
                        if (!firstInvalidField) {
                            firstInvalidField = field;
                        }
                        field.classList.add('is-invalid');
                    }
                });
                
                // Kiểm tra giờ, phút hợp lệ
                const gioInput = document.getElementById('gio');
                const phutInput = document.getElementById('phut');
                
                if (gioInput && gioInput.value) {
                    const gioNum = parseInt(gioInput.value);
                    if (gioNum < 0 || gioNum > 23 || isNaN(gioNum)) {
                        gioInput.classList.add('is-invalid');
                        isValid = false;
                        if (!firstInvalidField) firstInvalidField = gioInput;
                    }
                }
                
                if (phutInput && phutInput.value) {
                    const phutNum = parseInt(phutInput.value);
                    if (phutNum < 0 || phutNum > 59 || isNaN(phutNum)) {
                        phutInput.classList.add('is-invalid');
                        isValid = false;
                        if (!firstInvalidField) firstInvalidField = phutInput;
                    }
                }
                
                // Kiểm tra số tiền hợp lệ
                const soTienInput = document.getElementById('so_tien');
                if (soTienInput && soTienInput.value) {
                    const rawValue = soTienInput.value.replace(/\./g, '').replace(',', '');
                    const soTienNum = parseInt(rawValue);
                    if (isNaN(soTienNum) || soTienNum <= 0) {
                        soTienInput.classList.add('is-invalid');
                        isValid = false;
                        if (!firstInvalidField) firstInvalidField = soTienInput;
                    }
                }
                
                return { isValid, firstInvalidField };
            }
            
            // ========== XỬ LÝ SỐ TIỀN ==========
            const soTienInput = document.getElementById('so_tien');
            if (soTienInput) {
                soTienInput.addEventListener('input', function() {
                    // Lấy giá trị và loại bỏ các ký tự không phải số
                    let value = this.value.replace(/[^0-9]/g, '');
                    
                    // Chuyển đổi sang số
                    const soTien = parseInt(value) || 0;
                    
                    // Format với dấu chấm ngăn cách hàng nghìn
                    if (soTien > 0) {
                        this.value = soTien.toLocaleString('vi-VN');
                    } else {
                        this.value = '';
                    }
                    
                    // Chuyển số thành chữ
                    const bangChu = numberToWords(soTien);
                    const bangChuInput = document.getElementById('bang_chu');
                    if (bangChuInput) {
                        bangChuInput.value = bangChu;
                    }
                });
            }
            
            // ========== ĐẶT GIÁ TRỊ MẶC ĐỊNH ==========
            function setDefaultValues() {
                // Đặt ngày hiện tại
                const today = new Date().toISOString().split('T')[0];
                const dateFields = ['ngay_cap', 'ngay_cam'];
                
                dateFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (field) {
                        field.value = today;
                    }
                });
                
                // Đặt giờ phút hiện tại
                const now = new Date();
                const gioInput = document.getElementById('gio');
                const phutInput = document.getElementById('phut');
                
                if (gioInput) {
                    gioInput.value = now.getHours().toString().padStart(2, '0');
                }
                
                if (phutInput) {
                    phutInput.value = now.getMinutes().toString().padStart(2, '0');
                }
                
                // Focus vào trường đầu tiên
                setTimeout(() => {
                    const hoTenInput = document.getElementById('ho_ten');
                    if (hoTenInput) {
                        hoTenInput.focus();
                    }
                }, 100);
            }
            
            // ========== XỬ LÝ NÚT TẠO HỢP ĐỒNG ==========
            const createBtn = document.getElementById('createBtn');
            if (createBtn) {
                createBtn.addEventListener('click', function() {
                    // Validate form
                    const validation = validateForm();
                    
                    if (!validation.isValid) {
                        showToast('Vui lòng điền đầy đủ và đúng các thông tin bắt buộc!', 'warning');
                        
                        // Focus vào trường lỗi đầu tiên
                        if (validation.firstInvalidField) {
                            validation.firstInvalidField.focus();
                        }
                        
                        return;
                    }
                    
                    // Chuẩn bị dữ liệu
                    const formData = new FormData();
                    const formFields = [
                        'ho_ten', 'nam_sinh', 'so_dt', 'cccd_so', 'ngay_cap', 
                        'noi_cap', 'noi_dktt', 'ten_tai_san', 'so_tien', 
                        'bang_chu', 'gio', 'phut', 'ngay_cam'
                    ];
                    
                    formFields.forEach(field => {
                        const element = document.getElementById(field);
                        if (element) {
                            // Format số tiền: bỏ dấu phẩy trước khi gửi
                            if (field === 'so_tien') {
                                const rawValue = element.value.replace(/\./g, '').replace(',', '');
                                formData.append(field, rawValue);
                            } else {
                                formData.append(field, element.value);
                            }
                        }
                    });
                    
                    // Gửi request đến create_contract.php
                    showLoading();
                    
                    fetch('./create_contract.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.text().then(text => {
                                throw new Error(`HTTP ${response.status}: ${text}`);
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        hideLoading();
                        
                        console.log('Response data:', data);
                        
                        if (data.success) {
                            showResult(data);
                            showToast(data.message, 'success');
                        } else {
                            showToast(data.message || 'Có lỗi xảy ra khi tạo hợp đồng', 'error');
                            console.error('Server error:', data);
                        }
                    })
                    .catch(error => {
                        hideLoading();
                        console.error('Fetch error:', error);
                        showToast('Lỗi kết nối: ' + error.message, 'error');
                    });
                });
            }
            
            // ========== XỬ LÝ NÚT MỞ LẠI BẰNG WORD ==========
            const openWordBtn = document.getElementById('openWordBtn');
            if (openWordBtn) {
                openWordBtn.addEventListener('click', function() {
                    if (currentFilePath) {
                        // Hiển thị loading
                        showLoading();
                        
                        fetch('./open_word.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                file_path: currentFilePath
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.text().then(text => {
                                    throw new Error(`HTTP ${response.status}: ${text}`);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            hideLoading();
                            
                            if (data.success) {
                                showToast('Đang mở file bằng Microsoft Word...', 'success');
                            } else {
                                showToast(data.message || 'Không thể mở file', 'warning');
                            }
                        })
                        .catch(error => {
                            hideLoading();
                            console.error('Error opening Word:', error);
                            showToast('Lỗi: ' + error.message, 'error');
                        });
                    } else {
                        showToast('Không tìm thấy file để mở', 'warning');
                    }
                });
            }
            
            // ========== XỬ LÝ NÚT TẠO HỢP ĐỒNG KHÁC ==========
            const createAnotherBtn = document.getElementById('createAnotherBtn');
            if (createAnotherBtn) {
                createAnotherBtn.addEventListener('click', function() {
                    hideResult();
                    resetForm();
                    showToast('Đã sẵn sàng tạo hợp đồng mới', 'info');
                });
            }
            
            // ========== KHỞI TẠO ==========
            // Đặt giá trị mặc định khi trang load
            setDefaultValues();
            
            // Thêm sự kiện cho các trường giờ phút để validate realtime
            const gioInput = document.getElementById('gio');
            const phutInput = document.getElementById('phut');
            
            if (gioInput) {
                gioInput.addEventListener('blur', function() {
                    const value = parseInt(this.value);
                    if (value < 0 || value > 23 || isNaN(value)) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });
            }
            
            if (phutInput) {
                phutInput.addEventListener('blur', function() {
                    const value = parseInt(this.value);
                    if (value < 0 || value > 59 || isNaN(value)) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });
            }
        });
    </script>
</body>
</html>