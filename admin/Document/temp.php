<?php
/*
 * 程式网:blog.pder.org
 * 作者:Protty
 */

if ($_GET['c']=='temp'){
    require_once EXE . 'PerClass' . EXP . 'State.admin.php';
    require_once EXE . 'PerClass' . EXP . 'Updata.admin.php';
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
    
    if ($_GET['ip'] == 'exe'){
        
        require_once EXE . 'Delivery' . EXP . 'temp_exe.html';
        exit;
    }

    require_once EXE . 'Delivery' . EXP . 'temp.html';
    if (!empty($_POST['temp_upload'])){
        $upload = uploadFile($_FILES['temp_link'], $uploadPath = '../Template/Engine/', false, $maxSize = 59856647, array('zip'));
        if (is_array($upload)){
            $new = new ZipArchive();
            $res = $new->open("$upload[url]");
            if ($res === TRUE){
                $new->extractTo('../Template/Engine/');
                $new->close();
                unlink($upload[url]);
            echo "<script>alert('上传成功,请到全局配置里面更换风格!');location.href='?c=temp';</script>";
            }else {
                echo "<script>alert('模板自动安装失败!,原因是你的空间不支持解压技术,所以请手动解压模板目录的文件!');location.href='?c=temp';</script>";
            }
        }else {
            echo "<script>alert('模板已经损坏!');location.href='?c=temp';</script>";
        }
    }
    if ($_GET['ip']=='del'){
        $filename = "../Template/Engine/". $_GET['file'];
        $del = temp_del($filename);
        if ($del){
            echo "<script>alert('模板卸载完成!!!!');location.href='?c=temp';</script>";
        }else {
            echo "<script>alert('模板卸载失败!,原因是你的空间不支持删除函数,所以请手动删除模板目录的文件!');location.href='?c=temp';</script>";
        }
    }
}
?>