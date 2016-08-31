<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c']=='add_ify'){
    require_once EXE . 'PerClass' . EXP . 'State.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    require_once EXE . 'Delivery' . EXP . 'add_ify.html';
    if (!empty($_POST['add_ify'])){
        $array = array(FileTer($_POST['ify_name']),FileTer($_POST['byname']),FileTer($_POST['the']));
        require_once EXE . 'PerClass' . EXP . 'Ify.admin.php';
        $if = Add_Ify($config, $array);
        if ($if){
            echo "<script>alert('添加成功!');location.href='?c=ify';</script>";

        }else {
            echo "<script>alert('添加失败!');location.href='';</script>";
        }
    }
}
?>