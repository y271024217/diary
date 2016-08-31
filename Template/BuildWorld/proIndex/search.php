<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['i'] == 'search') {
    $SITE = SITE($config);
    $users = IndexUser($config);
    if (! empty($_POST['search']) && ! empty($_POST['q'])) {
        $q = $_POST['q'];
        header("location:?i=search&q=$q");
    }
    if (! empty($_GET['q'])) {
        $search = RemoveXSS($_GET['q']);
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
    
    require_once TEMP_URL . '/search.html';
}
?>