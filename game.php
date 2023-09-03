<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-02-13
 * Time: 13:37
 */
require 'lib/game.inc.php';
echo '<pre>';
//print_r($game->getId());
//var_dump($_SESSION);
echo '</pre>';
$gameView = new Game\GameView($user, $_GET, $_SESSION , $site);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $gameView->pushScript() ?>
    <meta charset="UTF-8">
    <title>Who Murdered My Grade?</title>
    <link href="lib/murder.css" type="text/css" rel="stylesheet"/>
</head>
<body>
    <?php echo $gameView->presentBoard(); ?>
</body>
</html>
