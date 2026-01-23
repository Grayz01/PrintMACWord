document.addEventListener('DOMContentLoaded', function() {
    // ========== BIẾN VÀ HÀM CHUNG ==========
    let currentFileName = null;
    let currentFilePath = null;
    
    // Hàm hiển thị loading
    function showLoading() {
        const overlay = document.getElementById('loadingOverlay');
        overlay.style.display = 'flex';
        
        const createBtn = document.getElementById('createBtn');
        createBtn.disabled = true;
        createBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> ĐANG XỬ LÝ...';
    }
    
    // Hàm ẩn loading
    function hideLoading() {
        const overlay = document.getElementById('loadingOverlay');
        overlay.style.display = 'none';
        
        const createBtn = document.getElementById('createBtn');
        createBtn.disabled = false;
        createBtn.innerHTML = '<i class="bi bi-file-earmark-plus me-2"></i>TẠO HỢP ĐỒNG';
    }
    
    // Hàm hiển thị kết quả
    function showResult(filename, filePath, wordOpened) {
        const resultSection = document.getElementById('resultSection');
        const fileNameElement = document.getElementById('fileName');
        const filePathElement = document.getElementById('filePath');
        
        fileNameElement.textContent = filename;
        filePathElement.textContent = filePath;
        
        resultSection.style.display = 'block';
        resultSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Cuộn trang lên đầu nếu cần
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    
    // Hàm ẩn kết quả
    function hideResult() {
        const resultSection = document.getElementById('resultSection');
        resultSection.style.display = 'none';
    }
    
    // Hàm đặt lại form
    function resetForm() {
        document.getElementById('contractForm').reset();
        
        // Đặt ngày hiện tại cho các trường ngày
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('ngay_cap').value = today;
        document.getElementById('ngay_cam').value = today;
        document.getElementById('ky_1').value = today;
        document.getElementById('ky_2').value = today;
        
        // Đặt giờ phút hiện tại
        const now = new Date();
        document.getElementById('gio').value = now.getHours().toString().padStart(2, '0');
        document.getElementById('phut').value = now.getMinutes().toString().padStart(2, '0');
        
        // Focus vào trường đầu tiên
        document.getElementById('ho_ten').focus();
    }
    
    // ========== HÀM CHUYỂN ĐỔI SỐ THÀNH CHỮ ==========
    function numberToWords(num) {
        const ones = ['', 'một', 'hai', 'ba', 'bốn', 'năm', 'sáu', 'bảy', 'tám', 'chín'];
        const tens = ['', '', 'hai mươi', 'ba mươi', 'bốn mươi', 'năm mươi', 'sáu mươi', 'bảy mươi', 'tám mươi', 'chín mươi'];
        const teens = ['mười', 'mười một', 'mười hai', 'mười ba', 'mười bốn', 'mười lăm', 'mười sáu', 'mười bảy', 'mười tám', 'mười chín'];
        
        function convertLessThanOneThousand(n) {
            if (n == 0) return '';
            
            let result = '';
            
            if (n >= 100) {
                result += ones[Math.floor(n / 100)] + ' trăm ';
                n %= 100;
            }
            
            if (n >= 20) {
                result += tens[Math.floor(n / 10)] + ' ';
                n %= 10;
            } else if (n >= 10) {
                result += teens[n - 10] + ' ';
                return result;
            }
            
            if (n > 0) {
                if (n == 5) {
                    result += 'lăm ';
                } else {
                    result += ones[n] + ' ';
                }
            }
            
            return result;
        }
        
        if (num == 0) return 'không';
        
        let result = '';
        const billion = Math.floor(num / 1000000000);
        const million = Math.floor((num % 1000000000) / 1000000);
        const thousand = Math.floor((num % 1000000) / 1000);
        const remainder = num % 1000;
        
        if (billion > 0) {
            result += convertLessThanOneThousand(billion) + 'tỷ ';
        }
        
        if (million > 0) {
            result += convertLessThanOneThousand(million) + 'triệu ';
        }
        
        if (thousand > 0) {
            result += convertLessThanOneThousand(thousand) + 'nghìn ';
        }
        
        result += convertLessThanOneThousand(remainder);
        
        return result.trim() + ' đồng';
    }
    
    // ========== XỬ LÝ FORM ==========
    
    // Xử lý thay đổi số tiền
    document.getElementById('so_tien').addEventListener('input', function() {
        const soTien = parseInt(this.value.replace(/\D/g, '')) || 0;
        const bangChu = numberToWords(soTien);
        document.getElementById('bang_chu').value = bangChu;
        
        // Format số tiền với dấu phẩy
        if (soTien > 0) {
            this.value = soTien.toLocaleString('vi-VN');
        }
    });
    
    // Đặt ngày mặc định
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('ngay_cap').value = today;
    document.getElementById('ngay_cam').value = today;
    document.getElementById('ky_1').value = today;
    document.getElementById('ky_2').value = today;
    
    // Đặt giờ phút hiện tại
    const now = new Date();
    document.getElementById('gio').value = now.getHours().toString().padStart(2, '0');
    document.getElementById('phut').value = now.getMinutes().toString().padStart(2, '0');
    
    // ========== XỬ LÝ NÚT TẠO HỢP ĐỒNG ==========
    document.getElementById('createBtn').addEventListener('click', function() {
        // Validate form
        const requiredFields = [
            'ho_ten', 'nam_sinh', 'so_dt', 'cccd_so', 
            'ngay_cap', 'noi_cap', 'noi_dktt', 
            'ten_tai_san', 'so_tien', 'gio', 'phut', 'ngay_cam'
        ];
        
        let isValid = true;
        let firstInvalidField = null;
        
        requiredFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (!field.value.trim()) {
                isValid = false;
                if (!firstInvalidField) {
                    firstInvalidField = field;
                }
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            alert('❌ Vui lòng điền đầy đủ các trường bắt buộc!');
            if (firstInvalidField) {
                firstInvalidField.focus();
            }
            return;
        }
        
        // Chuẩn bị dữ liệu
        const formData = new FormData();
        const formFields = [
            'ho_ten', 'nam_sinh', 'so_dt', 'cccd_so', 'ngay_cap', 
            'noi_cap', 'noi_dktt', 'ten_tai_san', 'so_tien', 
            'bang_chu', 'gio', 'phut', 'ngay_cam', 'ky_1', 'ky_2'
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
        
        // Gửi request
        showLoading();
        
        fetch('./create_contract.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            hideLoading();
            
            if (data.success) {
                currentFileName = data.filename;
                currentFilePath = data.file_path;
                
                showResult(data.filename, data.file_path, data.word_opened);
                
                // Hiển thị thông báo nếu không mở được Word
                if (!data.word_opened) {
                    alert('⚠️ File đã được tạo nhưng không thể mở tự động bằng Microsoft Word.\nVui lòng mở file thủ công từ thư mục data.');
                }
            } else {
                alert('❌ Lỗi: ' + data.message);
                console.error('Server error:', data);
            }
        })
        .catch(error => {
            hideLoading();
            alert('❌ Lỗi kết nối: ' + error.message);
            console.error('Fetch error:', error);
        });
    });
    
    // ========== XỬ LÝ NÚT MỞ LẠI BẰNG WORD ==========
    document.getElementById('openWordBtn').addEventListener('click', function() {
        if (currentFilePath) {
            fetch('./open_word.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    file_path: currentFilePath
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('✅ Đang mở file bằng Microsoft Word...');
                } else {
                    alert('❌ Không thể mở file: ' + data.message);
                }
            })
            .catch(error => {
                alert('❌ Lỗi: ' + error.message);
            });
        }
    });
    
    // ========== XỬ LÝ NÚT TẠO HỢP ĐỒNG KHÁC ==========
    document.getElementById('createAnotherBtn').addEventListener('click', function() {
        hideResult();
        resetForm();
    });
    
    // ========== STYLE CHO FORM VALIDATION ==========
    const style = document.createElement('style');
    style.textContent = `
        .is-invalid {
            border-color: #dc3545 !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        .is-invalid:focus {
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }
    `;
    document.head.appendChild(style);
});