<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c']=='site'){
    require_once EXE . 'PerClass' . EXP . 'State.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    $site = SiteIni($config);
    $Template_u = template_file_admin("../Template/Engine/");
    $Logth = count($Template_u);
    $Temp_Key = array_keys($Template_u);
    for ($i = 0; $i < $Logth; $i ++) {
        if (file_exists("../Template/Engine/" . $Temp_Key[$i] . "/template.xml")) {
            $Templates[$Temp_Key[$i]] = "../Template/Engine/" . $Temp_Key[$i] . "/template.xml";
        }
    }
    
    $Temp_Json = count($Templates);
    $Temp_Xml = array_keys($Templates);
    require_once EXE . 'Delivery' . EXP . 'site.html';
    require_once EXE . 'PerClass' . EXP . 'Updata.admin.php';
    require_once EXE . 'PerClass' . EXP . 'root.admin.php';
    if (!empty($_POST['updata_site'])){
        $logo = $_FILES['logo'];
        $logo_title = FileTer($_POST['logo_title']);
        $title = FileTer($_POST['title']);
        $keys = FileTer($_POST['keys']);
        $con = FileTer($_POST['con']);
        $url = FileTer($_POST['url']);
        $copy = $_POST['copy'];
        $ify_ture_name = FileTer($_POST['ify_ture_name']);
        $image = uploadFile($logo,'img');
        $site_style = $_POST['site_style'];
        $cat_chs = FileTer($_POST['cat_ch']);
        if (is_array($image)){
            $img = true;
        }else {
            $img = false;
        }
        
        if (!empty($img) && !empty($_POST['title']) && !empty($_POST['keys']) && !empty($_POST['con']) && !empty($_POST['url']) && !empty($_POST['copy']) && !empty($_POST['logo_title']) && !empty($_POST['site_style'])){
            $set="logo='$image[url]',title='$title',keyword='$keys',con='$con',url='$url',copy='$copy',logo_title='$logo_title',ify_ture_name='$ify_ture_name',site_style='$site_style',cat_ch='$cat_chs'";
        }
        if (empty($img) && !empty($_POST['title']) && !empty($_POST['keys']) && !empty($_POST['con']) && !empty($_POST['url']) && !empty($_POST['copy']) && !empty($_POST['logo_title']) && !empty($_POST['site_style'])){
            $set="title='$title',keyword='$keys',con='$con',url='$url',copy='$copy',logo_title='$logo_title',ify_ture_name='$ify_ture_name',site_style='$site_style',cat_ch='$cat_chs'";
        }
        $up = SiteSet($set, $config);
        if ($up){
            echo "<script>alert('修改成功!');location.href='';</script>";

        }else {
            echo "<script>alert('修改失败!');location.href='';</script>";
        }
    }
    if (!empty($_POST['updata_music'])){
        $music_title = FileTer($_POST['music_title']);
        $music_image = FileTer($_POST['music_image']);
        $music_rec = FileTer($_POST['music_rec']);
        $set="music_title='$music_title',music_image='$music_image',music_rec='$music_rec',music_ch='$_POST[music_ch]'";
        $music_update = SiteSet($set, $config);
        if ($music_update){
            echo "<script>alert('修改成功!');location.href='';</script>";

        }else {
            echo "<script>alert('修改失败!');location.href='';</script>";
        }
    }
    
    if (!empty($_POST['updata_video'])){
        $video_title = FileTer($_POST['video_title']);
        $video_rec = FileTer($_POST['video_rec']);
        $video_rec_all = FileTer($_POST['video_rec_all']);
        $video_mend = FileTer($_POST['video_mend']);
        $video_rand = FileTer($_POST['video_rand']);
        $sets="video_title='$video_title',video_rec='$video_rec',video_rec_all='$video_rec_all',video_mend='$video_mend',video_rand='$video_rand',video_ch='$_POST[video_ch]'";
        $video_update = SiteSet($sets, $config);
        if ($video_update){
            echo "<script>alert('修改成功!');location.href='';</script>";
    
        }else {
            echo "<script>alert('修改失败!');location.href='';</script>";
        }
    }
    
    if (!empty($_POST['updata_article'])){
        $article_rec = FileTer($_POST['article_rec']);
        $article_dom = FileTer($_POST['article_dom']);
        $article_dom_image = FileTer($_POST['article_dom_image']);
        $article_rand = FileTer($_POST['article_rand']);
        $article_mend = FileTer($_POST['article_mend']);
        $article_substr = FileTer($_POST['article_substr']);
        $article_check = FileTer($_POST['article_check']);
        $setr="article_rec='$article_rec',article_dom='$article_dom',article_dom_image='$article_dom_image',article_rand='$article_rand',article_mend='$article_mend',article_ch='$_POST[article_ch]',article_substr='$article_substr',article_check='$article_check'";
        $article_update = SiteSet($setr, $config);
        if ($article_update){
            echo "<script>alert('修改成功!');location.href='';</script>";
    
        }else {
            echo "<script>alert('修改失败!');location.href='';</script>";
        }
    }
}
?>