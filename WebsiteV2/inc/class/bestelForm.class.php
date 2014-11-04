<?php
/**
 * Created by PhpStorm.
 * User: Sergen Nurel
 * Date: 4-11-2014
 * Time: 13:29
 */

if (isset($_POST['bes_submit'])){
    $_SESSION['bes'][$_GET['id']] = $_POST['bes_aantal'];
}