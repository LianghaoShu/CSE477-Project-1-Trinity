<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-04-08
 * Time: 22:21
 */
$open = true;		// Can be accessed when not logged in
require '../lib/game.inc.php';

$controller = new Game\ResetController($site, $_SESSION, $_POST, $user);

header("location: " . $controller->getRedirect());