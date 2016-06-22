<?php
if(isset($_SESSION['admin']))
    return json_encode($_SESSION['admin']);
else
    return json_encode(array('access_denided'=>1));