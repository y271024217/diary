<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
include 'Mysql.Class.php';

class IndexCor extends MySqlCor
{

    function IndexQuery($type, $ify, $page, $pageCount)
    {
        $sql = "select * from article where type=:type $ify order by id desc limit $page,$pageCount";
        $art = $this->MySql->prepare($sql);
        $art->execute(array(":type"=>"$type"));
        $query = $art->fetchAll(2);
        return $query;
    }
    
    function IndexIfy($id){
        $sql = "select * from ify where pid=?";
        $art = $this->MySql->prepare($sql);
        $art->execute(array($id));
        $query = $art->fetch(2);
        return $query;
    }
    
    function PageQuery($type)
    {
        $sql = "select * from article where type='$type' order by id desc";
        $art = $this->MySql->prepare($sql);
        $art->execute();
        $query = $art->fetchAll(2);
        return $query;
    }

    function AllQuery()
    {
        $sql = "select * from article order by id desc";
        $art = $this->MySql->prepare($sql);
        $art->execute();
        $query = $art->fetchAll(2);
        return $query;
    }

    function RandArticle($page, $type)
    {
        $sql = "select * from article where type=:type limit $page";
        $art = $this->MySql->prepare($sql);
        $art->execute(array(
            ":type" => "$type"
        ));
        $query = $art->fetchAll(2);
        return $query;
    }

    function OneArticle($id)
    {
        $sql = "select * from article left join ify on article.ify=ify.pid where id=?";
        $art = $this->MySql->prepare($sql);
        $art->execute(array(
            $id
        ));
        $query = $art->fetch(2);
        return $query;
    }

    function IfyQuery($type)
    {
        $sql = "select * from ify where alias=:type order by pid";
        $ify = $this->MySql->prepare($sql);
        $ify->execute(array(
            ":type" => "$type"
        ));
        $select = $ify->fetchAll(2);
        return $select;
    }

    function IfyAndArticleCount($ifyName)
    {
        $sql = "select count(id) as count from article where ify=?";
        $art = $this->MySql->prepare($sql);
        $art->execute(array(
            $ifyName
        ));
        $query = $art->fetch(2);
        return $query;
    }

    function MessageAdd($array)
    {
        $sql = "insert into message (names,content,times,primg,email) values (?,?,?,?,?)";
        $mss = $this->MySql->prepare($sql);
        $age = $mss->execute($array);
        return $age;
    }

    function QueryMessage()
    {
        $sql = "select * from message order by id desc";
        $Message = $this->MySql->prepare($sql);
        $Message->execute();
        $select = $Message->fetchAll(2);
        return $select;
    }

    function QueryTalk($page, $pageSum)
    {
        $sql = "select * from talk order by id desc limit $page,$pageSum";
        $talk = $this->MySql->prepare($sql);
        $talk->execute();
        $select = $talk->fetchAll(2);
        return $select;
    }

    function TalkCount()
    {
        $sql = "select count(id) as count from talk";
        $talk = $this->MySql->prepare($sql);
        $talk->execute();
        $select = $talk->fetch(2);
        return $select;
    }

    function CountMessage($id)
    {
        $sql = "select count(id) as count from message where pid=?";
        $message = $this->MySql->prepare($sql);
        $message->execute(array(
            $id
        ));
        $select = $message->fetch(2);
        return $select;
    }

    function ViewInsert($id)
    {
        $sql = "update article set view=view+1 where id=?";
        $article = $this->MySql->prepare($sql);
        $age = $article->execute(array(
            $id
        ));
        return $age;
    }

    function ArticleCount($type)
    {
        $sql = "select count(id) as count from article where type='$type'";
        $count = $this->MySql->prepare($sql);
        $count->execute();
        $key = $count->fetch(2);
        return $key;
    }

    function VideoQuery($type, $page, $pageCount)
    {
        $sql = "select * from article left join ify on article.ify=ify.pid where type=:type order by id desc limit $page,$pageCount";
        $art = $this->MySql->prepare($sql);
        $art->execute(array(
            ":type" => "$type"
        ));
        $query = $art->fetchAll(2);
        return $query;
    }

    function OneVideo($id)
    {
        $sql = "select * from article left join ify on article.ify=ify.pid where id=? and type='video'";
        $art = $this->MySql->prepare($sql);
        $art->execute(array(
            $id
        ));
        $query = $art->fetch(2);
        return $query;
    }

    function SiteQuery()
    {
        $sql = "select * from site where id = 1";
        $art = $this->MySql->prepare($sql);
        $art->execute();
        $query = $art->fetch(2);
        return $query;
    }

    function UserQuery($id)
    {
        $sql = "select * from user where id=?";
        $user = $this->MySql->prepare($sql);
        $user->execute(array(
            $id
        ));
        $go = $user->fetch(2);
        return $go;
    }

    function CountAll()
    {
        $sql = "select count(id) as count from article";
        $count = $this->MySql->prepare($sql);
        $count->execute();
        $key = $count->fetch(2);
        return $key['count'];
    }

    function IndexUser()
    {
        $sql = "select nickname,sig,sex,img,qq_num,user_mail,user_bri,user_weibo,user_image_new,user_qzone from user where id=1";
        $user = $this->MySql->prepare($sql);
        $user->execute();
        $go = $user->fetch(2);
        return $go;
        ;
    }

    function SearchQuery($q, $page, $pageCount)
    {
        $sql = "select * from article left join ify on article.ify=ify.pid where content like '%$q%' or title like '%$q%' order by id desc limit $page,$pageCount";
        $search = $this->MySql->prepare($sql);
        $search->execute();
        $go = $search->fetchAll(2);
        $count = count($go);
        return array(
            "article" => $go,
            "count" => $count
        );
    }

    function SearchCount($q)
    {
        $sql = "select count(id) as count from article where content like '%$q%' or title like '%$q%'";
        $search = $this->MySql->prepare($sql);
        $search->execute();
        $go = $search->fetch(2);
        return $go;
    }

    function MendCount($type)
    {
        $sql = "select count(id) as count from article where mend=1 and type='$type'";
        $count = $this->MySql->prepare($sql);
        $count->execute();
        $key = $count->fetch(2);
        return $key['count'];
    }

    function OneArt($id, $type)
    {
        $sql = "select * from article where id=:id and type=:type";
        $art = $this->MySql->prepare($sql);
        $art->execute(array(
            ":id" => "$id",
            ":type" => "$type"
        ));
        $query = $art->fetch(2);
        return $query;
    }

    function LinkQuery()
    {
        $sql = "select * from link";
        $art = $this->MySql->prepare($sql);
        $art->execute();
        $query = $art->fetchAll(2);
        return $query;
    }
    function QueryIFYALL(){
        $sql = "select * from ify";
        $art = $this->MySql->prepare($sql);
        $art->execute();
        $query = $art->fetchAll(2);
        return $query;
    }
    function AddCheckPage($array) {
        $sql = "insert into article (title,content,rlink,image_link,ify,times,athor,view,type) values (?,?,?,?,?,?,?,?,?)";
        $page = $this->MySql->prepare($sql);
        $go = $page->execute($array);
        return $go;
    }
    function MusicAll_xiami() {
        $sql = "select * from upload where athor='虾米官方'";
        $art = $this->MySql->prepare($sql);
        $art->execute();
        $query = $art->fetchAll(2);
        return $query;
    }
}
?>