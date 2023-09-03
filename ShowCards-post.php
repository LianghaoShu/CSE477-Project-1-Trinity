<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-02-20
 * Time: 00:02
 */
require __DIR__.'/lib/game.inc.php';
session_start();
$controller = new Game\ShowCardsController($game, $_POST);
if ($controller->IsEnd()){
    header('location: game.php');
    exit;
}
else{
    header('location: ShowCards.php');

}

exit;