<?php
include("../class/Auth.php");
$auth = new Auth();
$act = $_GET['action'];
if ($act == 'register'){
    $auth->register($_POST['username'],$_POST['password'],$_POST['cPassword'],$_POST['email']);
}else if ($act == 'login'){
    $auth->login($_POST['username'],$_POST['password'],$_POST['cPassword']);
}else if($act == 'logout'){
    $auth->logout();
}
?>