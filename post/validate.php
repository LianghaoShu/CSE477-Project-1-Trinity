<?php
/**
 * Created by PhpStorm.
 * User: NickJones
 * Date: 3/30/2019
 * Time: 6:18 PM
 */
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
require '../lib/game.inc.php';
$controller = new Game\PasswordValidateController($site, $_POST);
header("location: " . $controller->getRedirect());