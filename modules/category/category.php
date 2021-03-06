<?php 
$cat_id = $_GET['cat_id'];
$cat_name = $_GET['cat_name'];

//phân trang
if(isset($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page = 1;
}

$rowPerPage = 6;
$keyStart = $page*$rowPerPage - $rowPerPage;
$totalRow = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product WHERE cat_id=$cat_id ORDER BY prd_id"));
$totalPage = ceil($totalRow/$rowPerPage);

$listPage = '';
$prePage = $page - 1;
if($prePage <= 0){
    $prePage = 1;
}
$listPage .= '<li class="page-item"><a class="page-link" 
href="index.php?page_layout=category&cat_id='.$cat_id.'&cat_name='.$cat_name.'&page='.$prePage.'">&laquo;</a></li>';

for($i = 1; $i <= $totalPage; $i++){
    if($i == $page){
        $active = 'active';
    }
    else{
        $active = '';
    }
    $listPage .= '<li class="page-item '.$active.'"><a class="page-link" 
    href="index.php?page_layout=category&cat_id='.$cat_id.'&cat_name='.$cat_name.'&page='.$i.'">'.$i.'</a></li>';
}

$nextPage = $page + 1;
if($nextPage > $totalPage){
    $nextPage = $totalPage;
}
$listPage .= '<li class="page-item"><a class="page-link" 
href="index.php?page_layout=category&cat_id='.$cat_id.'&cat_name='.$cat_name.'&page='.$nextPage.'">&raquo;</a></li>';
//
$sql = "SELECT * FROM product WHERE cat_id=$cat_id 
ORDER BY prd_id DESC LIMIT $keyStart,$rowPerPage";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);
?>

<!--	List Product	-->
<div class="products">
    <h3><?php echo $cat_name; ?> (hiện có <?php echo $num; ?> sản phẩm)</h3>
    <?php 
    /* $i là đại diện cho 1 item sản phẩm, 1 dòng card-deck có i chạy
    từ 1 đến 3, khởi tạo và kiểm tra $i tại 1 và 3 */
    $i=1;
    while($row = mysqli_fetch_array($query)){
        if($i==1){
            echo '<div class="product-list card-deck">';
        }
    ?>
        <div class="product-item card text-center">
            <a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>"><img src="admin/img/products/<?php echo $row['prd_image']; ?>"></a>
            <h4><a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>"><?php echo $row['prd_name']; ?></a></h4>
            <p>Giá Bán: <span><?php echo number_format($row['prd_price'], 0,'','.'); ?>đ</span></p>
        </div>
    <?php   
        if($i==3){
            $i = 1;
            echo '</div>';
        }
        else {
            $i++;
        } 
    }
    // kiểm tra nếu sản phẩm không chia hết cho 3, viết ngoài vòng lặp while
    if($num % 3 != 0){
        echo '</div>';
    }
    ?>
</div>
<!--	End List Product	-->

<div id="pagination">
    <ul class="pagination">
        <?php echo $listPage;?>
    </ul>
</div>