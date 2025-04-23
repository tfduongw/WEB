<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

.container{
    background-color: #ffff;
    width: 450px;
    padding: 1.5rem;
    margin: 50px auto;
    border-radius: 10px;
    box-shadow: 0 20px 35px rgba(0,0,1,0.5);
}

.container h2{
    font: size 1.5rem;  
    font-weight:bold;
    text-align:center;
    padding: 1.3rem;
    margin-top:0.1rem;
    margin-bottom:0.2rem;
}

.input-container {
  display: flex; 
  display: flex;
  width: 100%;
  margin-bottom: 15px;
  flex-direction: column;
}

.icon {
  padding: 10px;
  background: #f37319;
  color: white;
  min-width: 50px;
  text-align: center;
}

.input-row {
  display: flex;
}

.input-field {
  width: 100%;
  padding: 10px;
  outline: none;
}

.input-field:focus {
  border: 2px solid black;
}

.error-message {
    color: red;
    font-size: 12px;
    margin-top: 5px;
    display: none;
}

input[type=submit] {
  background-color: #f37319;
  color: white;
  padding: 15px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

input[type=submit]:hover {
  opacity: 1;
}

.social {
  text-align:center;
}
.social i{
  color: #F37319;
  padding: 0.8rem 1.5rem;
  border-radius:10px;
  font-size:1.5rem;
  cursor: pointer;
  border: 2px solid #dfe9f5;
  margin:0 15px;
  
}
.social i:hover{
  font-size:1.6rem;
  border:2px solid #F37319;
  transition:1s;
}

.links{
    display:flex;
    justify-content:center;
    padding:0 4rem;
    margin-top:0.3rem;
    font-weight:bold;
}

.links a{
    color:#F37319;
    text-decoration:none;
    margin: 16px 0px 0px 2px;
    font-size:1rem;
    font-weight:bold;
}
.links a:hover{
    cursor: pointer;
    text-decoration:underline;
    color: red;
}
</style>
<?php 
ob_start();
                                include "../../model/thuvien.php";
                                $conn = ketnoidb();
                                if (!$conn) {
                                  die("Lỗi: Không thể kết nối MySQL.");
                                }
                                $thisid=$_GET['this_id'];
                                $sql="SELECT * FROM nguoidung WHERE id_nguoidung='$thisid'";
$hoten;
$tendn;
$email;
$mk;
$sdt;
$diachi;
$phuong;
$quan;
$result=mysqLi_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
    $hoten=$row['tenNguoiDung'];
$tendn=$row['tenDangNhap'];
$email=$row['email'];
$mk=$row['password'];
$sdt=$row['sdt'];
$diachi=$row['diaChi'];
$phuong=$row['phuong_xa'];
$quan=$row['quan_huyen'];
}
?>

