<?php
print ("\n Processing Categories ...");

/**
 * HTML
 *
 **/
 
 $template_dir = 'templates/'.$post['TEMPLATE'].'/admin/';
 $dest_dir = $www_dir.$post['MODULE'].'/categories/';
 @mkdir($dest_dir,0777,true);


$content = file_get_contents($template_dir.'listCategories.php');
$vars = array(
    "__CAT__IS_VISIBLE__"     => ($post['category.visible']     ? file_get_contents($template_dir.'list/categories/is_visible.php') : ''),
    "__CAT__IMAGE__"          => ($post['category.image']       ? file_get_contents($template_dir.'list/categories/image.php')      : ''),
    "__CAT__SUBTITLE__"       => ($post['category.subtitle']    ? file_get_contents($template_dir.'list/categories/subtitle.php'): ''),
    
    "__CAT__FORM_SUBTITLE__"  => ($post['category.subtitle']    ? file_get_contents($template_dir.'form/categories/subtitle.php'): ''),
    "__CAT__MODAL_IMAGE__"    => ($post['category.image']       ? file_get_contents($template_dir.'modal/categories/image.php')     : ''),
);
foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);

file_put_contents($dest_dir.'index.php', $content);


// Image
 if($post['category.image']){
     $content = file_get_contents($template_dir.'imageCategory.php');
     $vars = array(
        //'__DB__'        => $post['DB'],
        //'__MODULE__'    => $post['MODULE']
     );
     //foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
     foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
     file_put_contents($dest_dir.'image.php', $content);
 } 


/**
 * AJAX
 *
 * */

 $template_dir = 'templates/'.$post['TEMPLATE'].'/ajax/';
 $dest_dir = $ajax_dir.$post['MODULE'].'/categories/';
 @mkdir($dest_dir,0777,true);
 
 $vars = array(
    //'__DB__'            => $post['DB'],
    '__CAT_VISIBLE__'   => ($post['category.visible']       ? 'c.is_visible,'   : ''),
    '__CAT_SUBTITLE__'  => ($post['category.subtitle']      ? 'c.subtitle,'  : ''),
    '__CAT_IMAGE__'     => ($post['category.image']         ? 'c.id image,c.date_image, c.image_size,' : ''),
    
    '__CAT_FILTER_SUBTITLE__'=> ($post['category.subtitle']  ? '"subtitle"=>FILTER_SANITIZE_STRING,'     :''),
 );
 
 // get Categories
 $content = file_get_contents($template_dir.'categories/getCategories.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getCategories.php', $content);
 
 // prepare Category
 $content = file_get_contents($template_dir.'categories/prepareCategories.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'prepareCategories.php', $content);
 
 // post New Category
 $content = file_get_contents($template_dir.'categories/postNewCategory.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postNewCategory.php', $content);
 
 // get Category
 $content = file_get_contents($template_dir.'categories/getCategory.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getCategory.php', $content);
 
 // post Edit Category
 $content = file_get_contents($template_dir.'categories/postEditCategory.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postEditCategory.php', $content);
 
 // post Toggle Category
 $content = file_get_contents($template_dir.'categories/postToggleCategory.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postToggleCategory.php', $content);
 
 // post Delete Category
 $content = file_get_contents($template_dir.'categories/postDeleteCategory.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postDeleteCategory.php', $content);
 
 // post Image
 $content = file_get_contents($template_dir.'categories/postImage.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postImage.php', $content);
 
 

 print ("ok");