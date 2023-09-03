<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-04-08
 * Time: 22:21
 */

namespace Game;


class ResetController
{
    /**
     * LoginController constructor.
     * @param Site $site The Site object
     * @param array $session $_SESSION
     * @param array $post $_POST
     */
    public function __construct(Site $site, array &$session, array $post,User $user) {
        // Create a Users object to access the table
        $root = $site->getRoot();

        $id = $user->getId();



        $players = new Players($site);
        $lobbies = new Lobbies($site);



        $gameId = $players->getUserGame($id)['gameid'];
        $lobbyId = $lobbies->getLobbyFromUserId($id)['lobbyid'];

        $players->deletePlayerFromGame($id);
        $lobbies->leaveLobby($lobbyId, $id , $gameId);
        $session[GAME_SESSION] = new Game(); // Reset the game
        $this->pushToClient();
        $this->redirect = "$root/newgame.php?uid=$id";

    }

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }	// Page we will redirect the user to.

    private $redirect;


    public function pushToClient(){
        /*
 * PHP code to cause a push on a remote client.
 */
        $msg = json_encode(array('key'=>'Trinity-1-lobby', 'cmd'=>'reload'));

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        $sock_data = socket_connect($socket, '127.0.0.1', 8078);
        if(!$sock_data) {
            echo "Failed to connect";
        } else {
            socket_write($socket, $msg, strlen($msg));
        }
        socket_close($socket);
    }


}