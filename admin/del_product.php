<?php
session_start();
define("TEMPLATE",true);
include_once('../config/connect.php');
if(isset($_SESSION['email']) && isset($_SESSION['password']))
{
    $prd_id = $_GET['prd_id'];
    $sql = "DELETE FROM product WHERE prd_id=$prd_id";
    $query = mysqli_query($conn, $sql);
    header('location: index.php?page_layout=product');
}
else
{
    header('location: index.php');
}
?>