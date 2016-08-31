<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
include_once 'Control/Api.protty/Api.Class.php';//API入口文件

/**
 * @author Protty
 * Mysql的Api静态访问类
 */
class MysqlApi{
    
    /** 静态执行MySQL增删改
     * @param unknown $sql
     * @param unknown $core
     */
    static function MysqlInner($sql, $core, $config){
        $Mysql = new Api($config);
        $Complete = $Mysql->MySQL_Inner($sql, $core);
        return $Complete;
    }
    /** 查询全部的记录
     * @param unknown $sql
     * @param unknown $core
     */
    static function MysqlQuery($sql , $core, $config){
        $Mysql = new Api($config);
        $Complete = $Mysql->MySQL_Query($sql, $core);
        return $Complete;
    }
    
    /** 查询单条记录
     * @param unknown $sql
     * @param unknown $core
     * @return unknown
     */
    static function MysqlQuerOne($sql, $core, $config){
        $Mysql = new Api($config);
        $Complete = $Mysql->MySQL_QueryOne($sql, $core);
        return $Complete;
    }
}
?>