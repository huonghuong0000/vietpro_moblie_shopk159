<?php  
// lấy 6 sản phẩm mới nhất trong CSDL
$sql = "SELECT * FROM product ORDER BY prd_id DESC LIMIT 6";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);
?>

<!--	Lastest Product	-->
<div class="products">
    <h3>Sản phẩm mới</h3>
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
            <a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id'];?>"><img src="admin/img/products/<?php echo $row['prd_image']; ?>"></a>
            <h4><a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id'];?>"><?php echo $row['prd_name']; ?></a></h4>
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
<!--	End Lastest Product	-->