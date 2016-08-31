<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c']=='link'){
    require_once 'PerClass/State.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    require_once 'PerClass/Link.admin.php';
    $_num = 10;
    $pageCount = ceil(LinkAll($config) / $_num);//总页码
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
    $page = ($p - 1) * $_num;
    $next = $p+1;
    $break = $p-1;
    $Query = LinkQuery($page, $_num, $config);
    if ($_GET['ip']=='edit'){
        $LinkNum = LinkNum($_GET['id'], $config);
        if (@!is_array($LinkNum)){
            header("location:?c=link");
        }
        if (!empty($_POST['edit_link'])){
            if (!empty($_POST['link_title'])){
                if (@CheckUrl($_POST['link_url'])){
                    $array = array(FileTer($_POST['link_title']),FileTer($_POST['link_url']),FileTer($_POST['link_content']),$_GET['id']);
                    $edit = LinkEdit($array, $config);
                    if ($edit){
                        echo "<script>alert('修改成功!');location.href='?c=link';</script>";
                    }else {
                        echo "<script>alert('修改失败,可能是数据库短路,重新试试?');location.href='?c=link';</script>";
                    }
                }else {
                    echo "<script>alert('修改失败,可能是URL错了,是不是没加http://呢,重新试试?');location.href='?c=link';</script>";
                }
            }else {
                echo "<script>alert('修改失败,可能是忘记输入名称了,重新试试?');location.href='?c=link';</script>";
            }
        }
    }
    if ($_GET['ip']=='del'){
        $del = LinkDel($_GET['id'], $config);
        if ($del){
            echo "<script>alert('删除成功!');location.href='?c=link';</script>";
        }else {
            echo "<script>alert('删除失败,可能是数据库短路,重新试试?');location.href='?c=link';</script>";
        }
    }
    if ($_GET['ip']=='hidden'){
        $array = array($_GET['res'],$_GET['id']);
        $hidden = LinkHidden($array, $config);
        echo "<script>location.href='?c=link';</script>";
    }
    require_once 'Delivery/link.html';
    
    if (!empty($_POST['add_link'])){
        if (!empty($_POST['link_title'])){
            if (CheckUrl($_POST['link_url'])){
               $array = array(FileTer($_POST['link_title']),FileTer($_POST['link_url']),FileTer($_POST['link_content']),1,time());
               $add = LinkAdd($array, $config);
               if ($add){
                   echo "<script>alert('添加成功!');location.href='?c=link';</script>";
               }else {
                   echo "<script>alert('添加失败,可能是数据库短路,重新试试?');location.href='?c=link';</script>";
               }
            }else {
                echo "<script>alert('添加失败,可能是URL错了,是不是没加http://呢,重新试试?');location.href='?c=link';</script>";
            }
        }else {
            echo "<script>alert('添加失败,可能是忘记输入名称了,重新试试?');location.href='?c=link';</script>";
        }
    }
}