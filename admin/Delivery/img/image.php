<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
session_start();
require '../../../Control/admin.protty/Image.Class.php';
$_vc = new ValidateCode();  //实例化一个对象
$_vc->doimg();
$_SESSION['Verification.code'] = $_vc->getCode();//验证码保存到SESSION中