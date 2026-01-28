
document.addEventListener('DOMContentLoaded', function() {
    console.log('Hệ thống hợp đồng cầm cố đã sẵn sàng!');
    
    // Biến lưu trữ thông tin file hiện tại
    let currentFilePath = null;
    let currentFileName = null;
    let currentFileUrl = null;
    let currentIdHopDong = null;
    let currentMaHopDong = null;
    let currentPaperType = 'A4';
    let defaultPaperType = 'A4';
    
    // ========== HÀM LẤY MÃ HỢP ĐỒNG TỰ ĐỘNG KHI TRANG LOAD ==========
    function loadAutoMaHopDong() {
        const displaySpan = document.getElementById('autoMaHopDongText');
        const hiddenInput = document.getElementById('maHopDong');
        
        if (displaySpan && hiddenInput) {
            // Hiển thị loading
            displaySpan.textContent = 'Đang tải...';
            
            // Gọi API để lấy mã hợp đồng tự động
            fetch('./get_auto_maHopDong.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success && data.maHopDong) {
                        // Cập nhật hiển thị với font monospace
                        displaySpan.textContent = data.maHopDong;
                        
                        // Cập nhật input hidden
                        hiddenInput.value = data.maHopDong;
                        
                        // Thêm hiệu ứng flash khi tải xong
                        displaySpan.classList.add('flashing');
                        setTimeout(() => {
                            displaySpan.classList.remove('flashing');
                        }, 3000);
                        
                        // Hiển thị thông báo
                        if (data.auto_generated) {
                            console.log('Mã hợp đồng tự động được tạo:', data.maHopDong);
                        }
                    } else {
                        // Fallback: Tạo mã mặc định
                        displaySpan.textContent = 'HD001';
                        hiddenInput.value = 'HD001';
                        console.warn('Không thể lấy mã tự động, sử dụng mã mặc định HD001');
                    }
                })
                .catch(error => {
                    console.error('Lỗi khi lấy mã hợp đồng tự động:', error);
                    
                    // Fallback: Tạo mã mặc định
                    displaySpan.textContent = 'HD001';
                    hiddenInput.value = 'HD001';
                });
        }
    }
    
    // ========== HÀM LẤY LOẠI GIẤY MẶC ĐỊNH TỪ SERVER ==========
    function loadDefaultPaperType() {
        fetch('./get_settings.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success && data.paper_type) {
                    defaultPaperType = data.paper_type;
                    currentPaperType = defaultPaperType;
                    
                    // Cập nhật hiển thị
                    updatePaperTypeUI();
                    
                    console.log('Loại giấy mặc định:', defaultPaperType);
                } else {
                    console.warn('Không thể lấy loại giấy mặc định, sử dụng A4');
                }
            })
            .catch(error => {
                console.error('Lỗi khi lấy loại giấy mặc định:', error);
            });
    }
    
    // ========== HÀM CẬP NHẬT UI LOẠI GIẤY ==========
    function updatePaperTypeUI() {
        const paperTypeSelect = document.getElementById('paperTypeSelect');
        const paperTypeInput = document.getElementById('paper_type');
        const currentBadge = document.getElementById('currentPaperTypeBadge');
        const defaultText = document.getElementById('defaultPaperType');
        
        if (paperTypeSelect) {
            paperTypeSelect.value = currentPaperType;
        }
        
        if (paperTypeInput) {
            paperTypeInput.value = currentPaperType;
        }
        
        if (currentBadge) {
            currentBadge.textContent = currentPaperType;
            currentBadge.className = `paper-badge paper-${currentPaperType.toLowerCase()}`;
        }
        
        if (defaultText) {
            defaultText.textContent = defaultPaperType;
        }
    }
    
    // ========== HÀM LƯU LOẠI GIẤY MẶC ĐỊNH ==========
    function saveDefaultPaperType() {
        const saveBtn = document.getElementById('saveDefaultBtn');
        const paperTypeSelect = document.getElementById('paperTypeSelect');
        
        if (!paperTypeSelect) return;
        
        const selectedType = paperTypeSelect.value;
        
        // Hiển thị loading
        const originalText = saveBtn.innerHTML;
        saveBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Đang lưu...';
        saveBtn.disabled = true;
        
        fetch('./save_settings.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                paper_type: selectedType
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Khôi phục nút
            saveBtn.innerHTML = originalText;
            saveBtn.disabled = false;
            
            if (data.success) {
                // Cập nhật loại giấy mặc định
                defaultPaperType = selectedType;
                currentPaperType = selectedType;
                
                // Cập nhật UI
                updatePaperTypeUI();
                
                // Hiển thị thông báo thành công
                showToast('Đã lưu loại giấy mặc định: ' + selectedType, 'success');
                
                // Thêm hiệu ứng
                saveBtn.classList.add('setting-saved');
                setTimeout(() => {
                    saveBtn.classList.remove('setting-saved');
                }, 3000);
                
                console.log('Đã lưu loại giấy mặc định:', selectedType);
            } else {
                showToast('Không thể lưu cài đặt: ' + (data.message || 'Lỗi không xác định'), 'error');
            }
        })
        .catch(error => {
            // Khôi phục nút
            saveBtn.innerHTML = originalText;
            saveBtn.disabled = false;
            
            console.error('Lỗi khi lưu loại giấy mặc định:', error);
            showToast('Lỗi kết nối khi lưu cài đặt', 'error');
        });
    }
    
    // ========== HÀM HIỂN THỊ ID ==========
    function showId(id, maHopDong) {
        const idSection = document.getElementById('idDisplaySection');
        const idSpan = document.getElementById('currentIdHopDong');
        
        if (idSection && idSpan) {
            let displayText = '';
            if (maHopDong) {
                displayText = `${maHopDong} (ID: ${id})`;
            } else {
                displayText = id;
            }
            idSpan.textContent = displayText;
            idSection.style.display = 'block';
            currentIdHopDong = id;
            currentMaHopDong = maHopDong;
            
            // Thêm hiệu ứng
            idSection.style.animation = 'fadeIn 0.5s';
            
            // Scroll đến ID
            setTimeout(() => {
                idSection.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'center' 
                });
            }, 100);
        }
    }
    
    // ========== HÀM ẨN ID ==========
    function hideId() {
        const idSection = document.getElementById('idDisplaySection');
        if (idSection) {
            idSection.style.display = 'none';
        }
        currentIdHopDong = null;
        currentMaHopDong = null;
    }
    
    // ========== HÀM HIỂN THỊ MÃ HỢP ĐỒNG TỰ ĐỘNG ==========
    function showAutoMaHopDong(maHopDong) {
        const displaySpan = document.getElementById('autoMaHopDongText');
        const hiddenInput = document.getElementById('maHopDong');
        
        if (displaySpan && hiddenInput) {
            displaySpan.textContent = maHopDong;
            hiddenInput.value = maHopDong;
            
            // Thêm hiệu ứng flash khi cập nhật mã mới
            displaySpan.classList.add('flashing');
            setTimeout(() => {
                displaySpan.classList.remove('flashing');
            }, 2000);
        }
    }
    
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
            const fileMaHopDong = document.getElementById('fileMaHopDong');
            const fileIdHopDong = document.getElementById('fileIdHopDong');
            const filePaperType = document.getElementById('filePaperType');
            const filePath = document.getElementById('filePath');
            const fileSize = document.getElementById('fileSize');
            const downloadBtn = document.getElementById('downloadBtn');
            
            // Kiểm tra các phần tử tồn tại
            if (!resultSection || !successMessage || !successDetail || !fileName || !fileMaHopDong || !fileIdHopDong || !filePaperType || !filePath || !fileSize) {
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
            fileMaHopDong.textContent = data.maHopDong ? data.maHopDong : 'Không có';
            fileIdHopDong.textContent = data.idHopDong ? `${data.idHopDong}/HĐCC` : 'Không xác định';
            
            // Hiển thị loại giấy
            let paperTypeDisplay = data.paper_type || 'A4';
            if (paperTypeDisplay === 'A4') {
                filePaperType.innerHTML = '<span class="badge bg-primary">Khổ A4</span>';
            } else if (paperTypeDisplay === 'A5') {
                filePaperType.innerHTML = '<span class="badge bg-success">Khổ A5</span>';
            } else {
                filePaperType.textContent = paperTypeDisplay;
            }
            
            filePath.textContent = data.file_path || 'Không xác định';
            fileSize.textContent = data.file_size || 'Không xác định';
            
            // Hiển thị ID hợp đồng ở đầu form
            if (data.idHopDong) {
                showId(data.idHopDong, data.maHopDong);
            }
            
            // Lưu thông tin file
            currentFilePath = data.file_path;
            currentFileName = data.filename;
            currentFileUrl = data.file_url;
            currentIdHopDong = data.idHopDong;
            currentMaHopDong = data.maHopDong;
            currentPaperType = data.paper_type || 'A4';
            
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
            
            // Sau khi tạo xong hợp đồng, load mã mới cho lần tạo tiếp theo
            setTimeout(() => {
                loadAutoMaHopDong();
            }, 1000);
            
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
        currentIdHopDong = null;
        currentMaHopDong = null;
        
        // Ẩn ID và mã hợp đồng
        hideId();
        
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
        
        // Đặt lại loại giấy về mặc định
        currentPaperType = defaultPaperType;
        updatePaperTypeUI();
        
        // Ẩn kết quả và ID
        hideResult();
        
        // Tải lại mã hợp đồng tự động mới
        loadAutoMaHopDong();
        
        // Focus vào trường họ tên
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
        // Không cần validate mã hợp đồng nữa vì nó là tự động
        const requiredFields = [
            'ho_ten', 'nam_sinh', 'so_dt', 'cccd_so', 'ngay_cap', 
            'noi_cap', 'noi_dktt', 'ten_tai_san', 'so_tien', 
            'gio', 'phut', 'ngay_cam'
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
        
        // Tải mã hợp đồng tự động và loại giấy mặc định
        loadAutoMaHopDong();
        loadDefaultPaperType();
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
            
            // Kiểm tra mã hợp đồng đã được tạo chưa
            const maHopDongInput = document.getElementById('maHopDong');
            if (!maHopDongInput || !maHopDongInput.value) {
                showToast('Vui lòng chờ hệ thống tạo mã hợp đồng tự động', 'warning');
                return;
            }
            
            // Chuẩn bị dữ liệu
            const formData = new FormData();
            const formFields = [
                'maHopDong', 'paper_type', 'ho_ten', 'nam_sinh', 'so_dt', 'cccd_so', 'ngay_cap', 
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
            resetForm();
            // Đã xoá dòng showToast này
        });
    }
    
    // ========== XỬ LÝ CHỌN LOẠI GIẤY ==========
    const paperTypeSelect = document.getElementById('paperTypeSelect');
    if (paperTypeSelect) {
        paperTypeSelect.addEventListener('change', function() {
            currentPaperType = this.value;
            const paperTypeInput = document.getElementById('paper_type');
            if (paperTypeInput) {
                paperTypeInput.value = currentPaperType;
            }
            
            // Cập nhật badge
            const currentBadge = document.getElementById('currentPaperTypeBadge');
            if (currentBadge) {
                currentBadge.textContent = currentPaperType;
                currentBadge.className = `paper-badge paper-${currentPaperType.toLowerCase()}`;
            }
        });
    }
    
    // ========== XỬ LÝ NÚT LƯU MẶC ĐỊNH ==========
    const saveDefaultBtn = document.getElementById('saveDefaultBtn');
    if (saveDefaultBtn) {
        saveDefaultBtn.addEventListener('click', function() {
            saveDefaultPaperType();
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
    
    // Kiểm tra nếu có thông báo lỗi từ URL
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');
    if (error) {
        showToast(decodeURIComponent(error), 'error');
    }
    
    // Kiểm tra nếu có thông báo thành công từ URL
    const success = urlParams.get('success');
    if (success) {
        showToast(decodeURIComponent(success), 'success');
    }
});
