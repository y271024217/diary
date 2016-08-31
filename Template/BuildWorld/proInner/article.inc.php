<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
include_once 'Control/index.protty/Index.Class.php';
include_once 'Control/plug.protty/File.Class.php';
include_once 'admin/PerClass/filter.admin.php';
include_once 'sql.inc.php';
/**
 *
 * @param unknown $type            
 * @param unknown $page            
 * @param unknown $pageCount            
 * @param unknown $config            
 * @return multitype: 查询所有文章
 */
function QUERYARTICLE($type, $ify, $page, $pageCount, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->IndexQuery($type, $ify, $page, $pageCount);
    return $KEY;
}

/**
 *
 * @param unknown $type            
 * @param unknown $config            
 * @return unknown 查询所有记录
 */
function PAGEQUERY($type, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->PageQuery($type);
    return $KEY;
}

/**
 *
 * @param unknown $config            
 * @return unknown 查询所有article表下的记录
 */
function ALLARTICLE($config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->AllQuery();
    return $KEY;
}

/**
 *
 * @param unknown $type            
 * @param unknown $config            
 * @return multitype: 查询指定模块的分类
 */
function QUERYIFY($type, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->IfyQuery($type);
    return $KEY;
}

/**
 *
 * @param unknown $ifyName            
 * @param unknown $config            
 * @return mixed 返回分类总数
 */
function IENDARTCOUNT($ifyName, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->IfyAndArticleCount($ifyName);
    return $KEY['count'];
}

/**
 *
 * @param unknown $page            
 * @param unknown $type            
 * @param unknown $config            
 * @return multitype: 随机文章
 */
function RANDARTICLE($page, $type, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->RandArticle($page, $type);
    return $KEY;
}

/**
 *
 * @param unknown $list            
 * @return unknown|multitype:unknown 打乱数组技术
 */
function SHUFFLEING($list)
{
    if (! is_array($list))
        return $list;
    $keys = array_keys($list);
    shuffle($keys);
    $random = array();
    foreach ($keys as $key)
        $random[$key] = $list[$key];
    return $random;
}

/**
 *
 * @param unknown $id            
 * @param unknown $config            
 * @return mixed 查询一条文章记录
 */
function ONEARTICLE($id, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->OneArticle($id);
    return $KEY;
}

/**
 *
 * @param unknown $array            
 * @param unknown $config            
 * @return boolean 增加留言
 */
function MESSAGEADD($array, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->MessageAdd($array);
    return $KEY;
}

/**
 *
 * @param unknown $id            
 * @param unknown $config            
 * @return multitype: 查询留言
 */
function QUERYMESSAGE($config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->QueryMessage();
    return $KEY;
}

/**
 *
 * @param unknown $id            
 * @param unknown $config            
 * @return mixed 获取留言总数
 */
function COUNTMESSAGE($id, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->CountMessage($id);
    return $KEY['count'];
}

/**
 *
 * @param unknown $id            
 * @param unknown $config            
 * @return boolean 页面浏览量增加
 */
function VIEWINSERT($id, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->ViewInsert($id);
    return $KEY;
}

/**
 *
 * @param unknown $count            
 * @param unknown $page            
 * @param unknown $num
 *            文章模块分页技术
 */
function PAGEING($open, $count, $page, $num)
{
    $num = min($count, $num); // 处理显示的页码数大于总页数的情况
    if ($page > $count || $page < 1)
        return; // 处理非法页号的情况
    $end = $page + floor($num / 2) <= $count ? $page + floor($num / 2) : $count; // 计算结束页号
    $start = $end - $num + 1; // 计算开始页号
    if ($start < 1) { // 处理开始页号小于1的情况
        $end -= $start - 1;
        $start = 1;
    }
    for ($i = $start; $i <= $end; $i ++) { // 输出分页条，请自行添加链接样式
        if ($i == $page)
            echo "<li class='active'><a >$i</a></li>";
        else
            echo "<li><a href=". page_url($open,$i) . ">$i</a></li>";
    }
}

/**
 *
 * @param unknown $count            
 * @param unknown $page            
 * @param unknown $num
 *            视频模块分页技术
 */
function VIDEOPAGE($open, $count, $page, $num)
{
    $num = min($count, $num); // 处理显示的页码数大于总页数的情况
    if ($page > $count || $page < 1)
        return; // 处理非法页号的情况
    $end = $page + floor($num / 2) <= $count ? $page + floor($num / 2) : $count; // 计算结束页号
    $start = $end - $num + 1; // 计算开始页号
    if ($start < 1) { // 处理开始页号小于1的情况
        $end -= $start - 1;
        $start = 1;
    }
    for ($i = $start; $i <= $end; $i ++) { // 输出分页条，请自行添加链接样式
        if ($i == $page)
            echo "<li class='active'><a>$i</a></li>";
        else
            echo "<li><a href='".vage_url($open,$i)."'>$i</a></li>";
    }
}

