<?php 
if(!defined("TEMPLATE"))
{
    header("location:index.php");
}

$comm_id = $_GET['comm_id'];
$sql = "SELECT * FROM comment WHERE comm_id=$comm_id";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);

if(isset($_POST['sbm'])){
    $comm_name = $_POST['comm_name'];
    $comm_mail = $_POST['comm_mail'];
    $comm_date = $_POST['comm_date'];
    $comm_details = $_POST['comm_details'];

    $sql = "UPDATE comment 
            SET  comm_name='$comm_name', comm_mail='$comm_mail',
                comm_date='$comm_date', comm_details='$comm_details'
            WHERE comm_id=$comm_id ";
    mysqli_query($conn, $sql);
    header('location: index.php?page_layout=comment');
}
?>

<script src="ckeditor/ckeditor.js"></script>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="">Quản lý bình luận</a></li>
            <li class="active"><?php echo $row['comm_name'];?></li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Họ & tên: <?php echo $row['comm_name'];?></h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">
                        <form role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Họ & tên</label>
                                <input type="text" name="comm_name" required class="form-control" value="<?php echo $row['comm_name'];?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="comm_mail" required value="<?php echo $row['comm_mail'];?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Ngày bình luận</label>
                                <input type="text" name="comm_date" required value="<?php echo $row['comm_date'];?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Chi tiết bình luận</label>
                                <textarea name="comm_details" required class="form-control" rows="3"><?php echo $row['comm_details'];?></textarea>
                                <script>
                                    CKEDITOR.replace('comm_details');
                                </script>
                            </div>
                            <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->

</div>
<!--/.main-->