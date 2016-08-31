<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c']=='mss'){
    require_once EXE . 'PerClass' . EXP . 'State.admin.php';
    require_once EXE . 'PerClass' . EXP . 'root.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    $msg = setQuery($config);
    require_once EXE . 'Delivery' . EXP . 'message.html';
    if (!empty($_POST['sub_mss'])){
        $array = array($_POST['mss_html'], FileTer($_POST['mss_url']));
        $if = MssSet($array, $config);
        if ($if){
            $mss = "保存成功!";
        }else {
            $mss = "保存失败!";
        }
        echo "<script>alert('$mss');location.href='';</script>";
    }
}
?>