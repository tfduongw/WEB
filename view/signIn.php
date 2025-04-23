<?php
session_start();
include '../model/thuvien.php';
$conn = ketnoidb();

// Variable to track login error
$loginError = false;
$errorMessage = "";

if(isset($_POST['signIn'])){
  $tenDangNhap = $_POST['tenDangNhap'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM nguoidung WHERE tenDangNhap = '$tenDangNhap' and password = '$password'";
  $result = $conn->query($sql);
  $row = mysqli_fetch_array($result);

  if($result->num_rows == 0){
    // Instead of alert, set a flag to show modal
    $loginError = true;
    $errorMessage = "Tài khoản hoặc mật khẩu không đúng";
  }

  if($result->num_rows > 0){
    if($row["TrangThai"] == 1){
      if($row["vaiTro"] == "user"){
        $_SESSION['tenNguoiDung'] = $row['tenNguoiDung'];
        $_SESSION['tenDangNhap'] = $row['tenDangNhap'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['sdt'] = $row['sdt'];
        $_SESSION['diaChi'] = $row['diaChi'];
        $_SESSION['quan_huyen'] = $row['quan_huyen'];
        $_SESSION['phuong_xa'] = $row['phuong_xa'];
        header("location:../controller/index.php");
      }else if($row["vaiTro"] == "admin"){
        $_SESSION['tenNguoiDung'] = $row['tenNguoiDung'];
        $_SESSION['tenDangNhap'] = $row['tenDangNhap'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['sdt'] = $row['sdt'];
        $_SESSION['diaChi'] = $row['diaChi']; 
        $_SESSION['quan_huyen'] = $row['quan_huyen'];
        $_SESSION['phuong_xa'] = $row['phuong_xa'];
        $_SESSION['role'] = "admin";
        header("location:adminhome.php");
      }
    }else{
      // Account is locked error
      $loginError = true;
      $errorMessage = "Tài khoản đã bị khóa";
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
  display: -ms-flexbox; 
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
  border: 2px soild #fff;
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
</style>
</head>
<body>

<div class="container">
<h2>ĐĂNG NHẬP</h2>
<form action="signIn.php" method="post" style="max-width:500px;margin:auto">

  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Tên đăng nhập" name="tenDangNhap" required>
  </div>
  
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Mật khẩu" name="password" required>
  </div>
  <input type="submit" value="Đăng nhập" name="signIn">
  <div class="links">
    <p> Chưa có tài khoản? </p>
    <a href="../view/signUp.php">Đăng ký</a>
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
        <a href="signIn.php">Thử lại</a>
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