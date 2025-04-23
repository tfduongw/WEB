<?php
// Khởi động session để có thể truy cập vào các biến session
session_start();
// Nhận dữ liệu từ form
$tenNguoiDung = $_POST['tenNguoiDung'] ?? '';
$email = $_POST['email'] ?? '';
$sdt = $_POST['sdt'] ?? '';
$diaChi = $_POST['diaChi'] ?? '';
$quan_huyen = $_POST['quan_huyen'] ?? '';
$phuong_xa = $_POST['phuong_xa'] ?? '';
$totalAmount = $_POST['totalAmount'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
      rel="shortcut icon"
      href="../view/img/DMTD-Food-Logo.jpg"
      type="image/x-icon"
    />
    <title>DMTD FOOD</title>
    <style>
/* Base styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Roboto, Arial, sans-serif;
  padding: 30px 15px;
  background-color: #f8f9fa;
  color: #333;
  line-height: 1.6;
}

.container {
  max-width: 1000px;
  margin: 0 auto;
  padding: 20px;
}

h2 {
  text-align: center;
  color: #2c3e50;
  margin-bottom: 25px;
  font-size: 24px;
  font-weight: 600;
  position: relative;
  padding-bottom: 10px;
}

h2::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 3px;
  background-color: #F37319;
}

/* Form styles */
.info-table {
  width: 100%;
  max-width: 800px;
  margin: 0 auto 30px;
  border-collapse: separate;
  border-spacing: 0;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 15px rgba(0,0,0,0.1);
  background-color: #fff;
}

.info-table th, 
.info-table td {
  padding: 15px;
  border-bottom: 1px solid #eaeaea;
}

.info-table tr:last-child th,
.info-table tr:last-child td {
  border-bottom: none;
}

.info-table th {
  background-color: #eee;
  text-align: left;
  width: 30%;
  font-weight: 600;
  color: back;
}

/* Form inputs */
input[type="text"], 
input[type="email"],
select {
  width: 100%;
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 14px;
  transition: background-color 0.3s;
}

/* Remove orange border on focus */
input[type="text"]:focus, 
input[type="email"]:focus,
select:focus {
  outline: none;
  background-color: #f9f9f9;
}

input[readonly] {
  background-color: #f0f0f0;
  cursor: not-allowed;
}

select {
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23495057' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 10px center;
  background-size: 16px;
  padding-right: 30px;
}

.input-container {
  position: relative;
}

/* Cart review section */
.cart-review {
  margin: 40px auto;
  max-width: 800px;
}

.cart-review h2 {
  margin-top: 20px;
}

.cart-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  border-radius: 8px;
  overflow: hidden; 
  margin-top: 20px;
  background-color: #fff;
  box-shadow: 0 2px 15px rgba(0,0,0,0.1);
}

.cart-table th {
  background-color: #F37319;
  color: #fff;
  padding: 15px 10px;
  font-weight: 600;
  text-align: center;
  border-bottom: 1px solid #eaeaea;
}

.cart-table td {
  padding: 15px 10px;
  text-align: center;
  border-bottom: 1px solid #eaeaea;
  vertical-align: middle;
}

.cart-table tr:last-child td {
  border-bottom: none;
}

.cart-table img {
  border-radius: 5px;
  max-width: 80px;
  height: auto;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

/* Total row styling */
.cart-table tr:last-child {
  background-color: #f8f9fa;
  font-weight: bold;
}

.cart-table tr:last-child td {
  padding-top: 15px;
  padding-bottom: 15px;
}

/* Buttons */
.cart-footer {
  display: flex;
  justify-content: space-between;
  margin-top: 25px;
  align-items: center;
}

.back-btn {
  background-color: #757575;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  font-weight: 500;
  transition: background-color 0.3s;
}

/* Removed hover effect for back button */

input[type="submit"] {
  background-color: #F37319;
  color: white;
  padding: 12px 25px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
  font-weight: 500;
  transition: background-color 0.3s;
}

input[type="submit"]:hover {
  background-color: #d66214;
}

/* Responsive styling */
@media screen and (max-width: 768px) {
  .info-table th,
  .info-table td {
    display: block;
    width: 100%;
  }
  
  .info-table th {
    padding-bottom: 5px;
    border-bottom: none;
  }
  
  .cart-table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
  }
  
  .cart-footer {
    flex-direction: column;
    gap: 15px;
  }
  
  .back-btn,
  input[type="submit"] {
    width: 100%;
    text-align: center;
  }
  
  h2 {
    font-size: 20px;
  }
}

/* Removed focus outline styles for accessibility */
a:focus,
button:focus,
input:focus,
select:focus {
  outline: none;
}

/* Animation for buttons */
.back-btn,
input[type="submit"] {
  position: relative;
  overflow: hidden;
}

.back-btn:after,
input[type="submit"]:after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 5px;
  height: 5px;
  background: rgba(255, 255, 255, 0.5);
  opacity: 0;
  border-radius: 100%;
  transform: scale(1, 1) translate(-50%);
  transform-origin: 50% 50%;
}

