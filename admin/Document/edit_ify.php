<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c']=='opi'){
    require_once EXE . 'PerClass' . EXP . 'State.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    require_once EXE . 'PerClass' . EXP . 'Ify.admin.php';
    if ($_GET['xp'] == 'edit'){
        $ify = OneIfy($_GET['id'], $config);
        require_once EXE . 'Delivery' . EXP . 'edit_ify.html';
        if (!empty($_POST['edit_ify'])){
            $array = array(FileTer($_POST['ify_name']),FileTer($_POST['byname']),FileTer($_POST['the']),FileTer($_GET['id']));
            if (!empty($_GET['id'])){
                $information = UpdateIfy($array, $config);
            }else {
                $information = false;
            }
            if ($information){
                echo "<script>alert('修改成功!');location.href='?c=ify';</script>";

            }else {
                echo "<script>alert('修改失败!');location.href='';</script>";
            }
        }
    }
    if ($_GET['xp'] == 'del'){
        $Del = Del_Ify(FileTer($_GET['id']), $config);
        if ($Del){
            echo "<script>alert('删除成功!');location.href='?c=ify';</script>";

        }else {
            echo "<script>alert('删除失败!');location.href='?c=ify';</script>";
        }
    }
}
?>