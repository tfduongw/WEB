<!DOCTYPE html>
<html lang="en">
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
      <div class="content">
        <p class="time"></p>
        <div class="TieuDe">
          <h3 style="margin-left: 10px">Danh sách tài khoản</h3>
        </div>
        <div class="list">
          <div class="search">
            <div class="Themmoi">
              <a href="Themmoinguoidung.php"
                ><button
                  style="
                    background-color: #f37319;
                    padding: 5px;
                    color: white;
                    border: none;
                    cursor: pointer;
                  "
                >
                  Thêm mới
                </button></a
              >
            </div>
          </div>
          <div class="Table">
            <table class="listPage">
              <tr>
                <th>ID</th>
                <th>Tên tài khoản</th>
                <th>Tên đăng nhập</th>
                <th>Email</th>
                <th>Password</th>
                <th>SĐT</th>
                <th>Ngày tạo</th>
                <th>Địa chỉ</th>
                <th>Tính năng</th>
              </tr>
            <?php 
                                include "../../model/thuvien.php";
                                $conn = ketnoidb();
                                if (!$conn) {
                                  die("Lỗi: Không thể kết nối MySQL.");
                                }
                                $sql="SELECT * FROM nguoidung";
                                $result = mysqLi_query($conn,$sql);
                                while($row=mysqli_fetch_array($result)){
                                    ?>
                                 <tr class="list_user">
                        <td class="id_nd"><?php echo $row['id_nguoidung'];?></td>
                        <td><?php echo $row['tenNguoiDung'];?></td>
                        <td><?php echo $row['tenDangNhap'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['password'];?></td>
                        <td><?php echo $row['sdt'];?></td>
                        <td> <?php 
                        $a=explode(" ",$row['ngay_tao']);
                        echo $a[0];
                        
                        ?></td>
                        <td><?php echo $row['diaChi']." ".$row['phuong_xa']." ".$row['quan_huyen'];?></td>
                       <td> 
                        <a href="Xoanguoidung.php?this_id=<?php echo $row['id_nguoidung']; ?>&this_tt=<?php echo $row['TrangThai']; ?>"; class="chucnang" ><?php 
                        if($row['TrangThai']==1){
                          echo "<i class='fa-solid fa-lock'></i>";
                        }
                        else{
                          echo "<i class='fa-solid fa-lock-open'></i>";
                        }
                        ?></a>
                    <a href="Chinhsuatk.php?this_id=<?php echo $row['id_nguoidung']; ?>"class="chucnang"><i class="fa-solid fa-pen"></i></a></td>
                       

                                 </tr>
                               <?php } ?>
            
            </table>
          </div>
          <div class="foot">
            <button>Return</button>
            <button style="background-color: #f37319">1</button>
            <button style="background-color: white">2</button>
            <button>Next</button>
          </div>
        </div>
      </div>
    </div>
    <script>
      function thoigian() {
        const today = new Date();

        // Lấy ngày, tháng, năm
        let day = today.getDate();
        let month = today.getMonth() + 1; // Tháng bắt đầu từ 0
        const year = today.getFullYear();

        // Lấy giờ, phút, giây
        let hours = today.getHours();
        let minutes = today.getMinutes();
        let seconds = today.getSeconds();

        // Định dạng 2 chữ số
        day = day < 10 ? `0${day}` : day;
        month = month < 10 ? `0${month}` : month;
        hours = hours < 10 ? `0${hours}` : hours;
        minutes = minutes < 10 ? `0${minutes}` : minutes;
        seconds = seconds < 10 ? `0${seconds}` : seconds;

        // Gắn nội dung vào phần tử HTML
        const time = document.querySelector(".time");
        if (time) {
          time.innerHTML = `Ngày ${day} tháng ${month} năm ${year}, ${hours} giờ ${minutes} phút ${seconds} giây`;
        }
      } 
      setInterval(thoigian, 1);
    </script>
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
  </body>
</html>
<script>
let thispage = 1;
let limit = 6;
let list = document.querySelectorAll('.list_user');

function loadItem() {
  let begin = limit * (thispage - 1);
  let end = limit * thispage - 1;

  list.forEach((item, key) => {
    if (key >= begin && key <= end) {
      item.style.display = 'table-row';
    } else {
      item.style.display = 'none';
    }
  });
  listpage();
}

function listpage() {
  let count = Math.ceil(list.length / limit);
  let listPage = document.querySelector('.foot');

  listPage.innerHTML = '';

  if (thispage != 1) {
    let prev = document.createElement('button');
    prev.innerText = 'PREV';
    prev.setAttribute('onclick', `changePage(${thispage - 1})`);
    listPage.appendChild(prev);
  }

  for (let i = 1; i <= count; i++) {
    let newPage = document.createElement('button');
    newPage.innerText = i;
    if (i == thispage) {
      newPage.style.backgroundColor = '#f37319';
    } else {
      newPage.style.backgroundColor = 'white';
    }
    newPage.setAttribute('onclick', `changePage(${i})`);
    listPage.appendChild(newPage);
  }

  if (thispage != count) {
    let next = document.createElement('button');
    next.innerText = 'NEXT';
    next.setAttribute('onclick', `changePage(${thispage + 1})`);
    listPage.appendChild(next);
  }
}

function changePage(i) {
  thispage = i;
  loadItem();
}

loadItem();

</script>