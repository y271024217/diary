<?php

/**
 * @param Protty
 * @url www.pder.org
 **/
function LinkAdd($array, $config)
{
    $new = new AdminCor($config);
    $key = $new->LinkAdd($array);
    return $key;
}

function CheckUrl($C_url)
{
    if (! ereg("^http://[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*$", $C_url)) {
        return false;
    }
    return true;
}

function LinkQuery($page, $p, $config)
{
    $new = new AdminCor($config);
    $key = $new->LinkQuery($page, $p);
    return $key;
}

function LinkNum($id, $config)
{
    $new = new AdminCor($config);
    $key = $new->LinkNum($id);
    return $key;
}

function LinkEdit($array, $config)
{
    $new = new AdminCor($config);
    $key = $new->LinkEdit($array);
    return $key;
}

function LinkDel($id, $config)
{
    $new = new AdminCor($config);
    $key = $new->LinkDel($id);
    return $key;
}

function LinkHidden($array, $config)
{
    $new = new AdminCor($config);
    $key = $new->LinkHidden($array);
    return $key;
}

function LinkAll($config)
{
    $new = new AdminCor($config);
    $key = $new->LinkAll();
    return $key['count'];
}

function LinkPage($count, $page, $num)
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
            echo "<li class='active'><a>$i</a></li>";
        else
            echo "<li><a href='?c=link&p=$i'>$i</a></li>";
    }
}