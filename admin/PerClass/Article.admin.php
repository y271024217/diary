<?php

/**
 * @param Protty
 * @url www.pder.org
 **/
function Add($config, $array)
{
    $new = new AdminCor($config);
    $key = $new->Addarticle($array);
    return $key;
}

function Edit_Article($array, $config)
{
    $new = new AdminCor($config);
    $key = $new->EditArticle($array);
    return $key;
}

function Del_Article($id, $config)
{
    $new = new AdminCor($config);
    $key = $new->DelArticle($id);
    return $key;
}

function Query($page, $pageCount, $type, $config)
{
    $new = new AdminCor($config);
    $key = $new->QueryArticle($page, $pageCount, $type);
    return $key;
}

function QueryOne($id, $config)
{
    $new = new AdminCor($config);
    $key = $new->QueryArticleOne($id);
    return $key;
}

function ArtCount($config, $a_page, $type)
{
    $new = new AdminCor($config);
    $key = $new->ArticleCount($type);
    $pageCount = ceil($key['count'] / $a_page);
    return $pageCount;
}

function pagebar($count, $page, $num, $type)
{
    $num = min($count, $num); // 处理显示的页码数大于总页数的情况
    if ($page > $count || $page < 1)
        return; // 处理非法页号的情况
    $end = $page + floor($num / 2) <= $count ? $page + floor($num / 2) : $count; // 计算结束页号
    $start = $end - $num + 1; // 计算开始页号
    if ($start < 1) { // 处理开始页号小于1的情况
        $end -= $start - 1;
        $start = 1;
    }
    for ($i = $start; $i <= $end; $i ++) { // 输出分页条，请自行添加链接样式
        if ($i == $page)
            echo "<li class='active'><a href='?c=art&go=$type&p=$i'>$i</a></li>";
        else
            echo "<li><a href='?c=art&go=$type&p=$i'>$i</a></li>";
    }
    /* echo "($page)<br />"; */
}

function MendUpdate($mend, $id, $config)
{
    $new = new AdminCor($config);
    $key = $new->MendUpdate($mend, $id);
    return $key;
}

function TypeTs($type, $config)
{
    $new = new AdminCor($config);
    $key = $new->TypeTemt($type);
    return $key;
}

function ArtIndexCount($config)
{
    $new = new AdminCor($config);
    $key = $new->ArtIndexCount();
    return $key['count'];
}

function CheckPage($array, $config)
{
    $new = new AdminCor($config);
    $key = $new->CheckPage($array);
    return $key;
}
