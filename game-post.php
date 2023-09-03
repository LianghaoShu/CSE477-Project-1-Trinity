<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-02-22
 * Time: 14:49
 */

require __DIR__.'/lib/game.inc.php';
session_start();
$controller = new Game\GameController($game, $site, $_POST);
/*
 * PHP code to cause a push on a remote client.
 */
$msg = json_encode(array('key'=>'Trinity-game'.$game->getId(), 'cmd'=>'reload'));

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

$sock_data = socket_connect($socket, '127.0.0.1', 8078);
if(!$sock_data) {
    echo "Failed to connect";
} else {
    socket_write($socket, $msg, strlen($msg));
}
socket_close($socket);

header('location: game.php');
exit;