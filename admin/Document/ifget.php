<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if (!file_exists('../PROTTY.KEY')){
    header('location:../Install.php');
}
if (empty($_GET)){
    require_once EXE . 'Delivery' . EXP . 'login.html';
    exit;
}
?>