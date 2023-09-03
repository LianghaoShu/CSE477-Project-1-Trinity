<?php
/**
 * Created by PhpStorm.
 * User: NickJones
 * Date: 3/30/2019
 * Time: 6:01 PM
 */

namespace Game;


class LobbyView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct(Site $site, $user) {
        $this->site = $site;
        $this->id = $user->getId();
        $this->setTitle("Pre-Game Lobby");
    }

    /**
     * Generates the push script for the view
     */
    public function pushScript() {
        $js = <<<SCRIPT
<script>
    /**
     * Initialize monitoring for a server push command.
     * @param key Key we will receive.
     */
    function pushInit(key) {
        var conn = new WebSocket('ws://webdev.cse.msu.edu/ws');
        conn.onopen = function (e) {
            console.log("Connection to push established!");
            conn.send(key);
        };

        conn.onmessage = function (e) {
            try {
                var msg = JSON.parse(e.data);
                if (msg.cmd === "reload") {
                    location.reload();
                }
            } catch (e) {
            }
        };
    }

    pushInit("Trinity-1-lobby");
</script>
SCRIPT;
        return $js;
    }

    public function present() {
        $html = <<<HTML
<form action="post/lobby.php" method="post">
	<fieldset>
		<legend>Pre-Game Lobby</legend>
        <table>
		<tr><td>Players</td></tr>
HTML;
        $lobbies = new Lobbies($this->site);
        $users = $lobbies->getPlayers($this->id);
        $count = 0;
        foreach ($users as $user) {
            $count += 1;
            $name = $user->getName();
            $html.=<<<HTML
<tr><td>$name</td></tr>
HTML;
        }


        $html .= <<<HTML
        </table>
        <input type="hidden" name = "count" value="$count">
		<br><p>
			<input type="submit" value="Start Game" name="start"> <a href=""></a>
		</p>
	</fieldset>
</form>
<form action="post/resetgame.php" method="post">
	<fieldset>
	    <p>Join a different lobby or create a new game</p>
		<p><input type="submit" value="restart" name="restart" href="post/resetgame.php"></p>

	</fieldset>
	<br>Starting a game requires at least two players.
</form>
HTML;

        return $html;
    }



    public function isRedirect(){
        $lobbie = new Lobbies($this->site);
        $gamePlayer = new GamePlayers($this->site);
        $root = $this->site->getRoot();
        if (!$gamePlayer->inGame($this->id) == Null){
            $this->redirect = "$root/game.php";
            return True ;
        }
        if ($lobbie->inLobby($this->id) == NULL){
            $this->redirect = "$root/newgame.php";
            return True;
        }


        return False;
    }

    public function getRedirect(){
        return $this->redirect;
    }

    private $site; ///< The Site object
    private $id;
    private $redirect;
}