.back-btn:focus:not(:active)::after,
input[type="submit"]:focus:not(:active)::after {
  animation: ripple 1s ease-out;
}

@keyframes ripple {
  0% {
    transform: scale(0, 0);
    opacity: 1;
  }
  20% {
    transform: scale(25, 25);
    opacity: 1;
  }
  100% {
    opacity: 0;
    transform: scale(40, 40);
  }
}

/* Additional accent color elements */
::selection {
  background-color: rgba(243, 115, 25, 0.2);
}

   </style>
<script>
// Cập nhật danh sách huyện khi quận thay đổi
function updateHuyen() {
            const quanHuyen = document.getElementById("quan_huyen").value;
            const phuongXaSelect = document.getElementById("phuong_xa");
            
            // Xóa tất cả các phường/xã hiện tại
            phuongXaSelect.innerHTML = '<option value="">Chọn phường/xã</option>';
            
            // Danh sách phường/xã theo quận/huyện
            const phuongXaList = {
                "Quận 1": ["Phường Bến Nghé", "Phường Bến Thành", "Phường Cầu Kho", "Phường Cầu Ông Lãnh", "Phường Đa Kao"],
                "Quận 3": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
                "Quận 4": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
                "Quận 5": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
                "Quận 6": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
                "Quận 7": ["Phường Tân Thuận Đông", "Phường Tân Thuận Tây", "Phường Tân Kiểng", "Phường Tân Hưng", "Phường Tân Phú"],
                "Quận 8": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
                "Quận 10": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
                "Quận 11": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
                "Quận 12": ["Phường Tân Chánh Hiệp", "Phường Tân Thới Hiệp", "Phường Thạnh Xuân", "Phường Thới An", "Phường Hiệp Thành"],
                "Quận Bình Tân": ["Phường An Lạc", "Phường An Lạc A", "Phường Bình Trị Đông", "Phường Bình Trị Đông A", "Phường Bình Trị Đông B"],
                "Quận Bình Thạnh": ["Phường 1", "Phường 2", "Phường 3", "Phường 5", "Phường 6"],
                "Quận Gò Vấp": ["Phường 1", "Phường 3", "Phường 4", "Phường 5", "Phường 6"],
                "Quận Phú Nhuận": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
                "Quận Tân Bình": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
                "Quận Tân Phú": ["Phường Tân Sơn Nhì", "Phường Tây Thạnh", "Phường Sơn Kỳ", "Phường Tân Quý", "Phường Tân Thành"],
                "Thành phố Thủ Đức": ["Phường Linh Trung", "Phường Tam Phú", "Phường Hiệp Bình Phước", "Phường Linh Đông", "Phường Tam Bình"],
                "Huyện Bình Chánh": ["Xã An Phú Tây", "Xã Bình Chánh", "Xã Bình Hưng", "Xã Bình Lợi", "Xã Đa Phước"],
                "Huyện Củ Chi": ["Xã An Nhơn Tây", "Xã An Phú", "Xã Bình Mỹ", "Xã Hòa Phú", "Xã Nhuận Đức"],
                "Huyện Nhà Bè": ["Xã Hiệp Phước", "Xã Long Thới", "Xã Nhơn Đức", "Xã Phú Xuân", "Xã Phước Kiển"]
            };
            
            // Thêm các phường/xã cho quận/huyện đã chọn
            if (quanHuyen && phuongXaList[quanHuyen]) {
                phuongXaList[quanHuyen].forEach(phuongXa => {
                    const option = document.createElement("option");
                    option.value = phuongXa;
                    option.textContent = phuongXa;
                    phuongXaSelect.appendChild(option);
                });
            }
        }
</script>
</head>
<body>
    
