<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
//include 'key.admin.php';
include '../Control/admin.protty/Admin.Class.php';
include 'filter.admin.php';

function LoginStaFun($id, $config)
{
    $new = new AdminCor($config);
    $r = $new->LoginSta($id);
    return $r;
}

function SiteIni($config)
{
    $new = new AdminCor($config);
    $go = $new->SiteIni();
    return $go;
}
?>