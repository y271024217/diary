<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['i'] == 'chat') {
    $SITE = SITE($config);
    $users = IndexUser($config);
    $ext = getMail($users['user_mail']);
    $new_article = ALLARTICLE($config);
    $articleCount = CountAll($config);
    $imgs = array(
        "http://tupian.qqjay.com/tou3/2015/0728/3814e6a32b777a47fb630d7261c6fecb.jpg",
        "http://tupian.qqjay.com/tou3/2015/0728/aa9f434fa2d94c1329ca8588c8df26d9.jpg",
        "http://tupian.qqjay.com/tou3/2015/0728/642db527b363fc57e8aa7c8c64b364a3.jpg",
        "http://tupian.qqjay.com/tou3/2015/0728/fa46b81a2c4a50304d060c38710aaa56.jpg",
        "http://tupian.qqjay.com/tou3/2015/0728/6c8d643512ba2be096402512f4b399de.png",
        "http://tupian.qqjay.com/tou3/2015/0728/fc6ef82a04930bb178f10b03b9af2f00.jpg",
        "http://tupian.qqjay.com/tou3/2015/0728/13169b8f5ecb94fb53ce737e1869ae4a.jpg",
        "http://tupian.qqjay.com/tou3/2015/0728/142f384623cd14e4f12be8ab27f1aac4.jpg",
        "http://tupian.qqjay.com/tou3/2015/0728/ae36e1f1d2e4b9fc8e76bb36778e47a2.jpg",
        "http://tupian.qqjay.com/tou3/2015/0728/7be7f4d3ff1182ecb6861633a022b1e0.jpg",
        "http://tupian.qqjay.com/tou3/2015/0712/4842004fed5a56b7ee64eafa2be79404.jpg",
        "http://tupian.qqjay.com/tou3/2015/0712/7738bbbe8ea9a9e154adfcd838f52291.jpg",
        "http://tupian.qqjay.com/tou3/2015/0712/0f0665bd95a3d14488e4ef4ed5f58c77.jpg",
        "http://tupian.qqjay.com/tou3/2015/0712/9ab3f64816b4d7b4170d2d2de15317b6.jpg",
        "http://tupian.qqjay.com/tou3/2015/0712/f787bb28943baae0588086e3bd09c2de.jpg"
    );
    $rand = mt_rand(0, count($imgs) - 1);
    shuffle($imgs);
    $MessAge = QUERYMESSAGE($config);
    $count = count($MessAge);
    $page = 4;
    $TalkCount = TalkCount($config); // 心情总数
    $PageCount = THISPAGE($TalkCount, $page); // 心情页码总数
    $m = 1;
    if (! empty($_GET['m'])) {
        $m = $_GET['m'];
        if ($m <= 1) {
            $m = 1;
        }
        if ($m >= $PageCount) {
            $m = $PageCount;
        }
    }
    $prepage = $m - 1; // 上一页
    $nextpage = $m + 1; // 下一页
    $pagego = ($m - 1) * $page;
    $TalkQuery = TalkQuery($pagego, $page, $config);
    if ($ext == '163.com') {
        $mail_ext = "网易邮箱";
    } elseif ($ext == '126.com') {
        $mail_ext = "网易邮箱";
    } elseif ($ext == 'qq.com') {
        $mail_ext = "QQ邮箱";
    } else {
        $mail_ext = "私人邮箱";
    }
    require_once TEMP_URL . '/chat.html';
}
if ($_GET['i'] == 'post') {
    if ($_GET['ip'] == 'message') {
        if (! empty($_POST['mss_submit']) && ! empty($_POST['mss_content']) && ! empty($_POST['mss_name'])) {
            $imgs = array(
                "http://tupian.qqjay.com/tou3/2015/0728/3814e6a32b777a47fb630d7261c6fecb.jpg",
                "http://tupian.qqjay.com/tou3/2015/0728/aa9f434fa2d94c1329ca8588c8df26d9.jpg",
                "http://tupian.qqjay.com/tou3/2015/0728/642db527b363fc57e8aa7c8c64b364a3.jpg",
                "http://tupian.qqjay.com/tou3/2015/0728/fa46b81a2c4a50304d060c38710aaa56.jpg",
                "http://tupian.qqjay.com/tou3/2015/0728/6c8d643512ba2be096402512f4b399de.png",
                "http://tupian.qqjay.com/tou3/2015/0728/fc6ef82a04930bb178f10b03b9af2f00.jpg",
                "http://tupian.qqjay.com/tou3/2015/0728/13169b8f5ecb94fb53ce737e1869ae4a.jpg",
                "http://tupian.qqjay.com/tou3/2015/0728/142f384623cd14e4f12be8ab27f1aac4.jpg",
                "http://tupian.qqjay.com/tou3/2015/0728/ae36e1f1d2e4b9fc8e76bb36778e47a2.jpg",
                "http://tupian.qqjay.com/tou3/2015/0728/7be7f4d3ff1182ecb6861633a022b1e0.jpg",
                "http://tupian.qqjay.com/tou3/2015/0712/4842004fed5a56b7ee64eafa2be79404.jpg",
                "http://tupian.qqjay.com/tou3/2015/0712/7738bbbe8ea9a9e154adfcd838f52291.jpg",
                "http://tupian.qqjay.com/tou3/2015/0712/0f0665bd95a3d14488e4ef4ed5f58c77.jpg",
                "http://tupian.qqjay.com/tou3/2015/0712/9ab3f64816b4d7b4170d2d2de15317b6.jpg",
                "http://tupian.qqjay.com/tou3/2015/0712/f787bb28943baae0588086e3bd09c2de.jpg"
            );
            $rand = mt_rand(0, count($imgs) - 1);
            shuffle($imgs);
            $content = FileTer($_POST['mss_content']);
            $names = FileTer($_POST['mss_name']);
            $mail = FileTer($_POST['mss_mail']);
            $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i"; // 邮箱正则
            $times = time();
            $img = $imgs['0'];
            if (preg_match($pattern, $mail)) {
                if (! isset($names{24})) { // 24=8个中文字符串 3*8
                    if (! isset($content{630})) {
                        $array = array(
                            $names,
                            $content,
                            $times,
                            $img,
                            $mail
                        );
                        $if = MESSAGEADD($array, $config);
                        if ($if) {
                            echo "<script>alert('成功!');location.href='?i=chat';</script>";
                        } else {
                            echo "<script>alert('失败!');location.href='?i=chat';</script>";
                        }
                    } else {
                        echo "<script>alert('失败,你的内容过长,请不要超过210个字!');location.href='?i=chat';</script>";
                    }
                } else {
                    echo "<script>alert('失败,你的名字过长,请不要超过八个字!');location.href='?i=chat';</script>";
                }
            } else {
                echo "<script>alert('失败,原因很简单,你没有输入一个真实的邮箱,如果不以真实信息发送聊天的,将会被永久加入黑名单!');location.href='?i=chat';</script>";
            }
        } else {
            header("location:?i=chat");
        }
    }
}
?>