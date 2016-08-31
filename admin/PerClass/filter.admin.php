<?php

function FileTer($str)
{
    $str = strip_tags($str);
    $str = preg_replace("/\s+/", " ", $str); // 过滤多余回车
    $str = preg_replace("/<[ ]+/si", "<", $str); // 过滤<__("<"号后面带空格)
    $str = preg_replace("/<\!--.*?-->/si", "", $str); // 注释
    $str = preg_replace("/<(\!.*?)>/si", "", $str); // 过滤DOCTYPE
    $str = preg_replace("/<(\/?html.*?)>/si", "", $str); // 过滤html标签
    $str = preg_replace("/<(\/?head.*?)>/si", "", $str); // 过滤head标签
    $str = preg_replace("/<(\/?meta.*?)>/si", "", $str); // 过滤meta标签
    $str = preg_replace("/<(\/?body.*?)>/si", "", $str); // 过滤body标签
    $str = preg_replace("/<(\/?link.*?)>/si", "", $str); // 过滤link标签
    $str = preg_replace("/<(\/?form.*?)>/si", "", $str); // 过滤form标签
    $str = preg_replace("/cookie/si", "COOKIE", $str); // 过滤COOKIE标签
    
    $str = preg_replace("/<(applet.*?)>(.*?)<(\/applet.*?)>/si", "", $str); // 过滤applet标签
    $str = preg_replace("/<(\/?applet.*?)>/si", "", $str); // 过滤applet标签
    
    $str = preg_replace("/<(style.*?)>(.*?)<(\/style.*?)>/si", "", $str); // 过滤style标签
    $str = preg_replace("/<(\/?style.*?)>/si", "", $str); // 过滤style标签
    
    $str = preg_replace("/<(title.*?)>(.*?)<(\/title.*?)>/si", "", $str); // 过滤title标签
    $str = preg_replace("/<(\/?title.*?)>/si", "", $str); // 过滤title标签
    
    $str = preg_replace("/<(object.*?)>(.*?)<(\/object.*?)>/si", "", $str); // 过滤object标签
    $str = preg_replace("/<(\/?objec.*?)>/si", "", $str); // 过滤object标签
    
    $str = preg_replace("/<(noframes.*?)>(.*?)<(\/noframes.*?)>/si", "", $str); // 过滤noframes标签
    $str = preg_replace("/<(\/?noframes.*?)>/si", "", $str); // 过滤noframes标签
    
    $str = preg_replace("/<(i?frame.*?)>(.*?)<(\/i?frame.*?)>/si", "", $str); // 过滤frame标签
    $str = preg_replace("/<(\/?i?frame.*?)>/si", "", $str); // 过滤frame标签
    
    $str = preg_replace("/<(script.*?)>(.*?)<(\/script.*?)>/si", "", $str); // 过滤script标签
    $str = preg_replace("/<(\/?script.*?)>/si", "", $str); // 过滤script标签
    $str = preg_replace("/javascript/si", "Javascript", $str); // 过滤script标签
    $str = preg_replace("/vbscript/si", "Vbscript", $str); // 过滤script标签
    $str = preg_replace("/on([a-z]+)\s*=/si", "On\\1=", $str); // 过滤script标签
    $str = preg_replace("/&#/si", "&＃", $str); // 过滤script标签，如javAsCript:alert(
    return $str;
}

function CheckTel($phonenumber)
{
    if (preg_match("/1[3458]{1}\d{9}$/", $phonenumber)) {
        
        return true;
    } else {
        
        return false;
    }
}

/**
 *
 * @param unknown $dir            
 * @return multitype:string multitype:string NULL 递归实现寻找模板技术
 */
