<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
class MySqlCor{
    
    public $MySql;
    
    function __construct($config) {
         $this->MySql = new PDO("mysql:host=$config[host];dbname=$config[dbname];charset=utf8", $config[username], $config[password]);
         $this->MySql->query("set names utf8");
    }
    
}
?>