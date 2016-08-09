<?php
/**
 * Created by PhpStorm.
 * User: S
 * Date: 09.08.2016
 * Time: 9:02
 */

namespace Apo100l\Quest;

spl_autoload_register(function () {
    include 'src/classes/QuestAbstract.php';
    include 'src/classes/Furr.php';
});

switch ($argv[1]){
    case 'statistic':
        $q = new Furr();
        $q->Sumco($argv);
        break;
    case 'help':
        echo "help";
        break;
}




