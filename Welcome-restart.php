<?php
require __DIR__ . '/lib/game.inc.php';
?>
/**
 * Created by PhpStorm.
 * User: NickJones
 * Date: 2/25/2019
 * Time: 9:26 AM
 */

<!doctype html>
<html lang="en">
<head>
    <title>Welcome Restart</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link href="lib/murder.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php
unset($_SESSION[GAME_SESSION]);
$games = new Game\Games($site);
$games->endGame($game);
$gameid = $_SESSION['gameid'];
$playes = new Game\Players($site);
$gameplayers= new Game\GamePlayers($site);
$playes->deleteGame($gameid);
$gameplayers->deleteGame($gameid);


header('location: newgame.php');
?>
</body>

</html>