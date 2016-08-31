<?php
/**
 * @author protty
 * @link www.pder.org
 * @copyright protty 版权所有
 */
if ($_GET['c'] == 'plug') {
    require_once EXE . 'PerClass' . EXP . 'State.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    require_once EXE . 'Delivery' . EXP . 'plug.html';
}
?>