<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-04-10
 * Time: 21:21
 */

namespace Game;


class LobbyController
{
    function __construct(Site $site, $post,User $user, Game $game)
    {
        $root = $site->getRoot();
        if (isset($post['start'])){
            if($post['count'] < 2){

                $this->redirect = "$root/lobby.php?e";
                return;
            }
            $this->redirect = $site->getRoot();


        }
        $userId = $user->getId();
        $players = new Players($site);
        $lobbies = new Lobbies($site);
        $lobbyid = $lobbies->getLobbyFromUserId($userId);
        $gamePlayers = new GamePlayers($site);
        $games = new Games($site);


        $gameId = $players->getUserGame($userId);
        print_r($gameId);
        $gamePlayers->createGame($gameId['gameid']);

        $user_ids = $players->getAllPlayersInGame($gameId['gameid']);

        $post = array();
        for ($i = 0 ;$i <=count($userId); $i++){
            $prof = Game::PLAYER_NAMES[$i];
            $user = $user_ids[$i]['userid'];
            $gamePlayers->update($gameId['gameid'],strtolower($prof), $user);
            $post[$prof] = $user;
        }

        $welcome = new WelcomeController($game, $post);
        $game->setId($gameId['gameid']);

        $games->saveGame($game);
        $this->redirect = "$root/game.php";
        $this->pushToClient();

        $lobbies->deleteLobby($lobbyid['lobbyid']);




    }

    /**
     * @return string
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

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

    private $redirect;

}