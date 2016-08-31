<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['i']=='write'){
    $ify = QueryIFYALL($config);
    $SITE = SITE($config);
    require_once TEMP_URL . '/write.html';
    if (!empty($_POST['submit'])){
        if (!empty($_POST['title']) && !empty($_POST['content'])){
           if (!empty($_POST['con_tel']) && CheckTel($_POST['con_tel'])){
               $array = array(FileTer($_POST['title']), $_POST['content'], FileTer($_POST['rlink']), FileTer($_POST['image_link']), FileTer($_POST['ify']),  time(), FileTer($_POST['athor']), 0, 'CheckPage');
               $add = AddCheckPage($array, $config);
               if ($add){
                   echo "<script>alert('你的文章已经提交成功了,请等待审核吧,审核后,你的文章将呈现在网站中...');location.href='?i=write';</script>";
               }else {
                   echo "<script>alert('你的文章提交失败了,可能是你的内容中含有敏感代码或者字符串,请将这些代码或者字符串去掉再试试提交,谢谢你的支持!..!');location.href='?i=write';</script>";
                }
                
                }else {
                    echo "<script>alert('很遗憾,你的手机输入不正确,请重新输入..!');location.href='?i=write';</script>";
                }
                
               }else{
                   echo "<script>alert('内容和标题都不能为空!!');location.href='?i=write';</script>";
               }
           
    }
}