<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c']=='ify'){
    require_once EXE . 'PerClass' . EXP . 'State.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    require_once EXE . 'PerClass' . EXP . 'Ify.admin.php';
    $a_page = 10;
    $pageCount = ceil(CountIfy($config) / $a_page);
    $n = 1;
    if (!empty($_GET['p'])){
        $n=$_GET['p'];
        if ($n < 1){
            $n=1;
        }
        if ($n > $pageCount){
            $n = $pageCount;
        }
    }
    $page = ($n-1) * $a_page;
    $ify = selectIfy($page, $a_page, $config);
    require_once EXE . 'Delivery' . EXP . 'ify.html';
}
?>