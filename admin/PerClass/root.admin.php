<?php

/**
 * @param Protty
 * @url www.pder.org
 **/
function MySet($set, $where, $config)
{
    $new = new AdminCor($config);
    $go = $new->MySets($set, $where);
    return $go;
}

function SiteSet($set, $config)
{
    $new = new AdminCor($config);
    $go = $new->SiteSets($set);
    return $go;
}

function MssSet($array, $config)
{
    $new = new AdminCor($config);
    $go = $new->UpdateMss($array);
    return $go;
}

function setQuery($config)
{
    $new = new AdminCor($config);
    $go = $new->SiteIni();
    return $go;
}
?>