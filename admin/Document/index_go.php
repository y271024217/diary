<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c'] == 'index') {
    require_once EXE . 'PerClass' . EXP . 'State.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    require_once EXE . 'PerClass' . EXP . 'Talk.admin.php';
    $Talk = TalkQ(0, 10, $config); // 心情
    $TalkCount = TalkAllNum($config); // 心情总数
    require_once EXE . 'PerClass' . EXP . 'Article.admin.php';
    $ArticleCount = ArtIndexCount($config); // 文章总数
    require_once EXE . 'PerClass' . EXP . 'Ify.admin.php';
    $IfyCount = CountIfy($config); // 分类总数
    require_once EXE . 'PerClass' . EXP . 'Msg.admin.php';
    $MsgCount = MsgCount($config); // 留言总数 */
    $_VERSION = '3.1.0';
    $VERSION = curl_get_contents("http://pocent.version.lyiqi.com/version/v.php");
    preg_match_all("/<POCENT_VER>([\s\S]+?)<\/POCENT_VER><POCENT_NEW_URL>([\s\S]+?)<\/POCENT_NEW_URL>[\s\S]+?<POCENT_DATE>([\s\S]+?)<\/POCENT_DATE>/", $VERSION, $_SERVER_VERSION);
    $POCENT_VERSION = $_SERVER_VERSION['1']['0']; // 版本号
    if ($POCENT_VERSION){
        $COMM = '<protty style="color: green;"><i class="i-checkmark-2"></i> 通信正常</protty>';
    }else {
        $COMM = '<protty style="color: red;"><i class="i-cancel-2"></i> 通信异常</protty>';
    }
    $POCENT_NEW_DOWN = $_SERVER_VERSION['2']['0']; // 下载地址
    $POCENT_UPDATE_DATE =  $_SERVER_VERSION['3']['0'];// 更新日期
    $POCENT_COMM = $COMM;//通信状态;
    require_once EXE . 'Delivery' . EXP . 'index.html';
    
    
}
?>