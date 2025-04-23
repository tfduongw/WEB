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
      <div class="form_date">
<div class="date_con">
          <h1>Thống kê khách hàng</h1>
                <form action="thongke.php">
<div class='in'>
    <p>Chọn mốc thời gian</p>
                            <label for="from">Từ:</label>
                            <input type="date" name="from" id="from">
                            <label for="to">Đến:</label>
                            <input type="date" name="to" id="to">
</div>
                  <input type="submit" value="Gửi" class="btn">
                </form>
</div>

      </div>
</body>
</html>
<style>
.form_date {
    display: flex;
    justify-content: center;
    align-items: start;
    margin-top: 50px;
}
.date_con {
    width: 50%;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #e9e9e9;
    border: 1px solid;
}
form {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
    height: 80%;
}
.in {
    display: flex;
    align-items: center;
    gap: 10px;
   width: 100%;
   height: 20%;
}
label {
    width: 50px;
    text-align: right;
}
input[type="date"] {
    width: 150px;
    height: 35px;
    padding: 5px;
}
.btn{
    padding:10px 30px;
    font-size:larger;
}
.btn:hover{
    background-color: orange;
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
      // Xử lý sự kiện thay đổi trạng thái checkbox
    </script>