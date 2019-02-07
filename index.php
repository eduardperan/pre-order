<?php 
session_start();
if (!isset($_SESSION['log_in'])) {
    require('view/vw_login.php');
} else {
    header('Location:order.php');
    exit();
}
?>