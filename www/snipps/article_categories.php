<?php 
                $dbh=new PDO('sqlite:'.DB_DIR.'blog');
                $categories = $dbh->query("SELECT 
                        c.id,
                        c.title,
                        c.depth,
                        c.tags,
                        c.id image,c.date_image, c.image_size,
                        c.url_rewrite
                    FROM categories c 
                    WHERE c.is_visible = 1 
                    ORDER BY c.list_order
                ")->fetchAll(PDO::FETCH_ASSOC);
                
                if(isset($_SERVER['PATH_INFO'])) {
                    $temp =  explode("/",$_SERVER['PATH_INFO']);
                    list($id) = explode('-',$temp[count($temp)-2]);
                }else{ $id = 0; }
            ?>
            
             <div class="uk-panel uk-panel-box">
                 <h3>Категории</h3>
                 <hr>
                <ul class="uk-nav uk-nav-side">
                    <li class="uk-parent<?=!$id?' uk-active':''?>"><a href="<?=URL_BASE?>articles/" data-lang><i class="uk-icon-home"></i> Начало</a></li>
                    <?php /*<li class="uk-nav-divider"></li> */?>
                <?php
                    foreach($categories AS $n => $category){ 
                        echo '<li class="uk-parent'.($id==$category['id']?' uk-active':'').'">'
                            .'<a href="'.URL_BASE.'articles/index.php'.$category['url_rewrite'].'">'
                                .str_repeat("&nbsp;",(($category['depth']-1)*5)).$category['title']
                            .'</a></li>';  
                    }
                ?>
                </ul>
            </div>