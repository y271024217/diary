<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
include 'Mysql.Class.php';

class AdminCor extends MySqlCor
{

    function LoginSta($id)
    {
        $sql = "select * from user where id=?";
        $per = $this->MySql->prepare($sql);
        $per->execute(array(
            $id
        ));
        $ret = $per->fetch(2);
        return $ret;
    }

    function MySets($set, $where)
    {
        $sql = "update user set $set $where";
        $per = $this->MySql->prepare($sql);
        $go = $per->execute();
        return $go;
    }

    function SiteIni()
    {
        $sql = "select * from site";
        $per = $this->MySql->prepare($sql);
        $per->execute();
        $go = $per->fetch(2);
        return $go;
    }

    function SiteSets($set)
    {
        $sql = "update site set $set where id=1";
        $per = $this->MySql->prepare($sql);
        $go = $per->execute();
        return $go;
    }

    function Addarticle($array)
    {
        $sql = "insert into article (title,content,rlink,image_link,ify,times,athor,mend,type) values (?,?,?,?,?,?,?,?,?)";
        $article = $this->MySql->prepare($sql);
        $add = $article->execute($array);
        return $add;
    }

    function EditArticle($array)
    {
        $sql = "update article set title=?,content=?,rlink=?,image_link=?,ify=?,times=?,athor=?,mend=? where id=?";
        $article = $this->MySql->prepare($sql);
        $edit = $article->execute($array);
        return $edit;
    }

    function DelArticle($id)
    {
        $sql = "delete from article where id=$id";
        $article = $this->MySql->prepare($sql);
        $del = $article->execute(array(
            $id
        ));
        return $del;
    }

    function Addify($array)
    {
        $sql = "insert into ify (ify_name,alias,the) values(?,?,?)";
        $ify = $this->MySql->prepare($sql);
        $add = $ify->execute($array);
        return $add;
    }

    function UpdateIfy($array)
    {
        $sql = "update ify set ify_name=?,alias=?,the=? where pid=?";
        $ify = $this->MySql->prepare($sql);
        $edit = $ify->execute($array);
        return $edit;
    }

    function OneIfy($id)
    {
        $sql = "select * from ify where pid=?";
        $ify = $this->MySql->prepare($sql);
        $ify->execute(array(
            $id
        ));
        $select = $ify->fetch(2);
        return $select;
    }

    function SelectIfy($page, $pageCount)
    {
        $sql = "select * from ify order by pid desc limit $page,$pageCount";
        $ify = $this->MySql->prepare($sql);
        $ify->execute();
        $select = $ify->fetchAll(2);
        return $select;
    }

    function SelectIfyIni()
    {
        $sql = "select * from ify";
        $ify = $this->MySql->prepare($sql);
        $ify->execute();
        $select = $ify->fetchAll(2);
        return $select;
    }

    function DelIfy($id)
    {
        $sql = "delete from ify where pid=?";
        $ify = $this->MySql->prepare($sql);
        $del = $ify->execute(array(
            $id
        ));
        return $del;
    }

    function CountIfy()
    {
        $sql = "select count(pid) as count from ify";
        $ify = $this->MySql->prepare($sql);
        $ify->execute();
        $select = $ify->fetch(2);
        return $select;
    }

    function QueryArticle($page, $pageCount, $type)
    {
        $sql = "select * from article left join ify on article.ify=ify.pid where article.type=:type order by id desc limit $page,$pageCount";
        $art = $this->MySql->prepare($sql);
        $art->execute(array(
            ":type" => $type
        ));
        $query = $art->fetchAll(2);
        return $query;
    }

    function ArticleCount($type)
    {
        $sql = "select count(id) as count from article where type=:type";
        $art = $this->MySql->prepare($sql);
        $art->execute(array(
            ":type" => "$type"
        ));
        $quety = $art->fetch(2);
        return $quety;
    }

    function ArtIndexCount()
    {
        $sql = "select count(id) as count from article";
        $art = $this->MySql->prepare($sql);
        $art->execute();
        $quety = $art->fetch(2);
        return $quety;
    }

    function QueryArticleOne($id)
    {
        $sql = "select * from article where id=?";
        $art = $this->MySql->prepare($sql);
        $art->execute(array(
            $id
        ));
        $query = $art->fetch(2);
        return $query;
    }

    function UpdateMss($array)
    {
        $sql = "update site set mss_html=?,mss_url=? where id=1";
        $mss = $this->MySql->prepare($sql);
        $go = $mss->execute($array);
        return $go;
    }

    function MendUpdate($mend, $id)
    {
        $sql = "update article set mend=? where id=?";
        $mss = $this->MySql->prepare($sql);
        $go = $mss->execute(array(
            $mend,
            $id
        ));
        return $go;
    }

    function TypeTemt($type)
    {
        $sql = "update site set article_type=? where id=1";
        $mss = $this->MySql->prepare($sql);
        $go = $mss->execute(array(
            $type
        ));
        return $go;
    }

    function TalkNew($array)
    {
        $sql = "insert into talk (content,times,at) values(?,?,?)";
        $talk = $this->MySql->prepare($sql);
        $add = $talk->execute($array);
        return $add;
    }

