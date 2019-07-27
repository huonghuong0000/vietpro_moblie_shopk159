<script>
    function xacThucXoa(){
        var conf = confirm("Bạn có chắc chắn xóa sản phẩm này hay ko?");
        return conf;
    }
</script>

<?php
if(!defined('TEMPLATE')){
	die('Bạn không có quyền truy cập vào file này !');
}

if(isset($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page = 1;
}

$rowPerPage = 10;
$keyStart = $page*$rowPerPage - $rowPerPage;
$totalRow = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM comment"));
$totalPage = ceil($totalRow/$rowPerPage);

$listPage = '';
$prePage = $page - 1;
if($prePage <= 0){
    $prePage = 1;
}
$listPage .= '<li class="page-item"><a class="page-link" 
href="index.php?page_layout=comment&page='.$prePage.'">&laquo;</a></li>';

for($i = 1; $i <= $totalPage; $i++){
    if($i == $page){
        $active = 'active';
    }
    else{
        $active = '';
    }
    $listPage .= '<li class="page-item '.$active.'"><a class="page-link" 
    href="index.php?page_layout=comment&page='.$i.'">'.$i.'</a></li>';
}

$nextPage = $page + 1;
if($nextPage > $totalPage){
    $nextPage = $totalPage;
}
$listPage .= '<li class="page-item"><a class="page-link" 
href="index.php?page_layout=comment&page='.$nextPage.'">&raquo;</a></li>';
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Danh sách bình luận</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách bình luận</h1>
        </div>
    </div><!--/.row-->
    <!-- <div id="toolbar" class="btn-group">
        <a href="index.php?page_layout=add_user" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm bình luận
        </a>
    </div> -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table 
                        data-toolbar="#toolbar"
                        data-toggle="table">

                        <thead>
                        <tr>
                            <th data-field="id" data-sortable="true">ID</th>
                            <th data-field="name"  data-sortable="true">Họ & tên</th>
                            <th data-field="price" data-sortable="true">Email</th>
                            <th>Ngày bình luận</th>
                            <th>Chi tiết bình luận</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // $keyStart,$rowPerPage
						$sql = "SELECT * FROM comment WHERE prd_id ORDER BY comm_id ASC LIMIT $keyStart, $rowPerPage";
						$query = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_array($query)){
						?>
                            <tr>
                                <td style=""><?php echo $row['comm_id'];?></td>
                                <td style=""><?php echo $row['comm_name'];?></td>
                                <td style=""><?php echo $row['comm_mail'];?></td>
                                <td style=""><?php echo $row['comm_date'];?></td>
                                <td style=""><?php echo $row['comm_details'];?></td>
                                <td class="form-group">
                                    <a href="index.php?page_layout=edit_comment&comm_id=<?php echo $row['comm_id'];?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a onclick="return xacThucXoa();" href="del_comment.php?comm_id=<?php echo $row['comm_id'];?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                </td>
                            </tr>
						<?php
						}
						?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                        <?php echo $listPage;?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div><!--/.row-->	
</div>	<!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>
