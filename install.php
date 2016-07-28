<?php

//shell_exec('sudo cp ini/* ../backup_litetrader/ini -R');
//shell_exec('sudo cp sqlite/* ../backup_litetrader/sqlite -R');


//shell_exec('git checkout -- *');
//shell_exec('git pull');



foreach(glob('ini/*',GLOB_ONLYDIR) AS $dir){
    $dirname = filename($dir);
    shell_exec('cp -n ini/'.$dirname.'/schema/*.ini ini/'.$dirname);
    shell_exec('sudp chmod 0777 ini/'.$dirname.'/*.ini');
}

foreach(glob('sqlite/schema/*.sql') AS $sql){
    $db = basename($sql);
    list($db) = explode(".",$db);
    if(!file_exists('sqlite/'.$db)){
        shell_exec('sqlite3 sqlite/'.$db.' < '.$sql);
        shell_exec('sudo chmod 0777 sqlite/'.$db);
    }
}

