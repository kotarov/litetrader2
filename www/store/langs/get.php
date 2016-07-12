var lang = 
<?php session_start();



if(isset($_SESSION['lang']) && file_exists($_SESSION['lang'].'.json') ){
    $default_lang_file = $_SESSION['lang'].'.json';    
}else{
    $default_lang_file = 'bg.json';
}

include $default_lang_file;

$page_path = explode( dirname(dirname($_SERVER['SCRIPT_NAME'])).'/', $_SERVER['HTTP_REFERER']);
$page_lang_file = $page_path[1].'/'.$default_lang_file;


if(file_exists($page_lang_file)) {
    echo "\n$.extend(lang,".file_get_contents($page_lang_file).");";
}

?>


$(function(){
    
    $("[data-lang]").each(function(k,o){
        var ph = $(o).attr("placeholder");
        if(typeof ph == "string") $(o).attr( "placeholder", (lang[ph]||ph) );
        var tl = $(o).attr("title");
        if(typeof tl == "string") $(o).attr( "title", (lang[tl]||tl) );
        
        switch($(o).prop("tagName")){
            case "INPUT":
            case "SELECT":
                break;
            default:
                var st = $.trim( $(o).data("lang")) || $.trim($(o).html());
                if(typeof st == "string") $(o).html( lang[st]||st );
        }
    });
});

