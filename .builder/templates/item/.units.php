<?php
print ("\n Processing Units ...");

/**
 * HTML
 *
 **/
 
 $template_dir = 'templates/'.$post['TEMPLATE'].'/admin/';
 $dest_dir = $www_dir.$post['MODULE'].'/units/';
 @mkdir($dest_dir,0777,true);


$content = file_get_contents($template_dir.'listUnits.php');
foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);

file_put_contents($dest_dir.'index.php', $content);


/**
 * AJAX
 *
 * */

 $template_dir = 'templates/'.$post['TEMPLATE'].'/ajax/';
 $dest_dir = $ajax_dir.$post['MODULE'].'/units/';
 @mkdir($dest_dir,0777,true);
 
 // get Units
 $content = file_get_contents($template_dir.'units/getUnits.php');
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getUnits.php', $content);
 
 // post New Unit
 $content = file_get_contents($template_dir.'units/postNew.php');
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postNew.php', $content);
 
 // post Edit Unit
 $content = file_get_contents($template_dir.'units/postEdit.php');
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postEdit.php', $content);
 
 // post Delete
 $content = file_get_contents($template_dir.'units/postDelete.php');
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postDelete.php', $content);
 
 // post Toggle
 $content = file_get_contents($template_dir.'units/postToggle.php');
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postToggle.php', $content);
 
 
  print ("ok");
 