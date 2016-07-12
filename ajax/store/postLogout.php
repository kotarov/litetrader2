<?php
if(isset($_SESSION['store'])){
    unset($_SESSION['store']);
}

return json_encode(array('redirect'=>'index.php'));