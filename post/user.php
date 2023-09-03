<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-03-31
 * Time: 10:28
 */

/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
require '../lib/game.inc.php';

$controller = new Game\UserController($site, $_POST);
header("location: " . $controller->getRedirect());