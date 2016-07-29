<?php
print ("\n Processing Partners ...");


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
if($post['company']) $content .= file_get_contents($template_dir.'companies.sql');
if($post['carts']) $content .= file_get_contents($template_dir.'carts.sql');
if($post['orders']) $content .= file_get_contents($template_dir.'orders.sql');

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
 
 $default_order = 0;
 if($post['advertise']) $default_order +=1;
 if($post['active']) $default_order +=1;
 
 $vars = array(
    '__PLUGIN_PICEDIT__'=>($post['photo'] ? '<link href="<?=$_ASSETS[\'picedit.css\']?>" rel="stylesheet"> <script src="<?=$_ASSETS[\'picedit.js\']?>"></script>' : ''),
     
    '__DT_ACTIVE__' => ($post['active'] ? file_get_contents($template_dir.'dt/is_active.php') :''),
    '__DT_ADVERTISE__' => ($post['advertise'] ? file_get_contents($template_dir.'dt/is_advertise.php') :''),
    '__DT_DEF_ORDER__' => $default_order,
    '__DT_PHONE__'  => ($post['phone']      ? file_get_contents($template_dir.'dt/phone.php') :''),
    '__DT_PHOTO__'  => ($post['photo']      ? file_get_contents($template_dir.'dt/photo.php') :''),
    '__DT_ADDRESS__'=> ($post['address']    ? file_get_contents($template_dir.'dt/address.php') :''),
    '__DT_COMPANY__'=> ($post['company']    ? file_get_contents($template_dir.'dt/company.php') :''),
    '__DT_ACTION_CART__'=> ($post['carts']  ? file_get_contents($template_dir.'dt/action_cart.php') :'var btn_cart = "";'),
    
    
    '__FORM_COMPANY__'      => ($post['company']        ? file_get_contents($template_dir."form/company.php")       : ""),
    '__FORM_COMPANY_LOGO_RESULT__' => ($post['company.logo']   ? file_get_contents($template_dir."form/_company_logo_result.php") : "<i class='uk-icon-building'></i>"),
    '__FORM_COMPANY_LOGO_SELECT__' => ($post['company.logo']   ? file_get_contents($template_dir."form/_company_logo_select.php") : "<i class='uk-icon-building'></i>"),
    '__FORM_PHONE__'        => ($post['phone']          ? file_get_contents($template_dir."form/phone.php")         : ""),
    '__FORM_OTHER_PHONES__' => ($post['otherphones']    ? file_get_contents($template_dir."form/other_phones.php")  : ""),
    '__FORM_SOCIALS__'      => ($post['socials']        ? file_get_contents($template_dir."form/socials.php")       : ""),
    '__FORM_ADDRESS__'      => ($post['address']        ? file_get_contents($template_dir."form/address.php")       : ""),
    '__FORM_BIRTHDAY__'     => ($post['birthday']       ? file_get_contents($template_dir."form/birthday.php")      : ""),
    '__FORM_DATETIME__'     => ($post['datetime']       ? file_get_contents($template_dir."form/datetime.php")      : ""),
    '__FORM_SOMEDATE__'     => ($post['somedate']       ? file_get_contents($template_dir."form/somedate.php")      : ""),
    '__FORM_SITE__'         => ($post['site']           ? file_get_contents($template_dir."form/site.php")          : ""),

    '__MODAL_PHOTO__'       => ($post['photo']          ? file_get_contents($template_dir."modal/photo.php")        : ""),
 );

 // List Items
 $content = file_get_contents($template_dir.'list.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'index.php', $content);


 // Image
 if($post['photo']){
     $content = file_get_contents($template_dir.'image.php');
     $vars = array(
        '__DB__'        => $post['DB'],
        '__MODULE__'    => $post['MODULE']
     );
     foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
     file_put_contents($dest_dir.'image.php', $content);
 }
 



/**
 * AJAX
 *
 * */

 $template_dir = 'templates/'.$post['TEMPLATE'].'/ajax/';
 $dest_dir = $ajax_dir.$post['MODULE'].'/';
 @mkdir($dest_dir,0777,true);
 
 $vars = array(
    '__SELECT_ACTIVE__'     => ($post['active']     ? 'p.is_active,' : ''),
    '__SELECT_ADVERTISE__'  => ($post['advertise']  ? 'p.is_advertise,' : ''),
    '__SELECT_PHONE__'      => ($post['phone']      ? 'p.phone,' : ''),
    '__SELECT_PHOTO__'      => ($post['photo']      ? 'p.id as photo, p.photo_date,' : ''),
    '__SELECT_ADDRESS__'    => ($post['address']    ? "p.city || '; '|| p.address address," : ""),
    '__SELECT_COMPANY__'    => ($post['company']    ? "(SELECT GROUP_CONCAT(co.name) FROM partners_companies pc LEFT JOIN companies co ON (co.id = pc.id_company) WHERE pc.id_partner = p.id) company,":"" ),
    '__SELECT_PARTNER_COMPANY__'=> ($post['company']? "(SELECT GROUP_CONCAT(co.id) FROM partners_companies pc LEFT JOIN companies co ON (co.id = pc.id_company) WHERE pc.id_partner = p.id) 'id_company[]',":"" ),
    '__SELECT_CART__'       => ($post['carts']      ? "(SELECT COUNT(pp.id) FROM partners_items pp WHERE pp.is_closed != 1 AND pp.id_partner = p.id) cart," :""),
  
    '__FILTER_PHONE__'       => ($post['phone']      ? "'phone'=>FILTER_SANITIZE_STRING,"   : ''),
    '__FILTER_OTHER_PHONES__'=> ($post['otherphones']? "'work'=>FILTER_SANITIZE_STRING, 'mobile'=>FILTER_SANITIZE_STRING, 'sip'=>FILTER_SANITIZE_STRING,"        : ""),
    '__FILTER_SOCIALS__'     => ($post['socials']    ? "'skype'=>FILTER_SANITIZE_STRING, 'facebook'=>FILTER_SANITIZE_STRING, 'twitter'=>FILTER_SANITIZE_STRING," : ""),
    '__FILTER_ADDRESS__'     => ($post['address']    ? "'country'=>FILTER_SANITIZE_STRING, 'city'=>FILTER_SANITIZE_STRING, 'address'=>FILTER_SANITIZE_STRING,"   : ""),
    '__FILTER_SITE__'        => ($post['site']       ? "'site'=>FILTER_SANITIZE_STRING,"    : ""),
    '__FILTER_BIRTHDAY__'    => ($post['birthday']   ? "'birthday'=>FILTER_VALIDATE_INT,"   : ""),
    '__FILTER_DATETIME__'    => ($post['datetime']   ? "'datetime'=>FILTER_VALIDATE_INT,"   : ""),
    '__FILTER_SOMEDATE__'    => ($post['somedate']   ? "'somedate'=>FILTER_VALIDATE_INT,"   : ""),
    //'__FILTER_COMPANIES__'   => ($post['company']    ? "'id_company[]'=>FILTER_VALIDATE_INT,"   : ""),

    '__INSERT_COMPANIES_ON_POST_NEW__' => ($post['company'] ? file_get_contents($template_dir."postNew/insert_companies.php") : ''),
  
  );

 
 // get
 $content = file_get_contents($template_dir.'getPartners.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getPartners.php', $content);


 // post NEW
 $content = file_get_contents($template_dir.'postNew.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postNew.php', $content);

// post Edit Partner
$content = file_get_contents($template_dir.'postEdit.php');
foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
file_put_contents($dest_dir.'postEdit.php', $content);

// post Edit Partner
$content = file_get_contents($template_dir.'postDelete.php');
foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
file_put_contents($dest_dir.'postDelete.php', $content);

// post Edit Partner
$content = file_get_contents($template_dir.'postToggle.php');
foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
file_put_contents($dest_dir.'postToggle.php', $content);



// post IMAGE
$content = file_get_contents($template_dir.'postImage.php');
foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
file_put_contents($dest_dir.'postImage.php', $content);

// get Partner
$content = file_get_contents($template_dir.'getPartner.php');
foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
file_put_contents($dest_dir.'getPartner.php', $content);



print (" ok");

if($post['company']){
    include __DIR__.'/.companies.php';
}