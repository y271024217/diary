<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
session_start();
@define(EXP, DIRECTORY_SEPARATOR); // 分隔符
@define(EXE, dirname(__FILE__) . EXP); // 当前路径
@define(URL_PRO, "../Template/BuildWorld/proIndex/");
include URL_PRO . 'key.php';
Index::ProttyAdminControl();
?>