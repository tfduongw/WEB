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
    <link rel="stylesheet" href="../css/admin/index.css" />
    <link rel="stylesheet" href="../css/admin/admin.order.css" />
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
          <?php
            include "../../model/thuvien.php";
            $conn = ketnoidb();
          ?>
          <div class="main-content">
            <form id="formFilter" action="" method="GET">
              <div class="Filter">
              
                <div class="form-group">

                  <select id="filter-district" name="district" onchange="this.form.submit()">  
                    <option selected disabled <?php echo !isset($_GET['district']) ? 'selected' : ''; ?>>Quận/Huyện</option>
                    <?php 
                      $sql3 = "SELECT DISTINCT quan_huyen FROM hoadon";
                      $result3 = mysqli_query($conn, $sql3);
                      $selected_district = isset($_GET['district']) ? $_GET['district'] : '';
                      while($row=mysqLi_fetch_array($result3)){
                        $value = $row["quan_huyen"];
                        $isSelected = ($value == $selected_district) ? 'selected' : '';
                        echo "<option value=\"$value\" $isSelected>$value</option>";
                      }
                    ?>
                  </select>


                  <select id="filter-ward " name="ward" onchange="this.form.submit()">
                    <option selected disabled <?php echo !isset($_GET['ward']) ? 'selected' : ''; ?>>Phường/Xã</option>
                    <?php 
                      $safe_district = mysqli_real_escape_string($conn, $selected_district);

                      $sql4 = "SELECT DISTINCT phuong_xa FROM hoadon WHERE quan_huyen = '$safe_district'";
                      $result4 = mysqli_query($conn, $sql4);

                      $selected_ward = isset($_GET['ward']) ? $_GET['ward'] : '';
                      while($row=mysqLi_fetch_array($result4)){
                        $value = $row["phuong_xa"];
                        $isSelected = ($value == $selected_ward) ? 'selected' : '';
                        echo "<option value=\"$value\" $isSelected>$value</option>";
                      }
                    ?>
                  </select>

                
                  <?php 
                    $status_selected = isset($_GET['status']) ? $_GET['status'] : '';
                  ?>
                  <select id="filter-status" name="status" onchange="this.form.submit()">
                    <option selected disabled>Lọc theo tình trạng</option>
                    <option value = "1" <?php if ($status_selected == '1') echo 'selected'; ?>>Chưa xác nhận</option>
                    <option value="2" <?php if ($status_selected == '2') echo 'selected'; ?>>Đã xác nhận</option>
                    <option value="3" <?php if ($status_selected == '3') echo 'selected'; ?>>Giao thành công</option>
                    <option value="4" <?php if ($status_selected == '4') echo 'selected'; ?>>Hủy đơn</option>
                  </select>
                </div>

                <div class="Date">
                  <div class="start">
                    <label for="time-start">Từ</label>
                    <input type="date" id="time-start" name="start_date" onchange="this.form.submit()" value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>" />
                  </div>
                  <div class="end">
                    <label for="time-end">Đến</label>
                    <input type="date" id="time-end" name="end_date" onchange="this.form.submit()" value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>" />
                  </div>
                </div>
              </div>
            </form> 
            
            <div class="list-order">
              <table>
                <thead>
                  <tr>
                    <td>MÃ ĐƠN</td>
                    <td>KHÁCH HÀNG</td>
                    <td>NGÀY ĐẶT</td>
                    <td>ĐỊA CHỈ</td>
                    <td>TỔNG TIỀN</td>
                    <td>TRẠNG THÁI</td>
                    <td>THAO TÁC</td>
                  </tr>
                </thead>

                <tbody>
                  <?php 

                    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : "";
                    $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : "";

                    $status = isset($_GET['status']) ? $_GET['status'] : "";
                    $district = isset($_GET['district']) ? $_GET['district'] : "";
                    $ward = isset($_GET['ward']) ? $_GET['ward'] : "";

                    $sql = "SELECT * FROM hoadon";
                    if (!empty($start_date) || !empty($end_date) || !empty($status) || !empty($district) || !empty($ward) ) {
                      $conditions = []; 

                      if(!empty($status)) {
                        $conditions[] = "TrangThai = '$status'";
                      }

                      if(!empty($district)) {
                        $conditions[] = "quan_huyen = '$district'";
                      }

                      if(!empty($ward)) {
                        $conditions[] = "phuong_xa = '$ward'";
                      }
                  
                      if (!empty($start_date)) {
                          if (strpos($start_date, ':') === false) {
                              $start_date .= " 00:00:00";  
                          }
                          $conditions[] = "NgayDatHang >= '$start_date'";
                      }
                  
                      if (!empty($end_date)) {
                          if (strpos($end_date, ':') === false) {
                              $end_date .= " 23:59:59";  
                          }
                          $conditions[] = "NgayDatHang <= '$end_date'";
                      }
                      
                      if (!empty($conditions)) {
                          $sql .= " WHERE " . implode(" AND ", $conditions);
                      }
                    }

                    $result = mysqli_query($conn, $sql);

                    while($row = mysqLi_fetch_array($result)){
                      // $sql2 = "SELECT * FROM nguoidung WHERE id_nguoidung=" . $row['MaNguoiDung'];
                      // $result2 = mysqli_query($conn, $sql2);
                      // $nguoidung = mysqLi_fetch_array($result2);
                  ?>
                  <tr>
                    <td><?php echo $row['IdHoaDon'] ?></td>
                    <td><?php echo $row['HoTen']?></td>
                    <td><?php 
                      $datetime = new DateTime($row['NgayDatHang']); 
                      $formatted_date = $datetime->format('d/m/Y'); 
                      echo $formatted_date;
                    ?></td>
                    <td><?php echo $row['DiaChi'] ?></td>
                    <td><?php echo number_format($row['TongTien'], 0, ',', '.') . 'đ'; ?></td>
                    <td>
                      <?php 
                        switch($row['TrangThai']){
                          case 1:
                            echo '<span class="status-btn pending">Chưa xác nhận</span>';
                            break;
                          case 2:
                            echo '<span class="status-btn confirm">Đã xác nhận</span>';
                            break;
                          case 3:
                            echo '<span class="status-btn cancel">Giao thành công</span>';
                            break;
                          case 4:
                            echo '<span class="status-btn success">Hủy đơn</span>';
                            break;
                        }
                      ?>
                    </td>
                    <td class="control">
                      <button>
                        <a
                          href="./admin.order-detail.php?id=<?php echo $row["IdHoaDon"]?>&&status=<?php echo $row["TrangThai"]?>"
                          style="font-size: 14px; color: black"
                          >Chi tiết</a
                        >
                      </button>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
<script>

  const district = document.querySelector("#filter-district");
  const ward = document.querySelector("#filter-ward");
  const form = document.querySelector("#formFilter");
  
  
  district.addEventListener('change', function () {
    const url = new URL(window.location.href);
    const selectedDistrict = this.value;

    url.searchParams.set('district', selectedDistrict);
    url.searchParams.delete("ward");

    window.location.href = url.toString();
  });

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
