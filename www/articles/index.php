<?php include '../snipps/init.php'; ?>
<?php
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
        im.date_add image_date
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
        <div class="uk-width-medium-3-4 ">
        <?php foreach($articles AS $article){ 
            $article_url = URL_BASE.'articles/view/index.php/'.$article['id'].'/'.$article['title'];
            ?>
            
            
           <article class="uk-article uk-width-1-1 uk-grid">
                <a href="<?=$article_url?>" class="uk-width-1-3">
                    <img class="uk-thumbnail" src="<?=URL_BASE?>articles/image.php/<?=$article['id_image']?>/thumb/<?=$article['image_date']?>"> 
                </a>
                
                <div class="uk-width-2-3 uk-margin-bottom">
                    <h1 name="title" class="uk-width-1-1 uk-article-title editable">
                        <a href="<?=$article_url?>"> <?=$article['title']?> </a>
                    </h1>
                  
                    <div class="uk-article-meta">
                        <?=$article['owner']?> | 
                        <?=$article['category']?> |  
                        <?=str_replace(" "," | ",$article['date_add'])?>
                    </div>
                    
                    
                    
                    <div class="uk-article-lead uk-width-1-1 editable" name="description" >
                        <?=$article['description']?>
                    </div>
                </div>
                 
            </article> 
           <hr class="uk-width-1-1">
        <?php }?>
        </div>
        <div class="uk-width-medium-1-4">
            <?php 
                $dbh=new PDO('sqlite:'.DB_DIR.'blog');
                $categories = $dbh->query("SELECT 
                        c.is_visible,
                        c.id,
                        c.depth_html || c.title title,
                        
                        c.position,
                        c.tags,
                        c.id image,c.date_image, c.image_size,
                        c.id actions
                    FROM categories c 
                    ORDER BY c.list_order
                ")->fetchAll(PDO::FETCH_ASSOC);
                foreach($categories AS $n => $category){ 
                    echo '<div>'.$category['title'].'</div>';    
                }
            ?>
            
        </div>
    </div>
    <br>
    <?php include '../snipps/foot.php';?>
    </body>
</html>