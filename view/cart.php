<?php
session_start();
// Xử lý yêu cầu xóa sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove_item"])) {
    $id = $_POST["remove_id"];
    unset($_SESSION['giohang'][$id]);
}

// Xử lý yêu cầu cập nhật số lượng
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_quantity"])) {
    $id = $_POST["product_id"];
    $quantity = (int)$_POST["quantity"];
    
    if ($quantity > 0 && $quantity <= 100) {
        $_SESSION['giohang'][$id][4] = $quantity;
    }
    
    // Trả về dữ liệu cập nhật cho AJAX
    if (isset($_POST["ajax"])) {
        $price = $_SESSION['giohang'][$id][3];
        $total = $price * $quantity;
        echo json_encode([
            'success' => true,
            'total' => number_format($total) . " VND"
        ]);
        exit;
    }
}

$isLoggedIn = isset($_SESSION['tenDangNhap']);

if($isLoggedIn){
  $tenNguoiDung = $_SESSION['tenNguoiDung'];
  $tenDangNhap = $_SESSION['tenDangNhap']; 
  $email = $_SESSION['email']; 
  $password = $_SESSION['password'];
  $sdt = $_SESSION['sdt'];
  $diaChi = $_SESSION['diaChi'];
  $quan_huyen = $_SESSION['quan_huyen'];
  $phuong_xa = $_SESSION['phuong_xa'];
}

