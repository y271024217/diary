<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c']=='upload'){
    require_once EXE . 'PerClass' . EXP .  'State.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    require_once EXE . 'PerClass' . EXP .  'Updata.admin.php';
    require_once EXE . 'PerClass' . EXP .  'Upload.admin.php';
    $page_music = 10;
    $count = UploadCount($config);//总记录数
    $pageCount = ceil ($count / $page_music);//总页数
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
    $page = ($p - 1) * $page_music;
    $next = $p + 1;
    $break = $p - 1;
    $music = UploadQuery($page, $page_music, $config);
    require_once EXE . 'Delivery' . EXP .  'update.html';
    if (!empty($_POST['upload_music'])){
        $update = uploadFile($_FILES['rlink'], "../Template/UpLoads/music", false, 52428800,  array('mp3','wma','wav','m4a'));
        if (is_array($update)){
            $add = AddUpload(array($update[url],FileTer($_POST['title']),time(),$_SESSION['nickname']), $config); 
           if ($add){
               echo "<script>alert('上传成功,确定后立马载入!');location.href='?c=upload'</script>";
           }else {
               echo "<script>alert('文件上传成功了,但是数据库却短路了,请检测数据库环境是否异常!!!');location.href='?c=upload'</script>";
           }
         }else {
             echo "<script>alert('上传失败,请检测你的PHP配置文件的上传大小是否能够承载你所上传文件的大小!!!');location.href='?c=upload'</script>";
         }
    }
    if ($_GET['ip']=='del'){
        $delfile = unlink($_GET['file']);
        if ($delfile){
        $del = UploadDel($_GET['id'], $config);
        if ($del){
            echo "<script>alert('删除成功!');location.href='?c=upload'</script>";
        }else {
            echo "<script>alert('记录删除失败');location.href='?c=upload'</script>";
        }
      }else {
          echo "<script>alert('文件删除失败,但数据已经清除了!');location.href='?c=upload'</script>";
          $dels = UploadDel($_GET['id'], $config);
      }
    }
}
?>