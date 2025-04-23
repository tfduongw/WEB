<?php
$tenDangNhap = '';

if(isset($isLoggedIn) && $isLoggedIn){
  $tenDangNhap = $_SESSION['tenDangNhap']; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../view/js/modal.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
    <link
      rel="shortcut icon"
      href="../view/img/DMTD-Food-Logo.jpg"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="../view/css/style.css" />
    <title>DMTD FOOD</title>
    <style>
      
/* Action dropdown styling */
.action .item {
  position: relative;
  display: inline-block;
}

/* Hide dropdown by default */
.action .item .item_menu {
  display: none;
  position: absolute;
  background-color: #fff;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  right: 0;
  border-radius: 4px;
  padding: 8px 0;
  margin-top: 5px;
}

/* Only show dropdown on hover for the user icon */
.action .item:has(.fa-regular.fa-user):hover .item_menu {
  display: block;
}

/* Remove default list styling */
.action .item_menu li {
  list-style: none;
}

/* Style menu links to prevent wrapping */
.action .item_menu li a {
  color: #333;
  padding: 10px 16px;
  text-decoration: none;
  display: block;
  margin: 0;
  font-size: 16px;
  transition: all 0.3s ease;
  white-space: nowrap; /* Prevent text from wrapping */
}

.action .item_menu li a:hover {
  color: #f37319;
}

/* Add a small arrow to indicate dropdown only for user icon */
.action .item:has(.fa-regular.fa-user) > a::after {
  content: '';
  display: inline-block;
  margin-left: 5px;
  width: 0;
  height: 0;
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 4px solid #000;
  vertical-align: middle;
}

/* User name styling if logged in */
.action .item span {
  margin-left: 5px;
  font-size: 14px;
  font-weight: 500;
}

/* Add a triangle pointer to the dropdown */
.action .item_menu::before {
  content: '';
  position: absolute;
  top: -8px;
  right: 10px;
  width: 0;
  height: 0;
  border-left: 8px solid transparent;
  border-right: 8px solid transparent;
  border-bottom: 8px solid #fff;
}

.search-btn {
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px; 
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .search-btn i {
        font-size: 18px;
        color: #333; 
    }

    .search-btn:focus {
        outline: none;
    }
    .overlay {
  display: none;
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0, 0, 0, 0.5);
  z-index: 1000;
}

.advanced-popup {
  display: none;
  position: fixed;
  top: 50%; left: 50%;
  transform: translate(-50%, -50%);
  background: #fff;
  padding: 20px 30px;
  border-radius: 10px;
  z-index: 1001;
  width: 90%;
  max-width: 400px;
  box-shadow: 0 0 15px rgba(0,0,0,0.2);
}

.popup-content h3 {
  margin-top: 0;
  text-align: center;
}

.close-btn {
  position: absolute;
  top: 10px; right: 15px;
  font-size: 40px;
  cursor: pointer;
  color: #888;
}

.advanced-popup form input[type="text"],
.advanced-popup form select {
    font-size: 16px; 
    padding: 10px;
    margin: 10px 0; 
    width: 100%; 
    border: 1px solid #ccc; 
    border-radius: 5px; 
    box-sizing: border-box;
}

/* Tăng kích thước cho nút tìm kiếm */
.advanced-popup form button[type="submit"] {
    font-size: 18px; /* Tăng kích thước font chữ */
    padding: 12px 20px; /* Tăng kích thước nút */
    border-radius: 5px; /* Bo góc cho nút */
    cursor: pointer;
    background-color: #f37319;
    color: white;
    border: none;
}

/* Tăng kích thước cho label */
.advanced-popup form label {
    font-size: 18px; /* Tăng kích thước font chữ của nhãn */
    font-weight: bold; /* Đậm chữ cho nhãn */
}

/* Đảm bảo khoảng cách hợp lý giữa các phần tử */
.advanced-popup form {
    gap: 20px; /* Thêm khoảng cách giữa các phần tử */
    display: flex;
    flex-direction: column;
}


</style>
</head>
<body>
<div class="header-banner">60 phút - Giao ngay tận nơi</div>
    <!-- header  -->
    <header class="header-top">
      <div class="container">
      <div class="logo">
  <a href="#" class="logo-img"><img height="70" src="../view/img/DMTD-Food-Logo.jpg" alt="Logo"/></a>
  <span><b>DMTD FOOD</b></span>
</div>

<!-- Thêm thanh tìm kiếm giống như trong home.php -->
<form id="product-search" method="GET" action="../controller/index.php">
  <div class="box">
    <input type="text" placeholder="Tìm kiếm thức ăn" name="search" 
           value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />
    <button type="submit" class="search-btn">
        <i class="fa-solid fa-magnifying-glass"></i>
    </button>
    <button type="button" class="search-btn" onclick="openAdvancedSearch()" title="Tìm kiếm nâng cao">
        <i class="fa-solid fa-sliders"></i>
    </button>
  </div>
</form>

<!-- Lớp phủ mờ nền -->
<div id="overlay" class="overlay" onclick="closeAdvancedSearch()"></div>

<!-- Popup tìm kiếm nâng cao -->
<div id="advanced-popup" class="advanced-popup">
  <div class="popup-content">
    <span class="close-btn" onclick="closeAdvancedSearch()">&times;</span>
    <h3>Tìm kiếm nâng cao</h3>
    <form method="GET" action="../controller/index.php" style="display: flex; flex-direction: column; gap: 10px;">
      <label>Tên sản phẩm:</label>
      <input type="text" name="search" placeholder="Tìm theo tên sản phẩm" 
             value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
      <label>Danh mục:</label>
      <select name="MaLoaiSP">
        <option value="0">-- Tất cả --</option>
        <option value="1" <?= (isset($_GET['MaLoaiSP']) && $_GET['MaLoaiSP'] == 1) ? 'selected' : '' ?>>Món mặn</option>
        <option value="2" <?= (isset($_GET['MaLoaiSP']) && $_GET['MaLoaiSP'] == 2) ? 'selected' : '' ?>>Món chay</option>
        <option value="3" <?= (isset($_GET['MaLoaiSP']) && $_GET['MaLoaiSP'] == 3) ? 'selected' : '' ?>>Món lẩu</option>
        <option value="4" <?= (isset($_GET['MaLoaiSP']) && $_GET['MaLoaiSP'] == 4) ? 'selected' : '' ?>>Nước uống</option>
      </select>

      <label>Khoảng giá:</label>
      <input type="range" name="min_price" id="min_price" min="0" max="500000" step="10000"
             value="<?= isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0 ?>" oninput="updatePriceLabel()">
      <input type="range" name="max_price" id="max_price" min="0" max="500000" step="10000"
             value="<?= isset($_GET['max_price']) ? (int)$_GET['max_price'] : 500000 ?>" oninput="updatePriceLabel()">
      <div id="priceLabel" style="font-weight:bold;"></div>

      <button type="submit" class="search-btn" style="background: #f37319; color: white; padding: 8px; border-radius: 5px;">
        Tìm kiếm
      </button>
    </form>
  </div>
</div>
        <div class="action">
          <div class="item">
            <a href="#"><i class="fa-regular fa-user"></i></a>
            <?php if(isset($isLoggedIn) && $isLoggedIn): ?>
              <span><?php echo $tenDangNhap; ?></span>
            <?php endif; ?>
            <ul class="item_menu">
              <?php if(isset($isLoggedIn) && $isLoggedIn): ?>
                <li class="heder_item_user">
                  <a href="../view/info.php">Thông tin cá nhân</a>
                </li>
                <li class="heder_item_user">
                  <a href="../controller/index.php?act=xemhoadon">Xem hóa đơn</a>
                </li>
                <li class="heder_item_user">
                  <a href="../view/logOut.php">Đăng xuất</a>
                </li>
              <?php else: ?>
                <li class="heder_item_user">
                  <a href="../view/signIn.php">Đăng nhập</a>
                </li>
                <li class="heder_item_user">
                  <a href="../view/signUp.php">Đăng ký</a>
                </li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="item">
            <a href="../view/cart.php"
              ><i class="fa-solid fa-cart-shopping"></i
            ></a>
          </div>
        </div>
      </div>
    </header>
    <!-- header  -->
    <nav>
  <ul>
    <li><a href="../controller/index.php">Trang chủ</a></li>
    <li><a href="../controller/index.php?MaLoaiSP=1">Món mặn</a></li>
    <li><a href="../controller/index.php?MaLoaiSP=2">Món chay</a></li>
    <li><a href="../controller/index.php?MaLoaiSP=3">Món lẩu</a></li>
    <li><a href="../controller/index.php?MaLoaiSP=4">Nước uống</a></li>
  </ul>
</nav>

<script>
    function openAdvancedSearch() {
    document.getElementById("overlay").style.display = "block";
    document.getElementById("advanced-popup").style.display = "block";
    updatePriceLabel();
  }

  function closeAdvancedSearch() {
    document.getElementById("overlay").style.display = "none";
    document.getElementById("advanced-popup").style.display = "none";
  }

  function updatePriceLabel() {
    const min = document.getElementById("min_price").value;
    const max = document.getElementById("max_price").value;
    document.getElementById("priceLabel").innerText =
      `Từ ${Number(min).toLocaleString()} đ đến ${Number(max).toLocaleString()} đ`;
  }

</script>