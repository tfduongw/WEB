<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phân Trang Đơn Giản</title>
    <style>
        .pagination {
    display: flex;
    justify-content: center;
    list-style: none;
    padding: 0;
    margin-bottom: 20px;
    align-items: center;
}

.pagination li {
    margin: 5px;
}

.pagination a {
    text-decoration: none;
    padding: 12px 18px;
    color: white;
    background-color: #f37319;
    border-radius: 15px;  
    font-weight: bold;
    margin-right: 8px;
    margin-left: 8px;
    transition: background-color 0.3s ease, transform 0.2s ease;  
}

.pagination a:hover {
    background-color: #e55d17;  
    color: white;
    transform: scale(1.1); 
}

.pagination a:active {
    background-color: #d14d12; 
    transform: scale(1); 
}

.pagination .current-page {
    background-color:rgb(255, 81, 0);  
    color: white;
    padding: 12px 18px;
    border-radius: 15px;
    font-weight: bold;
    margin-right: 8px;
    margin-left: 8px;
}


    </style>
</head>
<body> 
<div class="pagination">
    
<?php
$param="";
if($search){
    $param ="name=".$search."&";
}
if (!empty($maLoaiSP)) {
    $param .= "MaLoaiSP=" . (int)$maLoaiSP . "&";
}


if ($current_page > 3) {
    $first_page = 1;
    ?>
    <a class="page-item" href="?<?=$param ?>per_page=<?=$item_perpage?>&page=<?=$first_page?>">First</a>
    <?php 
}
?>

<?php

if ($current_page > 1) {
    $prev_page = $current_page - 1;
    ?>
    <a class="page-item" href="?<?=$param ?>per_page=<?=$item_perpage?>&page=<?=$prev_page?>"><<</a>
    <?php
}
?>

<?php for ($num = 1; $num <= $totalPages; $num++) { ?>
    <?php if ($num != $current_page) { ?>
        <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
            <a class="page-item" href="?<?=$param ?>per_page=<?=$item_perpage?>&page=<?=$num?>"><?=$num?></a>
        <?php } ?>
    <?php } else { ?>
        <strong class="current-page page-item"><?=$num?></strong>
    <?php } ?>
<?php } ?>

<?php
if ($current_page < $totalPages - 1) {
    $next_page = $current_page + 1;
    ?>
    <a class="page-item" href="?<?=$param ?>per_page=<?=$item_perpage?>&page=<?=$next_page?>">>></a>
    <?php
}
?>

<?php
if ($current_page < $totalPages - 3) {
    $end_page = $totalPages;
    ?>
    <a class="page-item" href="?<?=$param ?>per_page=<?=$item_perpage?>&page=<?=$end_page?>">Last</a>
    <?php
}
?>
</div>

</body>
</html>
