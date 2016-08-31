<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c'] == 'art') {
    require_once EXE . 'PerClass' . EXP . 'State.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    $site = SiteIni($config);
    require EXE . 'PerClass' . EXP . 'Article.admin.php';
    $a_page = 10;
    $type = $site['article_type'];
    if (! empty($_GET['go'])) {
        $type = $_GET['go'];
        if ($type !== $site['article_type']) {
            TypeTs($type, $config);
        }
        $array = array(
            "music",
            "video",
            "images",
            "article",
            "down",
            "CheckPage"
        );
        if (! in_array($_GET['go'], $array)) {
            echo "别总是乱输入数据好么?";
            exit();
        }
    }
    $pageCount = ArtCount($config, $a_page, $type);
    $n = 1;
    if (! empty($_GET['p'])) {
        $n = $_GET['p'];
        if ($_GET['p'] < 1) {
            $n = 1;
        }
        if ($_GET['p'] > $pageCount) {
            $n = $pageCount;
        }
    }
    $page = ($n - 1) * $a_page;
    
    $article = Query($page, $a_page, $type, $config);
    $xia = $n+1;
    $shang = $n-1;
    require_once EXE . 'Delivery' . EXP . 'article.html';
}
?>