<?php include '../../snipps/init.php'; ?>
<?php
    if(!isset($_SERVER['PATH_INFO'])) return;
    
    $temp =  explode("/",$_SERVER['PATH_INFO']);
    list($id) = explode('-',end($temp));
    $dbh = new PDO('sqlite:'.DB_DIR.'blog');
    $article = $dbh->query("
    SELECT 
        b.id,
        b.title,
        b.description,
        c.title category,
        b.tags,
        b.owner,
        strftime('%d.%m.%Y',datetime(b.date_add,'unixepoch')) date_add,
        b.content,
        im.id id_image,
        im.date_add image_date
    FROM items b
    LEFT JOIN categories c ON (c.id = b.id_category)
    LEFT JOIN images im ON (im.id_item = b.id AND is_cover = 1)
    WHERE b.id = $id AND c.is_visible = 1 AND b.is_active = 1 
    ")->fetch(PDO::FETCH_ASSOC);
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
    </head>
    <body id="page-articles"> 
    <?php include '../../snipps/head.php'; ?>
    <br>
    
    <div class="uk-grid">
        <div class="uk-width-medium-3-4">
        <?php if(!$article) { ?>
            <article class="uk-article">
                <h1 class="uk-width-1-1 uk-article-title uk-text-danger">
                    <span data-lang>Статията не е намерена</span>
                </h1>
                <div class="uk-article-lead uk-width-1-1 uk-text-muted" name="subtitle">
                    <span data-lang>Тази статия не съществува или е премахната !</span>
                </div>
                <br>
            </article>
        <?php }else { ?>
           <article class="uk-article">
        
                <h1 class="uk-width-1-1 uk-article-title">
                    <?=$article['title']?>
                </h1>
                
                <div class="uk-article-meta">
                    <span datalang>Написана от</span> <b><?=$article['owner']?></b> <span data-lang>на</span> <b><?=$article['date_add']?></b> 
                    | 
                    <span data-lang>Публикувана в</span> <b><?=$article['category']?></b></select>
                </div>
                <br> 
                <div class="uk-article-lead uk-width-1-1 uk-text-bold" name="description" >
                    <?=$article['description']?>
                </div>
                <br>
                
                <img src="<?=URL_BASE.'articles/image.php/'.$article['id_image'].'/'.$article['image_date']?>" class="uk-thumbnail uk-align-left uk-width-large-2-3 ">
                
                
                <div name="content" class="uk-width-1-1 edit uk-margin-top uk-margin-bottom" >
                    <?=$article['content']?>
                </div>
            </article> 
            
        <?php } ?>
           
        
        </div>
        <div class="uk-width-medium-1-4">
            <?php include '../../snipps/article_categories.php';?>
        </div>
    </div>
    
    <br>
    <?php include '../../snipps/foot.php';?>
    </body>
</html>