<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hợp Đồng Cầm Cố Tài Sản - Bản quyền: Vnitech - 0944947411</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
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
        
        .id-display {
            background-color: #f8f9fa;
            border: 2px dashed #3498db;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: bold;
            color: #2c3e50;
            text-align: center;
            font-size: 1.2rem;
            margin-bottom: 20px;
            display: none;
        }
        
        .id-number {
            color: #e74c3c;
            font-size: 1.3rem;
            background-color: #fff;
            padding: 5px 15px;
            border-radius: 5px;
            border: 1px solid #3498db;
            margin-left: 5px;
        }
        
        .ma-hopdong-input {
            max-width: 300px;
            font-weight: bold;
            font-size: 1.1rem;
            text-align: center;
            letter-spacing: 1px;
        }
        
        .ma-hopdong-input:focus {
            border-color: #27ae60;
            box-shadow: 0 0 0 0.25rem rgba(39, 174, 96, 0.25);
        }
        
        .auto-ma-hopdong-display {
            background-color: #f8f9fa;
            border: 2px solid #27ae60;
            color: #2c3e50;
            font-weight: bold;
            font-size: 1.1rem;
            text-align: center;
            padding: 10px 15px;
            border-radius: 8px;
            margin-top: 5px;
            display: none;
        }
        
        .auto-ma-hopdong-hint {
            color: #27ae60;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        
        .auto-ma-hopdong-section {
            background-color: #e8f6f0;
            border: 2px dashed #27ae60;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
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
            
            .id-display {
                font-size: 1rem;
                padding: 10px 15px;
            }
            
            .id-number {
                font-size: 1.1rem;
                padding: 3px 10px;
            }
            
            .ma-hopdong-input {
                max-width: 100%;
                font-size: 1rem;
            }
            
            .auto-ma-hopdong-display {
                font-size: 1rem;
                padding: 8px 12px;
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
            
            <!-- Hiển thị ID hợp đồng đã tạo -->
            <div id="idDisplaySection" class="id-display">
                <i class="bi bi-hash me-2"></i>
                <span>Số hợp đồng đã tạo: </span>
                <span id="currentIdHopDong" class="id-number"></span>
                <span class="text-muted ms-2">/HĐCC</span>
            </div>
            
            <!-- Thông báo -->
            <div class="alert alert-info alert-custom mb-4">
                <i class="bi bi-info-circle me-2"></i>
                <strong>Lưu ý:</strong> Hệ thống sẽ tạo file DOCX và mở bằng Microsoft Word để in. 
                Đảm bảo Microsoft Word đã được cài đặt trên máy Mac.
            </div>

            <form id="contractForm">
                <!-- Thông tin mã hợp đồng TỰ ĐỘNG -->
                <div class="auto-ma-hopdong-section">
                    <h5 class="section-title">
                        <i class="bi bi-card-checklist me-2"></i>THÔNG TIN MÃ HỢP ĐỒNG (TỰ ĐỘNG)
                    </h5>
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">MÃ HỢP ĐỒNG</label>
                        <div class="col-sm-9">
                            <!-- Hiển thị mã hợp đồng tự động (readonly) -->
                            <div class="form-control auto-ma-hopdong-display" 
                                 id="autoMaHopDongDisplay" style="display: block;">
                                <span id="autoMaHopDongText">Đang tải mã hợp đồng...</span>
                            </div>
                            <small class="text-muted auto-ma-hopdong-hint" id="autoMaHopDongHint">
                                <i class="bi bi-check-circle me-1"></i>
                                Mã hợp đồng được tạo tự động từ hệ thống
                            </small>
                            <div id="maHopDongLoading" style="display: none;">
                                <div class="spinner-border spinner-border-sm text-primary me-2"></div>
                                <small class="text-primary">Đang tạo mã hợp đồng...</small>
                            </div>
                            
                            <!-- Input ẩn để lưu mã hợp đồng -->
                            <input type="hidden" name="maHopDong" id="maHopDong" value="">
                        </div>
                    </div>
                    
                    <div class="alert alert-info alert-custom mb-0">
                        <i class="bi bi-lightbulb me-2"></i>
                        <strong>Thông tin:</strong> Mã hợp đồng được tạo tự động dựa trên số thứ tự trong hệ thống (VD: HD001, HD002, HD003...)
                    </div>
                </div>

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
                                    <strong><i class="bi bi-hash me-2"></i>Mã hợp đồng:</strong> 
                                    <span id="fileMaHopDong" class="fw-bold text-danger"></span><br>
                                    <strong><i class="bi bi-hash me-2"></i>Số thứ tự:</strong> 
                                    <span id="fileIdHopDong" class="fw-bold text-info"></span><br>
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
   <script src="./js/main.js"></script>
</body>
</html>