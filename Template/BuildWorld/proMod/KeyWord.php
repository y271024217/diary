<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
$Template_u = template_file("Template/Engine");//递归实现模板加载
is_Template($Template_u, $_SITE, $config);//整站模板分离技术

?>