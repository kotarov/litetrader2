<?php
print ("\n Processing Items ...");

/**
 * INI
 * 
 * */

$template_dir = 'templates/'.$post['TEMPLATE'].'/ini/';
$dest_dir = $ini_dir.$post['MODULE'].'/schema/';
@mkdir($dest_dir,0777,true);

$content = file_get_contents($template_dir.'images.ini');
file_put_contents($dest_dir.'images.ini', $content);
if(!file_exists($dest_dir.'../images.ini')) file_put_contents($dest_dir.'../images.ini', $content);



/**
 * SQL
 * 
 * */

$template_dir = 'templates/'.$post['TEMPLATE'].'/sqlite/';
$dest_dir = $sqlite_dir.'schema/';
@mkdir($dest_dir,0777,true);

$content = file_get_contents($template_dir.'main.sql');
if($post['category']) $content .= file_get_contents($template_dir.'categories.sql');
if($post['unit']) $content .= file_get_contents($template_dir.'units.sql');

file_put_contents($dest_dir.$post['MODULE'].'.sql', $content);
if(!file_exists($dest_dir.'../'.$post['MODULE'])) {
    shell_exec('sqlite3 "'.$dest_dir.'../'.$post['MODULE'].'" < '.$dest_dir.$post['MODULE'].'.sql' );
}



/**
 * HTML
 *
 **/
 
 $template_dir = 'templates/'.$post['TEMPLATE'].'/admin/';
 $dest_dir = $www_dir.$post['MODULE'].'/';
 @mkdir($dest_dir,0777,true);
 
 
 // List Items
 $content = file_get_contents($template_dir.'list.php');
 $vars = array(
    '__LSIT__IS_VISIBLE__'    => ($post['visible']      ? file_get_contents($template_dir.'list/is_visible.php')    : ''),
    '__LSIT__IS_AVAIBLE__'    => ($post['avaible']      ? file_get_contents($template_dir.'list/is_avaible.php')    : ''),
    '__LSIT__IS_ADVERTISE__'  => ($post['advertise']    ? file_get_contents($template_dir.'list/is_advertise.php')  : ''),
    '__LSIT__IS_ACTIVE__'     => ($post['active']       ? file_get_contents($template_dir.'list/is_active.php')     : ''),
    '__LIST__DATE_ADD__'      => ($post['date_add']     ? file_get_contents($template_dir.'list/date_add.php')      : ''),
    '__LSIT__QTY__'           => ($post['qty']          ? file_get_contents($template_dir.'list/qty.php')           : ''),
    '__LSIT__UNIT__'          => ($post['unit']         ? file_get_contents($template_dir.'list/unit.php')          : ''),
    '__LSIT__PRICE__'         => ($post['price']        ? file_get_contents($template_dir.'list/price.php')         : ''),
    '__LSIT__REFERENCE__'     => ($post['reference']    ? file_get_contents($template_dir.'list/_reference.php')    : ''),
    '__LSIT__CATEGORY__'      => ($post['category']     ? file_get_contents($template_dir.'list/category.php')      : ''),
    '__LSIT__OWNER__'         => ($post['owner.person'] ? file_get_contents($template_dir.'list/owner_person.php')  : ''),
    '__LIST__OWNER_COMPANY__' => ($post['owner.company']? file_get_contents($template_dir.'list/owner_company.php') : ''),
    '__LSIT__IMAGE__'         => ($post['image']        ? file_get_contents($template_dir.'list/image.php')         : ''),
    
    '__BUTTON__OWNER__'       => $post['owner.person'] && $post['owner.person.filter']  ? file_get_contents($template_dir.'list/button_owner_person.php') : '',
    '__BUTTON__OWNER_COMPANY__'=>$post['owner.company']&& $post['owner.company.filter'] ? file_get_contents($template_dir.'list/button_owner_company.php') : '',
    
    '__FILTER__OWNER__'       => $post['owner.person'] && $post['owner.person.filter']  ? file_get_contents($template_dir.'list/filter_owner_person.php') : '',
    '__FILTER__OWNER_COMPANY__'=>$post['owner.company']&& $post['owner.company.filter'] ? file_get_contents($template_dir.'list/filter_owner_company.php') : '',
    
    
    '__FORM__REFERENCE__'     => ($post['reference']  ? file_get_contents($template_dir.'form/reference.php')     : ''),
    '__FORM__PRICE__'         => ($post['price']      ? file_get_contents($template_dir.'form/price.php')         : ''),
    
    '__FORM__QTY__'           => ($post['qty']        ? file_get_contents($template_dir.'form/qty.php')           : ''),
    '__FORM__UNIT__'          => ($post['unit']       ? file_get_contents($template_dir.'form/unit.php')          : ''),
    '__FORM__DATE_ADD__'      => ($post['date_add']   ? file_get_contents($template_dir.'form/date_add.php')      : ''),
    
    '__FORM__CATEGORY__'      => ($post['category']     ? file_get_contents($template_dir.'form/category.php')      : ''),
    '__FORM__OWNER__'         => ($post['owner.person'] ? file_get_contents($template_dir.'form/owner_person.php')         : ''),
    '__FORM__OWNER_COMPANY__' => ($post['owner.company']? file_get_contents($template_dir.'form/owner_company.php')         : ''),
    '__FORM__DESCRIPTION__'   => ($post['description']  ? file_get_contents($template_dir.'form/description.php')   : ''),
    
    '__MODAL__IMAGE__'        => ($post['image']      ? file_get_contents($template_dir.'modal/image.php')        : ''),
 );
 
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 $content = str_replace('__REFERENCE__', $vars['__LSIT__REFERENCE__'], $content);
 file_put_contents($dest_dir.'index.php', $content);


 // Image
 if($post['image']){
     $content = file_get_contents($template_dir.'image.php');
     $vars = array(
        '__DB__'        => $post['DB'],
        '__MODULE__'    => $post['MODULE']
     );
     foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
     file_put_contents($dest_dir.'/image.php', $content);
 } 
 


 

