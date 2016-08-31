<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
// 分离器开始
include ICN_URL . "article.inc.php";
include DDL_URL . 'goIndex.php'; // 核心验证开启
//include DDL_URL . 'Template.Inc.php';
$_SITE['site_style'] = 2;
if ($_SITE['site_style'] <= 3) {
    // 核心默认模板
    if ($_SITE['site_style'] == 1 || $_SITE['site_style'] == 2) {
        include DDL_URL . 'article.php'; // 加载ArtIcle文章功能
        include DDL_URL . 'music.php'; // 加载Music文章功能
        include DDL_URL . 'video.php'; // 加载Video文章功能
        include DDL_URL . 'search.php'; // 加载search搜索功能
        include DDL_URL . 'chat.php'; // 加载交互功能
        include DDL_URL . 'write.php'; // 加载投稿功能
    }
    // New_Pocent模板加载
    if ($_SITE['site_style'] == 3) {
        include TEMP_CURL . 'pocent/blog.php';
    }
}else {
    require_once API_URL . 'sql.api.php';//sql的api
    require_once PUBLIC_URL . 'query.public.php';//Mysql公共函数
    require_once PUBLIC_URL . 'plug.public.php';//插件加载
    require_once MOD_URL . 'KeyWord.php';//模板分离器
}
?>
