<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="../view/js/modal.js"></script>
  <title>DMTD FOOD</title>
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


/* Headline */
.headline {
  text-align: center;
  margin: 20px auto;
}

.headline .section-title {
  font-size: 24px;
  font-weight: bold;
  color: #000;
  text-transform: uppercase;
  display: inline-block;
}

.headline .header-underline {
  width: 200px;
  height: 3px;
  background-color: #f37319;
  margin: 5px auto 0;
}

      .products {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start; /* Canh sát trái */
    gap: 20px; /* Khoảng cách giữa các item */
    padding: 0;
    margin: 0;
    list-style: none;
}

      /* product  */

        .box {
        display: flex;
        align-items: center;
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

/* ex  */
.product-popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    z-index: 1001;
    width: 90%;
    max-width: 800px; /* Tăng kích thước tối đa */
    max-height: 90vh; /* Giới hạn chiều cao tối đa */
    overflow-y: auto; /* Cho phép cuộn nếu nội dung dài */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    animation: fadeIn 0.3s ease-in-out;
    font-family: Arial, sans-serif;
}

.product-popup .popup-content {
    position: relative;
    display: flex;
    flex-direction: column;
}

.product-popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    z-index: 1001;
    width: 90%;
    max-width: 600px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    animation: fadeIn 0.3s ease-in-out;
    font-family: Arial, sans-serif;
}

.product-popup .popup-content {
    position: relative;
}

.product-popup .close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 35px;
    height: 35px;
    background-color: #f37319;
    color: #fff;
    font-size: 20px;
    font-weight: bold;
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    z-index: 1002; /* Đảm bảo nút đóng luôn ở trên cùng */
}

.product-popup .close-btn:hover {
    background-color: #d65a00;
    transform: scale(1.1);
}

.product-popup .close-btn:focus {
    outline: none;
}
.product-popup img {
    max-width: 100%;
    border-radius: 10px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Product Detail Layout */
.product-detail-container {
    width: 100%;
    padding: 10px;
    margin: 0 auto;
}

/* Product Detail Layout - Center the image */
.product-detail-content {
    display: flex;
    flex-direction: column;
    align-items: center; /* Center items horizontally */
    gap: 20px;
}

.product-detail-content img {
    display: block;
    max-width: 100%;
    max-height: 300px;
    object-fit: contain; /* Maintains aspect ratio */
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin: 0 auto; /* Center the image with margin auto */
}

/* Make sure the product info is properly aligned */
.product-info {
    text-align: center;
    width: 100%;
}


/* Responsive cho laptop nhỏ và màn hình lớn hơn */
@media screen and (min-width: 768px) {
  .product-detail-content {
        flex-direction: column; /* Keep as column to center the image */
        align-items: center;
    }
    
    .product-detail-content img {
        width: auto; /* Let the max-height control the size */
        max-width: 80%; /* Prevent image from being too wide */
    }

    
    .product-info {
        flex: 1;
        min-width: 45%;
    }
    
    .product-popup {
        width: 80%;
        max-width: 700px;
    }
}

/* Responsive cho màn hình nhỏ và tablet */
@media screen and (max-width: 767px) {
    .product-detail-content {
        gap: 15px;
    }
    
    .product-detail-content img {
        width: 100%;
        max-height: 250px;
        object-fit: cover;
    }
    
    .product-detail-container h2 {
        font-size: 1.3rem;
    }
    
    .product-popup {
        width: 95%;
        padding: 15px;
        max-height: 85vh;
    }
    
    .product-popup .close-btn {
        width: 30px;
        height: 30px;
        font-size: 16px;
    }
}

/* Responsive để sản phẩm hiển thị tốt trên màn hình laptop nhỏ */
@media screen and (min-width: 992px) and (max-width: 1199px) {
    .product-detail-content {
        gap: 15px;
    }
    
    .product-detail-content img {
        width: 40%;
    }
    
    .product-info {
        width: 55%;
    }
    
    .product-popup {
        width: 85%;
        max-width: 800px;
    }
}

/* Định dạng các thành phần bên trong popup */
.product-detail-content img {
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    align-self: center;
}


.product-popup h2 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 15px;
    color: #333;
    text-align: center;
    margin-top: 20px;
}

