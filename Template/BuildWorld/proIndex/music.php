<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['i'] == 'music') {
    $type = "music";
    $SITE = SITE($config);
    $IFY = QUERYIFY($type, $config);
    $count = ARTICLECOUNT($type, $config); // 总数
    $APP = QUERYARTICLE($type, NULL, 0, $count, $config);
    require_once TEMP_URL . '/music.html';
}
if ($_GET['i'] == 'mp3') {
    $type = "music";
    $mp3 = OneArt($_GET['id'], $type, $config);
    if (is_array($mp3)) {
        $count = ARTICLECOUNT($type, $config);
        $APP = QUERYARTICLE($type, NULL, 0, $count, $config);
        $ALL = SHUFFLEING($APP);
        VIEWINSERT($_GET['id'], $config);
        $SITE = SITE($config);
        require_once TEMP_URL . '/mp3.html';
    } else {
        require_once TEMP_URL . '/404.html';
    }
}

?>