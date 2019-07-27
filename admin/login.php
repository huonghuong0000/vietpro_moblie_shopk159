<?php
	if(isset($_POST['dang_nhap']))
	{
		//lấy dữ liệu ô input
		$email=$_POST['mail'];
		$password=$_POST['pass'];
		//kiểm tra tài khoản hợp lệ hay không
		$sql = "SELECT * FROM user WHERE user_mail='$email' AND user_pass='$password'";
		$query = mysqli_query($conn, $sql);
		$num = mysqli_num_rows($query);
		if($num > 0){
			$_SESSION['email']=$email;
			$_SESSION['password']=$password;
			//chuyển hướng đến trang admin.php nếu tài khoản chính xác
			// $row = mysqli_fetch_array($query);
			// $_SESSION['email'] = $row['user_mail'];
			// $_SESSION['password'] = $row['user_pass'];
			//        check nút nhớ tài khoản
			if (isset($_POST['remember'])) {
				setcookie('user', $email, time() + (86400*7), '/', '', 0, 0);
				setcookie('pass', $password, time() + (86400*7), '/', '', 0, 0);
			}
	 
			if ($row['user_level'] == 1) {
				$_SESSION['level'] = $row['user_level'];
				header('location: admin.php');
			} else {
				header('location: index.php');
			}
		} else {
			echo "<script>alert('ten sai');</script>";
		}
	}
	else{
		$error = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vietpro Mobile Shop - Administrator</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Vietpro Mobile Shop - Administrator</div>
				<div class="panel-body">

					<?php if(isset($thongbao)) { ?>
						<div class="alert alert-danger"><?php echo $thongbao ?></div>

					<?php }?>


					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input required class="form-control" placeholder="E-mail" name="mail" type="email" value="<?php if(isset($_COOKIE['user'])){echo $_COOKIE['user'];} ?>" autofocus>
							</div>
							<div class="form-group">
								<input required  class="form-control" placeholder="Mật khẩu" name="pass" type="password" value="<?php if(isset($_COOKIE['pass'])){echo $_COOKIE['pass'];} ?>">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="<?php if(isset($_COOKIE['user'])&&($_COOKIE['pass'])){echo 'checked';} ?>">Nhớ tài khoản
								</label>
							</div>
							<button name='dang_nhap' type="submit" class="btn btn-primary">Đăng nhập</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</body>

</html>
