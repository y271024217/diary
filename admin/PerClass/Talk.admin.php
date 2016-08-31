<?php

/**
 * @param Protty
 * @url www.pder.org
 **/
function TalkNew($array, $config)
{
    $new = new AdminCor($config);
    $key = $new->TalkNew($array);
    return $key;
}

function TalkQ($page, $p, $config)
{
    $new = new AdminCor($config);
    $key = $new->TalkQ($page, $p);
    return $key;
}

function TalkDel($id, $config)
{
    $new = new AdminCor($config);
    $key = $new->TalkDel($id);
    return $key;
}

function TalkAllNum($config)
{
    $new = new AdminCor($config);
    $key = $new->TalkAllNum();
    return $key['count'];
}

function TalkP($count, $page, $num)
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
            echo "<a class='ds-current'>$i</a>";
        else
            echo "<a href='?c=talk&p=$i'>$i</a>";
    }
}

function TalkOne($config)
{
    $new = new AdminCor($config);
    $key = $new->TalkQone();
    return $key;
}
?>