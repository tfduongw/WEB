<?php
$id=$_GET['thisid'];
$from=$_GET['from'];
$to=$_GET['to'];

include "../../model/thuvien.php";
$conn = ketnoidb();
$sql="SELECT * FROM nguoidung WHERE id_nguoidung='$id'";
$result=mysqLi_query($conn,$sql);
while($row=mysqLi_fetch_array($result)){
    $ten=$row['tenNguoiDung'];
    $email=$row['email'];
    $sdt=$row['sdt'];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="../assets/img/DMTD-Food-Logo.jpg"
      type="image/x-icon"
    />
    <title>DMTD FOOD</title>
  </head>
  <body>
    <div class="ThongTin">
      <div class="content">
        <div class="KhachHang">
          <h2 style="color: #f37319">
            Chi tiết các món ăn đã đặt - <?php echo $ten; ?>
          </h2>
          <p><b>Tên khách hàng:</b> <?php echo $ten; ?></p>
          <p><b>Email:</b> <?php echo $email; ?></p>
          <p><b>Số điện thoại:</b> <?php echo $sdt; ?></p>
        </div>
        <div class="oders">
          <?php
          $sql="SELECT * FROM hoadon WHERE IdNguoiDung='$id' and NgayDatHang>='$from' and NgayDatHang<='$to'and TrangThai='3' ORDER BY TongTien DESC";
         $result=mysqLi_query($conn,$sql);
         while($row=mysqLi_fetch_array($result)){
          $idhd=$row['IdHoaDon'];
          ?>
                    <h3 style="color: #f37319">Đơn hàng <?php echo "#".$row['IdHoaDon'];?>( <?php echo $row['NgayDatHang']  ?>)</h3>
                    <table class="food-table">
            <thead>
              <tr>
                <th>Tên món ăn</th>
                <th>Hình ảnh</th>
                <th>Giá (VNĐ)</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
              </tr>
            </thead>
            <tbody>
            <tr>
             <?php 
             $sql1="SELECT * FROM chitiethoadon c,sanpham s WHERE s.MaSP=c.MaSP and IdHoaDon='$idhd' ";
             $result1=mysqLi_query($conn,$sql1);
             $count=0;
             while($row1=mysqLi_fetch_array($result1)){
              ?>
              <tr>
             <td><?php echo $row1['TenSP'];  ?></td>
             <td><img src="../img/product/<?php echo $row1['HinhAnh']?>" alt=""></td>
             <td><?php echo number_format($row1['DonGia'],0,'','.');  ?></td>
             <td><?php echo $row1['SoLuong'];  ?></td>
             <td><?php echo number_format($row1['DonGia']*$row1['SoLuong'],0,'','.');
             $count+=$row1['DonGia']*$row1['SoLuong'];
             ?></td>
              </tr>
            <?php }
             ?>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4"><b>Tổng tiền:</b></td>
                <td><b><?php echo number_format($count,0,'','.'); ?></b></td>
              </tr>
            </tfoot>
          </table>
      

<?php         } 
          ?>
          
        </div>
        <div class="goback">
        <button onclick="window.history.back()">Quay lại</button>
        </div>
      </div>
    </div>
  </body>
</html>
<style>
    body {
  font-family: Arial, sans-serif;
  background-color: #f7f9fc;
  margin: 0;
  padding: 0;
  width: 100vw;
  height: 100vh;
}
.ThongTin {
  background-color: white;
  max-width: 80%;
  margin: 20px auto;
  border-radius: 8px;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  display: flex;
  justify-content: center;
}
.content {
  height: 100%;
  width: 90%;
}
.KhachHang {
  margin-top: 50px;
  display: block;
}
.oders p {
  font-size: 16px;
  margin: 5px 0;
}
.food-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
  margin-bottom: 30px;
}
thead {
  background-color: #f37319;
  color: white;
}
.food-table tr td,
.food-table tr th {
  border: 1px solid #ddd;
  text-align: center;
  padding: 10px;
}
.goback {
  width: 100%;
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
}
.goback button {
  color: white;
  background-color: gray;
  font-size: 16px;
  padding: 5px;
  border-radius: 5px;
  border: 2px solid black;
}
.goback button:hover {
  background-color: #f37319;
}
td img {
  height: 100px;
  width: 100px;
}
@media (max-width: 520px) {
  .ThongTin {
    background-color: white;
    max-width: 100%;
    margin: 0;
    border-radius: 0;
    display: flex;
    justify-content: center;
  }
  td img {
    height: 50px;
    width: 50px;
  }
  td {
    font-size: small;
  }
}
@media (max-width: 372px) {
  .food-table {
    font-size: x-small;
  }
}

</style>
