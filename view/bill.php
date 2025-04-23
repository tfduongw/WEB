<?php
include_once('../model/thuvien.php');
$conn = ketnoidb();
$isLoggedIn = isset($_SESSION['tenDangNhap']);

if($isLoggedIn){
  $email = $_SESSION['email']; 
}else{
    echo "không có dữ liệu";
}
if(!isset($_SESSION['hoadon'])){
    $_SESSION['hoadon']=[];
} 

$timIdNguoiIDung = "SELECT id_nguoidung FROM nguoidung where email = '$email'";
$result = $conn->query($timIdNguoiIDung);

$IdNguoiDung = 0;
if($result && $result->num_rows > 0){
    $row = mysqli_fetch_array($result);
    $IdNguoiDung = $row['id_nguoidung'];
}

if($IdNguoiDung > 0){
    // Sắp xếp theo NgayDatHang giảm dần (mới nhất lên đầu)
    $sql = "SELECT * FROM hoadon where IdNguoiDung = '$IdNguoiDung' ORDER BY NgayDatHang DESC";
    $kq = $conn->query($sql);
    if($kq && $kq->num_rows > 0){
        // Xóa mảng hóa đơn cũ trước khi thêm dữ liệu mới
        $_SESSION['hoadon'] = [];
        
        // Sử dụng $kq thay vì $result
        while($row = mysqli_fetch_array($kq)){
            $IdHoaDon = $row["IdHoaDon"];
            $hoTen = $row['HoTen'];
            $sdt = $row['sdt'];
            $diaChi = $row['DiaChi'];
            $quan_huyen = $row['quan_huyen'];
            $phuong_xa = $row['phuong_xa'];
            $NgayDatHang = $row["NgayDatHang"];
            $TongTien = $row["TongTien"];
            $ThanhToan = $row["PhuongThucTT"];
            $TrangThai = $row["TrangThai"];
            $_SESSION['hoadon'][] = [$IdHoaDon,$hoTen,$sdt,$diaChi,$quan_huyen,$phuong_xa,$NgayDatHang,$TongTien,$ThanhToan,$TrangThai];
        }
    } else {
        // Không có đơn hàng, đảm bảo mảng rỗng
        $_SESSION['hoadon'] = [];
    }
}else{
    echo "<script> alert('Không thành công') </script>";
}

// Hàm chuyển đổi giá trị số sang text cho phương thức thanh toán
function getPhuongThucThanhToan($value) {
    switch ($value) {
        case 1:
            return "Tiền mặt";
        case 2:
            return "Chuyển khoản";
        default:
            return "Không xác định";
    }
}

// Hàm chuyển đổi giá trị số sang text cho trạng thái đơn hàng
function getTrangThaiDonHang($value) {
    switch ($value) {
        case 1:
            return "<span class='status-pending'>Chưa xác nhận</span>";
        case 2:
            return "<span class='status-confirmed'>Đã xác nhận</span>";
        case 3:
            return "<span class='status-delivered'>Đã giao</span>";
        case 4:
            return "<span class='status-cancelled'>Đã hủy</span>";
        default:
            return "Không xác định";
    }
}

// Hàm định dạng ngày tháng năm
function formatDate($dateString) {
    $date = new DateTime($dateString);
    return $date->format('d/m/Y');
}

