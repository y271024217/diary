<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c'] == 'back') {
    require_once EXE . '..' . EXP . 'Control' . EXP . 'admin.protty' . EXP . 'dbBack.Class.php';
    require_once EXE . 'PerClass' . EXP . 'State.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    if ($_GET['ip'] == 'backup') {
        $Back = new dbBackup($config);
        $rs = $Back->beifen($config[dbname] . '.sql');
        if ($rs) {
            $sql = file_get_contents($config[dbname] . '.sql');
            $down = downfile($config[dbname] . '.sql', $config[dbname] . '.sql');
            unlink($config[dbname] . '.sql');
            exit();
        } else {
            echo <<<end
<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:(</h1><p><b>备份失败!</b>！</p>
<meta http-equiv='refresh' content='1;url=?c=back'>
end;
            exit();
        }
    }
    
    if ($_GET['ip'] == 'backReturn') {
        require_once EXE . 'PerClass' . EXP . 'Updata.admin.php';
        
        if (! empty($_POST['sql_sub'])) {
            $update = uploadFile($_FILES['sql'], "../", false, 52428800, array(
                'sql'
            ));
            if (is_array($update)) {
                $upload = true;
            } else {
                $upload = false;
            }
            if ($upload) {
                $Back = new dbBackup($config);
                $rs = $Back->huanyuan($update['url']);
                unlink($update['url']);
                if ($rs) {
                    echo <<<end
<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p><b>还原成功,你的网站已经恢复如初..!</b>！</p>
<meta http-equiv='refresh' content='3;url=?c=back'>
end;
                    exit();
                } else {
                    echo <<<end
<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:(</h1><p><b>还原失败,你的网站可能已经崩溃,请修复..!</b>！</p>
<meta http-equiv='refresh' content='2;url=?c=back'>
end;
                    exit();
                }
            } else {
                echo <<<end
<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:(</h1><p><b>这个文件没有上传成功,请检查是否是sql数据库文件..!</b>！</p>
<meta http-equiv='refresh' content='2;url=?c=back'>
end;
                exit();
            }
        }
    }
    require_once EXE . 'Delivery' . EXP . 'back.html';
}

?>