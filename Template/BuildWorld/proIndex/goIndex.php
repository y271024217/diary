<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
session_start();
$user = UserQuery($_SESSION['id'], $config);
?>