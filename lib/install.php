<?php 
echo "\n *** INSTALLATION START *** \n\n";

/** DB */ 

$src = realpath(__DIR__.'/../sqlite/schema/');
$dest = realpath(__DIR__.'/../sqlite/');

foreach (glob("$src/*.sql") as $file) {
    $db = basename(substr($file,0,-4));
    echo 'sqlite3 '.$dest.'/'.$db.' < '.$file."\n";
    shell_exec('sqlite3 '.$dest.'/'.$db.' < '.$file);
}

echo "sudo chmod 777 -R $dest";
shell_exec("sudo chmod 777 -R $dest");

echo "\n\n";

/** INI */

$src = realpath(__DIR__.'/../ini/schema/');
$dest = realpath(__DIR__.'/../ini/');

foreach (glob("$src/*.ini") as $file) {
    $filename = basename($file);
    echo 'cp '.$file.' '.$dest.'/'.$filename."\n";
    shell_exec('cp '.$file.' '.$dest.'/'.$filename);
}
echo "sudo chmod 777 $dest/*.ini";
shell_exec("sudo chmod 777 $dest/*.ini");

echo "\n";

echo "\n *** // INSTALLATION END *** \n\n";