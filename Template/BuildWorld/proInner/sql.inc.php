<?php
/**
 * @param Protty
 * @url www.pder.org
 **/

/**
 * @param unknown $sql_str
 * @return unknown SQL注入防御函数
 */
function sql_check($sql_str) {
    @$check= eregi('and|select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file
|outfile', $sql_str);
    if($check)
    {
         echo <<<end
<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:(</h1><p><b>这个SQL注入没有成功,继续努力!</b>！</p>
<meta http-equiv='refresh' content='1;url=?i=index'>
end;
        exit();
    }else
    {
        return $sql_str;
    }
}
?>