function template_file_admin($dir)
{
    $files = array();
    if (is_dir($dir)) {
        if ($handle = opendir($dir)) {
            while (($file = readdir($handle)) !== false) {
                if ($file != "." && $file != "..") {
                    if (is_dir($dir . "/" . $file)) {
                        
                        $files[$file] = template_file_admin($dir . "/" . $file);
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
 *
 * @param unknown $xml
 *            获取模板
 */
function getTemplate_admin($xml)
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
 * @param unknown $val            
 * @return unknown 过滤XSS函数
 */
function RemoveXSS($val)
{
    $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);
    
    $search = 'abcdefghijklmnopqrstuvwxyz';
    
    $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    $search .= '1234567890!@#$%^&*()';
    
    $search .= '~`";:?+/={}[]-_|\'\\';
    
    for ($i = 0; $i < strlen($search); $i ++) {
        
        $val = preg_replace('/(&#[xX]0{0,8}' . dechex(ord($search[$i])) . ';?)/i', $search[$i], $val); // with a ;
        
        $val = preg_replace('/(&#0{0,8}' . ord($search[$i]) . ';?)/', $search[$i], $val);
    }
    
    $ra1 = Array(
        'javascript',
        'vbscript',
        'expression',
        'applet',
        'meta',
        'xml',
        'blink',
        'link',
        'style',
        'script',
        'embed',
        'object',
        'iframe',
        'frame',
        'frameset',
        'ilayer',
        'layer',
        'bgsound',
        'title',
        'base'
    );
    
    $ra2 = Array(
        'onabort',
        'onactivate',
        'onafterprint',
        'onafterupdate',
        'onbeforeactivate',
        'onbeforecopy',
        'onbeforecut',
        'onbeforedeactivate',
        'onbeforeeditfocus',
        'onbeforepaste',
        'onbeforeprint',
        'onbeforeunload',
        'onbeforeupdate',
        'onblur',
        'onbounce',
        'oncellchange',
        'onchange',
        'onclick',
        'oncontextmenu',
        'oncontrolselect',
        'oncopy',
        'oncut',
        'ondataavailable',
        'ondatasetchanged',
        'ondatasetcomplete',
        'ondblclick',
        'ondeactivate',
        'ondrag',
        'ondragend',
        'ondragenter',
        'ondragleave',
        'ondragover',
        'ondragstart',
        'ondrop',
        'onerror',
        'onerrorupdate',
        'onfilterchange',
        'onfinish',
        'onfocus',
        'onfocusin',
        'onfocusout',
        'onhelp',
        'onkeydown',
        'onkeypress',
        'onkeyup',
        'onlayoutcomplete',
        'onload',
        'onlosecapture',
        'onmousedown',
        'onmouseenter',
        'onmouseleave',
        'onmousemove',
        'onmouseout',
        'onmouseover',
        'onmouseup',
        'onmousewheel',
        'onmove',
        'onmoveend',
        'onmovestart',
        'onpaste',
        'onpropertychange',
        'onreadystatechange',
        'onreset',
        'onresize',
        'onresizeend',
        'onresizestart',
        'onrowenter',
        'onrowexit',
        'onrowsdelete',
        'onrowsinserted',
        'onscroll',
        'onselect',
        'onselectionchange',
        'onselectstart',
        'onstart',
        'onstop',
        'onsubmit',
        'onunload'
    );
    
    $ra = array_merge($ra1, $ra2);
    
    $found = true; //
    
    while ($found == true) {
        
        $val_before = $val;
        
        for ($i = 0; $i < sizeof($ra); $i ++) {
            
            $pattern = '/';
            
            for ($j = 0; $j < strlen($ra[$i]); $j ++) {
                
                if ($j > 0) {
                    
                    $pattern .= '(';
                    
                    $pattern .= '(&#[xX]0{0,8}([9ab]);)';
                    
                    $pattern .= '|';
                    
                    $pattern .= '|(&#0{0,8}([9|10|13]);)';
                    
                    $pattern .= ')*';
                }
                
                $pattern .= $ra[$i][$j];
            }
            
            $pattern .= '/i';
            
            $replacement = substr($ra[$i], 0, 2) . '<protty>' . substr($ra[$i], 2); // add in <> to nerf the tag
            
            $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
            
            if ($val_before == $val) {
                
                // no replacements were made, so exit the loop
                
                $found = false;
            }
        }
    }
    
    return $val;
}

/**
 *
 * @param unknown $fileurl
 *            下载URL
 * @param unknown $filename
 *            要保存的名称
 *            下载函数
 */
function downfile($fileurl, $filename)
{
    $filename = $fileurl;
    $file = fopen($filename, "rb");
    Header("Content-type:  application/octet-stream ");
    Header("Accept-Ranges:  bytes ");
    Header("Content-Disposition:  attachment;  filename= $filename");
    $contents = "";
    while (! feof($file)) {
        $contents .= fread($file, 8192);
    }
    echo $contents;
    fclose($file);
}

function str_post_del($str)
{
    $ok = stripslashes($str);
    return $ok;
}

/**
 *
 * @param unknown $path            
 * @return boolean 递归删除文件夹
 */
function temp_del($path)
{
    if (is_dir($path)) {
        $file_list = scandir($path);
        foreach ($file_list as $file) {
            if ($file != '.' && $file != '..') {
                temp_del($path . '/' . $file);
            }
        }
        @rmdir($path);
    } else {
        @unlink($path);
    }
    return true;
}

function curl_get_contents($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $dxycontent = curl_exec($ch);
    return $dxycontent;
}


function art_url($open, $name, $id)//文章伪静态URL开关
{
    if ($open == 1) {
        echo "{$name}-{$id}.html";
    } else {
        echo "?g=$id";
    }
}
function video_url($open, $name, $id)//视频伪静态URL开关
{
    if ($open == 1) {
        echo "{$name}-{$id}.html";
    } else {
        echo "?play&id=$id";
    }
}
function class_url($open, $name, $pid){//分类伪静态开关
    if ($open == 1) {
        echo "{$name}-{$pid}.html";
    } else {
        echo "?index&sort=$pid";
    }
}
function page_url($open,$id){//分页静态开关
    if ($open == 1) {
        return  "pages-{$id}.html";
    } else {
        return  "?index&m=$id";
    }
}
function vage_url($open,$id){//视频分页静态开关
    if ($open == 1) {
        return  "vages-{$id}.html";
    } else {
        return  "?video&m=$id";
    }
}
function model($open, $name){//模块伪静态功能
    if ($open == 1){
        echo "{$name}.html";
    }else{
        echo "?i={$name}"; 
    }
}
?>