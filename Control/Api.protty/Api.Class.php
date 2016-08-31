<?php
/**
 * @param 数据库API类
 * @link www.pder.org
 * @author Protty
 * @copyright POCENT 2015年9月24日00:51:07
 **/
class Api{
    public $MySQL;
    
    function __construct($config) {
        $this->MySql = new PDO("mysql:host=$config[host];dbname=$config[dbname];charset=utf8", $config[username], $config[password]);
        $this->MySql->query("set names utf8");
    }
    
    /**@author Protty 增删改操作
     * @param unknown $sql 预定义SQL语句
     * @param unknown $core 插入内容
     */
    function MySQL_Inner($sql,$core) {
        $Inner = $this->MySql->prepare($sql);
        $ExeCute = $Inner->execute($core);
        return $ExeCute;
    }
    
    /**@author Protty 全部查询操作
     * @param unknown $sql 预定义SQL语句
     * @param unknown $core 插入内容
     */
    function MySQL_Query($sql, $core){
        $Query = $this->MySql->prepare($sql);
        $Query->execute($core);
        $RowAll = $Query->fetchAll(2);
        return $RowAll;
    }
    
    /**@author Protty 单条查询操作
     * @param unknown $sql 预定义SQL语句
     * @param unknown $core 插入内容
     */
    function MySQL_QueryOne($sql,$core) {
        $Query = $this->MySql->prepare($sql);
        $Query->execute($core);
        $Row = $Query->fetch(2);
        return $Row;
    }
    
}

?>