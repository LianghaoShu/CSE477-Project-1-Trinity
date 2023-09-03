<?php
/**
 * Created by PhpStorm.
 * User: Ze Liu
 * Date: 2/14/2019
 * Time: 15:15
 */
require __DIR__ . '/lib/game.inc.php';
$view =new Game\InstructionView();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instructions</title>
    <link href="" type="text/css" rel="stylesheet" />
</head>
<body>
<?php
    echo $view->presentInstruction();
?>

<p><a href="index.php">Return to Game</a> </p>
</body>
</html>