.product-popup p {
    font-size: 16px;
    line-height: 1.6;
    color: #555;
    margin-bottom: 20px;
    text-align: justify;
}

.product-popup .product-price {
    font-size: 20px;
    font-weight: bold;
    color: #f37319;
    margin-bottom: 20px;
    text-align: center;
}

.product-popup form {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
}

.product-popup form label {
    font-size: 16px;
    font-weight: bold;
    color: #333;
}

.product-popup form input[type="number"] {
    width: 60px;
    padding: 5px;
    font-size: 16px;
    text-align: center;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.product-popup form input[type="submit"] {
    background-color: #f37319;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.product-popup form input[type="submit"]:hover {
    background-color: #d65a00;
}

#product-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    animation: fadeIn 0.3s ease-in-out;
}

/* Animation for popup */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.product-popup img {
    max-width: 100%;
    border-radius: 10px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.product-popup h2 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 15px;
    color: #333;
    text-align: center;
}

.product-popup p {
    font-size: 16px;
    line-height: 1.6;
    color: #555;
    margin-bottom: 20px;
    text-align: justify;
}

.product-popup .product-price {
    font-size: 20px;
    font-weight: bold;
    color: #f37319;
    margin-bottom: 20px;
    text-align: center;
}

.product-popup form {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
}

.product-popup form label {
    font-size: 16px;
    font-weight: bold;
    color: #333;
}

.product-popup form input[type="number"] {
    width: 60px;
    padding: 5px;
    font-size: 16px;
    text-align: center;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.product-popup form input[type="submit"] {
    background-color: #f37319;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.product-popup form input[type="submit"]:hover {
    background-color: #d65a00;
}

#product-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    animation: fadeIn 0.3s ease-in-out;
}

/* Animation for popup */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 1000;
        font-family: 'Roboto', 'Segoe UI', sans-serif;
    }

    .modal-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        max-width: 420px;
        width: 90%;
        text-align: center;
    }

    .success-icon {
        margin-bottom: 20px;
    }

    .modal-title {
        color: #2c3e50;
        margin-bottom: 15px;
        font-size: 24px;
        font-weight: 600;
    }

    .modal-message {
        color: #5d6778;
        margin-bottom: 25px;
        font-size: 16px;
        line-height: 1.5;
    }

    .modal-action {
        margin-top: 5px;
    }

    .close-button {
        background-color: #F37319;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(243, 115, 25, 0.3);
    }

    .close-button:hover {
        background-color: #e06410;
        box-shadow: 0 4px 12px rgba(243, 115, 25, 0.4);
    }

    </style>
</head>
<body>
<?php
$conn = ketnoidb();

// Lấy giá trị tìm kiếm từ tham số GET
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$maLoaiSP = isset($_GET['MaLoaiSP']) ? (int)$_GET['MaLoaiSP'] : 0;

// Xây dựng điều kiện tìm kiếm
$where = "";
if (!empty($search)) {
    $where = "WHERE TenSP LIKE '%$search%'";
}
// gpt
$maLoaiSP = isset($_GET['MaLoaiSP']) ? (int)$_GET['MaLoaiSP'] : 0;
$min_price = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 500000;
if ($min_price > 0 || $max_price < 500000) {
  if (!empty($where)) {
      $where .= " AND DonGia BETWEEN $min_price AND $max_price";
  } else {
      $where = "WHERE DonGia BETWEEN $min_price AND $max_price";
  }
}
// gpt 

// Nếu có lọc theo loại sản phẩm
if ($maLoaiSP > 0) {
    if (!empty($where)) {
        $where .= " AND MaLoaiSP = $maLoaiSP";
    } else {
        $where = "WHERE MaLoaiSP = $maLoaiSP";
    }
}


