<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if (empty($_GET['i']) || $_GET['i'] == 'index') {
    $type = 'article';
    $IFY = QUERYIFY($type, $config);
    $talk = TalkQuery(0,$_SITE['talk_rec'],$config);//心情
    $Link = LinkQuerys($config);//友链
    $users = UserQuery('1', $config);//个人信息,后期多用户
    function articleInc($sql, $config){
        $csname = "and ify=$sql";
        $art = QUERYARTICLE('article', $csname, 0, 200, $config);
        return $art;
    }
    if (!empty($_GET['p'])){
        $PRO = ONEARTICLE(intval($_GET['p']), $config);
        if (is_array($PRO)){
        require_once TEMP_PATH . 'pocent/page.html';
        exit;
        }else{
            echo "文章类型不对!";
            exit;
        }
    }
    $music = MusicAll_xiami($config);
    require_once TEMP_PATH . 'pocent/index.html';
    
}


if ($_GET['i'] == 'search') {
    $SITE = SITE($config);
    $users = IndexUser($config);
    if (! empty($_POST['search']) && ! empty($_POST['q'])) {
        $q = $_POST['q'];
        header("location:?i=search&q=$q");
    }
    if (! empty($_GET['q'])) {
        $search = $_GET['q'];
        $s_page = 10;
        $count = SearchCount($search, $config);
        $pageCount = ceil($count / $s_page); // 总页码
        $p = 1;
        if (! empty($_GET['p'])) {
            $p = $_GET['p'];
            if ($p < 1) {
                $p = 1;
            }
            if ($p > $pageCount) {
                $p = $pageCount;
            }
        }
        $page = ($p - 1) * $s_page;

        $s = SearchQueryI($search, $page, $s_page, $config);
    }

    require_once TEMP_PATH . 'pocent/search.html';
}