include "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng của tôi</title>
    <style>
        /* Main Bill Page Styling */
        .bill-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 15px;
            font-family: 'Arial', sans-serif;
        }

        .page-title {
            color: #f37419;
            text-align: center;
            margin: 30px 0;
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Table Styling */
        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .order-table th {
            background-color: rgba(243, 116, 25, 0.88);
            color: #fff;
            padding: 15px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
        }

        .order-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            color: #333;
            font-size: 14px;
        }

        .order-table tr:hover {
            background-color: rgba(243, 116, 25, 0.1);
        }

        /* Order number link styling */
        .order-link {
            color: #f37419;
            text-decoration: none;
            font-weight: bold;
        }

        .order-link:hover {
            text-decoration: underline;
        }

        /* Empty order styling */
        .empty-row td {
            padding: 30px;
            text-align: center;
            color: #888;
            font-style: italic;
        }

        /* Button Styling */
        .button-container {
            display: flex;
            justify-content: center;
            margin: 30px 0;
        }

        .shop-button {
            padding: 12px 24px;
            background-color: #f37419;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
            text-transform: uppercase;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .shop-button:hover {
            background-color: #ff8c3a;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Status color coding */
        .status-pending {
            color: #ffaa00;
            font-weight: bold;
        }

        .status-confirmed {
            color: #2196F3;
            font-weight: bold;
        }

        .status-delivered {
            color: #4CAF50;
            font-weight: bold;
        }

        .status-cancelled {
            color: #F44336;
            font-weight: bold;
        }

        /* Responsive design */
        @media screen and (max-width: 768px) {
            .order-table th, 
            .order-table td {
                padding: 10px 5px;
                font-size: 12px;
            }
            
            .page-title {
                font-size: 22px;
            }
            
            /* Stack table on mobile */
            .order-table {
                display: block;
                overflow-x: auto;
            }
        }

        @media screen and (max-width: 480px) {
            .shop-button {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="bill-container">
        <h2 class="page-title">ĐƠN HÀNG CỦA TÔI</h2>
        
        <?php if(count($_SESSION['hoadon']) > 0): ?>
            <table class="order-table">
                <tr>
                    <th>Đơn hàng</th>
                    <th>Ngày</th>
                    <th>Địa chỉ</th>
                    <th>Giá trị đơn hàng</th>
                    <th>Hình thức thanh toán</th>
                    <th>Trạng thái đơn hàng</th>
                </tr>
                <?php 
                for ($i = 0; $i < count($_SESSION['hoadon']); $i++): 
                    $hoadon = $_SESSION['hoadon'][$i];
                    $ptttText = getPhuongThucThanhToan($hoadon[8]); // Chuyển đổi giá trị phương thức thanh toán
                    $trangThaiText = getTrangThaiDonHang($hoadon[9]); // Chuyển đổi giá trị trạng thái
                    $formattedDate = formatDate($hoadon[6]); // Định dạng ngày tháng
                ?>
                    <tr>
                        <td>
                            <a href="../view/chitiethoadon.php?mahoadon=<?=$hoadon[0]?>" class="order-link">
                                #<?= $hoadon[0] ?>
                            </a>
                        </td>
                        <td><?= $formattedDate ?></td>
                        <td><?= $hoadon[3] . ', ' . $hoadon[4] . ', ' . $hoadon[5] ?></td>
                        <td><?= number_format($hoadon[7], 0, ',', '.') ?>₫</td>
                        <td><?= $ptttText ?></td>
                        <td><?= $trangThaiText ?></td>
                    </tr>
                <?php endfor; ?>
            </table>
            
            <div class="button-container">
                <button type="button" class="shop-button" onclick="window.location.href='../controller/index.php'">Tiếp tục mua sắm</button>
            </div>
            
        <?php else: ?>
            <table class="order-table">
                <thead>
                <tr>
                    <th>Đơn hàng</th>
                    <th>Ngày</th>
                    <th>Địa chỉ</th>
                    <th>Giá trị đơn hàng</th>
                    <th>Hình thức thanh toán</th>
                    <th>Trạng thái đơn hàng</th>
                </tr>
                </thead>
                <tbody>
                <tr class="empty-row">
                    <td colspan="6">Không có đơn hàng</td>
                </tr>
                </tbody>
            </table>    
            
            <div class="button-container">
                <button type="button" class="shop-button" onclick="window.location.href='../controller/index.php'">Tiếp tục mua sắm</button>
            </div> 
        <?php endif; ?>
    </div>
<?php include "footer.php"; ?>   
</body>
</html>