<script>
// Mảng dữ liệu quận huyện nội thành TPHCM
const quanHuyenData = {
  "Quận 1": ["Bến Nghé", "Bến Thành", "Cầu Kho", "Cầu Ông Lãnh", "Đa Kao", "Nguyễn Cư Trinh", "Nguyễn Thái Bình", "Phạm Ngũ Lão", "Tân Định"],
  "Quận 3": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5", "Phường 6", "Phường 7", "Phường 8", "Phường 9", "Phường 10", "Phường 11", "Phường 12", "Phường 13", "Phường 14"],
  "Quận 4": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5", "Phường 6", "Phường 8", "Phường 9", "Phường 10", "Phường 13", "Phường 14", "Phường 15", "Phường 16", "Phường 18"],
  "Quận 5": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5", "Phường 6", "Phường 7", "Phường 8", "Phường 9", "Phường 10", "Phường 11", "Phường 12", "Phường 13", "Phường 14", "Phường 15"],
  "Quận 6": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5", "Phường 6", "Phường 7", "Phường 8", "Phường 9", "Phường 10", "Phường 11", "Phường 12", "Phường 13", "Phường 14"],
  "Quận 7": ["Bình Thuận", "Phú Mỹ", "Phú Thuận", "Tân Hưng", "Tân Kiểng", "Tân Phong", "Tân Phú", "Tân Quy", "Tân Thuận Đông", "Tân Thuận Tây"],
  "Quận 8": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5", "Phường 6", "Phường 7", "Phường 8", "Phường 9", "Phường 10", "Phường 11", "Phường 12", "Phường 13", "Phường 14", "Phường 15", "Phường 16"],
  "Quận 10": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5", "Phường 6", "Phường 7", "Phường 8", "Phường 9", "Phường 10", "Phường 11", "Phường 12", "Phường 13", "Phường 14", "Phường 15"],
  "Quận 11": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5", "Phường 6", "Phường 7", "Phường 8", "Phường 9", "Phường 10", "Phường 11", "Phường 12", "Phường 13", "Phường 14", "Phường 15", "Phường 16"],
  "Quận 12": ["An Phú Đông", "Đông Hưng Thuận", "Hiệp Thành", "Tân Chánh Hiệp", "Tân Hưng Thuận", "Tân Thới Hiệp", "Tân Thới Nhất", "Thạnh Lộc", "Thạnh Xuân", "Thới An", "Trung Mỹ Tây"],
  "Quận Bình Tân": ["An Lạc", "An Lạc A", "Bình Hưng Hòa", "Bình Hưng Hòa A", "Bình Hưng Hòa B", "Bình Trị Đông", "Bình Trị Đông A", "Bình Trị Đông B", "Tân Tạo", "Tân Tạo A"],
  "Quận Bình Thạnh": ["Phường 1", "Phường 2", "Phường 3", "Phường 5", "Phường 6", "Phường 7", "Phường 11", "Phường 12", "Phường 13", "Phường 14", "Phường 15", "Phường 17", "Phường 19", "Phường 21", "Phường 22", "Phường 24", "Phường 25", "Phường 26", "Phường 27", "Phường 28"],
  "Quận Gò Vấp": ["Phường 1", "Phường 3", "Phường 4", "Phường 5", "Phường 6", "Phường 7", "Phường 8", "Phường 9", "Phường 10", "Phường 11", "Phường 12", "Phường 13", "Phường 14", "Phường 15", "Phường 16", "Phường 17"],
  "Quận Phú Nhuận": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5", "Phường 7", "Phường 8", "Phường 9", "Phường 10", "Phường 11", "Phường 13", "Phường 14", "Phường 15", "Phường 17"],
  "Quận Tân Bình": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5", "Phường 6", "Phường 7", "Phường 8", "Phường 9", "Phường 10", "Phường 11", "Phường 12", "Phường 13", "Phường 14", "Phường 15"],
  "Quận Tân Phú": ["Hiệp Tân", "Hòa Thạnh", "Phú Thạnh", "Phú Thọ Hòa", "Phú Trung", "Sơn Kỳ", "Tân Quý", "Tân Sơn Nhì", "Tân Thành", "Tân Thới Hòa", "Tây Thạnh"],
  "TP Thủ Đức": ["An Khánh", "An Lợi Đông", "An Phú", "Bình Chiểu", "Bình Thọ", "Bình Trưng Đông", "Bình Trưng Tây", "Cát Lái", "Hiệp Bình Chánh", "Hiệp Bình Phước", "Hiệp Phú", "Linh Chiểu", "Linh Đông", "Linh Tây", "Linh Trung", "Linh Xuân", "Long Bình", "Long Phước", "Long Thạnh Mỹ", "Long Trường", "Phú Hữu", "Phước Bình", "Phước Long A", "Phước Long B", "Tam Bình", "Tam Phú", "Tăng Nhơn Phú A", "Tăng Nhơn Phú B", "Thảo Điền", "Thủ Thiêm", "Trường Thạnh", "Trường Thọ"],
  "Huyện Bình Chánh": ["An Phú Tây", "Bình Chánh", "Bình Hưng", "Bình Lợi", "Đa Phước", "Hưng Long", "Lê Minh Xuân", "Phạm Văn Hai", "Phong Phú", "Quy Đức", "Tân Kiên", "Tân Nhựt", "Tân Quý Tây", "Tân Túc", "Vĩnh Lộc A", "Vĩnh Lộc B"],
  "Huyện Cần Giờ": ["An Thới Đông", "Bình Khánh", "Long Hòa", "Lý Nhơn", "Tam Thôn Hiệp", "Thạnh An", "Cần Thạnh"],
  "Huyện Củ Chi": ["An Nhơn Tây", "An Phú", "Bình Mỹ", "Củ Chi", "Hòa Phú", "Nhuận Đức", "Phạm Văn Cội", "Phú Hòa Đông", "Phú Mỹ Hưng", "Phước Hiệp", "Phước Thạnh", "Phước Vĩnh An", "Tân An Hội", "Tân Phú Trung", "Tân Thạnh Đông", "Tân Thạnh Tây", "Tân Thông Hội", "Thái Mỹ", "Trung An", "Trung Lập Hạ", "Trung Lập Thượng"],
  "Huyện Hóc Môn": ["Bà Điểm", "Đông Thạnh", "Hóc Môn", "Nhị Bình", "Tân Hiệp", "Tân Thới Nhì", "Tân Xuân", "Thới Tam Thôn", "Trung Chánh", "Xuân Thới Đông", "Xuân Thới Sơn", "Xuân Thới Thượng"],
  "Huyện Nhà Bè": ["Hiệp Phước", "Long Thới", "Nhà Bè", "Nhơn Đức", "Phú Xuân", "Phước Kiển", "Phước Lộc"],
};

