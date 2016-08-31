<?php

/**
 * @param Protty
 * @url www.pder.org
 **/
// 时间：2015年9月24日09:57:32
/**
 *
 * @param unknown $type            
 * @param unknown $start            
 * @param unknown $show            
 * @return unknown 查询指定类型下的文章
 */
function ViewAll($Type, $ify, $start, $show, $config)
{
    $go = ViewFeach("article", "*", "left join ify on article.ify=ify.pid where type='$Type' $ify order by id desc limit $start,$show", $config);
    return $go;
}

/**
 * @param unknown $id
 * @param unknown $type
 * @return unknown 单条文章记录查询
 */
function ViewPage($id, $type, $config){
    $go = ViewTech('article', "*", "where id=$id and type='$type'", $config);
    return $go;
}

/**
 * @param unknown $type
 * @param unknown $config
 * @return unknown 查询指定类型的分类
 */
function iFYAll($type, $config){
    $go = ViewFeach("ify", "*", "where alias='$type'", $config);
    return $go;
}

/**
 * @param unknown $config
 * @return multitype: 友链查询
 */
function LinkAll($config){
    $go = ViewFeach("link", "*", NULL, $config);
    return $go;
}


/**
 *
 * @param unknown $Type            
 * @param unknown $config            
 * @return unknown 查询指定类型类型下文章的总数
 */
function ViewFeachCount($Type, $config)
{
    $go = ViewTech("article", "count(id) as num", "where type='$Type'", $config);
    return $go['num'];
}

/**
 *
 * @param unknown $N            
 * @param unknown $show            
 * @return number 计算从何开始查询
 */
function PageStart($N, $show)
{
    $page = (intval($N) - 1) * $show;
    return $page;
}

/**
 *
 * @param unknown $show            
 * @param unknown $Type            
 * @param unknown $config
 *            计算分页
 */
function PageCount($show, $Type, $ify, $config)
{
    $go = ViewTech("article", "count(id) as num", "where type='$Type' $ify", $config);
    return ceil($go['num'] / $show);
}


/**
 *
 * @param unknown $PageCount
 *            总页码
 * @param unknown $page
 *            当前页码
 * @param unknown $num
 *            显示多少页
 */
function PageNum($PageCount, $page, $num, $csstrue)
{
    $num = min($PageCount, $num); // 处理显示的页码数大于总页数的情况
    if ($page > $PageCount || $page < 1)
        return; // 处理非法页号的情况
    $end = $page + floor($num / 2) <= $PageCount ? $page + floor($num / 2) : $PageCount; // 计算结束页号
    $start = $end - $num + 1; // 计算开始页号
    if ($start < 1) { // 处理开始页号小于1的情况
        $end -= $start - 1;
        $start = 1;
    }
    for ($i = $start; $i <= $end; $i ++) { // 输出分页条
        if ($i == $page)
            echo "<a class='$csstrue'>$i</a>"; // 当前页码
        else
            echo "<a href='?m=$i'>$i</a>"; // 其他页码
    }
}

/**
 *
 * @param unknown $page            
 * @return unknown 当前页
 */
function PageTrue($page)
{
    $p = intval($page);
    return $p;
}

/**
 *
 * @param unknown $page            
 * @return number 上一页
 */
function PageBreak($page)
{
    $page = intval($page);
    if ($page <= 1) {
        return $page;
    } else {
        $p = $page - 1;
        return $p;
    }
}

/**
 *
 * @param unknown $page            
 * @return 下一页
 */
function PageNext($page, $pageCount)
{
    $page = intval($page);
    if ($page >= $pageCount) {
        return $page;
    } else {
        $p = $page + 1;
        return $p;
    }
}

/**
 *
 * @param unknown $xml
 * 获取模板
 */
function getTemplate($xml)
{
    $template = file_get_contents($xml);
    preg_match_all("/<template_inc>([\s\S]+?)<\/template_inc>[\s\S]+?<template_ini>([\s\S]+?)<\/template_ini>[\s\S]+?<template_title>([\s\S]+?)<\/template_title>[\s\S]+?<template_athor>([\s\S]+?)<\/template_athor>[\s\S]+?<template_url>([\s\S]+?)<\/template_url>/", $template, $template_c);
    $template_r = array(
        "inc" => $template_c[1][0],
        "ini" => $template_c[2][0],
        "title" => $template_c[3][0],
        "athor" => $template_c[4][0],
        "url" => $template_c[5][0]
    );
    return $template_r;
}

/**
 *
 * @param unknown $dir            
 * @return multitype:string multitype:string NULL 递归实现寻找模板技术
 */
function template_file($dir)
{
    $files = array();
    if (is_dir($dir)) {
        if ($handle = opendir($dir)) {
            while (($file = readdir($handle)) !== false) {
                if ($file != "." && $file != "..") {
                    if (is_dir($dir . "/" . $file)) {
                        
                        $files[$file] = template_file($dir . "/" . $file);
                    } else {
                        if ($file == 'template.xml') {
                            
                            $files[] = $dir . "/" . $file;
                        }
                    }
                }
            }
            closedir($handle);
            return $files;
        }
    }
}

/**
 * @param unknown $Template_u 
 * @param unknown $_SITE 模板分离技术
 */
function is_Template($Template_u, $_SITE, $config)
{
    $Logth = count($Template_u);
    $Temp_Key = array_keys($Template_u);
    for ($i = 0; $i < $Logth; $i ++) {
        if (file_exists("Template/Engine/" . $Temp_Key[$i] . "/template.xml")) {
            $Templates[$Temp_Key[$i]] = "Template/Engine/" . $Temp_Key[$i] . "/template.xml";
        }
    }
    
    $Temp_Json = count($Templates);
    $Temp_Xml = array_keys($Templates);
    for ($i = 0; $i < $Temp_Json; $i ++) {
        $Temp_Filed = getTemplate($Templates[$Temp_Xml[$i]]);
        if ($_SITE['site_style'] == $Temp_Filed['inc']) { // 模板唯一ID号
            include TEMP_PATH . $Temp_Xml[$i] . '/' .  $Temp_Filed['ini'];
        }
    }
}

/**
 * @param unknown $config
 * @return unknown 查询网站信息
 */
function _web($config)
{
    $web = ViewTech('site', '*', 'where id = 1', $config);
    return $web;
}

/**
 * @param unknown $config
 * @return unknown 查询个人信息
 */
function _user($config)
{
    $_user = ViewTech('user', 'nickname,sig,sex,img,qq_num,user_mail,user_bri,user_weibo,user_image_new,user_qzone', 'where id = 1', $config);
    return $_user;
}

/**
 * @param unknown $type
 * @param unknown $config
 * @return Ambigous <unknown, multitype:> 查询指定类型推荐的文章
 */
function RecArticle($type, $config){
    $art = ViewFeach('article', '*', "where mend = 1 and type='$type' order by id desc", $config);
    return $art;
}

/**
 * @param unknown $config
 * @return unknown 查询单条最新心情
 */
function _mood($config){
    $talk = ViewTech('talk', '*', "order by id desc", $config);
    return $talk;
}

/**
 * @param unknown $config
 * @return Ambigous <unknown, multitype:> 查询多条心情
 */
function mood($config){
    $talk = ViewFeach('talk', '*', "order by id desc", $config);
    return $talk;
}

function iFYGET($pid, $config){
    $ify = ViewTech('ify', '*', "where pid=$pid", $config);
    return $ify;
}
?>