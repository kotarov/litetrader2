<?php
print ("\n Processing Owner ...");


/**
 * AJAX
 *
 * */

 $template_dir = 'templates/'.$post['TEMPLATE'].'/ajax/';
 $dest_dir = $ajax_dir.$post['MODULE'].'/owners/';
 @mkdir($dest_dir,0777,true);
 
 // get Units
 $content = file_get_contents($template_dir.'owners/getOwners.php');
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getOwners.php', $content);
 

 
 print ("ok");
  
 if(!file_exists($sqlite_dir.'schema/'.$post['owner.db'].'.sql')) 
    print("   - !!! WARNING: The DB '".$post['owner.db']."' - not installed !");
 