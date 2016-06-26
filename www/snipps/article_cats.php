<?php 
                $dbh=new PDO('sqlite:'.DB_DIR.'blog');
                $categories = $dbh->query("SELECT 
                        c.id,
                        c.title,
                        c.depth,
                        c.tags,
                        c.id image,c.date_image, c.image_size,
                        c.id actions
                    FROM categories c 
                    WHERE c.is_visible = 1 
                    ORDER BY c.list_order
                ")->fetchAll(PDO::FETCH_ASSOC);
            ?>
            
             <div class="uk-panel uk-panel-box">
                <h3 class="uk-panel-title" data-lang>Категории</h3>
                <hr>
                <ul class="uk-nav uk-nav-side">
                <?php
                    foreach($categories AS $n => $category){ 
                        echo '<li class="uk-parent"><a href="#">'.str_repeat("&nbsp;",(($category['depth']-1)*5)).$category['title'].'</li>';  
                    }
                ?>
                </ul>
            </div>