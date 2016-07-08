<?php
session_start();

if(isset($_SESSION['customer']))
    return json_encode($_SESSION['customer']);
elseif(isset($_SESSION['order']))
    return json_encode($_SESSION['order']);