<?php
/**
 * Created by PhpStorm.
 * User: Ze Liu
 * Date: 4/7/2019
 * Time: 2:30
 */

namespace Game;


class NewGameController
{
    private $redirect;
    private $user;


    public function __construct(Site $site, User $user,Game $game, $post , array &$session)
    {
        $this->user = $user;
        $lobbies = new Lobbies($site);
        $players = new Players($site);
        $games = new Games($site);

        $root = $site->getRoot();
        $this->redirect = $root;
        if(isset($post['join'])){
            $id = 0;
            if (isset($post['id'])){
                $id = $post["id"];
            }

            if ($lobbies->inLobby($user->getId()) || $games->inGame($user->getId())){
                return;
            }

            //go to lobby to find a game

            $lobbies->joinLobby($id,$user->getId());
            $lobby = $lobbies->getLobby($id);
            $gameId = $lobby['gameId'];


            $session[GAME_SESSION] = $games->restoreGame($gameId);
            $players->createGame_byId($user->getId(),$gameId);
            $this->pushToClient();

            $this->redirect = "$root/lobby.php?lobbyId=$id";
        }
        elseif (isset($post['create'])){
            $games = new Games($site);
            $game->setId(1);
            if ($lobbies->inLobby($user->getId()) || $games->inGame($user->getId())){
                return;
            }

            $gameId = $games->createGame($game);
            $lobbyId = $lobbies->createLobby($gameId);
            $players->createGame_byId($user->getId(),$gameId);
            $this->pushToClient();



            //Go to waiting screen
            $this->redirect = "$root/lobby.php?lobbyId=$lobbyId";


        }

        if (isset($post['start'])){
            if($players < 2){ //do nothing if less than two players
                $this->redirect = "$root/lobby.php?lobbyId=$lobbyId";
            }
            else{ //start game
                $this->redirect = "$root/welcome.php?lobbyId";
            }
        }




    }

    /**
 * @return mixed
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
}