// Cập nhật danh sách huyện khi quận thay đổi
function updateHuyen() {
  const quanSelect = document.getElementById('quan_huyen');
  const huyenSelect = document.getElementById('phuong_xa');
  const selectedQuan = quanSelect.value;
  
  huyenSelect.innerHTML = '<option value="">Chọn phường/xã</option>';

  if (selectedQuan && quanHuyenData[selectedQuan]) {
    quanHuyenData[selectedQuan].forEach(huyen => {
      const option = document.createElement('option');
      option.value = huyen;
      option.textContent = huyen;
      if (huyen === "<?php echo $phuong; ?>") { 
        option.selected = true; // Chọn sẵn phường đã lưu
      }
      huyenSelect.appendChild(option);
    });
  }
}

// Gọi hàm khi trang tải xong
window.onload = function () {
  updateHuyen();
};

</script>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<div class="container">
<h2>Chỉnh sửa tài khoản #<?php echo $thisid; ?></h2>
<form action="" method="post" style="max-width:500px;margin:auto">
  <div class="input-container">
    <div class="input-row">
      <i class="fa fa-user icon"></i>
      <input class="input-field" type="text" placeholder="Họ và tên" name="tenNguoiDung" value="<?php echo $hoten; ?>" required>
    </div>
  </div>

  <div class="input-container">
    <div class="input-row">
      <i class="fa fa-user icon"></i>
      <input class="input-field" type="text" placeholder="Tên đăng nhập" name="tenDangNhap" value="<?php echo $tendn; ?>" required>
    </div>
  </div>

  <div class="input-container">
    <div class="input-row">
      <i class="fa fa-envelope icon"></i>
      <input class="input-field" type="email" placeholder="Email" name="email" value="<?php echo $email;?>" required>
    </div>
    <span id="emailError" class="error-message">Email đã được sử dụng</span>
  </div>
  
  <div class="input-container">
    <div class="input-row">
      <i class="fa fa-key icon"></i>
      <input class="input-field" type="password" placeholder="Mật khẩu" name="password" value="<?php echo $mk; ?>" required>
    </div>
  </div>

  <div class="input-container">
    <div class="input-row">
      <i class="fa fa-phone icon"></i>
      <input class="input-field" type="text" pattern="^0[1-9][0-9]{8,10}$" placeholder="Số điện thoại" name="sdt" value="<?php echo $sdt; ?>" required>
    </div>
  </div>

  <div class="input-container">
    <div class="input-row">
      <i class="fa fa-map-marker icon"></i>
      <input class="input-field" type="text" placeholder="Địa chỉ" name="diaChi" value="<?php echo $diachi; ?>" required>
    </div>
  </div>
  <select class="input-field" id="quan_huyen" name="quan_huyen" onchange="updateHuyen()" required>
  <option value="">Chọn quận/huyện</option>
  <option value="Quận 1" <?php if ($quan == "Quận 1") echo "selected"; ?>>Quận 1</option>
  <option value="Quận 3" <?php if ($quan == "Quận 3") echo "selected"; ?>>Quận 3</option>
  <option value="Quận 4" <?php if ($quan == "Quận 4") echo "selected"; ?>>Quận 4</option>
  <option value="Quận 5" <?php if ($quan == "Quận 5") echo "selected"; ?>>Quận 5</option>
  <option value="Quận 6" <?php if ($quan == "Quận 6") echo "selected"; ?>>Quận 6</option>
  <option value="Quận 7" <?php if ($quan == "Quận 7") echo "selected"; ?>>Quận 7</option>
  <option value="Quận 8" <?php if ($quan == "Quận 8") echo "selected"; ?>>Quận 8</option>
  <option value="Quận 10" <?php if ($quan == "Quận 10") echo "selected"; ?>>Quận 10</option>
  <option value="Quận 11" <?php if ($quan == "Quận 11") echo "selected"; ?>>Quận 11</option>
  <option value="Quận 12" <?php if ($quan == "Quận 12") echo "selected"; ?>>Quận 12</option>
  <option value="Quận Bình Tân" <?php if ($quan == "Quận Bình Tân") echo "selected"; ?>>Quận Bình Tân</option>
  <option value="Quận Bình Thạnh" <?php if ($quan == "Quận Bình Thạnh") echo "selected"; ?>>Quận Bình Thạnh</option>
  <option value="Quận Gò Vấp" <?php if ($quan == "Quận Gò Vấp") echo "selected"; ?>>Quận Gò Vấp</option>
  <option value="Quận Phú Nhuận" <?php if ($quan == "Quận Phú Nhuận") echo "selected"; ?>>Quận Phú Nhuận</option>
  <option value="Quận Tân Bình" <?php if ($quan == "Quận Tân Bình") echo "selected"; ?>>Quận Tân Bình</option>
  <option value="Quận Tân Phú" <?php if ($quan == "Quận Tân Phú") echo "selected"; ?>>Quận Tân Phú</option>
  <option value="Thành phố Thủ Đức" <?php if ($quan == "Thành phố Thủ Đức") echo "selected"; ?>>Thành phố Thủ Đức</option>
  <option value="Huyện Bình Chánh" <?php if ($quan == "Huyện Bình Chánh") echo "selected"; ?>>Huyện Bình Chánh</option>
  <option value="Huyện Củ Chi" <?php if ($quan == "Huyện Củ Chi") echo "selected"; ?>>Huyện Củ Chi</option>
  <option value="Huyện Nhà Bè" <?php if ($quan == "Huyện Nhà Bè") echo "selected"; ?>>Huyện Nhà Bè</option>
