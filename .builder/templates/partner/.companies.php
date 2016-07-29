<?php
print ("\n Processing Companies ...");


/**
 * HTML
 *
 **/
 
 $template_dir = 'templates/'.$post['TEMPLATE'].'/admin/';
 $dest_dir = $www_dir.$post['MODULE'].'/companies/';
 @mkdir($dest_dir,0777,true);
 
 $default_order = 0;
 if($post['advertise']) $default_order +=1;
 if($post['active']) $default_order +=1;
 
 $vars = array(
    '__PLUGIN_PICEDIT__'=> $post['company.logo']  ? '<link href="<?=$_ASSETS[\'picedit.css\']?>" rel="stylesheet"> <script src="<?=$_ASSETS[\'picedit.js\']?>"></script>' : '',
    '__SEARCH_PHOTO__'  => $post['photo'] ? '<img src="../image.php/{{id}}" width="30" class="uk-border-circle">' : '<i class="uk-icon-user"></i>', 
    '__DT_ORDERBY__'    => $post['photo'] ? "2" : "1",
    '__DT_CE_PHOTO__'   => $post['photo'] ? '{ data:"photo", sortable:false, title: (lang["__photo.title__"]  ||"__photo.title__"), render:function(d,t,r){ return \'<img style="width:30px" class="uk-border-circle" src="../image.php/\'+r.id+\'/\'+r.photo_date+\'">\'; } },':'',
    
    '__DT_COMPANY_LOGO__'   => $post['company.logo'] ? file_get_contents($template_dir.'dt/company/logo.php') : '',
    '__MODALS_LOGO__'       => $post['company.logo'] ? file_get_contents($template_dir.'modal/companyLogo.php') : '',
 );


 // List Items
 $content = file_get_contents($template_dir.'listCompanies.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'index.php', $content);


 // Logo
 if($post['company.logo']){
     $content = file_get_contents($template_dir.'imageCompanies.php');
     foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
     foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
     file_put_contents($dest_dir.'image.php', $content);
 }


 /**
 * AJAX
 *
 * */

 $template_dir = 'templates/'.$post['TEMPLATE'].'/ajax/companies/';
 $dest_dir = $ajax_dir.$post['MODULE'].'/companies/';
 @mkdir($dest_dir,0777,true);
 
  $vars = array(
    
  );
 
 // get List of Companies
 $content = file_get_contents($template_dir.'getCompanies.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getCompanies.php', $content);
 
 // post NEW
 $content = file_get_contents($template_dir.'postNew.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postNew.php', $content);
 
  // get EDIT Company
 $content = file_get_contents($template_dir.'getCompany.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getCompany.php', $content);
 
 // post EDIT Company
 $content = file_get_contents($template_dir.'postEdit.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postEdit.php', $content);

 // post DELETE Company
 $content = file_get_contents($template_dir.'postDelete.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postDelete.php', $content);

 // post Company Image / Logo
 if($post['company.logo']){
     $content = file_get_contents($template_dir.'postImage.php');
     foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
     foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
     file_put_contents($dest_dir.'postImage.php', $content);
 }
 

 //// companies_employees 
 $template_dir = 'templates/'.$post['TEMPLATE'].'/ajax/companies_employees/';
 $dest_dir = $ajax_dir.$post['MODULE'].'/companies_employees/';
 @mkdir($dest_dir,0777,true);
 
 // get CompanyEmployees
 $content = file_get_contents($template_dir.'getList.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'getList.php', $content);
 
 // search Partner
 $content = file_get_contents($template_dir.'searchPartner.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'searchPartner.php', $content);
 
 // post ADD Employee
 $content = file_get_contents($template_dir.'postAddEmployee.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postAddEmployee.php', $content);
 
 // post REMOVE Employee
 $content = file_get_contents($template_dir.'postRemoveEmployee.php');
 foreach($vars AS $KEY => $VAL) $content = str_replace($KEY, $VAL, $content);
 foreach($post AS $key=>$val)   $content = str_replace('__'.$key.'__', $val, $content);
 file_put_contents($dest_dir.'postRemoveEmployee.php', $content);
 
 
 
 
 print (" ok");