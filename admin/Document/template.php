<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c'] == 'template'){
    require_once 'PerClass/State.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    $site = SiteIni($config);
    if ($site['site_style'] > 2){
        if ($site['site_style'] == 3 || $site['site_style'] == 187){
            require_once EXE . 'PerClass'. EXP .'Upload.admin.php';
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
            $music = UploadQuery_xiami($page, $page_music, $config);
            
    require_once EXE . 'Delivery'. EXP .'template.html';
            
          if (!empty($_POST['xiami_add'])){
              $add = AddUpload(array(FileTer($_POST['xiami_id']),FileTer($_POST['xiami_music']),time(),'虾米官方'), $config);
              if ($add){
                  echo "<script>alert('添加成功,确定后立马载入!');location.href='?c=template'</script>";
              }else {
                  echo "<script>alert('数据库短路了,请检测数据库环境是否异常!!!');location.href='?c=template'</script>";
              }
          }
    
          if ($_GET['ip']=='del'){
                  $del = UploadDel($_GET['id'], $config);
                  if ($del){
                      echo "<script>alert('删除成功!');location.href='?c=template'</script>";
                  }else {
                      echo "<script>alert('记录删除失败');location.href='?c=template'</script>";
                  }
          }
          
          if (!empty($_POST['all_sub'])){
              require_once EXE . 'PerClass'. EXP .'root.admin.php';
              if (!empty($_POST['talk_rec'])){
                  $talk_rec = FileTer($_POST[talk_rec]);
                  $set="talk_rec='$talk_rec', talk_ch='$_POST[talk_ch]'";
              }
              $up = SiteSet($set, $config);
              if ($up){
                  echo "<script>alert('修改成功!');location.href='';</script>";
              
              }else {
                  echo "<script>alert('修改失败!');location.href='';</script>";
              }
          }
          
          
        }
        
        
         
    }else{
        echo "默认模板不支持模板设置功能!";
    }
}

?>