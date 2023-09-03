<?php
/**
 * Created by PhpStorm.
 * User: Ze Liu
 * Date: 2/15/2019
 * Time: 13:41
 */

namespace Game;

class WelcomeView
{
    private $game;
    public function __construct(Game $game,$get)
    {
        $this->game = $game;
        if(isset($post['uid'])){
            $id = strip_tags($this->$get(['uid']));
        }

    }

    public function presentWelcomeOLD(){
        $html = <<<HTML
        
<form class="welcome" method="post" action="welcome-post.php">
        <p>
            <input type="checkbox" name="Owen" id="welcome1">
            <label for="Owen">Prof. Owen</label>
        </p>
        <p>
            <input type="checkbox" name="McCullen" id="welcome2">
            <label for="McCullen">Prof. McCullen</label>
        </p>
        <p>
            <input type="checkbox" name="Onsay" id="welcome3">
            <label for="Onsay">Prof. Onsay</label>
        </p>
        <p>
            <input type="checkbox" name="Enbody" id="welcome4">
            <label for="Enbody">Prof. Enbody</label>
        </p>
        <p>
            <input type="checkbox" name="Plum" id="welcome5">
            <label for="Plum">Prof. Plum</label>
        </p>
        <p>
            <input type="checkbox" name="Day" id="welcome6">
            <label for="Day">Prof. Day</label>
        </p>

        <p>Select at least 2 players to play the game.<p>
        <p><input type="submit"></p>
        <p><a href="Instructions.php">Instructions</a></p>
    </form>

HTML;
        return $html;

    }

    public function presentWelcome(){
        $numPlayers = $this->game->getPlayerCount();
        $playerNames = array("Owen", "McCullen", "Onsay", "Enbody", "Plum", "Day");
        $welcome = array("welcome1", "welcome2", "welcome3", "welcome4", "welcome5", "welcome6");
        //$numPlayers = 3; //testing
        $html = <<<HTML
<form class="welcome" method="post" action="welcome-post.php" id="startgame" hidden>
HTML;
        $count = 0;
        while ($count < $numPlayers){
            $html .= <<<HTML
            <input type="hidden" name="
HTML;
            $html .= $playerNames[$count];
            $html .= "\"";
            $html .= " id=";
            $html .= "\"";
            $html .= $welcome[$count];
            $html .= "\">";
            $count++;
        }

        $html .= <<<HTML
        <input type="submit">
        <script>document.getElementById("startgame").submit();</script>
    </form>
HTML;
        /*
        <input type="hidden" name="Owen" id="welcome1" />
        <input type="hidden" name="McCullen" id="welcome2" />
        <input type="hidden" name="Onsay" id="welcome3" />
        <input type="hidden" name="Enbody" id="welcome4" />
        <input type="hidden" name="Plum" id="welcome5" />
        <input type="hidden" name="Day" id="welcome6" />
        */
        return $html;
    }
}