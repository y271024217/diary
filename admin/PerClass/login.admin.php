<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
include '../Control/admin.protty/Login.Class.php';

function LoginFun($u, $p, $config)
{
    $new = new LoginCor($config);
    $r = $new->LoginPer($u, $p);
    if ($r) {
        $_SESSION['user_login'] = md5($r['username'] . $r['password'] . LOGIN_PROTTY);
        $_SESSION['nickname'] = $r['nickname'];
        $_SESSION['id'] = $r['id'];
        header("location:?c=index");
    } else {
        echo <<<end
<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:(</h1><p><b>登陆失败!</b>！</p>
<meta http-equiv='refresh' content='1;url=../admin'>
end;
    }
    return $r;
}

function SiteQuery($config)
{
    $new = new LoginCor($config);
    $r = $new->SiteQuery();
    return $r;
}

function UserForget($user, $config)
{
    $new = new LoginCor($config);
    $r = $new->ForgetPass($user);
    return $r;
}

