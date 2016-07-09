<?php
session_start();

if(isset($_SESSION['customer'])){
    unset($_SESSION['customer']);
}

return json_encode(array('redirect'=>URL_BASE.'home/index.php'));