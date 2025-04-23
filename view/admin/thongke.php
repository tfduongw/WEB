<?php 
$from=@$_GET['from'];
$to=@$_GET['to'];
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DMTD FOOD</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="../css/admin/Quanly.css" />
    <link rel="stylesheet" href="../css/admin/thongke.css" />
    <link
      rel="shortcut icon"
      href="../assets/img/DMTD-Food-Logo.jpg"
      type="image/x-icon"
    />
  </head>
  <body>
    <div class="classQuanLy">
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
      <div class="ThongKe">
        <div class="bang">
          <h1>Top 5 tài khoản mua hàng nhiều nhất từ:<?php echo $from ;?> đến <?php echo $to; ?></h1>
        </div>
        <?php
        include "../../model/thuvien.php";
        $conn = ketnoidb();
        
        $sql="SELECT COUNT(TongTien) as sldon,SUM(TongTien) AS sotien,h.IdNguoiDung as id,n.tenNguoiDung as ten FROM hoadon h,nguoidung n WHERE NgayDatHang>='$from' and NgayDatHang<='$to'and h.IdNguoiDung=n.id_nguoidung and h.TrangThai='3' GROUP BY IdNguoiDung 
ORDER BY sotien DESC 
LIMIT 5";
        $result = mysqLi_query($conn,$sql);
        $i=0;
        if(mysqli_num_rows($result) == 0){
         ?>
         <div class="thongbao"><p>Không có dữ liệu để hiển thị</p></div>
       <?php  }  
        else{
          ?>
        <table border='1'>
          <tr>
            <th>Xếp hạng</th>
            <th>ID người dùng</th>
            <th>Tên Người Dùng</th>
            <th>Số lượng đơn</th>
            <th>Tổng số tiền</th>
            <th>Xem chi tiết</th>
          </tr>

      <?php 

while($row=mysqLi_fetch_array($result)){
  $i++;
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row['id'] ?></td>
    <td><?php echo $row['ten'] ?></td>
    <td><?php echo $row['sldon'] ?></td>
    <td><?php echo number_format($row['sotien'],0,'','.'); ?></td>
    <td>                  <div class="icon-container">
                    <a href="chitietdonhang.php?thisid=<?php echo $row['id']; ?>&from=<?php echo $from; ?>&to=<?php echo $to; ?>"
                      ><i class="fa-solid fa-eye"></i
                    ></a>
                    <div class="tooltip">Chi tiết đơn hàng</div>
                  </div></td>
  </tr>
<?php
}
?>
      </table>

       <?php } ?>
       <div class="back"> <button onclick="window.history.back()">Quay lại</button></div>
       </div>
        

</body>
</html>
<style>
    .back{
    display: flex;
    justify-content: center;
  }
  .back button{
    margin-top:5px;
    padding: 5px;
  }
  .back button:hover{
background-color: orange;
  }
  .thongbao{
    display: flex;
    justify-content: center;
  }
</style>
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
    </script>