<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c']=='msg'){
    require_once EXE . 'PerClass' . EXP . 'State.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    require_once EXE . 'PerClass' . EXP . 'Msg.admin.php';
    if ($_GET['ip']=='reply'){
        $MsgReply = MsgOne($_GET['id'], $config);
        if (is_array($MsgReply)){
            require_once EXE . 'Delivery' . EXP . 'reply.html';
            if (!empty($_POST['reply_submit'])){
                if (!empty($_POST['reply_content'])){
                    $content = $MsgReply['content']."<BR><BR><b style='margin-left: 20px;'>站长回复：@".$MsgReply['names']."：</b>".FileTer($_POST['reply_content']);
                    $go = MsgUpdate($content, $_GET['id'], $config);
                    if ($go){
                        echo "<script>alert('回复成功!');location.href='?c=msg';</script>";
                    }else {
                        echo "<script>alert('回复失败,可能是数据库短路,重新试试?');location.href='?c=msg';</script>";
                    }
                }else {
                    echo "<script>alert('没有成功,原因是没有输入内容!');location.href='';</script>";
                }
            }
            exit;
        }else {
            echo "错误";
            exit;
        }
    }
    if ($_GET['ip']=='del'){
        if (!empty($_GET['id'])){
            $del = MsgDel($_GET['id'], $config);
            if ($del){
                echo "<script>alert('删除成功!');location.href='?c=msg';</script>";
            }else {
                echo "<script>alert('删除失败,可能是数据库短路,重新试试?');location.href='?c=msg';</script>";
            }
        }
    }
    $_page = 10;
    $count = MsgCount($config);
    $pageCount = ceil($count / $_page);//总页码
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
    $pages = ($p - 1) * $_page;
    $msg = MsgQuery($pages, $_page, $config);//
    require_once EXE . 'Delivery' . EXP . 'msg.html';
}
?>