<?php

/**
 * @param Protty
 * @url www.pder.org
 **/
error_reporting(0);//屏蔽所有错误信息
header('Content-type: text/html; charset=utf-8');
date_default_timezone_set('PRC');
define(HOST, $_SERVER['HTTP_HOST']);
 // 设置时区
if(get_magic_quotes_gpc()){
    	    function stripslashes_deep($value){
        	        $value=is_array($value)?array_map('stripslashes_deep',$value):stripslashes($value);
        	        return $value;
        	    }
        	    $_POST=array_map('stripslashes_deep',$_POST);
        	    $_GET=array_map('stripslashes_deep',$_GET);
        	    $_COOKIE=array_map('stripslashes_deep',$_COOKIE);
        	    $_REQUEST=array_map('stripslashes_deep',$_REQUEST);
}//去掉反斜杠函数
class Index
{
    static function ProttyIndexControl()
    {
        if (! file_exists('PROTTY.KEY')) {
            header('location:Install.php');
            exit();
        }
        define(PUBLIC_URL, "Template/BuildWorld/proJeck/");
        define(API_URL, "Template/BuildWorld/proApi/");
        define(MOD_URL, "Template/BuildWorld/proMod/");
        define(TEMP_URL, "Template/Engine/default/");
        define(ICN_URL, "Template/BuildWorld/proInner/");
        define(TEMP_CURL, "Template/BuildWorld/proTemp/");
        define(TEMP_PATH, "Template/Engine/");
        require_once 'config.php';
        require_once 'Template/index.php';
    }

    static function ProttyAdminControl()
    {
        define(URL_INDEX, "../");
        eval(gzinflate(base64_decode('S0lNy8xL1Qj2DHGN93aN1FFQKi8v1yvIT07NK9FLzs9V0rQGAA==')));
        include URL_INDEX . 'config.php'; // config配置
        include EXE . 'Document' . EXP . 'ifget.php'; // 检测get请求
        include EXE . 'Document' . EXP . 'login.php'; // 登陆验证
        include EXE . 'Document' . EXP . 'index_go.php'; // 后台仪表盘
        include EXE . 'Document' . EXP . 'my.php'; // 个人信息设置.ok
        include EXE . 'Document' . EXP . 'out.php'; // 退出
        include EXE . 'Document' . EXP . 'site.php'; // 网站设置.ok
        include EXE . 'Document' . EXP . 'add_article.php'; // 添加文章.ok
        include EXE . 'Document' . EXP . 'add_ify.php'; // 添加分类.ok
        include EXE . 'Document' . EXP . 'article.php'; // 文章列表
        include EXE . 'Document' . EXP . 'edit_article.php'; // 文章修改/删除 .ok
        include EXE . 'Document' . EXP . 'ify.php'; // 分类列表
        include EXE . 'Document' . EXP . 'edit_ify.php'; // 分类修改.ok
        include EXE . 'Document' . EXP . 'mss_set.php'; // 留言配置.ok
        include EXE . 'Document' . EXP . 'Talk.php'; // 心情.ok
        include EXE . 'Document' . EXP . 'msg.php'; // 留言模块.ok
        include EXE . 'Document' . EXP . 'link.php'; // 链接模块.ok
        include EXE . 'Document' . EXP . 'upload.php'; // 资源模块.ok
        include EXE . 'Document' . EXP . 'template.php'; // 模板模块.ok
        include EXE . 'Document' . EXP . 'update.php'; // 在线更新模块.ok
        include EXE . 'Document' . EXP . 'back.php'; // 数据库备份模块.2015年9月25日00:08:31
        include EXE . 'Document' . EXP . 'temp.php'; // 模板功能 2015年9月28日 18:11:06
        include EXE . 'Document' . EXP . 'seo.php';//SEO伪静态模块,2015年11月12日 22:09:44
    }
}

?>