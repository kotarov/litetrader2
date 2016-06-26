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
        b.date_avaible,
        b.content,
        b.id image
    FROM items b
    LEFT JOIN categories c ON (c.id = b.id_category)
    WHERE c.is_visible = 1 AND b.is_active = 1 
    LIMIT $p,$l
    ")->fetchAll(PDO::FETCH_ASSOC);
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
    <?php include '../snipps/head.php'; ?>
    <br>
    
    <div class="uk-grid">
        <div class="uk-width-medium-3-4">
        <?php foreach($articles AS $article){ ?>
           <article class="uk-article">
                <h1 name="title" class="uk-width-1-1 uk-article-title editable">
                    <?=$article['title']?>
                </h1>
                
                <div class="uk-article-meta uk-panel-box1">
                    Written by <b><?=$article['author']?></b> on <b><?=$article['date']?></b> Posted in <b><?=$article['category']?></b></select>
                </div>
                
                <div class="uk-article-divider"></div>
                
                <div class="uk-article-lead uk-width-1-1 editable" name="subtitle" >
                    <?=$article['subtitle']?>
                </div>
                
                <div><a href="<?=URL_BASE?>articles/view/index.php/<?=$article['id'].'/'.$article['title']?>">Read more <i class="uk-icon-link"></i></a></div>
            </article> 
           <hr><br>
        <?php }?>
        </div>
        <div class="uk-width-medium-1-4">
            
        </div>
    </div>
    <br>
    <?php include '../snipps/foot.php';?>
    </body>
</html>