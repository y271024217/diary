<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
$site = SiteQuery($config);
if ($_POST['email'] == $site['email']){
    require_once EXE . 'PerClass/mail.admin.php';
    $randpass = mt_rand(65489, 999999999);
    $user = md5($randpass. "PROTTY");
    $forgetp = UserForget($user, $config);
    if ($forgetp){
        $smtpserver = "smtp.163.com";
        $smtpserverport =25;
        $smtpusermail = "prometed@163.com";
        $smtpemailto = "$site[email]";
        $smtpuser = "prometed@163.com";
        $smtppass = "password";
        $mailsubject = "找回密码,POCENT安全中心!";
        $mailbody = "你的密码已经被重置为$randpass,现在你可以继续体验POCENT的强大功能了!";
        $mailtype = "HTML";
        $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
        $smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
        echo <<<end
<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p><b>你的密码已经发送到你的邮箱,请到邮箱查收!</b>！</p>
<meta http-equiv='refresh' content='10;url=../admin'>
end;
    }
     
}else {
    echo <<<end
<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:(</h1><p><b>验证失败,请重新填写!</b>！</p>
<meta http-equiv='refresh' content='1;url=../admin'>
end;
}
?>