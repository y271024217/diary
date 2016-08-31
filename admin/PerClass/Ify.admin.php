<?php

/**
 * @param Protty
 * @url www.pder.org
 **/
function Add_Ify($config, $array)
{
    $new = new AdminCor($config);
    $key = $new->Addify($array);
    return $key;
}

function selectIfy($page, $pageCount, $config)
{
    $new = new AdminCor($config);
    $key = $new->SelectIfy($page, $pageCount);
    return $key;
}

function selectIfyIni($config)
{
    $new = new AdminCor($config);
    $key = $new->selectIfyIni();
    return $key;
}

function CountIfy($config)
{
    $new = new AdminCor($config);
    $key = $new->CountIfy();
    return $key[count];
}

function UpdateIfy($array, $config)
{
    $new = new AdminCor($config);
    $key = $new->UpdateIfy($array);
    return $key;
}

function OneIfy($id, $config)
{
    $new = new AdminCor($config);
    $key = $new->OneIfy($id);
    return $key;
}

function Del_Ify($id, $config)
{
    $new = new AdminCor($config);
    $key = $new->DelIfy($id);
    return $key;
}
?>