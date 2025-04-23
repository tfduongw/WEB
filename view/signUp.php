<?php
include '../model/thuvien.php';
$conn = ketnoidb();

$loginError = false;
$errorMessage = "";

if(isset($_POST['signUp'])){
    $tenNguoiDung = $_POST['tenNguoiDung'];
    $tenDangNhap = $_POST['tenDangNhap'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sdt = $_POST['sdt'];
    $diaChi = $_POST['diaChi'];
    $quan_huyen= $_POST['quan_huyen'];
    $phuong_xa = $_POST['phuong_xa'];

    $checkEmail = "SELECT * FROM nguoidung where email = '$email'";
    $result = $conn->query($checkEmail);
    
    $checkUserName = "SELECT * FROM nguoidung where tenDangNhap = '$tenDangNhap'";
    $resultUsername = $conn->query($checkUserName);

    if($result->num_rows>0){
      // echo "<script>alert('Tài khoản đã được đăng ký!');</script>";
      $loginError = true;
      $errorMessage = "Tài khoản đã tồn tại";
    }else if( $resultUsername->num_rows>0){
      $loginError = true;
      $errorMessage = "Tên đăng nhập đã có người sử dụng";
    }
    else{
      $emailExists = false;
      $insertQuery = "INSERT INTO nguoidung(tenNguoiDung, tenDangNhap, email, password, sdt, diaChi, quan_huyen, phuong_xa) 
      VALUES('$tenNguoiDung','$tenDangNhap','$email','$password','$sdt','$diaChi','$quan_huyen','$phuong_xa')";      
        if($conn->query($insertQuery) == true){
            header("location:../view/signIn.php");
        }else{
            echo "Error:" . $conn->error;
        }
    }
  }   
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">\
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
<link
      rel="shortcut icon"
      href="../view/img/DMTD-Food-Logo.jpg"
      type="image/x-icon"
    />
    <title>DMTD FOOD</title>
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
}

.icon {
  padding: 10px;
  background: #f37319;
  color: white;
  min-width: 50px;
  text-align: center;
}

.input-field {
  width: 100%;
  padding: 10px;
  outline: none;
}

