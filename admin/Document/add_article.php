<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c']=='add_page'){
    require_once EXE . 'PerClass' . EXP . 'State.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    require_once EXE . 'Editor' . EXP . 'edit_js.html';
    require_once EXE . 'PerClass' . EXP . 'Ify.admin.php';
    $ify = selectIfyIni($config);
    require_once EXE . 'Delivery' . EXP . 'add_article.html';
    if (!empty($_POST['add_article'])){
        if ($_POST['section'] == 'music' || $_POST['section'] == 'video'){
            $array = array(FileTer($_POST['title']),FileTer($_POST['con_rose']),FileTer($_POST['rlink']),FileTer($_POST['image_link']),FileTer($_POST['ify']),time(),$ver['nickname'],$_POST['mend'],$_POST['section']);
        }else {
            $array = array(FileTer($_POST['title']),str_post_del($_POST['content']),FileTer($_POST['rlink']),FileTer($_POST['image_link']),FileTer($_POST['ify']),time(),$ver['nickname'],$_POST['mend'],$_POST['section']);
        }
        require EXE . 'PerClass' . EXP . 'Article.admin.php';
        $if = Add($config, $array);
        if ($if){
            echo "<script>alert('发表成功!');location.href='?c=art';</script>";

        }else {
            echo "<script>alert('发表失败!');location.href='';</script>";
        }
    }
}
?>