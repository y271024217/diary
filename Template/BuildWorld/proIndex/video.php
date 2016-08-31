<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['i'] == 'video') {
    $SITE = SITE($config);
    $v_page = $SITE['video_rec_all'];
    $count = ARTICLECOUNT("video", $config);
    $videoCount = THISPAGE($count, $v_page);
    $n = 1;
    if (! empty($_GET['m'])) {
        $n = $_GET['m'];
        if ($n < 1) {
            $n = 1;
        }
        if ($n > $videoCount) {
            $n = $videoCount;
        }
    }
    $page = ($n - 1) * $v_page;
    $video = VIDEROQUERY('video', $page, $v_page, $config);
    require_once TEMP_URL . '/video.html';
}
if ($_GET['i'] == 'play') {
    $SITE = SITE($config);
    $video = ONEVIDEO($_GET['id'], $config);
    $page = $type = 'video';
    $count = ARTICLECOUNT($type, $config);
    $videoAll = VIDEROQUERY($type, 0, $count, $config);
    $mp4_video = array(
        "flv",
        "f4v",
        "mp4",
        "ogv",
        "webm"
    );
    $flash_video = array(
        "swf"
    );
    $m3u8 = array("m3u8");
    $ext = getExt($video['rlink']);
    shuffle($videoAll);
    if (is_array($video)) {
        $users = IndexUser($config);
        VIEWINSERT($_GET['id'], $config);
        require_once TEMP_URL . '/VideoPlayer.html';
    } else {
        require_once TEMP_URL . '/404.html';
    }
}
?> 