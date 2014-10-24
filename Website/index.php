<?php
session_start();
$con = mysqli_connect('localhost','root','','EatIt');

if (mysqli_connect_errno()){
    die('Could not make connection with the database!');
}

include('inc/template/header.php');

if (isset($_GET['p'])) {
    $dir = 'inc/template/' . $_GET['p'] . '.php';
    if (is_file($dir)) {
        include($dir);
    }else{
        include('inc/template/body.php');
    }
}else{
    include('inc/template/body.php');
}

include('inc/template/footer.php');
?>