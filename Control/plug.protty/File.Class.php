<?php

/**
 * @param Protty
 * @url www.pder.org
 **/
class FilePlug
{
    //获取文件扩展名
    function getExt($filename)
    {
        $arr = explode('.', $filename);
        $ext = strtolower(end($arr));
        return $ext;
    }
    
    function getMail($filename)
    {
        $arr = explode('@', $filename);
        $ext = strtolower(end($arr));
        return $ext;
    }
}
?>