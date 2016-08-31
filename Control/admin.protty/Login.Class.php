<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
include 'Mysql.Class.php';
class LoginCor extends MySqlCor{
    function LoginPer ($u,$p){
        $sql = "select * from user where username=? and password=?";
        $per = $this->MySql->prepare($sql);
        $per->execute(array($u,$p));
        $arr = $per->fetch(2);
        return $arr;
    }
    function SiteQuery() {
        $sql = "select * from user";
        $per = $this->MySql->prepare($sql);
        $per->execute();
        $arr = $per->fetch(2);
        return $arr;
    }
    function ForgetPass($user) {
        $sql = "update user set password=? where id=1";
        $per = $this->MySql->prepare($sql);
        $arr = $per->execute(array($user));
        return $arr;
    }
}
