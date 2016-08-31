<?php
/**
 * @author protty
 * @link www.pder.org
 * @copyright protty 版权所有
 */
if ($_GET['c'] == 'seo') {
    require_once EXE . 'PerClass' . EXP . 'State.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    $site = SiteIni($config);
    require_once EXE . 'Delivery' . EXP . 'seo.html';
    if (!empty($_POST['seo_set'])){
        require_once EXE . 'PerClass' . EXP . 'root.admin.php';
        $open = intval($_POST['open']);
        $article_name = $_POST['seo_article_name'];
        $class_name = $_POST['seo_class_name'];
        $int="seo_url='$open',seo_article_name='$article_name',seo_class_name='$class_name'";
        $set = SiteSet($int, $config);
        if ($set){
            echo "<script>alert('修改成功!');location.href='';</script>";

        }else {
            echo "<script>alert('修改失败!');location.href='';</script>";
        }
    }
}
?>