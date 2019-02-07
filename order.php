<?php 
session_start();
if (!isset($_SESSION['log_in'])) {
    header('Location:index.php');
    exit();
}
require('view/vw_order.php');


