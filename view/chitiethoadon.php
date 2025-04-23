<?php
session_start();
include_once('../model/thuvien.php');
$conn = ketnoidb();
$isLoggedIn = isset($_SESSION['tenDangNhap']);

if($isLoggedIn){
  $email = $_SESSION['email']; 
}else{
    echo "không có dữ liệu";
    exit();
}

// Lấy mã hóa đơn từ URL
$maHoaDon = isset($_GET['mahoadon']) ? $_GET['mahoadon'] : 0;

if($maHoaDon <= 0) {
    echo "Không tìm thấy đơn hàng";
    exit();
}

// Lấy thông tin hóa đơn
$sql = "SELECT * FROM hoadon WHERE IdHoaDon = '$maHoaDon'";
$result = $conn->query($sql);

if(!$result || $result->num_rows == 0) {
    echo "Không tìm thấy thông tin đơn hàng";
    exit();
}

$hoaDon = $result->fetch_assoc();
$idNguoiDung = $hoaDon['IdNguoiDung'];
$hoTen = $hoaDon['HoTen'];
$sdt = $hoaDon['sdt'];
$diaChi = $hoaDon['DiaChi'];
$quan_huyen = $hoaDon['quan_huyen'];
$phuong_xa = $hoaDon['phuong_xa'];
$ngayDatHang = $hoaDon['NgayDatHang'];
$tongTien = $hoaDon['TongTien'];
$phuongThucTT = $hoaDon['PhuongThucTT'];
$trangThai = $hoaDon['TrangThai']; 

// Lấy thông tin chi tiết đơn hàng
$sql = "SELECT c.*, s.TenSP, s.HinhAnh, s.MaSP FROM chitiethoadon c 
        JOIN sanpham s ON c.MaSP = s.MaSP
        WHERE c.IdHoaDon = '$maHoaDon'";
$result = $conn->query($sql);

$chiTietDonHang = [];
if($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $chiTietDonHang[] = $row;
    }
}

// Hàm chuyển đổi trạng thái thanh toán
function getTrangThaiThanhToan($value) {
    switch ($value) {
        case 1:
            return "<span class='status-value not-paid'>Chưa thanh toán</span>";
        case 2:
            return "<span class='status-value paid'>Đã thanh toán</span>";
        default:
            return "Không xác định";
    }
}

// Hàm chuyển đổi phương thức thanh toán
function getPhuongThucThanhToan($value) {
    switch ($value) {
        case 1:
            return "Thanh toán khi giao hàng (COD)";
        case 2:
            return "Chuyển khoản ngân hàng";
        default:
            return "Không xác định";
    }
}

// Hàm định dạng ngày tháng năm
function formatDate($dateString) {
    $date = new DateTime($dateString);
    return $date->format('d/m/Y H:i');
}

// Tính tổng tiền hàng (không bao gồm phí vận chuyển)
$tongTienHang = 0;
foreach($chiTietDonHang as $item) {
    $tongTienHang += $item['DonGia'] * $item['SoLuong'];
}