// Số sản phẩm trên mỗi trang
$item_perpage = !empty($_GET['per_page']) ? (int)$_GET['per_page'] : 8;
$current_page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $item_perpage;

// Truy vấn sản phẩm
$sql = "SELECT * FROM sanpham $where ORDER BY MaSP DESC LIMIT $item_perpage OFFSET $offset";
$result = mysqli_query($conn, $sql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Đếm tổng số sản phẩm phù hợp
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM sanpham $where";
$totalRecordsResult = mysqli_query($conn, $totalRecordsQuery);
$totalRecordsRow = mysqli_fetch_assoc($totalRecordsResult);
$totalRecords = $totalRecordsRow['total'];

// Tính tổng số trang
$totalPages = ceil($totalRecords / $item_perpage);


$categoryTitle = "Khám phá thực đơn của chúng tôi";
if ($maLoaiSP == 1) {
  $categoryTitle = "Món Mặn";
} elseif ($maLoaiSP == 2) {
  $categoryTitle = "Món Chay";
} elseif ($maLoaiSP == 3) {
  $categoryTitle = "Món Lẩu";
} elseif ($maLoaiSP == 4) {
  $categoryTitle = "Nước Uống";
}
?>

<div class="header-banner">60 phút - Giao ngay tận nơi</div>
    <!-- header  -->
    <header class="header-top">
      <div class="container">
        <div class="logo">
          <a href="#" class="logo-img"
            ><img height="70" src="../view/img/DMTD-Food-Logo.jpg" alt="Logo"
          /></a>
          <span><b>DMTD FOOD</b></span>
</div>

<!-- 
//  Tìm kiếm sản phẩm -->
<!-- Thanh tìm kiếm đơn giản -->
<form id="product-search" method="GET">
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
    <form method="GET" style="display: flex; flex-direction: column; gap: 10px;">
    <label>Tên sản phẩm:</label>
      <input type="text" name="search" placeholder="Tìm theo tên sản phẩm" 
             value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
      <label>Danh mục:</label>
      <select name="MaLoaiSP">
        <option value="0">-- Tất cả --</option>
        <option value="1" <?= ($maLoaiSP == 1) ? 'selected' : '' ?>>Món mặn</option>
        <option value="2" <?= ($maLoaiSP == 2) ? 'selected' : '' ?>>Món chay</option>
        <option value="3" <?= ($maLoaiSP == 3) ? 'selected' : '' ?>>Món lẩu</option>
        <option value="4" <?= ($maLoaiSP == 4) ? 'selected' : '' ?>>Nước uống</option>
      </select>

      <label>Khoảng giá:</label>
      <input type="range" name="min_price" id="min_price" min="0" max="500000" step="10000"
             value="<?= $min_price ?>" oninput="updatePriceLabel()">
      <input type="range" name="max_price" id="max_price" min="0" max="500000" step="10000"
             value="<?= $max_price ?>" oninput="updatePriceLabel()">
      <div id="priceLabel" style="font-weight:bold;"></div>

      <button type="submit" class="search-btn" style="background: #f37319; color: white; padding: 8px; border-radius: 5px;">
        Tìm kiếm
      </button>
    </form>
  </div>
</div>


<!-- chi tiết sản phẩm  -->




<!-- Chi tiết sản phẩm  -->


 
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
    <li><a href="index.php">Trang chủ</a></li>
    <li><a href="index.php?MaLoaiSP=1">Món mặn</a></li>
    <li><a href="index.php?MaLoaiSP=2">Món chay</a></li>
    <li><a href="index.php?MaLoaiSP=3">Món lẩu</a></li>
    <li><a href="index.php?MaLoaiSP=4">Nước uống</a></li>
  </ul>
</nav>
<?php
$min_price = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 0;

if (empty($search) && $maLoaiSP == 0 && $min_price == 0 && $max_price == 0): ?>
  <div class="banner">
    <img src="../view/img/White Texture Modern Korean Food Banner.png" alt="banner">
  </div>
<?php endif; ?>

<section>
    <div id="wrapper">
        <div class="headline">
            <div class="section-title">Khám phá thực đơn của chúng tôi</div>
            <div class="header-underline"></div>
        </div>
   
<!-- ex  -->

        <ul class="products">
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="products-item">
              <li>
                <div class="product-top">
                    <a href="javascript:void(0)" class="product-thumb" onclick="openProductDetail(<?= $product['MaSP'] ?>)">
                        <img src="../view/img/product/<?= htmlspecialchars($product['HinhAnh']) ?>" alt="<?= htmlspecialchars($product['TenSP']) ?>">
                    </a>
                </div>
                <div class="product-info">
                    <a href="javascript:void(0)" class="product-name" onclick="openProductDetail(<?= $product['MaSP'] ?>)">
                        <?= htmlspecialchars($product['TenSP']) ?>
                    </a>
                    <div class="product-price">
                        <span class="price"><?= number_format($product['DonGia'], 0, ',', '.') ?><span class="currency">đ</span></span>
                    </div>
                    <form action="index.php?act=cart" method="post">
                        <input type="hidden" name="id" value="<?= $product['MaSP'] ?>">
                        <input type="hidden" name="tensp" value="<?= htmlspecialchars($product['TenSP']) ?>">
                        <input type="hidden" name="gia" value="<?= $product['DonGia'] ?>">
                        <input type="hidden" name="hinh" value="<?= htmlspecialchars($product['HinhAnh']) ?>">
                        <input type="submit" name="addcart" value="Đặt hàng">
                    </form>
                </div>
            </li>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Không có sản phẩm nào!</p>
    <?php endif; ?>
</ul>

<div id="product-detail-popup" class="product-popup">
<span class="close-btn" onclick="closeProductDetail()">&times;</span>
    <div class="popup-content">

        <div id="product-detail-content">
            <!-- Nội dung chi tiết sản phẩm sẽ được tải động -->
        </div>
    </div>
</div>
<div id="product-overlay" class="overlay" onclick="closeProductDetail()"></div>



</div>
<!-- ex  -->

</section>

<?php include "../view/phantrang.php"; ?>
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


  // ex 
  function openProductDetail(productId) {
    // Hiển thị overlay và popup
    document.getElementById("product-overlay").style.display = "block";
    document.getElementById("product-detail-popup").style.display = "block";

    // Gửi yêu cầu AJAX để lấy thông tin chi tiết sản phẩm
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../view/getProductDetail.php?product_id=${productId}`, true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        // Hiển thị nội dung chi tiết sản phẩm trong popup
        document.getElementById("product-detail-content").innerHTML = xhr.responseText;
      } else {
        document.getElementById("product-detail-content").innerHTML = "<p>Không thể tải chi tiết sản phẩm.</p>";
      }
    };
    xhr.send();
  }

  function closeProductDetail() {
    // Ẩn overlay và popup
    document.getElementById("product-overlay").style.display = "none";
    document.getElementById("product-detail-popup").style.display = "none";
  }
</script>

<div id="successModal" class="modal-overlay">
    <div class="modal-container">
        <div class="success-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
        </div>
        <h3 class="modal-title">Đặt hàng thành công!</h3>
        <p class="modal-message">Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đang được xử lý.</p>
        <div class="modal-action">
            <button onclick="closeModal()" class="close-button">Đóng</button>
        </div>
    </div>
</div>

<script>
function showModal() {
    document.getElementById('successModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('successModal').style.display = 'none';
}

// Check for order success flag
<?php if(isset($_SESSION['order_success']) && $_SESSION['order_success']): ?>
    document.addEventListener('DOMContentLoaded', function() {
        showModal();
    });
    <?php unset($_SESSION['order_success']); // Clear the flag ?>
<?php endif; ?>
</script>
<?php include_once('../view/footer.php'); ?>
</body>
</html>
