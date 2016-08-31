<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c'] == 'opt') {
    require_once EXE . 'PerClass' . EXP . 'State.admin.php';
    $ver = LoginStaFun($_SESSION['id'], $config);
    require EXE . 'PerClass' . EXP . 'Article.admin.php';
    if ($_GET['ip'] == 'edit') {
        $EditArticle = QueryOne($_GET['id'], $config);
        require_once EXE . 'PerClass' . EXP . 'Ify.admin.php';
        $ify = selectIfyIni($config);
        require_once EXE . 'Editor' . EXP . 'edit_js.html';
        require_once EXE . 'Delivery' . EXP . 'edit_article.html';
        if ($_POST['edit_submit']) {
            $array = array(
                FileTer($_POST['title']),
                $_POST['content'],
                FileTer($_POST['rlink']),
                FileTer($_POST['image_link']),
                FileTer($_POST['ify']),
                time(),
                $ver['nickname'],
                $_POST['mend'],
                $_GET['id']
            );
            if (! empty($_GET['id'])) {
                $information = Edit_Article($array, $config);
            } else {
                $information = false;
            }
            if ($information) {
                echo "<script>alert('修改成功!');location.href='?c=art';</script>";
            } else {
                echo "<script>alert('修改失败!');location.href='';</script>";
            }
        }
    }
    if ($_GET['ip'] == 'del') {
        $Del = Del_Article($_GET['id'], $config);
        if ($Del) {
            echo "<script>alert('删除成功!');location.href='?c=art';</script>";
        } else {
            echo "<script>alert('删除失败!');location.href='?c=art';</script>";
        }
    }
    if ($_GET['ip'] == 'mend') {
        if (! empty($_GET['id'])) {
            $Mend = MendUpdate($_GET['v'], $_GET['id'], $config);
            if ($Mend) {
                echo "<script>alert('推荐操作成功!');location.href='?c=art';</script>";
            } else {
                echo "<script>alert('推荐操作失败!');location.href='?c=art';</script>";
            }
        } else {
            echo "<script>alert('操作失败!');location.href='?c=art';</script>";
        }
    }
    if ($_GET['ip'] == 'check') {
        if (! empty($_GET['id'])) {
            $checkArticle = QueryOne($_GET['id'], $config);
            if ($checkArticle['type'] == 'CheckPage') {
                require_once EXE . 'Delivery' . EXP . 'check.html';
                if (! empty($_POST['check'])) {
                    if ($_POST['byname'] !== '0') {
                        $array = array(
                            $_POST['byname'],
                            $_GET['id']
                        );
                        $check = CheckPage($array, $config);
                        if ($check) {
                            echo "<script>alert('文章已经审核!');location.href='?c=art';</script>";
                        } else {
                            echo "<script>alert('审核失败,数据库短路,请重试!');location.href='?c=art';</script>";
                        }
                    } else {
                        echo "<script>alert('没有选择类型,请选择一个类型再审核,Ok..?');location.href='';</script>";
                    }
                }
            } else {
                echo "<script>alert('这个文章是被审核的文章,请不要乱提交参数,谢谢你的合作!');location.href='?c=art';</script>";
            }
        }
    }
}
?>