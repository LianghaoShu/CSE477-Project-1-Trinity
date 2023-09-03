<?php
/**
 * Created by PhpStorm.
 * User: Ze Liu
 * Date: 3/30/2019
 * Time: 20:11
 */

/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/

require '../lib/game.inc.php';
$controller = new Game\UsersController($site, $user, $_POST);
header("location: " . $controller->getRedirect());
