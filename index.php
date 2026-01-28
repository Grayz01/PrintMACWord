<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hợp Đồng Cầm Cố Tài Sản - Bản quyền: Vnitech - 0944947411</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/styles.css">
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
            
            <!-- Thông tin hệ thống -->
            <div class="system-info">
                <div class="system-status">
                    <div class="status-dot status-online" id="systemStatus"></div>
                    <span>Hệ thống: <span id="statusText">Đang kiểm tra...</span></span>
                </div>
                <div class="info-item" id="databaseInfo">
                    <i class="bi bi-database"></i>Database: <span id="dbStatus">Đang kiểm tra...</span>
                </div>
                <div class="info-item" id="templateInfo">
                    <i class="bi bi-file-word"></i>Template: <span id="templateStatus">Đang kiểm tra...</span>
                </div>
            </div>
            
            <!-- Phần chọn loại giấy -->
            <div class="paper-type-section">
                <div>
                    <i class="bi bi-printer me-2"></i>
                    <span>LOẠI GIẤY IN</span>
                    <span id="currentPaperTypeBadge" class="paper-badge paper-a4">A4</span>
                    <div class="default-setting" id="defaultSettingText">
                        <i class="bi bi-gear me-1"></i>Mặc định: <span id="defaultPaperType">A4</span>
                        <span id="templateLoaded" class="ms-2" style="display: none;">
                            <i class="bi bi-check-circle-fill text-success"></i> Đã tải template
                        </span>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <select class="paper-type-select" id="paperTypeSelect">
                        <option value="A4">Khổ A4</option>
                        <option value="A5">Khổ A5</option>
                    </select>
                    <button type="button" class="save-setting-btn" id="saveDefaultBtn">
                        <i class="bi bi-save me-1"></i>Lưu mặc định
                    </button>
                </div>
            </div>
            
            <!-- Hiển thị ID hợp đồng đã tạo -->
            <div id="idDisplaySection" class="id-display">
                <i class="bi bi-hash me-2"></i>
                <span>Số hợp đồng đã tạo: </span>
                <span id="currentIdHopDong" class="id-number"></span>
                <span class="text-muted ms-2">/HĐCC</span>
            </div>
            
            <!-- Hiển thị mã hợp đồng sắp tạo -->
            <div class="ma-hopdong-badge">
                <span class="ma-hopdong-label">MÃ HỢP ĐỒNG:</span>
                <span id="autoMaHopDongText" class="ma-hopdong-value">Đang tải...</span>
            </div>
            
            <!-- Input ẩn để lưu mã hợp đồng và loại giấy -->
            <input type="hidden" name="maHopDong" id="maHopDong" value="">
            <input type="hidden" name="paper_type" id="paper_type" value="A4">

            <form id="contractForm">
                <!-- Thông tin cá nhân -->
                <h5 class="section-title">
                    <i class="bi bi-person-badge me-2"></i>THÔNG TIN CÁ NHÂN
                </h5>
                
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">HỌ VÀ TÊN</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ho_ten" id="ho_ten" required placeholder="Nguyễn Văn A">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">NĂM SINH</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="nam_sinh" id="nam_sinh" required placeholder="1990">
                    </div>
                    <label class="col-sm-2 col-form-label">SỐ ĐIỆN THOẠI</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="so_dt" id="so_dt" required placeholder="0912345678">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">SỐ CCCD</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="cccd_so" id="cccd_so" required placeholder="001234567890">
                    </div>
                    <label class="col-sm-2 col-form-label">NGÀY CẤP</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="ngay_cap" id="ngay_cap" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">NƠI CẤP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="noi_cap" id="noi_cap" required placeholder="Công an thành phố Hà Nội">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">NƠI ĐĂNG KÝ THƯỜNG TRÚ</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="noi_dktt" id="noi_dktt" required placeholder="Số 1, đường ABC, quận XYZ, Hà Nội">
                    </div>
                </div>

                <!-- Thông tin tài sản -->
                <h5 class="section-title">
                    <i class="bi bi-box-seam me-2"></i>THÔNG TIN TÀI SẢN CẦM CỐ
                </h5>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">TÊN TÀI SẢN CẦM</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="ten_tai_san" id="ten_tai_san" rows="3" required placeholder="Ví dụ: 01 xe máy Honda Vision màu đen, biển số 29A1-12345, đăng ký năm 2020"></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">SỐ TIỀN CẦM</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="so_tien" id="so_tien" required placeholder="5.000.000">
                        <div class="form-text">Nhập số tiền, hệ thống sẽ tự động định dạng</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">BẰNG CHỮ</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="bang_chu" id="bang_chu" readonly style="background-color: #f8f9fa; font-weight: bold;">
                        <div class="form-text">Số tiền bằng chữ sẽ tự động chuyển đổi</div>
                    </div>
                </div>

                <!-- Thời gian cầm cố -->
                <h5 class="section-title">
                    <i class="bi bi-calendar-check me-2"></i>THỜI GIAN CẦM CỐ
                </h5>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">THỜI ĐIỂM CẦM</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="gio" id="gio" min="0" max="23" required placeholder="14">
                        <div class="form-text">Giờ (0-23)</div>
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="phut" id="phut" min="0" max="59" required placeholder="30">
                        <div class="form-text">Phút (0-59)</div>
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
                                    <strong><i class="bi bi-paperclip me-2"></i>Loại giấy:</strong> 
                                    <span id="filePaperType" class="fw-bold"></span><br>
                                    <strong><i class="bi bi-folder me-2"></i>Vị trí lưu:</strong> 
                                    <span id="filePath" class="text-muted"></span><br>
                                    <strong><i class="bi bi-hdd me-2"></i>Kích thước:</strong> 
                                    <span id="fileSize" class="text-muted"></span>
                                </div>
                                <div class="mt-3">
                                    <div class="alert alert-info alert-custom mb-3">
                                        <i class="bi bi-info-circle me-2"></i>
                                        <strong>Hướng dẫn:</strong> Sử dụng Microsoft Word để in hợp đồng (File → Print). 
                                        <br>Lưu ý chọn đúng khổ giấy <span id="printPaperType" class="fw-bold">A4</span> trong cài đặt máy in.
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
                                    <button type="button" class="btn btn-outline-warning" id="copyInfoBtn" style="display: none;">
                                        <i class="bi bi-clipboard me-2"></i>Sao chép thông tin
                                    </button>
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
                    Hệ thống tạo hợp đồng cầm cố tự động - Phiên bản 2.0
                </div>
                <div class="mt-1 text-muted small">
                    <i class="bi bi-cpu me-1"></i>Hỗ trợ in khổ A4 & A5 | 
                    <i class="bi bi-database me-1"></i>Lưu trữ tự động | 
                    <i class="bi bi-wordpress me-1"></i>Microsoft Word Integration
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <script src="./js/main.js"></script>
</body>
</html>