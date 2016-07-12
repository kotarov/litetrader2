<?php $exp=0; include '../snipps/init.php'; ?>
<?php
    $required = array();
    if(isset($_POST['submit-message'])){
        $post = filter_var_array($_POST,array(
            'name'=>FILTER_SANITIZE_STRING,
            'email'=>FILTER_SANITIZE_EMAIL,
            'message'=>FILTER_DEFAULT
        ));
        if(!$post['name'])      $required['name']    = true;
        if(!$post['email'])     $required['email']   = true;
        if(!$post['message'])   $required['message'] = true;
        
        if(!$required){
            include LIB_DIR.'SMTPMailer.php';
            $name = $post['name'];
            $message = $post['message'];
            $mail = include MAIL_DIR.'from_customer_post_message.php';
            
            if(sendmail($post['email'], $mail['title'], $mail['body'], true)){
                $ret['success'] = 'Mail was sended successful.';
            }else{
                $ret['error'] = $sendmail_error;   
            }
            /*
            if(sendmail( $post['email'], $mail['title'], $mail['body'] )) {
                $ret['success'] = 'Ok! Check your email for temporary password';
            }*/
            //print_r($mail);exit;
        }
        
    }
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
    <body id="page-contacts"> 
    <?php include '../snipps/head.php'; ?>

        <br>

<?php if(isset($_POST['submit-message']) && !$required) { ?>

    <div id="ready_form">  <?php /** ready-form */ ?>
        <br>
        <div class="uk-panel-box uk-text-large uk-alert-success">
        <div class="uk-container">
            <b><i class="uk-icon-check-circle uk-icon-medium"></i> &nbsp;&nbsp; Вашето запитване беше изпратено успешно.</b>
        </div>
        </div>
        <div class="uk-block uk-text-large">
            Блгодарим Ви, че изпозвахте нашите услуги ! <br> Ще получите отговор или ще се свържем с вас възможно най-скоро.
        </div>
        <br><br><br><br><br>
    </div> <?php /** //ready-form */ ?>

<?php }else{ ?>

    <div id="contact_form" >  <?php /** contact-form */ ?>
    
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-1-1 uk-text-left">
                <h1 data-lang>Контакти</h1>
                <hr>
                <p class="uk-text-large">За въпроси относно поръчка или за повече информация относно продукт.</p>
            </div>
        </div>

        
        <br><br><br>
        <div class="uk-grid" data-uk-grid-margin>

            <div class="uk-width-medium-2-3">
                <div class="uk-panel uk-panel-header">

                    <h2 data-lang>Свържете се</h2>
                    <hr>

                    <form class="uk-form uk-form-stacked" method="post" action="?submit-message">

                        <div class="uk-form-row">
                            <label class="uk-form-label" data-lang>Вашето име</label>
                            <div class="uk-form-controls">
                                <input type="text" placeholder="" name="name" 
                                    class="uk-width-1-1<?=isset($required['name'])?' uk-form-danger':''?>"
                                    value="<?=isset($_POST['name'])?$_POST['name']:''?>"
                                >
                            </div>
                        </div>

                        <div class="uk-form-row">
                            <label class="uk-form-label" data-lang>Вашат поща</label>
                            <div class="uk-form-controls">
                                <input type="email" placeholder="" name="email" 
                                    class="uk-width-1-1 <?=isset($required['email'])?' uk-form-danger':''?>"
                                    value="<?=isset($_POST['email'])?$_POST['email']:''?>"
                                >
                            </div>
                        </div>

                        <div class="uk-form-row">
                            <label class="uk-form-label" data-lang>Вашето съобщение</label>
                            <div class="uk-form-controls">
                                <textarea class="uk-width-1-1 <?=isset($required['message'])?' uk-form-danger':''?>" 
                                    name="message" id="form-h-t" cols="100" rows="9"
                                ><?=isset($_POST['message'])?$_POST['message']:''?></textarea>
                            </div>
                        </div>

                        <div class="uk-form-row">
                            <div class="uk-form-controls">
                                <button class="uk-button uk-button-primary uk-button-large" name="submit-message" data-lang>Изпрати</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

            <div class="uk-width-medium-1-3">
                <div class="uk-panel uk-panel-box uk-panel-box-secondary">
                    <h2 data-lang>Детайли за контакти</h2>
                    <hr>
                    <p>
                        <strong><?=$_COMPANY['name']?></strong>
                        <br><?=$_COMPANY['country']?>
                        <br><?=$_COMPANY['city']?>, <?=$_COMPANY['address']?>
                    </p>
                    <p>
                        <i class="uk-icon-envelope"></i> <a href="mailto:<?=$_COMPANY['email']?>"><?=$_COMPANY['email']?></a><br>
                        <?php foreach(explode(";",$_COMPANY['phone']) AS $phone) { ?> 
                         <a href="dial:<?=$phone?>"><?=$phone?></a><br>
                        <?php } ?>
                    </p>
                    <h3 class="uk-h4" data-lang>Последвайте ни</h3>
                    <p>
                        <a href="https://www.facebook.com/<?=$_COMPANY['facebook']?>" class="uk-icon-button uk-icon-facebook" target="_null"></a>
                        <a href="https://www.twitter.com/<?=$_COMPANY['twitter']?>" class="uk-icon-button uk-icon-twitter" target="_null"></a>
                        <a href="https://www.skype.com/<?=$_COMPANY['skype']?>" class="uk-icon-button uk-icon-skype" target="_null"></a>
                    </p>
                </div>
            </div>
        </div>
        <br><br>
    </div> <?php /** //contact-form */ ?>

<?php } ?>
    
    <?php include '../snipps/foot.php';?>
    </body>
</html>