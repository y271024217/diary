<?php
/**
 * @param Protty
 * @url www.pder.org
 **/
if ($_GET['c']=='out'){
    session_destroy();
    header("location:../admin");
}
 ?>