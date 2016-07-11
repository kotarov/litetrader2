<?php 
return array(
    'title'=>'Регистрация',
    'body'=>'

<h2>Поздравления,</h2>
<p>Бяхте регистриран успешно в нашата система. </p>
<p>За да можете да ползвате своя профил, е нужно да бъде активиран. Можете да го активирате като кликнете на този линк:</p>
<p><a href="'.$urlActivate.$urlParams.'" target="_null">'.$urlActivate.$urlParams.'</a></p>
<p>или като посетите следния адрес:<br> <strong>'.$urlActivate.'</strong><br> и въведете своята поща и този ключ:<br> <strong>'.$key_activate.'</strong></p>

<br><hr><br>

<p>Поздрави,</p>
<p>Екипът на <strong>'.$company['name'].'</strong></p>

');