</select>

  <!-- Thêm select cho Phường -->
  <div class="input-container">
    <i class="fa fa-map-pin icon"></i>
    <select class="input-field" id="phuong_xa" name="phuong_xa" required>
      <option value="">Chọn phường/xã</option>
    </select>
  </div>
  <input type="submit" value="Xác nhận" name="signUp">
  <div class="links">
  <a href="quanlytk.php" class="back">Quay lại</a>
  </div>
</form>
</div>
<?php
$emailError = false; // Biến để kiểm tra lỗi email
if(isset($_POST['signUp'])){
    $tenNguoiDung = $_POST['tenNguoiDung'];
    $tenDangNhap = $_POST['tenDangNhap'];
    $email = $_POST['email'];
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sdt = $_POST['sdt'];
    $diaChi = $_POST['diaChi'];
    $q=$_POST['quan_huyen'];
    $p=$_POST['phuong_xa'];
    $checkEmail = "SELECT * FROM nguoidung where email = '$email' and id_nguoidung!=$thisid";
    $result = $conn->query($checkEmail);

    if($result->num_rows>0){
        $emailError = true; // Đánh dấu có lỗi email
    }else{
        $insertQuery = "UPDATE nguoidung SET tenNguoiDung='$tenNguoiDung',tenDangNhap='$tenDangNhap',email='$email',password='$password',sdt='$sdt',diaChi='$diaChi',phuong_xa='$p',quan_huyen='$q' WHERE id_nguoidung='$thisid'";
        if($conn->query($insertQuery) == true){
header("location:quanlytk.php");
            exit();
        }else{
            echo "Error:" . $conn->error;
        }
    }
} 
  
?>
<script>
// Hiển thị thông báo lỗi nếu có
<?php if($emailError): ?>
    document.getElementById('emailError').style.display = 'block';
<?php
 endif; 

ob_end_flush();
?>

// Reset thông báo lỗi khi người dùng bắt đầu nhập lại
document.querySelector('input[name="email"]').addEventListener('input', function() {
    document.getElementById('emailError').style.display = 'none';
});
</script>

</body>
</html>
