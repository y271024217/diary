<?php

/**
 * @param Protty
 * @url www.pder.org
 **/
function AddUpload($array, $config)
{
    $new = new AdminCor($config);
    $key = $new->AddUpload($array);
    return $key;
}

function UploadQuery($page, $p, $config)
{
    $new = new AdminCor($config);
    $key = $new->UploadQuery($page, $p);
    return $key;
}

function UploadQuery_xiami($page, $p, $config)
{
    $new = new AdminCor($config);
    $key = $new->UploadQuery_xiami($page, $p);
    return $key;
}

function UploadCount($config)
{
    $new = new AdminCor($config);
    $key = $new->UploadCount();
    return $key['count'];
}

function UploadDel($id, $config)
{
    $new = new AdminCor($config);
    $key = $new->UploadDel($id);
    return $key;
}

function pagenum($count, $page, $num)
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
            echo "<li><a href='?c=upload&p=$i'>$i</a></li>";
    }
    /* echo "($page)<br />"; */
}

function pagenum_xiami($count, $page, $num)
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
            echo "<li><a href='?c=template&p=$i'>$i</a></li>";
    }
    /* echo "($page)<br />"; */
}
?>