<?php


$partners_ini    = __DIR__.'/../../modules/'.$post['module.partners'].'.ini';
$items_ini = __DIR__.'/../../modules/'.$post['module.items'].'.ini';

print ("\n Check items module ...");
if(!file_exists($items_ini))    die("Error: !!! INI file '".$post['module.items']   ."' not exists !!!\n");
echo "ok";
print ("\n Check partners module ...");
if(!file_exists($partners_ini)) die("Error: !!! INI file '".$post['module.partners']."' not exists !!!\n");
echo "ok";

foreach(parse_ini_file($items_ini) AS $k => $v) $post['items.'.$k] = $v;
foreach(parse_ini_file($partners_ini) AS $k => $v) $post['partners.'.$k] = $v;



print ("\n Processing Orders ...");
/**
 * SQL
 * 
 * */

$template_dir = 'templates/'.$post['TEMPLATE'].'/sqlite/';
$dest_dir = $sqlite_dir.'schema/';
@mkdir($dest_dir,0777,true);

$content = file_get_contents($template_dir.'main.sql');
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
 
 $vars = array(
    //'__DT_ACTIVE__' => ($post['active'] ? file_get_contents($template_dir.'dt/is_active.php') :''),
    '__DT_PARTNERS_COMPANIES__'=> $post['partners.company'] ? file_get_contents($template_dir.'dt/company.php') : '',
    '__FORM_PARTNER_PHOTO_RES__' => $post['partners.photo'] ? '<img src="<?=URL_BASE?>/__partners.MODULE__/image.php/{{id}}/{{photo_date}}" width="40" class="uk-border-circle">' : '<i class="uk-icon-user"></i>',
    '__FORM_PARTNER_PHOTO_SEL__' => $post['partners.photo'] ? '<img src="<?=URL_BASE?>/__partners.MODULE__/image.php/{{id}}/{{photo_date}}" width="20" class="uk-border-circle">' : '<i class="uk-icon-user"></i>',
 );
 
 // List Items
 $content = file_get_contents($template_dir.'list.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'index.php', $content);
 
 // List Items
 $content = file_get_contents($template_dir.'listStatuses.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'statuses.php', $content);
 
 
 
 
 /**
 * AJAX
 *
 * */

 $template_dir = 'templates/'.$post['TEMPLATE'].'/ajax/';
 $dest_dir = $ajax_dir.$post['MODULE'].'/';
 @mkdir($dest_dir,0777,true);
 
 $vars = array(
    '__SELECT_ACTIVE__'     => ($post['active']     ? 'p.is_active,' : ''),
    '__SELECT_PARTNERS_COMPANIES__' => $post['partners.company'] ? 'o.id_company,o.company,':'',
  );
 
 // get List
 $content = file_get_contents($template_dir.'getList.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getList.php', $content);
 
 // search Partners
 $content = file_get_contents($template_dir.'searchPartners.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'searchPartners.php', $content);
 
 // search Items
 $content = file_get_contents($template_dir.'searchItems.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'searchItems.php', $content);
 
 // get Partner Companies
 $content = file_get_contents($template_dir.'getPartnerCompanies.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getPartnerCompanies.php', $content);
 
 // get Partner Field
 $content = file_get_contents($template_dir.'getPartnerData.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getPartnerData.php', $content);
 
 
 // post New & Edit
 $content = file_get_contents($template_dir.'post.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'post.php', $content);
 
 // get Edit
 $content = file_get_contents($template_dir.'getOrder.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getOrder.php', $content);
 
 // register Status
 $content = file_get_contents($template_dir.'registerStatus.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'registerStatus.php', $content);
 
 // post Delete
 $content = file_get_contents($template_dir.'postDelete.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postDelete.php', $content);
 
  // post Status
 $content = file_get_contents($template_dir.'postStatus.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postStatus.php', $content);

 
 
 
 /** Statuses **/
 $template_dir = 'templates/'.$post['TEMPLATE'].'/ajax/statuses/';
 $dest_dir = $ajax_dir.$post['MODULE'].'/statuses/';
 @mkdir($dest_dir,0777,true);
 
 // get List
 $content = file_get_contents($template_dir.'getList.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getList.php', $content);
 
 // get History
 $content = file_get_contents($template_dir.'getHistory.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getHistory.php', $content);
 
 // postNew
 $content = file_get_contents($template_dir.'postNew.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postNew.php', $content);
 
  // post Delete
 $content = file_get_contents($template_dir.'postDelete.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postDelete.php', $content);
 
  // get Edit
 $content = file_get_contents($template_dir.'getStatus.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getStatus.php', $content);
 
  // post Edit
 $content = file_get_contents($template_dir.'postEdit.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postEdit.php', $content);
 
  // post Toggle Default
 $content = file_get_contents($template_dir.'postToggleDefault.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postToggleDefault.php', $content);
 
  // post Toggle
 $content = file_get_contents($template_dir.'postToggle.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postToggle.php', $content);
 
 
 
 /** Cart **/
 $template_dir = 'templates/'.$post['TEMPLATE'].'/ajax/orders_items/';
 $dest_dir = $ajax_dir.$post['MODULE'].'/orders_items/';
 @mkdir($dest_dir,0777,true);
 
  // get Cart
 $content = file_get_contents($template_dir.'getCart.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getCart.php', $content);
 
 // post Append Cart
 $content = file_get_contents($template_dir.'postAppendCart.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postAppendCart.php', $content);
 
 // get Edit Item from Cart
 $content = file_get_contents($template_dir.'getEditItem.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getEditItem.php', $content);
 
 // post Edit Item from Cart
 $content = file_get_contents($template_dir.'postEditItem.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postEditItem.php', $content);
 
 // post Remove Item from Cart
 $content = file_get_contents($template_dir.'postRemove.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postRemove.php', $content);
 

 
 /** Delivery **/
 $template_dir = 'templates/'.$post['TEMPLATE'].'/ajax/deliveries/';
 $dest_dir = $ajax_dir.$post['MODULE'].'/deliveries/';
 @mkdir($dest_dir,0777,true);
 
 // get List Methods
 $content = file_get_contents($template_dir.'getList.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getList.php', $content);
 
 
 
 /** Payment **/
 $template_dir = 'templates/'.$post['TEMPLATE'].'/ajax/payments/';
 $dest_dir = $ajax_dir.$post['MODULE'].'/payments/';
 @mkdir($dest_dir,0777,true);
 
 // get List Methods
 $content = file_get_contents($template_dir.'getList.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getList.php', $content);
 
 
 
 /** Taxes **/
 $template_dir = 'templates/'.$post['TEMPLATE'].'/ajax/taxes/';
 $dest_dir = $ajax_dir.$post['MODULE'].'/taxes/';
 @mkdir($dest_dir,0777,true);
 
 // get List Methods
 $content = file_get_contents($template_dir.'getList.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getList.php', $content);
 
 
 
 echo "ok";