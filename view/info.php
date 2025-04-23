<?php
session_start();
include '../model/thuvien.php';

// Kiểm tra đăng nhập
$isLoggedIn = isset($_SESSION['tenDangNhap']);

// Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
if (!$isLoggedIn) {
    header("location: signIn.php");
    exit();
}

// Lấy thông tin người dùng từ session
$tenNguoiDung = $_SESSION['tenNguoiDung'];
$tenDangNhap = $_SESSION['tenDangNhap'];
$email = $_SESSION['email'];
$sdt = $_SESSION['sdt'];
$diaChi = $_SESSION['diaChi'];
$quan_huyen = $_SESSION['quan_huyen'];
$phuong_xa = $_SESSION['phuong_xa'];

// Include header
include 'header.php';
?>

<div class="container" style="max-width: 800px; margin: 40px auto; padding: 30px; box-shadow: 0 3px 15px rgba(0,0,0,0.1); border-radius: 10px; background-color: #fff;">
    <h2 style="text-align: center; color: #2c3e50; margin-bottom: 30px; font-size: 24px; font-weight: 600; position: relative; padding-bottom: 15px;">THÔNG TIN CÁ NHÂN</h2>
    
    <style>
        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: #F37319;
        }
        
        .info-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .info-table th, 
        .info-table td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid #eaeaea;
        }
        
        .info-table tr:last-child th,
        .info-table tr:last-child td {
            border-bottom: none;
        }
        
        .info-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #444;
            width: 30%;
        }
        
        .info-table td {
            background-color: #fff;
        }
        
        .info-table tr:hover td {
            background-color: #f9f9f9;
        }
        
        .btn-back {
            display: inline-block;
            background-color: #F37319;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.3s;
            margin-top: 30px;
        }
        
        .btn-back:hover {
            background-color: #e66700;
        }
    </style>
    
    <table class="info-table">
        <tr>
            <th>Họ và tên</th>
            <td><?php echo $tenNguoiDung; ?></td>
        </tr>
        <tr>
            <th>Tên đăng nhập</th>
            <td><?php echo $tenDangNhap; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo $email; ?></td>
        </tr>
        <tr>
            <th>Số điện thoại</th>
            <td><?php echo $sdt; ?></td>
        </tr>
        <tr>
            <th>Địa chỉ</th>
            <td><?php echo $diaChi; ?></td>
        </tr>
        <tr>
            <th>Quận/Huyện</th>
            <td><?php echo $quan_huyen; ?></td>
        </tr>
        <tr>
            <th>Phường/Xã</th>
            <td><?php echo $phuong_xa; ?></td>
        </tr>
    </table>
    
    <div style="text-align: center;">
        <a href="../controller/index.php" class="btn-back">Quay lại trang chủ</a>
    </div>
</div>

<?php
include 'footer.php';
?>