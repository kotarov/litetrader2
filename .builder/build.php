<?php
/**
 * argv[0] = selfname.php
 * argv[1] = << moduel.ini >>
 *
 * handly: add to images.ini -> [__MODULE__] full="" thumb=""...
 * */
error_reporting(E_ALL);



$iniFile = isset($argv[1]) ? $argv[1] : (isset($_GET['module']) ? $_GET['module'] : false );

if(!$iniFile|| !file_exists('modules/'.$iniFile)) 
    die("\n ERROR - module ini file: ".$iniFile.", NOT Exists !!!\n\n");


$post_module  = parse_ini_file('modules/'.$iniFile);
$post_default = parse_ini_file('templates/'.$post_module['TEMPLATE'].'/.settings.ini');
$post_external = array(
    'PROJECT'=>'admin',
    'PROJECT.title' => 'Admin'
);
$post         = array_merge($post_default, $post_external, $post_module);

$module_dir     = $iniFile.'/';
$www_dir        = '../www/'.$post['PROJECT'].'/';
$ajax_dir       = '../ajax/'.$post['PROJECT'].'/';
$sqlite_dir     = '../sqlite/';
$ini_dir        = '../ini/';

@mkdir($www_dir,0777,true);
@mkdir($ajax_dir,0777,true);

if(isset($_GET['module'])) echo "<xmp>";
include 'templates/'.$post['TEMPLATE'].'/.index.php';
if(isset($_GET['module'])) echo "</xmp><div>";
echo date("\r\n-- d.m.Y -- H:i:s --",time());
if(isset($_GET['module'])) echo "</div>";

echo " \n";