// Tính phí vận chuyển (giả sử)
$phiVanChuyen = 0; // Có thể thay đổi nếu có thông tin phí vận chuyển
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="shortcut icon"
      href="../view/img/DMTD-Food-Logo.jpg"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="../view/css/style.css" />
    <title>DMTD FOOD</title>
    <style>
        /* Main style for order details page */
        .order-details-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            color: #333;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            font-family: 'Arial', sans-serif;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f37419;
        }

        .order-header h1 {
            color: #000;
            font-size: 24px;
            margin: 0;
        }

        .order-date {
            color: #666;
            font-size: 14px;
        }

        /* Section styling */
        .section {
            margin-bottom: 30px;
        }

        .section-title {
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 16px;
            color: #f37419;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
        }

        .info-box {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 20px;
            background-color: #f9f9f9;
            line-height: 1.6;
        }

        .customer-name {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 5px;
            color: #333;
        }

        /* Product table styling */
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        .product-table th {
            text-align: left;
            padding: 15px;
            background-color: rgba(243, 116, 25, 0.88);
            color: #fff;
            font-weight: bold;
        }

        .product-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .product-table tr:last-child td {
            border-bottom: none;
        }

        .product-table tr:hover {
            background-color: rgba(243, 116, 25, 0.05);
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border: 1px solid #eee;
            border-radius: 4px;
        }

        .product-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .product-code {
            color: #666;
            font-size: 14px;
        }

        /* Summary table styling */
        .summary-table {
            width: 100%;
            max-width: 400px;
            margin-left: auto;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .summary-table td {
            padding: 8px 15px;
            border-bottom: 1px solid #eee;
        }

        .summary-table tr:last-child td {
            border-bottom: none;
        }

        .summary-table .subtotal-row {
            color: #666;
        }

        .summary-table .shipping-row {
            color: #666;
        }

        .summary-table .total-row {
            font-weight: bold;
            font-size: 18px;
            font-weight: 25px;
            color: #000;
        }

        .text-right {
            text-align: right;
        }

        /* Button styling */
        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            margin-bottom: 20px;
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
            text-decoration: none;
        }

        .shop-button:hover {
            background-color: #ff8c3a;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Responsive design */
        @media screen and (max-width: 768px) {
            .status-container {
                flex-direction: column;
            }
            
            .status-item {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .product-table th, 
            .product-table td {
                padding: 10px 5px;
                font-size: 14px;
            }
            
            .product-image {
                width: 60px;
                height: 60px;
            }
            
            .order-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .order-header h1 {
                margin-bottom: 10px;
            }
        }

        @media screen and (max-width: 480px) {
            .product-flex {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .product-details {
                margin-left: 0;
                margin-top: 10px;
            }
            
            .shop-button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <?php include_once('../view/header.php'); ?>

    <div class="order-details-container">
        <div class="order-header">
            <h1>Chi tiết đơn hàng #<?php echo $maHoaDon; ?></h1>
            <div class="order-date">Ngày đặt hàng: <?php echo formatDate($ngayDatHang); ?></div>
        </div>

        <div class="section">
            <div class="section-title">ĐỊA CHỈ GIAO HÀNG</div>
            <div class="info-box">
                <div class="customer-name"><?php echo $hoTen; ?></div>
                <div>Địa chỉ: <?php echo $diaChi . ', ' . $phuong_xa . ', ' . $quan_huyen; ?></div>
                <div>Số điện thoại: <?php echo $sdt; ?></div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">PHƯƠNG THỨC THANH TOÁN</div>
            <div class="info-box">
                <?php echo getPhuongThucThanhToan($phuongThucTT); ?>
            </div>
        </div>

        <div class="section">
            <div class="section-title">CHI TIẾT ĐƠN HÀNG</div>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($chiTietDonHang as $item): ?>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center;" class="product-flex">
                                <img src="../view/img/product/<?php echo $item['HinhAnh']; ?>" class="product-image" alt="<?php echo $item['TenSP']; ?>">
                                <div style="margin-left: 15px;" class="product-details">
                                    <div class="product-name"><?php echo $item['TenSP']; ?></div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo number_format($item['DonGia'], 0, ',', '.'); ?>₫</td>
                        <td><?php echo $item['SoLuong']; ?></td>
                        <td><?php echo number_format($item['DonGia'] * $item['SoLuong'], 0, ',', '.'); ?>₫</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <table class="summary-table">
                <tr class="subtotal-row">
                    <td>Tổng tiền hàng</td>
                    <td class="text-right"><?php echo number_format($tongTienHang, 0, ',', '.'); ?>₫</td>
                </tr>
                <?php if($phiVanChuyen > 0): ?>
                <tr class="shipping-row">
                    <td>Phí vận chuyển</td>
                    <td class="text-right"><?php echo number_format($phiVanChuyen, 0, ',', '.'); ?>₫</td>
                </tr>
                <?php endif; ?>
                <tr class="total-row">
                    <td>Tổng thanh toán</td>
                    <td class="text-right"><?php echo number_format($tongTien, 0, ',', '.'); ?>₫</td>
                </tr>
            </table>
        </div>

        <div class="button-container">
            <a href="../controller/index.php" class="shop-button">Tiếp tục mua sắm</a>
        </div>
    </div>

    <?php include_once('../view/footer.php'); ?>
</body>
</html>