.input-field:focus {
  border: 2px solid black;
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

input[type=submit]  {
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

.back {
  display: inline-block;
  padding: 10px 30px;
  font-size: 15px;
  background: #d3d3d3;
  margin: 0 5px;
  text-decoration: none; 
  color: black;
  font-weight:5px;
  text-align: center;
  border-radius: 5px;
}

.back:hover {
  text-decoration: none;
  background: #b0b0b0; 
}

select.input-field {
  cursor: pointer;
}

</style>
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
  "Thành phố Thủ Đức": ["An Khánh", "An Lợi Đông", "An Phú", "Bình Chiểu", "Bình Thọ", "Bình Trưng Đông", "Bình Trưng Tây", "Cát Lái", "Hiệp Bình Chánh", "Hiệp Bình Phước", "Hiệp Phú", "Linh Chiểu", "Linh Đông", "Linh Tây", "Linh Trung", "Linh Xuân", "Long Bình", "Long Phước", "Long Thạnh Mỹ", "Long Trường", "Phú Hữu", "Phước Bình", "Phước Long A", "Phước Long B", "Tam Bình", "Tam Phú", "Tăng Nhơn Phú A", "Tăng Nhơn Phú B", "Thảo Điền", "Thủ Thiêm", "Trường Thạnh", "Trường Thọ"],
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
  
  // Xóa tất cả các option hiện tại
  huyenSelect.innerHTML = '<option value="">Chọn phường/xã</option>';
  
  // Thêm các option mới dựa trên quận được chọn
  if (selectedQuan && quanHuyenData[selectedQuan]) {
    quanHuyenData[selectedQuan].forEach(huyen => {
      const option = document.createElement('option');
      option.value = huyen;
      option.textContent = huyen;
      huyenSelect.appendChild(option);
    });
  }
}
</script>
</head>
<body>

<div class="container">
<h2>ĐĂNG KÝ</h2>
<form action="signUp.php" method="post" style="max-width:500px;margin:auto">
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Họ và tên" name="tenNguoiDung" required>
  </div>

  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Tên đăng nhập" name="tenDangNhap" required>
  </div>

  <div class="input-container">
    <i class="fa fa-envelope icon"></i>
    <input class="input-field" type="email" placeholder="Email" name="email" required>
  </div>
  
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Mật khẩu" name="password" required>
  </div>

  <div class="input-container">
  <i class="fa fa-phone icon"></i>
    <input class="input-field" type="text" pattern="^0[1-9][0-9]{8,10}$" placeholder="Số điện thoại" name="sdt" required>
  </div>

  <div class="input-container">
  <i class="fa fa-map-marker icon"></i>
    <input class="input-field" type="text" placeholder="Địa chỉ" name="diaChi" required>
  </div>

  <!-- Thêm select cho Quận -->
  <div class="input-container">
    <i class="fa fa-map icon"></i>
    <select class="input-field" id="quan_huyen" name="quan_huyen" onchange="updateHuyen()" required>
      <option value="">Chọn quận/huyện</option>
      <option value="Quận 1">Quận 1</option>
      <option value="Quận 3">Quận 3</option>
      <option value="Quận 4">Quận 4</option>
      <option value="Quận 5">Quận 5</option>
      <option value="Quận 6">Quận 6</option>
      <option value="Quận 7">Quận 7</option>
      <option value="Quận 8">Quận 8</option>
      <option value="Quận 10">Quận 10</option>
      <option value="Quận 11">Quận 11</option>
      <option value="Quận 12">Quận 12</option>
      <option value="Quận Bình Tân">Quận Bình Tân</option>
      <option value="Quận Bình Thạnh">Quận Bình Thạnh</option>
      <option value="Quận Gò Vấp">Quận Gò Vấp</option>
      <option value="Quận Phú Nhuận">Quận Phú Nhuận</option>
      <option value="Quận Tân Bình">Quận Tân Bình</option>
      <option value="Quận Tân Phú">Quận Tân Phú</option>
      <option value="Thành phố Thủ Đức">Thành phố Thủ Đức</option>
      <option value="Huyện Bình Chánh">Huyện Bình Chánh</option>
      <option value="Huyện Củ Chi">Huyện Củ Chi</option>
      <option value="Huyện Nhà Bè">Huyện Nhà Bè</option>
    </select>
  </div>

  <!-- Thêm select cho Phường -->
  <div class="input-container">
    <i class="fa fa-map-pin icon"></i>
    <select class="input-field" id="phuong_xa" name="phuong_xa" required>
      <option value="">Chọn phường/xã</option>
    </select>
  </div>

  <input type="submit" value="Đăng ký" name="signUp">
  <div class="links">
    <p>Đã có tài khoản?</p>
    <a href="../view/signIn.php">Đăng nhập</a>
  </div>

  <a href="../controller/index.php" class="back">Quay lại</a>
</form>
</div>


<!-- Create a custom function to show error modal -->
<script>
// Create a custom function for showing login error modals
function showLoginErrorModal(message) {
  // Create modal container and add to body
  const modalContainer = document.createElement("div");
  modalContainer.id = "modal-container";

  // Create HTML for modal with our error message
  modalContainer.innerHTML = `
    <div class="modal" id="modal-demo">
      <div class="modal_header">
        <h3>Thông báo</h3>
        <button id="btn-close"><i class="fa-solid fa-xmark"></i></button>
      </div>
      <div class="modal_body">
        <p>${message}</p>
        <a href="signIn.php">Đăng nhập</a>
      </div>
    </div>
  `;

  document.body.appendChild(modalContainer);

  const btnClose = document.getElementById("btn-close");
  const modalDemo = document.getElementById("modal-demo");

  modalContainer.classList.add("show");

  btnClose.addEventListener("click", function () {
    modalContainer.classList.remove("show");
    setTimeout(() => {
      document.body.removeChild(modalContainer);
    }, 300);
  });

  modalContainer.addEventListener("click", function (e) {
    if (!modalDemo.contains(e.target)) {
      btnClose.click();
    }
  });

  // Add modal styling if it doesn't exist
  if (!document.getElementById("modal-style")) {
    const style = document.createElement("style");
    style.id = "modal-style";
    style.textContent = `
      * {
        box-sizing: border-box;
      }

      body {
        font-family: Arial, Helvetica, sans-serif;
        line-height: 1.3;
      }

      #modal-container {
        height: 100vh;
        background-color: rgb(0, 0, 0, 0.5);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        opacity: 0;
        pointer-events: none;
        z-index: 1000;
      }

      #modal-container.show {
        opacity: 1;
        pointer-events: all;
      }

      .modal {
        background-color: #ffff;
        max-width: 500px;
        position: relative;
        left: 50%;
        top: 100px;
        transform: translateX(-50%);
      }

      .modal .modal_header {
        display: flex;
        position: relative;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        border-bottom: 1px solid gray;
      }

      .modal_header h3 {
        margin: 0;
        text-align: center;
        flex-grow: 1;
      }

      button#btn-close {
        width: 30px;
        height: 30px;
        border: none;
        font-size: 20px;
        color: white;
        align-items: center;
        background-color: #f37319;
        border-radius: 20px;
        cursor: pointer;
        position: absolute;
        top: -5px;
        right: -5px;
      }

      .modal .modal_body {
        padding: 10px 20px 15px;
      }

      .modal_body p {
        text-align: center;
      }

      .modal_body a {
        text-decoration: none;
        background: #f37319;
        color: #fff;
        display: block;
        padding: 5px 15px;
        text-align: center;
        margin: 10px auto;
        width: fit-content;
        border-radius: 10px;
      }
    `;
    document.head.appendChild(style);
  }
}
</script>

<!-- Show error modal if login failed -->
<?php if($loginError): ?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    showLoginErrorModal("<?php echo $errorMessage; ?>");
  });
</script>
<?php endif; ?>
</body>
</html>