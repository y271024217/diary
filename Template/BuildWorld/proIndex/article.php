<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if (!empty($_GET['g'])) {
    $type = 'article';
    $SITE = SITE($config);
    $IFY = QUERYIFY($type, $config);
    $RAND = RANDARTICLE(5, $type, $config);
    $RAND = SHUFFLEING($RAND);
    $PRO = ONEARTICLE($_GET['g'], $config);
    $APP = PAGEQUERY($type, $config);
    $Count = count($APP);
    $CountIfy = count($IFY);
    if (is_array($PRO)) {
        VIEWINSERT($_GET['g'], $config);
        $users = IndexUser($config);
        require_once TEMP_URL . '/page.html';
    } else {
        require_once TEMP_URL . '/404.html';
    }
    exit;
}
if (empty($_GET['i']) || $_GET['i'] == 'index') {
    $type = "article";
    $SITE = SITE($config);
    $IFY = QUERYIFY($type, $config);
    $RAND = RANDARTICLE($SITE['article_rand'], $type, $config);
    $RAND = SHUFFLEING($RAND);
    $a_page = $SITE['article_rec'];
    $n = 1;
    $count = ARTICLECOUNT('article', $config);
    $pageCount = THISPAGE($count, $a_page);
    if (! empty($_GET['m'])) {
        $n = $_GET['m'];
        if ($n < 1) {
            $n = 1;
        }
        if ($n > $pageCount) {
            $n = $pageCount;
        }
    }
    $page = ($n - 1) * $a_page;
    $ify = NULL;
    if (!empty($_GET['sort'])){
        $sql = sql_check($_GET['sort']);
        $ify_go = IndexIfy($sql, $config);
        $ify = "and ify=$sql";
    }
    $APP = QUERYARTICLE('article', $ify, $page, $a_page, $config);
    $CountIF = count($APP);
    $CountIfy = count($IFY);
    $LINK = LinkQuerys($config);
    $Linking = count($LINK);
    require_once TEMP_URL . '/index.html';
}



?>