/**
 *
 * @param unknown $type            
 * @param unknown $config            
 * @return mixed 获取指定模块的id总数
 */
function ARTICLECOUNT($type, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->ArticleCount($type);
    return $KEY['count'];
}

/**
 *
 * @param unknown $count            
 * @param unknown $page            
 * @return number 计算总页码数
 */
function THISPAGE($count, $page)
{
    $page = ceil($count / $page);
    return $page;
}

/**
 *
 * @param unknown $type            
 * @param unknown $page            
 * @param unknown $pageCount            
 * @param unknown $config            
 * @return multitype: 查询所有视频信息
 */
function VIDEROQUERY($type, $page, $pageCount, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->VideoQuery($type, $page, $pageCount);
    return $KEY;
}

/**
 *
 * @param unknown $id            
 * @param unknown $config            
 * @return mixed 读取视频单条信息
 */
function ONEVIDEO($id, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->OneVideo($id);
    return $KEY;
}

/**
 *
 * @param
 *            $config
 * @return mixed 获取网站配置信息
 */
function SITE($config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->SiteQuery();
    return $KEY;
}

/**
 *
 * @param 获取文件扩展名 $filename            
 * @return 扩展名
 */
function getExt($filename)
{
    $file = new FilePlug();
    $plug = $file->getExt($filename);
    return $plug;
}

/**
 *
 * @param 获取邮箱扩展名 $filename            
 * @return 扩展名
 */
function getMail($filename)
{
    $file = new FilePlug();
    $plug = $file->getMail($filename);
    return $plug;
}

/**
 *
 * @param unknown $user            
 * @param unknown $id            
 * @param unknown $config            
 * @return mixed 通过session查询个人信息
 */
function UserQuery($id, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->UserQuery($id);
    return $KEY;
}

/**
 *
 * @param unknown $config            
 * @return unknown 查询所有文章表的记录
 */
function CountAll($config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->CountAll();
    return $KEY;
}

/**
 *
 * @param unknown $config            
 * @return unknown 查询个人简单信息
 */
function IndexUser($config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->IndexUser();
    return $KEY;
}

function SearchQueryI($q, $page, $pageCount, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->SearchQuery($q, $page, $pageCount);
    return $KEY;
}

function SearchCount($q, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->SearchCount($q);
    return $KEY['count'];
}

function SearchPage($count, $page, $num, $q)
{
    $num = min($count, $num); // 处理显示的页码数大于总页数的情况
    if ($page > $count || $page < 1)
        return; // 处理非法页号的情况
    $end = $page + floor($num / 2) <= $count ? $page + floor($num / 2) : $count; // 计算结束页号
    $start = $end - $num + 1; // 计算开始页号
    if ($start < 1) { // 处理开始页号小于1的情况
        $end -= $start - 1;
        $start = 1;
    }
    for ($i = $start; $i <= $end; $i ++) { // 输出分页条，请自行添加链接样式
        if ($i == $page)
            echo "<span>$i</span>";
        else
            echo "<a href='?i=search&q=$q&p=$i'>$i</a>";
    }
}

function MendCount($type, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->MendCount($type);
    return $KEY;
}

function OneArt($id, $type, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->OneArt($id, $type);
    return $KEY;
}

function TalkQuery($page, $pageSum, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->QueryTalk($page, $pageSum);
    return $KEY;
}

function TalkCount($config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->TalkCount();
    return $KEY['count'];
}

function TalkPage($count, $page, $num)
{
    $num = min($count, $num); // 处理显示的页码数大于总页数的情况
    if ($page > $count || $page < 1)
        return; // 处理非法页号的情况
    $end = $page + floor($num / 2) <= $count ? $page + floor($num / 2) : $count; // 计算结束页号
    $start = $end - $num + 1; // 计算开始页号
    if ($start < 1) { // 处理开始页号小于1的情况
        $end -= $start - 1;
        $start = 1;
    }
    for ($i = $start; $i <= $end; $i ++) { // 输出分页条，请自行添加链接样式
        if ($i == $page)
            echo "<li class='active'><a>$i</a></li>";
        else
            echo "<li><a href='?i=chat&m=$i'>$i</a></li>";
    }
}

function LinkQuerys($config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->LinkQuery();
    return $KEY;
}

function IndexIfy($id, $config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->IndexIfy($id);
    return $KEY;
}

function QueryIFYALL($config)
{
    $DDL = new IndexCor($config);
    $KEY = $DDL->QueryIFYALL();
    return $KEY;
}

function AddCheckPage($array, $config)
{
    $DLL = new IndexCor($config);
    $KEY = $DLL->AddCheckPage($array);
    return $KEY;
}

function MusicAll_xiami($config)
{
    $DLL = new IndexCor($config);
    $KEY = $DLL->MusicAll_xiami();
    return $KEY;
}
