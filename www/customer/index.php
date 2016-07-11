<?php include '../snipps/init.php'; ?>
<!DOCTYPE html>
<html class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Customer Login</title>
        <link rel="shortcut icon" href="<?=URL_BASE?>img/favicon.png" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="<?=URL_BASE?>img/apple-touch-icon.png">
        
        <script src="<?=$_ASSETS['jquery.js']?>"></script>
        
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.css']?>" />
        <script src="<?=$_ASSETS['uikit.js']?>"></script>
        
        <link href="<?=URL_BASE?>css/theme.css" rel="stylesheet">
        
        <style> .uk-tab > li.uk-active > a {background:#f5f5f5} 
            .uk-panel-box { border-color: #ddd; border-style: solid; border-width: 0 1px 1px;}
        </style>
        
        <script>
            lang = {
                'Wellcom':'Добре дошли',
                'Wrong email or password':'Грешна поща или парола',
                'This Email is not active or is not registered':'Тази поща не регистрирана или не е активна',
                'Ok! Check your email for temporary password':'Ок! Проверете си пощата за веменната парола',
                'This email is already registered':'С тази електронна поща вече има регистриран профил'
            }
        </script>

    </head>

    <body class="uk-height-1-1">

    
        <div class="uk-vertical-align uk-text-center uk-height-1-1">
            <div class="uk-vertical-align-middle" style="width:400px">
                
                
                <ul id="login-forms-tabs"  data-uk-tab="#login-forms" class="uk-tab" >
                    <li class="uk-active">      <a href="#login" data-lang>Имате профил</a></li>
                    <li>                        <a href="#signup" data-lang>Регистрация</a></li>
                    <li>                        <a href="#reset" data-lang>Забрвена парола</a></li>
                </ul>
                
                
                
                <ul id="login-forms" class="uk-switcher" >
                    
                    <li id="login" class="uk-active">
                    <div class="uk-width-medium-1-1 uk-panel uk-panel-box">
                        <br>
                        <i class="uk-icon-user uk-border-circle uk-margin-bottom" style="font-size:6em;padding:0.1em 0.2em;color:#f5f5f5;background:#fff"></i>
                        <br><br>
                        <form id="login-form" class="uk-form" method="post" action="login/postLogin" data-redirect="profile.php">
                            <div class="uk-form-row">
                                <input class="uk-width-1-1 uk-form-large" type="text" placeholder="Email" name="email">
                            </div>
                            <div class="uk-form-row">
                                <input class="uk-width-1-1 uk-form-large" type="password" placeholder="Парола" name="password" data-lang>
                            </div>
                            <div class="uk-form-row">
                                <button type="submit" name="login" class="uk-width-1-1 uk-button uk-button-primary uk-button-large" data-lang>Вход</button>
                            </div>
                            <div class="uk-form-row uk-text-small">
                                <label class="uk-float-left"><input type="checkbox"> <span data-lng>Запомни ме</span></label>
                            </div>
                        </form>
                    </div>
                    </li>
                    

                    <li id="signup">
                    <div class="uk-width-medium-1-1 uk-panel uk-panel-box">
                        
                        <h3 class="uk-margin-bottom">Нямате все още профил ?</h3>
                        <p>Само попълнете тази проста форма.</p>
                        
                        <form id="signup-form" class="uk-form" method="post" action="login/postSignup" data-redirect="activte.php">
                            
                            <div class="uk-grid uk-form-row" style="margin-left:0">
                                <input class="uk-width-1-2 uk-form-large" type="text" placeholder="Име*" name="name">
                                <input class="uk-width-1-2 uk-form-large" type="text" placeholder="Фамилия" name="family">
                            </div>
                            
                            <div class="uk-form-row">
                                <input class="uk-width-1-1 uk-form-large" type="text" placeholder="Email*" name="email">
                            </div>
                            
                            <div class="uk-form-row uk-grid uk-width-1-1" style="margin-left:0">
                                <input class="uk-width-1-2 uk-form-large" type="password" placeholder="Парола*" name="password">
                                <input class="uk-width-1-2 uk-form-large" type="password" placeholder="Повторете пролата" name="repeat">
                            </div>
                            <div class="uk-form-row uk-grid" style="margin-left:0">
                                <input class="uk-width-1-2 uk-form-large" type="text" placeholder="Телефон*" name="phone">
                                <input class="uk-width-1-2 uk-form-large" type="text" placeholder="Град*" name="city">
                            </div>
                            <div class="uk-form-row">
                                <input class="uk-width-1-1 uk-form-large" type="text" placeholder="Address*" name="address">
                            </div>
                            <br>
                            <div class="uk-form-row">
                                <button type="submit" name="signup" class="uk-width-1-1 uk-button uk-button-success uk-button-large">Създай</button>
                            </div>
                            <br>
                            <div class="uk-fom-row uk-text-left" data-lang>Всички полета са задължителни. Ще се нуждаете от валидна ел. поща, за да активирате профила.</div>
                            
                        </form>
                    </div>
                    </li>


                    <li id="reset">
                        <div class="uk-panel uk-panel-box ">
                            <h3>Забрвили сте паролата си ?</h3>
                            <div class="uk-form-row uk-text-left" data-lang>Ще генерираме временна парола, която ще изпратим на Вашата електронна поща ! </div>
                             <br>   
                            <form id="reset-password" class="uk-form" method="post" action="login/postReset" >
                                <div class="uk-form-row">
                                    <input class="uk-width-1-1 uk-form-large" type="text" placeholder="Email" name="email">
                                </div>
                                <div class="uk-form-row">
                                    <button type="submit" class="uk-width-1-1 uk-button uk-button-danger uk-button-large" href="#" data-lang>Генерирай паролта</button>
                                </div>
                               
                                
                                <div class="uk-form-row uk-text-left uk-text-small">
                                    Временната парола не заменя, нито премахва официалната. Валидна е 30 мин. след което ще трябва да генерирате нова. 
                                </div>
                            </form>
                        </div>

                    </li>



                </ul>
                
                <div class="uk-margin-top uk-text-large">
                     <a href="<?=URL_BASE?>"><i class="uk-icon-home"></i> <span data-lang>Началната страница</span></a>
                </div>
            </div>
        </div>
        
    
        <script>
            $("form").on("submit",function(e){ 
                e.preventDefault();
                $(".uk-alert").remove();
                var $form = $(this);
                $(".uk-form-danger", $form).removeClass('uk-form-danger');
                
                $.post("<?=URL_BASE?>ajax.php?f="+$(this).attr('action'), $(this).serialize()).done(function(ret){
                    $("body").find(".uk-alert").remove();
                    ret = $.parseJSON(ret);
                    if(ret.required){
                        $.each(ret.required, function(i,field){ $("[name='"+field+"']", $form).addClass("uk-form-danger"); });
                        if(!ret.error) $("body").prepend('<div class="uk-alert uk-alert-danger"><b>Попълнете задължителните полета !</b></div>');
                    }
                    if(ret.error){
                        $("body").prepend('<div class="uk-alert uk-alert-danger"><b>'+(lang[ret.error]||ret.error)+'</b></div>');
                    }
                    if(ret.success){
                        $("body").prepend('<div class="uk-alert uk-alert-success"><b>'+(lang[ret.success]||ret.success)+'</b></div>');
                        if($form.data("redirect") ) window.location.href = $form.data("redirect");
                    }
                });
            });
            
            
            $("a", "ul.uk-tab > li").on("click",function(e){ e.preventDefault();
                $(".uk-active", $(this).closest(".uk-tab") ).removeClass("uk-active");
                $(this).parent().addClass("uk-active");
                $("li.uk-active", $(this).closest(".uk-tab").attr("data-uk-tab")).removeClass("uk-active");
                $( $(this).attr("href") ).addClass("uk-active");
            });
        </script>
    
    </body>
</html>
