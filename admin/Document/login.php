<?php
/**
 * @param Protty
 * @url www.pder.org
 **/

if ($_GET['c']=='login'){
   if (!empty($_POST['login_submit'])){
       require EXE . 'PerClass' . EXP  .  'login.admin.php';
       $u = $_POST['u'];
       $p = md5($_POST['p'].LOGIN_PROTTY);
       $v = $_POST['v'];
       if ($v == $_SESSION['Verification.code']){
           require_once EXE . 'PerClass' . EXP  . 'filter.admin.php';
           LoginFun(FileTer($u), $p, $config);
       }else {
           echo <<<end
<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:(</h1><p><b>验证码错误!</b>！</p>
<meta http-equiv='refresh' content='1;url=../admin'>
end;
       }
   }else {
       echo <<<end
<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:(</h1><p><b>错误,本次错误不是程序,请检查环境是否配置正确,程序无法进行POST请求!</b>！</p>
<meta http-equiv='refresh' content='1;url=../admin'>
end;
   }
}

if ($_GET['c']=='forget'){
    require EXE . 'PerClass' . EXP  .  'login.admin.php';
    if (!empty($_POST['sub_email'])){
        require_once EXE . 'Document/int_mail.php';
    }
}
?>