include "../view/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DMTD FOOD - Giỏ Hàng</title>
    <link rel="shortcut icon" href="../view/img/DMTD-Food-Logo.jpg" type="image/x-icon" />
    <script>
        function updateTotal(id, price) {
            let quantity = document.getElementById('quantity-' + id).value;
            let totalPrice = parseInt(price) * parseInt(quantity);
            document.getElementById('total-' + id).innerText = totalPrice.toLocaleString() + " VND";
            
            // Cập nhật tổng tiền
            updateGrandTotal();
            
            // Lưu số lượng vào session thông qua AJAX
            updateQuantityInSession(id, quantity);
        }

        function updateQuantityInSession(id, quantity) {
            // Tạo form data cho AJAX request
            const formData = new FormData();
            formData.append('product_id', id);
            formData.append('quantity', quantity);
            formData.append('update_quantity', 'true');
            formData.append('ajax', 'true');
            
            // Gửi AJAX request
            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Đã cập nhật số lượng trong session');
                }
            })
            .catch(error => console.error('Lỗi cập nhật số lượng:', error));
        }

        function updateGrandTotal() {
            let total = 0;
            let totalElements = document.querySelectorAll("[id^='total-']");
            totalElements.forEach(element => {
                total += parseInt(element.innerText.replace(/\D/g, '')); 
            });
            document.getElementById("grand-total").innerText = total.toLocaleString() + " VND";
        }
    </script>
    <style>
        .cart-container {
            max-width: 1200px;
            margin: 20px auto 40px;
            padding: 0 15px;
        }

        /* Page Title Styling */
        .cart-title {
            color: #333;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 25px;
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 2px solid #f37319;
        }

        /* Table Styling */
        .cart-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            background-color: #fff;
        }

        .cart-table th {
            background-color: #f37319;
            color: white;
            font-weight: 600;
            padding: 15px;
            text-align: center;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .cart-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #eee;
            color: #444;
            vertical-align: middle;
        }

        .cart-table tr:last-child td {
            border-bottom: none;
        }

        .cart-table tr:hover td {
            background-color: #fff8f2;
        }

        /* Product Image */
        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.05);
        }

        /* Product Name */
        .product-name {
            font-weight: 500;
            color: #333;
            max-width: 200px;
            margin: 0 auto;
        }

        /* Price styling */
        .price {
            font-weight: 500;
            color: #f37319;
        }

        /* Total Price Styling */
        .item-total {
            font-weight: 600;
            color: #f37319;
        }

        /* Grand Total Row */
        .grand-total-row td {
            background-color: #f9f9f9;
            font-weight: 700;
        }

        .grand-total-label {
            text-align: right;
            color: #333;
            font-size: 16px;
        }

        #grand-total {
            color: #f37319;
            font-size: 18px;
            font-weight: 700;
        }

        /* Empty Cart Message */
        .empty-row td {
            padding: 50px 20px;
            text-align: center;
            font-size: 16px;
            color: #777;
            background-color: #fff;
        }

        .empty-cart-icon {
            font-size: 40px;
            color: #ccc;
            margin-bottom: 15px;
            display: block;
        }

        /* Quantity Input Styling */
        .quantity-input {
            width: 70px;
            padding: 8px 5px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 15px;
            transition: border-color 0.3s;
            background-color: #fff;
        }

        .quantity-input:focus {
            border-color: #f37319;
            outline: none;
            box-shadow: 0 0 0 2px rgba(243, 115, 25, 0.2);
        }

        .quantity-input::-webkit-inner-spin-button,
        .quantity-input::-webkit-outer-spin-button {
            opacity: 1;
            height: 20px;
        }

        /* Delete Button */
        .delete-btn {
            background-color: #f37319;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            font-size: 14px;
            width: auto;
            display: block;
            margin: 0 auto;
        }

        .delete-btn:hover {
            background-color: #ff4500;
            transform: translateY(-2px);
        }

        .delete-btn:active {
            transform: translateY(0);
        }

        /* Action Buttons Container */
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* Action Buttons */
        .cart-btn {
            padding: 12px 25px;
            font-size: 15px;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 180px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .continue-btn {
            background-color: #fff;
            color: #f37319;
            border: 2px solid #f37319;
        }

        .continue-btn:hover {
            background-color: #fff8f2;
            transform: translateY(-2px);
        }

        .checkout-btn {
            background-color: #f37319;
            color: white;
        }

        .checkout-btn:hover {
            background-color: #ff4500;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(243, 115, 25, 0.3);
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .cart-table {
                display: block;
                overflow-x: auto;
            }
            
            .cart-table th, 
            .cart-table td {
                padding: 10px;
            }
            
            .product-image {
                width: 80px;
                height: 80px;
            }
            
            .button-group {
                flex-direction: column;
                gap: 15px;
            }
            
            .cart-btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .cart-title {
                font-size: 24px;
            }
            
            .product-image {
                width: 60px;
                height: 60px;
            }
            
            .quantity-input {
                width: 60px;
            }
            
            .cart-table th, 
            .cart-table td {
                padding: 8px 5px;
                font-size: 14px;
            }
        }
        /* Cart Page Container Styling */
        .cart-container {
            max-width: 1200px;
            margin: 20px auto 40px;
            padding: 0 15px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Page Title Styling */
        .cart-title {
            color: #333;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 25px;
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 2px solid #f37319;
        }

        /* Table Styling */
        .cart-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            background-color: #fff;
        }

        .cart-table th {
            background-color: #f37319;
            color: white;
            font-weight: 600;
            padding: 15px;
            text-align: center;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .cart-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #eee;
            color: #444;
            vertical-align: middle;
        }

        .cart-table tr:last-child td {
            border-bottom: none;
        }

        .cart-table tr:hover td {
            background-color: #fff8f2;
        }

        /* Product Image */
        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.05);
        }

        /* Product Name */
        .product-name {
            font-weight: 500;
            color: #333;
            max-width: 200px;
            margin: 0 auto;
        }

        /* Price styling */
        .price {
            font-weight: 500;
            color: #f37319;
        }

        /* Total Price Styling */
        .item-total {
            font-weight: 600;
            color: #f37319;
        }

        /* Grand Total Row */
        .grand-total-row td {
            background-color: #f9f9f9;
            font-weight: 700;
        }

        .grand-total-label {
            text-align: right;
            color: #333;
            font-size: 16px;
        }

        #grand-total {
            color: #FF0000;
            font-size: 18px;
            font-weight: 700;
        }

        /* Empty Cart Message */
        .empty-row td {
            padding: 50px 20px;
            text-align: center;
            font-size: 16px;
            color: #777;
            background-color: #fff;
        }

        .empty-cart-icon {
            font-size: 40px;
            color: #ccc;
            margin-bottom: 15px;
            display: block;
        }

        /* Quantity Input Styling */
        .quantity-input {
            width: 70px;
            padding: 8px 5px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 15px;
            transition: border-color 0.3s;
            background-color: #fff;
        }

        .quantity-input:focus {
            border-color: #f37319;
            outline: none;
            box-shadow: 0 0 0 2px rgba(243, 115, 25, 0.2);
        }

        .quantity-input::-webkit-inner-spin-button,
        .quantity-input::-webkit-outer-spin-button {
            opacity: 1;
            height: 20px;
        }

        /* Delete Button */
        .delete-btn {
            background-color: #f37319;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            font-size: 14px;
            width: auto;
            display: block;
            margin: 0 auto;
        }

        .delete-btn:hover {
            background-color: #ff4500;
            transform: translateY(-2px);
        }

        .delete-btn:active {
            transform: translateY(0);
        }

        /* Action Buttons Container */
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* Action Buttons */
        .cart-btn {
            padding: 12px 25px;
            font-size: 15px;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 180px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .continue-btn {
            background-color: #fff;
            color: #f37319;
            border: 2px solid #f37319;
        }

        .continue-btn:hover {
            background-color: #fff8f2;
            transform: translateY(-2px);
        }

        .checkout-btn {
            background-color: #f37319;
            color: white;
        }

        .checkout-btn:hover {
            background-color: #ff4500;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(243, 115, 25, 0.3);
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .cart-table {
                display: block;
                overflow-x: auto;
            }
            
            .cart-table th, 
            .cart-table td {
                padding: 10px;
            }
            
            .product-image {
                width: 80px;
                height: 80px;
            }
            
            .button-group {
                flex-direction: column;
                gap: 15px;
            }
            
            .cart-btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .cart-title {
                font-size: 24px;
            }
            
            .product-image {
                width: 60px;
                height: 60px;
            }
            
            .quantity-input {
                width: 60px;
            }
            
            .cart-table th, 
            .cart-table td {
                padding: 8px 5px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <h2 class="cart-title">GIỎ HÀNG CỦA BẠN</h2>
        
        <?php if (empty($_SESSION['giohang'])): ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="empty-row">
                        <td colspan="5">
                            <i class="fa-solid fa-cart-shopping empty-cart-icon"></i>
                            Giỏ hàng của bạn đang trống
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="button-group">
                <button type="button" class="cart-btn continue-btn" onclick="window.location.href='../controller/index.php'">
                    <i class="fa-solid fa-arrow-left"></i> Tiếp tục mua sắm
                </button>
            </div>
        <?php else: ?>     
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $totalAmount = 0; ?>
                    <?php foreach ($_SESSION['giohang'] as $id => $product): ?>
                        <?php $itemTotal = $product[3] * $product[4]; ?>
                        <?php $totalAmount += $itemTotal; ?>
                        <tr>
                            <td class="product-name"><?= $product[2] ?></td>
                            <td>
                                <img class="product-image" src="../view/img/product/<?= $product[1] ?>" alt="<?= $product[2] ?>">
                            </td>
                            <td class="price"><?= number_format($product[3]) ?> VND</td>
                            <td>
                                <input type="number" id="quantity-<?= $id ?>" class="quantity-input" 
                                    value="<?= $product[4] ?>" min="1" max="100" 
                                    onchange="updateTotal('<?= $id ?>', '<?= $product[3] ?>')">
                            </td>
                            <td id="total-<?= $id ?>" class="item-total"><?= number_format($itemTotal) ?> VND</td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="remove_id" value="<?= $id ?>">
                                    <button type="submit" name="remove_item" class="delete-btn">
                                        <i class="fa-solid fa-trash-can"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                    <!-- Hàng tổng tiền -->
                    <tr class="grand-total-row">
                        <td colspan="4" class="grand-total-label"><strong>Tổng tiền:</strong></td>
                        <td id="grand-total"><?= number_format($totalAmount) ?> VND</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            
            <form id="hiddenForm" action="check_order.php" method="post">
                <!-- Đảm bảo giá trị session được gán đúng cách vào các trường input -->
                <input type="hidden" name="tenNguoiDung" value="<?php echo $_SESSION['tenNguoiDung']; ?>">
                <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
                <input type="hidden" name="sdt" value="<?php echo $_SESSION['sdt']; ?>">
                <input type="hidden" name="diaChi" value="<?php echo $_SESSION['diaChi']; ?>">
                <input type="hidden" name="quan_huyen" value="<?php echo $_SESSION['quan_huyen']; ?>">
                <input type="hidden" name="phuong_xa" value="<?php echo $_SESSION['phuong_xa']; ?>">
                
                <!-- Thêm tổng số tiền -->
                <input type="hidden" name="totalAmount" value="<?php echo $totalAmount; ?>">

                <!-- Các nút -->
                <div class="button-group">
                    <button type="button" class="cart-btn continue-btn" onclick="window.location.href='../controller/index.php'">
                        <i class="fa-solid fa-arrow-left"></i> Tiếp tục mua sắm
                    </button>
                    <button type="submit" class="cart-btn checkout-btn">
                        <i class="fa-solid fa-check"></i> Xác nhận đặt hàng
                    </button>
                </div>
            </form>
            
            <script>
                // Cập nhật tổng tiền ban đầu
                updateGrandTotal();
            </script>
        <?php endif; ?>
    </div>
    
    <?php include "../view/footer.php" ?>
</body>
</html>