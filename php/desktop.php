<?php
session_start();
/*
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
          && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') 
{ 
    unset($_SESSION['obj']);
}
*/
unset($_SESSION['obj']);
include_once('../view/desktop.php');
