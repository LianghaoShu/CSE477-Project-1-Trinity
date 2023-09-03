<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-04-10
 * Time: 21:05
 */
require '../lib/game.inc.php';
$controller = new Game\LobbyController($site, $_POST, $user, $game);
header("location: " . $controller->getRedirect());