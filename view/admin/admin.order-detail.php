<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="../css/admin/index.css"/>
    <link rel="stylesheet" href="../css/admin/admin.order-detail.css"/>
    <link
      rel="shortcut icon"
      href="../assets/img/DMTD-Food-Logo.jpg"
      type="image/x-icon"
    />
    <title>DMTD FOOD</title>
  </head>

  <body>
    <div class="classQuanLy">
      <!-- Menu -->
      <div class="menu">
        <i class="fa-solid fa-bars"></i>
        <div class="logo">
          <div>
            <img
              src="../img/DMTD-Food-Logo.jpg"
              alt=""
            />
            <h4 style="white-space: unset">Nguyễn Tấn Dũng</h4>
            Chào mừng bạn trở lại
          </div>
        </div>
        <div class="innermenu">
        <ul>
            <li>
              <a href="chonngay.php" class="menu-1">Thống kê</a>
            </li>
            <li><a href="admin.product.php" class="menu-1">Sản phẩm</a></li>
            <li><a href="admin.order.php" class="menu-1">Đơn hàng</a></li>
            <li>
              <a href="./quanlytk.php" class="menu-1">Tài khoản khách hàng</a>
            </li>
          </ul>
        </div>
      </div>
      <!-- Header -->
      <div class="out">
        <div class="menu-toggle">
          <i class="fa-solid fa-bars"></i>
        </div>
        <a href="index.html" style="color: inherit">
          <div class="out1">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
          </div>
        </a>
      </div>
      <!-- Content -->
      <div class="content">
        <main>
          <div class="title">
            <h2>Chi tiết đơn hàng</h2>
          </div>

          <div class="main-content">

            <?php 
              include "../../model/thuvien.php";
              $conn = ketnoidb();
            ?>

            <div class="bill">
              <div class="order-group">
                <?php 
                  $id = $_GET['id'];
                  $sum = 0;
                  $sql = "SELECT * FROM chitiethoadon WHERE IdHoaDon = $id";
                  $result = mysqli_query($conn, $sql);

                  while($row=mysqLi_fetch_array($result)){
                    $sql2 = "SELECT * FROM sanpham WHERE MaSP = " . $row["MaSP"];
                    $result2 = mysqli_query($conn, $sql2);
                    $row2=mysqLi_fetch_array($result2);
                ?>
                  <div class="order-product">
                    <div class="order-product-detail">
                      <img src="../img/product/<?php echo $row2["HinhAnh"] ?>" alt="<?php echo $row2["TenSP"] ?>" />

                      <div class="info">
                        <h4><?php echo $row2["TenSP"] ?></h4>
                        <p>Không có ghi chú</p>
                        <p class="quantity">SL: <?php echo $row["SoLuong"] ?></p>
                      </div>
                    </div>
                    <div class="order-product-price">
                      <?php $sum = $sum + ($row["SoLuong"] * $row["DonGia"])?>
                      <span><?php echo number_format($row['DonGia'], 0, ',', '.') . 'đ'; ?></span>
                    </div>
                  </div>
                <?php } ?>

              </div>

            </div>

            <div class="description">
              <?php 
                $sql3 = "SELECT * FROM hoadon WHERE IdHoaDon = $id";
                $result3 = mysqli_query($conn, $sql3);
                $row3 = mysqLi_fetch_array($result3);
              ?>
              <ul>
                <li>
                  <span
                    ><i class="fa-regular fa-calendar-days"></i> Ngày đặt hàng
                  </span>
                  <span>
                    <?php 
                      $datetime = new DateTime($row3['NgayDatHang']); 
                      $formatted_date = $datetime->format('d/m/Y'); 
                      echo $formatted_date; 
                    ?>
                  </span>
                </li>
                <li>
                  <span>
                    <i class="fa-solid fa-money-bill-transfer"></i> Phương thức thanh toán
                  </span>
                  <?php 
                    switch($row3["PhuongThucTT"]){
                      case 1:
                        echo "<span> Tiền mặt </span>";
                        break;
                      case 2:
                        echo "<span> Chuyển khoản </span>";
                        break;
                    }
                  ?>
                </li>
                <li>
                  <span><i class="fa-solid fa-person"></i> Người nhận</span>
                  <span><?php echo $row3["HoTen"] ?></span>
                </li>
                <li>
                  <span><i class="fa-solid fa-phone"></i>Số điện thoại</span>
                  <span><?php echo $row3["sdt"] ?></span>
                </li>
                <li>
                  <span><i class="fa-regular fa-clock"></i>Thời gian giao</span>
                  <span>Giao ngay khi xong</span>
                </li>
                <li style="flex-direction: column">
                  <span
                    ><i class="fa-solid fa-location-dot"></i>Địa chỉ nhận</span
                  >
                  <p><?php echo $row3["DiaChi"] . ", " . $row3["phuong_xa"] . ", " . $row3["quan_huyen"] ?></p>
                </li>
                <li style="flex-direction: column">
                  <span><i class="fa-regular fa-note-sticky"></i>Ghi chú</span>
                  <p
                    style="overflow-y: auto; max-height: 80px; margin-top: 1px"
                  >
                    Tới nhớ gọi nha shop
                  </p>
                </li>
              </ul>
            </div>

            <div class="sum">
              <span>Thành tiền</span>
              <span><?php echo number_format($sum, 0, ',', '.') . 'đ'; ?></span>
            </div>
            <form action="" method="GET">
              <div class="changeStatus">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <select class="selectStatus" name="status" onchange="this.form.submit()">
                    <option value="1"  <?php if ($_GET['status'] == '1') echo 'selected'; ?>>Chưa xác nhận</option>
                    <option value="2" <?php if ($_GET['status'] == '2') echo 'selected'; ?>>Đã xác nhận</option>
                    <option value="3" <?php if ($_GET['status'] == '3') echo 'selected'; ?>>Giao thành công</option>
                    <option value="4" <?php if ($_GET['status'] == '4') echo 'selected'; ?>>Hủy đơn</option>
                </select>
                <?php 
                  if(isset($_GET['status'])){
                    $status = intval($_GET['status']);
                    $sql4 = "UPDATE hoadon SET TrangThai = $status WHERE IdHoaDon = $id";
                    $result4 = mysqli_query($conn, $sql4);
                  }
                ?>
              </div>
            </form>
          </div>

          
        </main>
      </div>
    </div>
  </body>
</html>
<script>



  const menu = document.querySelector(".menu");
  const menuToggle = document.querySelector(".menu-toggle i");
  menuToggle.addEventListener("click", function () {
    if (menu instanceof HTMLElement) {
      menu.style.display = "block";
    }
  });
  const menuinput = document.querySelector(".menu i");
  menuinput.addEventListener("click", function () {
    if (menu instanceof HTMLElement) {
      menu.style.display = "none";
    }
  });
  // Xử lý sự kiện thay đổi trạng thái checkbox
</script>
