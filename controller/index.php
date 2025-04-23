<?php
session_start();
// KT USER ĐĂNG NHẬP CHƯA
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

if(!isset($_SESSION['giohang'])){
    $_SESSION['giohang']=[];
}
?>

<?php
include_once('../model/thuvien.php');
$conn = ketnoidb();

if(isset($_GET['act'])){
    switch($_GET['act']){
        case 'cart':
            if(isset($_POST['addcart'])){
                if(!$isLoggedIn){
                   $showLoginModal = true;
                   if($showLoginModal) {
                    echo '<script>
                        document.addEventListener("DOMContentLoaded", function() {
                            showLoginModal("../view/signIn.php");
                        });
                    </script>';
                    }
                }else{
                    $id = $_POST['id'];
                    $hinh=$_POST['hinh'];
                    $tensp=$_POST['tensp'];
                    $gia=$_POST['gia'];
                    $soluong = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

                    $fl=0; //kiem tra sp co trung trong gio hang khong?

                    for ($i=0; $i < sizeof($_SESSION['giohang']); $i++) { 
                        if($_SESSION['giohang'][$i][2]==$tensp){
                            $fl=1;
                            $soluongnew=$soluong + $_SESSION['giohang'][$i][4];
                            $_SESSION['giohang'][$i][4]=$soluongnew;
                            break;
                        } 
                    }
                    
                    //neu khong trung sp trong gio hang thi them moi
                    if($fl==0){
                        //them moi sp vao gio hang
                        $sp=[$id,$hinh,$tensp,$gia,$soluong];
                        $_SESSION['giohang'][]=$sp;
                    }
                }
            }
            include "../view/home.php";
            break;
        case 'thanhtoan':
            if(isset($_POST['thanhtoan'])){
                $tenNguoiDung = $_POST['tenNguoiDung'];
                $email = $_POST['email'];
                $sdt = $_POST['sdt'];
                $diaChi = $_POST['diaChi'];
                $quan_huyen = $_POST['quan_huyen'];
                $phuong_xa = $_POST['phuong_xa'];
                $pttt = $_POST['pttt'];
                $tongTien = $_POST['tongTien'];

                $idHoaDon = 0;
    
                $timIdNguoiIDung = "SELECT id_nguoidung FROM nguoidung where email = '$email'";
                $result = $conn->query($timIdNguoiIDung);
                
                if($result && $result->num_rows>0){
                    $row = mysqli_fetch_array($result);
                    $idNguoiDung = $row['id_nguoidung'];
                    addhoadon($idNguoiDung,$tenNguoiDung,$email,$sdt,$diaChi,$quan_huyen,$phuong_xa,$pttt,$tongTien);
        
                    // Lấy ID hóa đơn vừa thêm
                    $sql = "SELECT IdHoaDon FROM hoadon 
                            WHERE email = '$email' AND sdt = '$sdt' 
                            ORDER BY NgayDatHang DESC LIMIT 1";
                    $result = $conn->query($sql);
                    
                    if($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $idHoaDon = $row['IdHoaDon'];
                    }
                }else{
                    $idNguoiDung = 0;
                }

                if($idHoaDon > 0 && $idNguoiDung > 0) {
                    addchitietdonhang($idHoaDon, $_SESSION['giohang']);
                    foreach($_SESSION['giohang'] as $product){
                        $idsp = $product[0]; // ID sản phẩm
                        $soLuong = $product[4]; // Số lượng đặt
                        $sql_update = "UPDATE sanpham SET SoLuongBan = SoLuongBan + $soLuong WHERE MaSP = $idsp";
                        mysqli_query($conn, $sql_update);
                    }
                    unset($_SESSION['giohang']); // Xóa giỏ hàng

                    $_SESSION['order_success'] = true;
                    header("Location: ../controller/index.php");
                    exit();
                }else{
                    echo "<script> alert ('Không thêm được giá trị idNguoiDung và idHoaDon'); </script>";
                }
            }
            include "../view/home.php";
            break;
        case 'xemhoadon':
            include "../view/bill.php";
            break;    
        default:
            include "../view/home.php";
            break;
    }  
} else {
    include "../view/home.php";
}
?>

