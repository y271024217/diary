<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
require_once ICN_URL . 'api.inc.php';

function ViewFeach($table, $Filed, $More, $config){
    $sql = MysqlApi::MysqlQuery("select $Filed from $table $More", array() , $config);
    return $sql;
}
function ViewTech($table, $Filed, $More, $config){
    $sql = MysqlApi::MysqlQuerOne("select $Filed from $table $More", array(), $config);
    return $sql;
}

?>