<div class="container">
<h2>THÔNG TIN ĐẶT HÀNG</h2>
<form action="../controller/index.php?act=thanhtoan" method="post">
    <table class="info-table">
      <tr>
        <th>Họ và tên</th>
        <td><input type="text" name="tenNguoiDung" value="<?=$tenNguoiDung?>" placeholder="Họ và tên"  required></td>
      </tr>
      <input type="hidden" name="email" value="<?=$email?>"  placeholder="Email" required>
      <tr>
        <th>Số điện thoại</th>
        <td><input type="text" name="sdt" value="<?=$sdt?>" placeholder="Số điện thoại" pattern="^0[1-9][0-9]{8,10}$" required></td>
      </tr>
      <tr>
        <th>Địa chỉ</th>
        <td><input type="text" name="diaChi" value="<?=$diaChi?>" placeholder="Địa chỉ" required></td>
      </tr>
      <tr>
        <th>Quận/Huyện</th>
        <td>
          <div class="input-container">
          <select class="input-field" id="quan_huyen" name="quan_huyen" onchange="updateHuyen()" required>
            <?php if(empty($quan_huyen)): ?>
              <option value="">Chọn quận/huyện</option>
            <?php endif; ?>
            <option value="Quận 1" <?=($quan_huyen == 'Quận 1') ? 'selected' : ''?>>Quận 1</option>
            <option value="Quận 3" <?=($quan_huyen == 'Quận 3') ? 'selected' : ''?>>Quận 3</option>
            <option value="Quận 4" <?=($quan_huyen == 'Quận 4') ? 'selected' : ''?>>Quận 4</option>
            <option value="Quận 5" <?=($quan_huyen == 'Quận 5') ? 'selected' : ''?>>Quận 5</option>
            <option value="Quận 6" <?=($quan_huyen == 'Quận 6') ? 'selected' : ''?>>Quận 6</option>
            <option value="Quận 7" <?=($quan_huyen == 'Quận 7') ? 'selected' : ''?>>Quận 7</option>
            <option value="Quận 8" <?=($quan_huyen == 'Quận 8') ? 'selected' : ''?>>Quận 8</option>
            <option value="Quận 10" <?=($quan_huyen == 'Quận 10') ? 'selected' : ''?>>Quận 10</option>
            <option value="Quận 11" <?=($quan_huyen == 'Quận 11') ? 'selected' : ''?>>Quận 11</option>
            <option value="Quận 12" <?=($quan_huyen == 'Quận 12') ? 'selected' : ''?>>Quận 12</option>
            <option value="Quận Bình Tân" <?=($quan_huyen == 'Quận Bình Tân') ? 'selected' : ''?>>Quận Bình Tân</option>
            <option value="Quận Bình Thạnh" <?=($quan_huyen == 'Quận Bình Thạnh') ? 'selected' : ''?>>Quận Bình Thạnh</option>
            <option value="Quận Gò Vấp" <?=($quan_huyen == 'Quận Gò Vấp') ? 'selected' : ''?>>Quận Gò Vấp</option>
            <option value="Quận Phú Nhuận" <?=($quan_huyen == 'Quận Phú Nhuận') ? 'selected' : ''?>>Quận Phú Nhuận</option>
            <option value="Quận Tân Bình" <?=($quan_huyen == 'Quận Tân Bình') ? 'selected' : ''?>>Quận Tân Bình</option>
            <option value="Quận Tân Phú" <?=($quan_huyen == 'Quận Tân Phú') ? 'selected' : ''?>>Quận Tân Phú</option>
            <option value="Thành phố Thủ Đức" <?=($quan_huyen == 'Thành phố Thủ Đức') ? 'selected' : ''?>>Thành phố Thủ Đức</option>
            <option value="Huyện Bình Chánh" <?=($quan_huyen == 'Huyện Bình Chánh') ? 'selected' : ''?>>Huyện Bình Chánh</option>
            <option value="Huyện Củ Chi" <?=($quan_huyen == 'Huyện Củ Chi') ? 'selected' : ''?>>Huyện Củ Chi</option>
            <option value="Huyện Nhà Bè" <?=($quan_huyen == 'Huyện Nhà Bè') ? 'selected' : ''?>>Huyện Nhà Bè</option>
          </select>
        </div>             
        </td>
      </tr>
      <tr>
        <th>Phường/Xã</th>  
        <td>
        <div class="input-container">
            <select class="input-field" id="phuong_xa" name="phuong_xa" required>
                <option value="<?=$phuong_xa?>"><?=empty($phuong_xa) ? "Chọn phường/xã" : $phuong_xa?></option>
            </select>
          </div>
        </td>
      </tr>

      <tr>
        <th>Phương thức thanh toán</th>
        <td>
        <select name="pttt" required>
            <option value="">Chọn phương thức thanh toán</option>
            <option value="1">Thanh toán khi nhận hàng</option>
            <option value="2">Chuyển khoản</option>
            </select>
        </td>
      </tr>
    </table>
  

   <!-- Phần xem lại giỏ hàng -->
   <div class="cart-review">
   <h2>XEM LẠI GIỎ HÀNG</h2>
    <table class="cart-table" border="1">
      <tr>
        <th>Sản phẩm</th>
        <th>Hình ảnh</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
      </tr>
      
      <?php 
      $calculatedTotal = 0;
      foreach ($_SESSION['giohang'] as $id => $product): 
          $itemTotal = $product[3] * $product[4];
          $calculatedTotal += $itemTotal;
      ?>
      <tr>
        <td><?= $product[2] ?></td>
        <td><img src="../view/img/product/<?= $product[1] ?>" alt="<?= $product[2] ?>" width="80"></td>
        <td><?= number_format($product[3]) ?> VND</td>
        <td><?= $product[4] ?></td>
        <td><?= number_format($itemTotal) ?> VND</td>
      </tr>
      <?php endforeach; ?>
      
      <tr>
        <td colspan="4" align="right"><strong>Tổng tiền:</strong></td>
        <td style="color:red;"><?= number_format($calculatedTotal) ?> VND</td>
        <input type="hidden" name="tongTien" value="<?=$calculatedTotal ?>">
      </tr>
    </table>
    
    <div class="cart-footer">
      <a href="../view/cart.php" class="back-btn">Quay lại giỏ hàng</a>
      <input type="submit" name="thanhtoan" value="Xác nhận đặt hàng">
    </div>
  </div>
  </form>  
</body>
</html>