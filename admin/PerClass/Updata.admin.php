<?php

/**
 * @param Protty
 * @url www.pder.org
 * 单文件上传
 * @param array $fileInfo 包含上传文件的完整信息
 * @param string $uploadPath 默认上传到uploads
 * @param bool $flag 默认检测是否是真实图片
 * @param number $maxSize 允许上传文件的最大大小
 * @param array $allowExt 允许上传文件的类型
 * @return string|multitype:string unknown
 * 成功返回的是数组，上传文件的信息
 * 失败返回的错误信息
 **/
function uploadFile($fileInfo, $uploadPath = 'uploads', $flag = true, $maxSize = 2097152, $allowExt = array('jpeg','jpg','png','gif'))
{
    if ($fileInfo['error'] !== 0) {
        switch ($fileInfo['error']) {
            case 1:
                $mes = '超过了PHP配置文件中的upload_max_filesize选项的值';
                break;
            case 2:
                $mes = '超过表单MAX_FILE_SIZE的值';
                break;
            case 3:
                $mes = '文件部分被上传';
                break;
            case 4:
                $mes = '没有选择上传文件';
                break;
            case 6:
            case 7:
            case 8:
                $mes = '系统错误';
                break;
        }
        // exit($mes);
        return $fileInfo['name'] . $mes;
    }
    
    // 3.检测上传文件大小是否符合规范
    // $maxSize=2*1024*1024;//2M
    if ($fileInfo['size'] > $maxSize) {
        return $fileInfo['name'] . '上传文件过大';
        exit;
    }
    
    // 4.检测上传文件的类型
    $ext = strtolower(pathinfo($fileInfo['name'], PATHINFO_EXTENSION));
    // $allowExt=array('jpeg','jpg','png','gif');//允许上传文件的类型
    if (! in_array($ext, $allowExt)) {
        return $fileInfo['name'] . '非法文件类型';
        exit;
    }
    // 5.检测是否是真实图片
    // $flag=true;//默认检测
    if ($flag) {
        if (! getimagesize($fileInfo['tmp_name'])) {
            return $fileInfo['name'] . '文件不是图片!';
            exit;
        }
    }
    
    // 6.检测是否是通过HTTP POST方式上传上来的
    if (! is_uploaded_file($fileInfo['tmp_name'])) {
        return $fileInfo['name'] . '文件不是通过HTTP方式上传上来的';
        exit;
    }
    
    // 7.移动文件
    // $uploadPath='uploads';
    // 检测目标目录是否存在，不存在则创建
    if (! file_exists($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }
    $uniName = md5(uniqid(microtime(true), true)) . '.' . $ext;
    $dest = $uploadPath . '/' . $uniName;
    if (! @move_uploaded_file($fileInfo['tmp_name'], $dest)) {
        return $fileInfo['name'] . '文件上载失败';
        exit;
    }
    
    $uploadInfo = array(
        'url' => $dest,
        'size' => $fileInfo['size'],
        'type' => $fileInfo['type'],
        'mes' => $fileInfo['name'] . '文件上传成功'
    );
    return $uploadInfo;
}
?>