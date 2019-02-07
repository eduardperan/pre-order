<?php
header('Content-Type: application/json');
session_start();
require_once '../model/Database.php';
require_once '../model/Customer.php';
require_once '../model/Category.php';
require_once '../model/Item.php';

if ( isset($_REQUEST['login']) ) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $customer = new Customer($email, $password);
    if ($customer->login()){
        $_SESSION['log_in'] = true;
        $_SESSION['customer'] = ["id" => $customer->id];
        echo json_encode($customer);
    }else{
        $_SESSION['log_in'] = false;
        echo json_encode(false);
    }
}

if ( isset($_REQUEST['register']) ) {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $customer = new Customer($email, $password);
    $customer->id = $id;
    $customer->fname = $fname;
    $customer->lname = $lname;

    if ($customer->register()){
        echo json_encode($customer);
    }else{
        echo json_encode(false);
    }
}

if ( isset($_REQUEST['getallitems']) ) {
    $db = new Database();
    $categories = [];
    $db->connect();
    $query = $db->db_con->prepare('select * from tblcategory');
    $query->execute();
    //$count = $query->rowCount();                      
    $res_c = $query->fetchAll();

    foreach($res_c as $category) {
        $category = new Category($category['id'], $category['name']);
        $query = $db->db_con->prepare('select * from tblitem where cat_id=?');
        $query->execute(array($category->id));
        $res_i = $query->fetchAll();
        foreach($res_i as $item) {
            $item = new Item($item['id'], $item['name'], $item['cat_id']);
            array_push($category->items, $item);
        }
        array_push($categories, $category);
    }
    echo json_encode($categories);
    $db->db_con = null;
}

if ( isset($_REQUEST['chkifexst'])) {
    $db = new Database();
    $db->connect();
    try {
        $query = $db->db_con->prepare("select tblsub.cus_id, tblorder.* from tblorder inner join tblsub on tblorder.sub_id = tblsub.id where tblsub.cus_id=? and tblorder.date=?");
        $query->execute(array($_SESSION['customer']['id'], date("Y-m-d")));
        $count = $query->rowCount();   
        if ($count > 0) {
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    } catch(PDOException $e){
        //echo json_encode($e->getMessage());
        echo json_encode(false);
    }
    $db->db_con = null;
}

if ( isset($_REQUEST['chkiflte'])) {
    date_default_timezone_set("Asia/Manila");
    if (date('H:i:s') > date('H:i:s', mktime(23, 30, 0, date('m'), date('d'), date('Y')))) {
        echo json_encode(true);
    }else{
        echo json_encode(false);
    }
}

if ( isset($_REQUEST['scsid']) ) {
    $db = new Database();
    $subid = $_POST['subid'];
    $db->connect();
    try {
        $query = $db->db_con->prepare("insert into tblsub(id, cus_id) values(?,?)");
        $query->execute(array($subid, $_SESSION['customer']['id']));
        $count = $query->rowCount();   
        if ($count > 0) {
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    } catch(PDOException $e){
        //echo json_encode($e->getMessage());
        echo json_encode(false);
    }
    $db->db_con = null;
}

if ( isset($_REQUEST['ssitems']) ) {
    $db = new Database();
    $queryStr = $_POST['querystr'];
    $db->connect();
    try {
        $db->db_con->exec($queryStr);
        echo json_encode(true);
    } catch(PDOException $e){
        //echo json_encode($e->getMessage());
        echo json_encode(false);
    }
    $db->db_con = null;
}

if ( isset($_REQUEST['preorder']) ) {
    $db = new Database();
    $subid = $_POST['subid'];
    $date = $_POST['date'];
    $db->connect();
    try{
        $query = $db->db_con->prepare("insert into tblorder(sub_id, date) values(?,?)");
        $query->execute(array($subid, $date));
        echo json_encode(true);
    } catch(PDOException $e){
        //echo json_encode($e->getMessage());
        echo json_encode(false);
    }
    $db->db_con = null;
}

if ( isset($_REQUEST['getsubid']) ) {
    $db = new Database();
    $db->connect();
    try{
        $query = $db->db_con->prepare('select tblorder.sub_id, tblsub.cus_id from tblorder inner join tblsub on tblorder.sub_id = tblsub.id where tblsub.cus_id=?');
        $query->execute(array($_SESSION['customer']['id']));
        $res = $query->fetch(PDO::FETCH_ASSOC);
        echo $res['sub_id'] === null || $res['sub_id'] === 'null'? json_encode(false) : json_encode($res['sub_id']);
    } catch(PDOException $e){
        //echo json_encode($e->getMessage());
        echo json_encode(false);
    }
    $db->db_con = null;
}

if ( isset($_REQUEST['orddetails']) ) {
    $db = new Database();
    $db->connect();
    $items = [];
    $subid = $_GET['subid'];

    try{
        $query = $db->db_con->prepare('select tblsubitem.sub_id, tblitem.* from tblsubitem inner join tblitem on (tblsubitem.item_id = tblitem.id) where sub_id=?');
        $query->execute(array($subid));
        $res = $query->fetchAll();
        foreach($res as $item) {
            $item = ["id" => $item['id'], "name" => $item['name'], "cat_id" => $item['cat_id'], "sub_id" => $item['sub_id']];
            array_push($items, $item);
        }
        echo json_encode($items);
    } catch(PDOException $e){
        //echo json_encode($e->getMessage());
        echo json_encode(false);
    }
    $db->db_con = null;
}

if ( isset($_REQUEST['logout']) ){
    session_destroy();
    header('Location:../index.php');
}


