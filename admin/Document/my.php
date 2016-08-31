<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c']=='my'){
    require_once EXE . 'PerClass' . EXP . 'State.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    require_once EXE . 'Delivery' . EXP . 'my.html';
    if (!empty($_POST['update_set'])){
        require_once EXE . 'PerClass' . EXP . 'Updata.admin.php';
        $img = $_FILES['touxiang'];
        $images = uploadFile($img,'img');
        $u = FileTer($_POST['u']);
        $p = md5($_POST['p'].LOGIN_PROTTY);
        $n = FileTer($_POST['n']);
        $q = FileTer($_POST['q']);
        $sex = FileTer($_POST['sex']);
        //开始额外数据
        $qq = FileTer($_POST['qq_num']);
        $email = FileTer($_POST['user_mail']);
        $bri = FileTer($_POST['user_bri']);
        $weibo = FileTer($_POST['user_weibo']);
        $image = FileTer($_POST['user_image_new']);
        $qzone = FileTer($_POST['user_qzone']);
        
        if (is_array($images)){
            $img = true;
        }else {
            $img = false;
        }
        require_once EXE . 'PerClass' . EXP . 'root.admin.php';
        if (!empty($img) && !empty($_POST['u']) && !empty($_POST['p']) && !empty($_POST['n']) && !empty($_POST['q']) && !empty($_POST['sex'])){
            $set="username='$u',password='$p',nickname='$n',sig='$q',sex='$sex',img='$images[url]',qq_num='$qq',user_mail='$email',user_bri='$bri',user_weibo='$weibo',user_image_new='$image',user_qzone='$qzone'";
            session_destroy();
        }
        if (empty($img) && !empty($_POST['u']) && empty($_POST['p']) && !empty($_POST['n']) && !empty($_POST['q']) && !empty($_POST['sex'])){
            $set="username='$u',nickname='$n',sig='$q',sex='$sex',qq_num='$qq',user_mail='$email',user_bri='$bri',user_weibo='$weibo',user_image_new='$image',user_qzone='$qzone'";
        }
        if (!empty($img) && !empty($_POST['u']) && empty($_POST['p']) && !empty($_POST['n']) && !empty($_POST['q']) && !empty($_POST['sex'])){
            $set="username='$u',nickname='$n',sig='$q',sex='$sex',img='$images[url]',qq_num='$qq',user_mail='$email',user_bri='$bri',user_weibo='$weibo',user_image_new='$image',user_qzone='$qzone'";
        }
        if (empty($img) && !empty($_POST['u']) && !empty($_POST['p']) && !empty($_POST['n']) && !empty($_POST['q']) && !empty($_POST['sex'])){
            $set="username='$u',password='$p',nickname='$n',sig='$q',sex='$sex',qq_num='$qq',user_mail='$email',user_bri='$bri',user_weibo='$weibo',user_image_new='$image',user_qzone='$qzone'";
            session_destroy();
        }
        $up = MySet($set, "where id=$ver[id]", $config);
        if ($up){
            echo "<script>alert('修改成功!');location.href='';</script>";
            if ($ver['username'] !== $u){
                session_destroy();
            }

        }else {
            echo "<script>alert('修改失败!');location.href='';</script>";
        }
         
         
    }
}
?>