/**
 * AJAX
 *
 * */

 $template_dir = 'templates/'.$post['TEMPLATE'].'/ajax/';
 $dest_dir = $ajax_dir.$post['MODULE'].'/';
 @mkdir($dest_dir,0777,true);
 
 $attach_db = array();
 if($post['owner.person']||$post['owner.company']) $attach_db[$post['__owner.db__']] = "\$dbh->query(\"ATTACH DATABASE '\".DB_DIR.\"__owner.db__' as 'db___owner.db__';\");";
 
 $vars = array(
    '__ATTACH_DB__'     => implode("\n",$attach_db),
    '__IS_VISIBLE__'    => ($post['visible']        ? 'items.is_visible,'   :''),
    '__IS_AVAIBLE__'    => ($post['avaible']        ? 'items.is_avaible,'   :''),
    '__IS_ACTIVE__'     => ($post['active']         ? 'items.is_active,'    :''),
    '__IS_ADVERTISE__'  => ($post['advertise']      ? 'items.is_advertise,' :''),
    '__REFERENCE__'     => ($post['reference']      ? 'items.reference,'    :''),
    '__DATE_ADD__'      => ($post['date_add']       ? "strftime('%d.%m.%Y %H:%M',datetime(items.date_add,'unixepoch')) date_add,"  :''),
    '__ID_UNIT__'       => ($post['unit']           ? 'items.id_unit,'      :''),
    '__UNIT_NAME__'     => ($post['unit']           ? 'unit.abbreviation unit,'     :''),
    '__JOIN_UNIT__'     => ($post['unit']           ? 'LEFT JOIN units unit ON (items.id_unit = unit.id)':''),
    '__QTY__'           => ($post['qty']            ? 'items.qty,'          :''),
    '__PRICE__'         => ($post['price']          ? 'items.price,'        :''),
    
    '__ID_OWNER__'      => ($post['owner.person']   ? 'items.id_owner,'     :''), // for form
    '__OWNER__'         => ($post['owner.person']   ? "owner.name||' '||owner.family owner,"         :''),
    '__JOIN_OWNER__'    => ($post['owner.person']   ? 'LEFT JOIN db___owner.db__.partners owner ON (items.id_owner = owner.id) ':''),
    '__WHERE_OWNERS__'      =>$post['owner.person'] ? 'if( isset($_SESSION[\'__PROJECT__\'][\'access\'][\'suppliers_persons\']) ) $where .= " AND items.id_owner IN (".implode(\',\',array_keys($_SESSION[\'__PROJECT__\'][\'access\'][\'suppliers_persons\'])).")";':'',
    
    '__ID_OWNER_COMPANY__'=>$post['owner.company']   ? 'items.id_owner_company,'    :'',
    '__OWNER_COMPANY__' => ($post['owner.company']   ? "owner_company.name owner_company,"         :''),
    '__JOIN_OWNER_COMPANY__'=>($post['owner.company']? 'LEFT JOIN db___owner.db__.companies owner_company ON (owner_company.id = items.id_owner_company) ':''),
    '__WHERE_OWNER_COMPANIES__'=>$post['owner.company']? 'if( isset($_SESSION[\'__PROJECT__\'][\'access\'][\'suppliers_companies\']) ) $where .= " AND items.id_owner_company IN (".implode(\',\',array_keys($_SESSION[\'__PROJECT__\'][\'access\'][\'suppliers_companies\'])).")";':'',
    
    '__DESCRIPTION__'   => ($post['description']? 'items.description,'  :''),
    '__ID_CATEGORY__'   => ($post['category']   ? 'items.id_category,' : ''),
    '__CATEGORY__'      => ($post['category']   ? 'c.title category, c.is_visible cat_is_visible,' : ''),
    '__IMAGE__'         => ($post['image']      ? 'img.id image, img.date_add date_image,(SELECT COUNT(id) FROM images WHERE id_item = items.id) nb_images,'   :''),
    '__JOIN_CATEGORY__' => ($post['category']   ? 'LEFT JOIN categories c ON (c.id = items.id_category) ':''),
    '__JOIN_IMAGES__'   => ($post['image']      ? 'LEFT JOIN images img ON (items.id = img.id_item AND img.is_cover = 1)':''),
    '__FORM_DATE_ADD__' => ($post['date_add']   ? "strftime('%d.%m.%Y',datetime(items.date_add,'unixepoch')) date_add,strftime('%H:%M',datetime(items.date_add,'unixepoch')) date_add_time,"  :''),
    
    '__SANITIZE_PRICE__'=> ($post['price']      ? 'if(isset($_POST["price"]) && strpos($_POST["price"], ".") === FALSE){ $_POST["price"] = str_replace(",", ".", $_POST["price"]); }':''),
    
    '__FILTER_DESCRIPTION__'=> ($post['description'] ? '"description"=>FILTER_SANITIZE_STRING,' : ""),
    '__FILTER_OWNER__'      => ($post['owner.person'] ? '"id_owner"=>FILTER_VALIDATE_INT,"owner"=>FILTER_SANITIZE_STRING,' : ''),
    '__FILTER_OWNER_COMPANY__'=> ($post['owner.company']? '"id_owner_company"=>FILTER_VALIDATE_INT,"owner_company"=>FILTER_SANITIZE_STRING,' : ''),
    
    '__FILTER_CATEGORY__'   => ($post['category']    ? '"id_category"=>FILTER_VALIDATE_INT,' : ''),
    '__FILTER_UNIT__'       => ($post['unit']        ? '"id_unit"=>FILTER_VALIDATE_INT,' : ""),
    '__FILTER_QTY__'        => ($post['qty']         ? '"qty"=>array("filter"=>FILTER_SANITIZE_NUMBER_FLOAT, "flags"=>FILTER_FLAG_ALLOW_FRACTION ),' : ""),
    '__FILTER_PRICE__'      => ($post['price']       ? '"price"=>array( "filter"=>FILTER_SANITIZE_NUMBER_FLOAT, "flags"=>FILTER_FLAG_ALLOW_FRACTION ),' : ""),
    '__FILTER_REFERENCE__'  => ($post['reference']   ? '"reference"=>FILTER_SANITIZE_STRING,' : ""),
    //'__FILTER_DATE_ADD__'   => ($post['date_add']  ? '"date_add"=>FILTER_VALIDATE_INT,"date_add_time"=>FILTER_VALIDATE_INT,' : ''),
    '__POST_DATE_ADD__'     => ($post['date_add']    ?  'if(isset($_POST["date_add"]) && $_POST["date_add"] && isset($_POST["date_add_time"]) && $_POST["date_add_time"]) $post["date_add"] = strtotime($_POST["date_add"]." ".$_POST["date_add_time"]);':''),
    '__POST_OWNER__'        =>($post['owner.person'] ? file_get_contents($template_dir.'owners/post/owner_person.php'):''),
    '__POST_OWNER_COMPANY__'=>($post['owner.company']? file_get_contents($template_dir.'owners/post/owner_company.php'):''),
    
    '__REQUIRE_PRICE__'     => ($post['price']       ? 'if(!$post["price"]) $ret["required"][] = "price";' : ""),
    '__REQUIRE_DESCRIPTION__'=>($post['description'] ? 'if(!$post["description"]) $ret["required"][] = "description";' : ''),
    
    // categories
    

 );
 
 // get Items
 $content = file_get_contents($template_dir.'getItems.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'/getItems.php', $content);
 
 // get Item
 $content = file_get_contents($template_dir.'getItem.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'/getItem.php', $content);
 
 // post New Item
 $content = file_get_contents($template_dir.'postNewItem.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'/postNewItem.php', $content);
 
  // post Edit Item
 $content = file_get_contents($template_dir.'postEditItem.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'/postEditItem.php', $content);
 
  // post Edit Item
 $content = file_get_contents($template_dir.'postDeleteItem.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'/postDeleteItem.php', $content);
 
  // get Item Content
 $content = file_get_contents($template_dir.'getItemContent.php');
 $content = str_replace('__DB__',          $post['MODULE'],$content);
 file_put_contents($dest_dir.'/getItemContent.php', $content);

 // post Item Content
 $content = file_get_contents($template_dir.'postItemContent.php');
 $content = str_replace('__DB__',          $post['MODULE'],$content);
 file_put_contents($dest_dir.'/postItemContent.php', $content);
 
 // post Toggle Item
 $content = file_get_contents($template_dir.'postToggleItem.php');
 $content = str_replace('__DB__',          $post['MODULE'],$content);
 file_put_contents($dest_dir.'/postToggleItem.php', $content);


 
 if($post['image']){

     /* IMAGES */
     $template_dir .= 'images/';
     $dest_dir .= 'images/';
     @mkdir($dest_dir,0777,true);
    
     // get Images
     $content = file_get_contents($template_dir.'getImages.php');
     $content = str_replace('__DB__',          $post['MODULE'],$content);
     file_put_contents($dest_dir.'getImages.php', $content);
    
     // post Images
     $content = file_get_contents($template_dir.'postImages.php');
     $content = str_replace('__DB__',           $post['MODULE'], $content);
     $content = str_replace('__MODULE__',       $post['MODULE'], $content);
     file_put_contents($dest_dir.'postImages.php', $content);
    
    // delete Images
     $content = file_get_contents($template_dir.'postDelete.php');
     $content = str_replace('__DB__',           $post['MODULE'], $content);
     file_put_contents($dest_dir.'postDelete.php', $content);
     
     // info Images
     $content = file_get_contents($template_dir.'getInfo.php');
     $content = str_replace('__DB__',           $post['MODULE'], $content);
     file_put_contents($dest_dir.'getInfo.php', $content);
     
     // post cover Images
     $content = file_get_contents($template_dir.'postUpdateCover.php');
     $content = str_replace('__DB__',           $post['MODULE'], $content);
     file_put_contents($dest_dir.'postUpdateCover.php', $content);
 
 }
 
 
print (" ok");

// CATEGORY
if($post['category']) include __DIR__.'/.categories.php';

// UNIT
if($post['unit']) include __DIR__.'/.units.php';

// OWNER
if($post['owner.person'] || $post['owner.company']) include __DIR__.'/.owner.php';