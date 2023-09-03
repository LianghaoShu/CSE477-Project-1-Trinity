<?php
/**
 * Created by PhpStorm.
 * User: NickJones
 * Date: 2/18/2019
 * Time: 2:06 AM
 */
require 'lib/game.inc.php';
$view = new Game\ShowCardsView($game->getPlayers()[$game->getIdx()], $_GET);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Cards</title>
    <link href="lib/murder.css" type="text/css" rel="stylesheet" />

</head>

<body>
<h1>
    <?php $view->presentPlayer($game); ?>
</h1>
    <?php echo $view->presentForm(); ?>
    <?php echo $view->presentHand();?>
    <?php echo $view->presentOther();?>

    <?php $view->nextPlayer($game); ?>

</body>
</html>