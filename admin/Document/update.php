<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c'] == 'update') {
    if (!empty($_POST['submit'])){
     if ($_POST['KeySite'] == SITE_KEY){
        $_VERSION = '3.1.0';
        $VERSION = @file_get_contents("http://pocent.version.lyiqi.com/version/v.php");
        @preg_match_all("/<POCENT_VER>([\s\S]+?)<\/POCENT_VER><POCENT_NEW_URL>([\s\S]+?)<\/POCENT_NEW_URL><POCENT_SQL>([\s\S]+?)<\/POCENT_SQL>/", $VERSION, $_SERVER_VERSION);
        $POCENT_VERSION = $_SERVER_VERSION['1']['0']; // 版本号
        $POCENT_NEW_DOWN = $_SERVER_VERSION['2']['0']; // 下载地址
        $POCENT_SQL = $_SERVER_VERSION['3']['0']; // 更新数据库
        if ($_VERSION !== $POCENT_VERSION) {
            $zip = file_get_contents($POCENT_NEW_DOWN);
            $down = file_put_contents("1.zip", $zip);
            if ($down) {
                $new = new ZipArchive();
                $res = $new->open('1.zip');
                if ($res === TRUE) {
                    $new->extractTo('../');
                    $new->close();
                    if (! empty($POCENT_SQL)) {
                        $link = mysql_connect($config['host'], $config['username'], $config['password']) or die("数据库连接失败了哟!");
                        $db = mysql_select_db($config['dbname']) or die("没有找到这个数据库哦~");
                        $charset = mysql_query("set names utf8");
                        $mysql = mysql_query($POCENT_SQL);
                        if ($mysql) {
                            echo <<<end
<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p><b>数据升级完成,现在,你只需要几秒就可以体验新功能!</b></p>
<meta http-equiv='refresh' content='3;url=../'>
end;
                            exit();
                        }
                    }
                    echo <<<end
<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p><b>更新成功,现在,你只需要几秒就可以体验新功能!</b></p>
<meta http-equiv='refresh' content='3;url=../'>
end;
                } else {
                    echo '更新失败, 请检查是否有可写权限,  错误代码:' . $res;
                }
            } else {
                echo "no";
            }
        } else {
            echo <<<end
<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:(</h1><p><b>你已经是最新版，无需升级!</b></p>
<meta http-equiv='refresh' content='3;url=../'>
end;
        } 
        exit;
    }else {
         echo <<<end
<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:(</h1><p><b>验证失败了,你可能使用的是盗版程序!</b></p>
<meta http-equiv='refresh' content='3;url=?c=update'>
end;
exit;
    }
  }
  ?>
  <style>
/* Basic Grey */
.basic-grey {
margin-left:auto;
margin-right:auto;
max-width: 500px;
background: #F7F7F7;
padding: 25px 15px 25px 10px;
font: 12px Georgia, "Times New Roman", Times, serif;
color: #888;
text-shadow: 1px 1px 1px #FFF;
border:1px solid #E4E4E4;
}
.basic-grey h1 {
font-size: 25px;
padding: 0px 0px 10px 40px;
display: block;
border-bottom:1px solid #E4E4E4;
margin: -10px -15px 30px -10px;;
color: #888;
}
.basic-grey h1>span {
display: block;
font-size: 11px;
}
.basic-grey label {
display: block;
margin: 0px;
}
.basic-grey label>span {
float: left;
width: 20%;
text-align: right;
padding-right: 10px;
margin-top: 10px;
color: #888;
}
.basic-grey input[type="text"], .basic-grey input[type="email"], .basic-grey textarea, .basic-grey select {
border: 1px solid #DADADA;
color: #888;
height: 30px;
margin-bottom: 16px;
margin-right: 6px;
margin-top: 2px;
outline: 0 none;
padding: 3px 3px 3px 5px;
width: 70%;
font-size: 12px;
line-height:15px;
box-shadow: inset 0px 1px 4px #ECECEC;
-moz-box-shadow: inset 0px 1px 4px #ECECEC;
-webkit-box-shadow: inset 0px 1px 4px #ECECEC;
}
.basic-grey textarea{
padding: 5px 3px 3px 5px;
}
.basic-grey select {
background: #FFF url('down-arrow.png') no-repeat right;
background: #FFF url('down-arrow.png') no-repeat right);
appearance:none;
-webkit-appearance:none;
-moz-appearance: none;
text-indent: 0.01px;
text-overflow: '';
width: 70%;
height: 35px;
line-height: 25px;
}
.basic-grey textarea{
height:100px;
}
.basic-grey .button {
background: #E27575;
border: none;
padding: 10px 25px 10px 25px;
color: #FFF;
box-shadow: 1px 1px 5px #B6B6B6;
border-radius: 3px;
text-shadow: 1px 1px 1px #9E3F3F;
cursor: pointer;
}
.basic-grey .button:hover {
background: #CF7A7A
}
        </style>
<form action="" method="post" class="basic-grey">
<h1>版权验证
<span>由于恶心的盗版,所以更新需要验证你是否使用的正版程序..</span>
</h1>
<label>
<span>官网是多少?</span>
<input id="name" type="text" name="KeySite" placeholder="官网地址:www.pocent.com" />
</label>



<label>
<span>&nbsp;</span>
<input type="submit" class="button" name="submit" value="开始更新" />
</label>
</form>
  <?php
}
?>

