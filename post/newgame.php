<?php
/**
 * Created by PhpStorm.
 * User: Ze Liu
 * Date: 4/7/2019
 * Time: 2:50
 */
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
require '../lib/game.inc.php';
$controller = new \Game\NewGameController($site, $user, $game, $_POST , $_SESSION);

header("location: " . $controller->getRedirect());
exit;