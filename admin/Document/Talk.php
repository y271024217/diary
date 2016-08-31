<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c']=='talk'){
    require_once EXE . 'PerClass'. EXP .'State.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    require_once EXE . 'PerClass'. EXP .'Talk.admin.php';
    $go_page = 6;
    $count = TalkAllNum($config);
    $pageCount = ceil($count / $go_page);//分页总数
    $p = 1;
    if (!empty($_GET['p'])){
        $p = $_GET['p'];
        if ($p <= 1){
            $p = 1;
        }
        if ($p >= $pageCount){
            $p = $pageCount;
        }
    }
    $next = $p+1;
    $break = $p-1;
    $page = ($p - 1) * $go_page;
    $query = TalkQ($page, $go_page, $config);
    require_once EXE . 'Delivery'. EXP .'talk.html';
     
    if (!empty($_POST['talk_submit'])){

        if (!empty($_POST['content'])){
            $array = array(FileTer($_POST['content']), time(), $_SESSION['nickname']);
            $go = TalkNew($array, $config);
            if ($go){
                echo "<script>alert('发表成功!');location.href='';</script>";
            }else {
                echo "<script>alert('发表失败,原因我也不知道!');location.href='';</script>";
            }

        }else {
            echo "<script>alert('发表失败,原因是没有输入内容!');location.href='';</script>";
        }
    }

    if ($_GET['ip'] == 'del'){
        $del =  TalkDel($_GET['id'], $config);
        if ($del){
            echo "<script>alert('遗憾的告诉你,你成功的删除了一条你的心情,这条心情将离你而去...');location.href='?c=talk';</script>";
        }else {
            echo "<script>alert('操作失败,可能是数据库短路,请重新试试!');location.href='?c=talk';</script>";
        }
    }

}
?>