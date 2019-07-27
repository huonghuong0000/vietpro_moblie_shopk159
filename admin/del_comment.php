<?php
session_start();
define("TEMPLATE",true);
include_once('../config/connect.php');
if(isset($_SESSION['email']) && isset($_SESSION['password']))
{
    $comm_id = $_GET['comm_id'];
    $sql = "DELETE FROM comment WHERE comm_id=$comm_id";
    $query = mysqli_query($conn, $sql);
    header('location: index.php?page_layout=comment');
}
else
{
    header('location: index.php');
}
?>