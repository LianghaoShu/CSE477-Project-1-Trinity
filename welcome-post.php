<?php
/**
 * Created by PhpStorm.
 * User: Ze Liu
 * Date: 2/17/2019
 * Time: 17:07
 */
require __DIR__.'/lib/game.inc.php';
session_start();
$controller = new Game\WelcomeController($game, $_POST);

if ($controller->getRestart()){
    header('location: lobby.php');
    exit;
}

header('location: game.php');
exit;