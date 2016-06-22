<?php
if(isset($_SESSION['admin'])){
    unset($_SESSION['admin']);
}

return json_encode(array('redirect'=>'index.php'));