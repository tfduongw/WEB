<?php
function ketnoidb(){
    $serve= "localhost";
    $user = "root";
    $password = "";
    $database = "web";

    $conn= new mysqli($serve,$user,$password,$database);
    
    if($conn->connect_error){
        die("Ket noi that bai:" . $conn->connect_error);
      }

    return $conn;
}

function upLoadSanPham() {
    // Kết nối database
    $conn = ketnoidb();
  
    // Truy vấn dữ liệu với phân trang
    // $item_perpage= !empty($_GET['per_page']) ? $_GET['per_page']:4;
    // $current_page=!empty($_GET['per_page']) ? $_GET['per_page']:1;
    // $offset=($current_page-1) * $item_perpage;
    $sql = "SELECT * FROM sanpham  ORDER BY MaSP ";
    // $totalRecords= mysqli_query($conn,"SELECT * FROM sanpham");
    // $totalRecords=$totalRecords->num_rows;
    // $totalPages=ceil($totalRecords/$item_perpage);
    $result = mysqli_query($conn, $sql);
  
    if (!$result) {
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }
  
    // Tạo mảng chứa sản phẩm
    $products = [];
    while ($pro = mysqli_fetch_assoc($result)) {
        $products[] = $pro; // Thêm sản phẩm vào mảng
    }
  
    mysqli_close($conn);
    return $products; // Trả về mảng sản phẩm
  }


  function addhoadon($idNguoiDung,$tenNguoiDung,$email,$sdt,$diaChi,$quan_huyen,$phuong_xa,$pttt,$tongTien){
    $conn = ketnoidb();

    $insertQuery = "INSERT INTO hoadon(IdNguoiDung,HoTen,email,sdt,DiaChi,quan_huyen,phuong_xa,NgayDatHang,TongTien,PhuongThucTT)
    VALUE('$idNguoiDung','$tenNguoiDung','$email','$sdt','$diaChi','$quan_huyen','$phuong_xa',NOW(),'$tongTien','$pttt')";

  return $conn->query($insertQuery);
}

function addchitietdonhang($idHoaDon,$giohang){
  $conn = ketnoidb();
  $success = true;

  foreach($giohang as $item){
    $MaSP = $item[0];
    $DonGia = $item[3];
    $SoLuong = $item[4];

     $insertQuery = "INSERT INTO chitiethoadon(IdHoaDon,MaSP,SoLuong,DonGia)
     VALUE('$idHoaDon','$MaSP','$SoLuong','$DonGia')";
     
     if(!$conn->query($insertQuery)){
      $success = false;
    }
  }
  return $success;
}

?>