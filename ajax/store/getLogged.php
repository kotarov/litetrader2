<?php
if(isset($_SESSION['store']))
    return json_encode($_SESSION['store']);
else
    return json_encode(array('access_denided'=>1));