    function TalkQ($page, $p)
    {
        $sql = "select * from talk order by id desc limit $page,$p";
        $art = $this->MySql->prepare($sql);
        $art->execute();
        $query = $art->fetchAll(2);
        return $query;
    }

    function TalkDel($id)
    {
        $sql = "delete from talk where id=?";
        $TalkDel = $this->MySql->prepare($sql);
        $del = $TalkDel->execute(array(
            $id
        ));
        return $del;
    }

    function TalkAllNum()
    {
        $sql = "select count(id) as count from talk";
        $talk = $this->MySql->prepare($sql);
        $talk->execute();
        $key = $talk->fetch(2);
        return $key;
    }

    function TalkQone()
    {
        $sql = "select * from talk order by id desc";
        $talk = $this->MySql->prepare($sql);
        $talk->execute();
        $key = $talk->fetch(2);
        return $key;
    }

    function MessageQ($page, $p)
    {
        $sql = "select * from message order by id desc limit $page,$p";
        $msg = $this->MySql->prepare($sql);
        $msg->execute();
        $all = $msg->fetchAll(2);
        return $all;
    }

    function MessageOne($id)
    {
        $sql = "select * from message where id=?";
        $msg = $this->MySql->prepare($sql);
        $msg->execute(array(
            $id
        ));
        $key = $msg->fetch(2);
        return $key;
    }

    function MessageReply($content, $id)
    {
        $sql = "update message set content=? where id=?";
        $msg = $this->MySql->prepare($sql);
        $go = $msg->execute(array(
            $content,
            $id
        ));
        return $go;
    }

    function MessageAllNum()
    {
        $sql = "select count(id) as count from message";
        $msg = $this->MySql->prepare($sql);
        $msg->execute();
        $key = $msg->fetch(2);
        return $key;
    }

    function MessageDel($id)
    {
        $sql = "delete from message where id=?";
        $MessageDel = $this->MySql->prepare($sql);
        $del = $MessageDel->execute(array(
            $id
        ));
        return $del;
    }

    function LinkAdd($array)
    {
        $sql = "insert into link (link_title,link_url,link_content,link_res,link_time) values (?,?,?,?,?)";
        $link = $this->MySql->prepare($sql);
        $go = $link->execute($array);
        return $go;
    }

    function LinkQuery($page, $p)
    {
        $sql = "select * from link order by id desc limit $page,$p";
        $msg = $this->MySql->prepare($sql);
        $msg->execute();
        $all = $msg->fetchAll(2);
        return $all;
    }

    function LinkNum($id)
    {
        $sql = "select * from link where id=?";
        $msg = $this->MySql->prepare($sql);
        $msg->execute(array(
            $id
        ));
        $all = $msg->fetch(2);
        return $all;
    }

    function LinkEdit($array)
    {
        $sql = "update link set link_title=?,link_url=?,link_content=? where id=?";
        $LinkEdit = $this->MySql->prepare($sql);
        $go = $LinkEdit->execute($array);
        return $go;
    }

    function LinkDel($id)
    {
        $sql = "delete from link where id=?";
        $LinkDel = $this->MySql->prepare($sql);
        $del = $LinkDel->execute(array(
            $id
        ));
        return $del;
    }

    function LinkHidden($array)
    {
        $sql = "update link set link_res=? where id=?";
        $LinkEdit = $this->MySql->prepare($sql);
        $go = $LinkEdit->execute($array);
        return $go;
    }

    function LinkAll()
    {
        $sql = "select count(id) as count from link";
        $msg = $this->MySql->prepare($sql);
        $msg->execute();
        $all = $msg->fetch(2);
        return $all;
    }
    function AddUpload($array) {
        $sql = "insert into upload (rlink,title,times,athor) values (?,?,?,?)";
        $link = $this->MySql->prepare($sql);
        $go = $link->execute($array);
        return $go;
    }
    function UploadQuery($page,$p) {
        $sql = "select * from upload  where athor!='虾米官方' order by id desc limit $page,$p";
        $upload = $this->MySql->prepare($sql);
        $upload->execute();
        $all = $upload->fetchAll(2);
        return $all;
    }
    function UploadQuery_xiami($page,$p) {
        $sql = "select * from upload where athor='虾米官方' order by id desc limit $page,$p";
        $upload = $this->MySql->prepare($sql);
        $upload->execute();
        $all = $upload->fetchAll(2);
        return $all;
    }
    function UploadCount() {
        $sql = "select count(id) as count from upload";
        $Upload = $this->MySql->prepare($sql);
        $Upload->execute();
        $all = $Upload->fetch(2);
        return $all;
    }
    function UploadDel($id) {
        $sql = "delete from upload where id=?";
        $UploadDel = $this->MySql->prepare($sql);
        $del = $UploadDel->execute(array(
            $id
        ));
        return $del;
    }
    function CheckPage($array) {
        $sql = "update article set type=? where id=?";
        $LinkEdit = $this->MySql->prepare($sql);
        $go = $LinkEdit->execute($array);
        return $go;
    }
}

?>