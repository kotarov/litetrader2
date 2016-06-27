<?php include '../snipps/init.php'; ?>
<?php
    if(isset($_SERVER['PATH_INFO'])) {
        $temp =  explode("/",$_SERVER['PATH_INFO']);
        list($id_category) = explode('-',$temp[count($temp)-2]);
    }else{ $id_category = 0; }
    

    $dbh = new PDO('sqlite:'.DB_DIR.'blog');
    $p = isset($_GET['p']) ? (int)$_GET['p'] : 0 ;
    $l = 15;
    
    $articles = $dbh->query("
    SELECT 
        b.id,
        b.title,
        b.description,
        c.title category,
        b.tags,
        b.owner,
        strftime('%d.%m.%Y %H:%M',datetime(b.date_add,'unixepoch')) date_add,
        b.content,
        im.id id_image,
        im.date_add image_date,
        c.url_rewrite cat_url_rewrite,
        b.url_rewrite
    FROM items b
    LEFT JOIN categories c ON (c.id = b.id_category)
    LEFT JOIN images im ON (im.id_item = b.id AND im.is_cover = 1) 
    WHERE b.is_active = 1 AND c.is_visible = 1  
    ORDER BY b.date_add DESC 
    LIMIT $p,$l 
    ")->fetchAll(PDO::FETCH_ASSOC);
    
    //print_r($articles);exit;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contacts</title>
        <link rel="shortcut icon" href="<?=URL_BASE?>img/favicon.png" type="image/x-icon">
        
        <script src="<?=$_ASSETS['jquery.js']?>"></script>
        
        <link  href="<?=$_ASSETS['uikit.css']?>" rel="stylesheet"/>
        <script src="<?=$_ASSETS['uikit.js']?>"></script>
        <script src="<?=$_ASSETS['uikit.offcanvas.js']?>"></script>
        
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.autocomplete.css']?>">
        <script src="<?=$_ASSETS['uikit.autocomplete.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.search.css']?>">
        <script src="<?=$_ASSETS['uikit.search.js']?>"></script>
        
        <link href="<?=URL_BASE?>css/theme.css" rel="stylesheet">
        
        <style>
            .uk-article-title:hover{ color:#999}
        </style>

    </head>
    <body id="page-articles"> 
    <?php include '../snipps/head.php'; ?>
    <br>
    
    <div class="uk-grid">
        <div class="uk-width-medium-3-4">
            <?php if($id_category) { ?>
                <img src="<?=URL_BASE.'articles/categories/image.php/'.$id_category.'/image'?>">
            <?php }else{ ?>
                <h1>Блог новини</h1><hr>
            <?php } ?>
            
            <div class="uk-margin-large-top">
        
                <template id="article-template" >
                    <div class="template">
                        <article class="uk-article uk-width-1-1 uk-grid">
                            <a href="<?=URL_BASE?>articles/view/index.php/{{cat_url_rewrite}}{{url_rewrite}}" class="uk-width-small-1-3">
                                <img class="uk-thumbnail" src="<?=URL_BASE?>articles/image.php/{{id_image}}/thumb/{{image_date}}"> 
                            </a>
                            <div class="uk-width-small-2-3 uk-margin-bottom">
                                <h1 name="title" class="uk-width-1-1 uk-article-title">
                                    <a href="<?=URL_BASE?>articles/view/index.php/{{cat_url_rewrite}}{{url_rewrite}}">{{title}}</a>
                                </h1>
                                <div class="uk-article-meta">{{owner}}  |  {{category}}  |  {{date_add}}</div>
                                <div class="uk-article-lead uk-width-1-1 editable" name="description" >{{description}}</div>
                            </div>
                        </article> 
                        <hr class="uk-width-1-1">
                    </div>
                </template>
                <div class="template uk-text-center uk-margin-large-top uk-text-muted"><h1 class="uk-icon-circle-o-notch uk-icon-spin"></h1></div>
            
            </div>
            
            <ul id="articles_pagination" class="uk-pagination uk-pagination-right"></ul>


                <script>
                    var blog = {
                        id_template     : "article-template",
                        id_pagination   : "articles_pagination",
                        perPage         : 10,
                        
                        currentPage : 0,
                        allPages    : 0,
                        data        : {},
                        
                        init:function(){ 
                            var _this = this;
                            $.getJSON("<?=URL_BASE?>ajax.php?f=articles/getList").done(function(ret){
                                _this.data = ret.data;
                                _this.allPages = Math.ceil(_this.data.length / _this.perPage);
                                
                                _this.renderPagination();
                                _this.renderPage(0);             
                            }); 
                        },
                        renderPagination: function(){
                            var content = "";
                            content += '<li data-left><span><i class="uk-icon-angle-double-left"></i></span></li>';
                            for(i = 1; i < (this.allPages+1); i++){
                                content += '<li data-page="'+(i-1)+'" onclick="blog.renderPage('+(i-1)+')"><a>'+i+'</a></li>';
                            }
                            content += '<li data-right><span><i class="uk-icon-angle-double-right"></i></span></li>';
                            $("#"+this.id_pagination).html(content);
                        },
                        renderPage: function(p){
                            this.currentPage = p;
                            
                            var old = $("#"+this.id_pagination).find("li.uk-active");
                            old.removeClass("uk-active").html("<a>"+$("span",old).text()+"</a>");
                            $("#"+this.id_pagination).find('[data-page="'+p+'"]').addClass("uk-active").html("<span>"+(p+1)+"</span>");
                            
                            if(p==0) $("#"+this.id_pagination+" [data-left]").html('<span><i class="uk-icon-angle-double-left"></i></span>');
                            else $("#"+this.id_pagination+" [data-left]").html('<a onclick="blog.renderPage('+(p-1)+')"><i class="uk-icon-angle-double-left"></i></a>');
                            if(p==(this.allPages-1)) $("#"+this.id_pagination+" [data-right]").html('<span><i class="uk-icon-angle-double-right"></i></span>');
                            else $("#"+this.id_pagination+" [data-right]").html('<a onclick="blog.renderPage('+(p+1)+')"><i class="uk-icon-angle-double-right"></i></a>');
                            
                            
                            var t =  $("#"+this.id_template);
                            var start = p*this.perPage;
                            var end = start+this.perPage;
                            if(end > (this.data.length-1)) end = this.data.length;

                            var page_content = '';
                            for(i=start; i<end;i++){
                                var cc = t.html();
                                $.each(this.data[i], function(f,c){
                                    cc = cc.replace(new RegExp('{{'+f+'}}','g'), c);
                                });
                                page_content += cc;
                            }
                            t.parent().find(".template").not("template").remove();
                            t.parent().hide(); t.after('<div class="template">'+page_content+'</div>'); t.parent().fadeIn();
                        }
                    };
                    blog.init();
                    
                </script>
            
        
        </div>


        <div class="uk-width-medium-1-4">
            <?php include '../snipps/article_categories.php';?>
        </div>
    </div>
    <br>
    <?php include '../snipps/foot.php';?>
    </body>
</html>