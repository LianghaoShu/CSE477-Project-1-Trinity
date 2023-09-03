<?php
/**
 * Created by PhpStorm.
 * User: Ze Liu
 * Date: 4/7/2019
 * Time: 2:13
 */

namespace Game;


class NewGameView extends View
{
    private $site;
    private $id;
    public function __construct(Site $site, $get,$user)
    {
        $this->site = $site;
        if ($user != Null){
            $this->id = $user->getId();
        }

    }

    public function present(){
        $html =<<<HTML
        <div class = "lobbies">
<form method="post" action="post/newgame.php">
    <fieldset>
        <legend>Welcome to the Game</legend>
            <p>
            If you wish to start a new game press new else select an avalible lobby and click join
</p>
            <p>
                <input type="submit" value="New" name="create">
            </p>
            
        <div  class="lobbies">

            <p>Available Lobby:</p>
        <table>
            
            <tr>
                <td></td>
                <td>Lobby Name</td>
                <td>Players</td>
            </tr>
            

HTML;
        $lobbies = new Lobbies($this->site);
        if($lobbies->getLobbies()!= null) {
            foreach ($lobbies->getLobbies() as $lobby) {
                $id = $lobby['lobbyid'];
                $name = $lobby['name'];
                $numPlayers  = $lobby['numplayer'];
                $html .=<<<HTML
                <tr>
			    <td><input type="radio" name="id" value="$id"></td>
			    <td class="name">$name</td>
			    <td class="playe">$numPlayers</td>
		        </tr>
HTML;
                    }
        }
        $html .= <<<HTML
        </table>
        <p>
                <input type="submit" value="Join" name="join">
        </p>
        
</p>
    </fieldset>
</form>
</div>

HTML;
        return $html;
    }

    public function isRedirect(){
        $lobbie = new Lobbies($this->site);
        print_r($lobbie->inLobby($this->id));
        if ($lobbie->inLobby($this->id) != NULL){
            return True;
        }
        return False;
    }

    public function getRedirect(){
        $lobbie = new Lobbies($this->site);
        $root = $this->site->getRoot();
        $lobbyId = $lobbie->inLobby($this->id);
        $Redirect = "$root/lobby.php?lobbyId = $lobbyId";
        return $Redirect;
    }
}