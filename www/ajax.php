<?php
define('DIR_BASE', realpath('../').'/' );
define('BASE_DIR', DIR_BASE            );

define(  'DB_DIR', realpath('../sqlite/').'/'           );
define( 'LIB_DIR', realpath('../lib/'   ).'/'           );
define( 'INI_DIR', realpath('../ini/'   ).'/'           );
define('MAIL_DIR', realpath('../templates/bulgaria/mails/').'/'  );

if( isset($_GET['f']) 
    && file_exists('../ajax/www/'.$_GET['f'].'.php') 
    && chdir(dirname('../ajax/www/'.$_GET['f'])) 
){
    include(LIB_DIR."URLBase.php");
 
    define('URL_BASE', base_url( realpath(__DIR__.'/') ));
    define('URL_PRODUCTS', 'products/index.php');
    define('URL_PRODUCT', 'products/view/index.php');
    
    echo include basename($_GET['f']).'.php' ;
}
