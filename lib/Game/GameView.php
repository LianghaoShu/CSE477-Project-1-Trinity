<?php
/**
 * Created by PhpStorm.
 * User: cgreene
 * Date: 2019-02-15
 * Time: 10:44
 */

namespace Game;


class GameView {

    /**
     * The game
     */
    private $game;

    private $myTurn; //< Whether or not the user has their turn now

    public function __construct(User $user, $get, &$session , Site $site, $test = 0) {
        if($test == 0) {
            $userId = $user->getId();
            $games = new Games($site);
            $session[GAME_SESSION] = $games->restoreUserGame($userId);
            $this->game = $session[GAME_SESSION];
            $gamePlayers = new GamePlayers($site);
            $this->myTurn = $gamePlayers->myTurn($this->game, $userId);

            if (isset($post['uid'])) {
                $id = strip_tags($this->$get(['uid']));
            }
        }
        $this->game = $session[GAME_SESSION];
    }

    public function presentBoard() {
        $html = '<form class="game" method="post" action="game-post.php" >';
        $html .= '<div class="game">';
        $html .= '<div class="board">';
        $html .= $this->buildGrid();
        $html .= $this->buildMiddleArea();
        $html .= '</div></div>';
        $html .= '</form>';
        $gameid = $this->game->getId();
        $_SESSION['gameid'] = $gameid;

        $html .= '<p class="new_game"><a href="Welcome-restart.php"> New Game </a></p>';




        $html .= $this->showCards();

        return $html;
    }

    public function buildMiddleArea() {
        $mode = $this->game->getMode();
        $html = $this->displayPlayer();
        if ($mode == Game::DICE){
            $html.= $this->presentDice();
        }
        else if ($mode == Game::INROOM){
            $html.= $this->presentChoices();
        }
        else if ($mode == Game::ACCUSE or $mode == Game::SUGGEST){
            $html.= $this->presentDone();

        }
        else if ($mode == Game::GUESSWEAPON){
            $html.= $this->presentWeapon();
        }
        else if ($mode == Game::WON){
            $html.=$this->presentWon();
        }
        else if ($mode == Game::LOST){
            $html.=$this->presentLost();
        }
        else if ($mode == Game::HINT){
            $html.=$this->presentHint();
        }

        //$this->presentReply();

        $html .= '</div>';

        return $html;
    }

    public function displayPlayer(){
        $name = $this->game->getCurrentPlayer();
        $name = "Prof. ".$name;
        $html = "<div class=\"play\"><p class=\"player-name\">Player<br> $name ";
        if (!$this->myTurn) {
            $html .= '<br><i>(not you)</i>';
        }
        $html .= "</p>";
        return $html;

    }

    private function buildGrid() {

        $currentLocation = $this->game->getPlayers()[$this->game->getCurrentPlayerIdx()]->getPosition();
        $currentNode = $this->game->getBoard()->getGrid()[$currentLocation[0]][$currentLocation[1]];
        $this->game->Disable();
        $players = $this->game->getPlayers();
        foreach($players as $player){
            $position = $player->getPosition();
            $this->game->getBoard()->getGrid()[$position[0]][$position[1]]->Block();
        }
        $currentNode->searchReachable($this->game->getDice2() + $this->game->getDice1(),$currentLocation[0],$currentLocation[1]);

        $html = "";
        for ($i = 0; $i < 25; $i++) {
            $html .= '<div class="row">';
            for ($j = 0; $j < 24; $j++) {
                $html .= '<div class="cell">';

                if ($this->game->getMode() == GAME::DICE && $this->game->getBoard()->getGrid()[$i][$j]->getReachable()) {
                    $html .= "<button type=\"submit\" name=\"cell\" value=\"$i, $j\"";
                    if (!$this->myTurn) {
                        $html.= ' disabled = "disabled"';
                    }
                    $html .= ">";
                }
                foreach ($this->game->getPlayers() as $p) {
                    if ($p->getPosition() == [$i, $j]) {
                        $pieceFile = "images/" . strtolower($p->getName()) . "-piece.png";
                        $html .= "<img class=\"player-piece\" src=\"$pieceFile\">";
                    }
                }
                if ($this->game->getMode() == GAME::DICE && $this->game->getBoard()->getGrid()[$i][$j]->getReachable()) {
                    $html .= '</button>';
                }
                $html .= '</div>';
            }
            $html.='</div>';
        }

      //  print_r($currentNode);

        return $html;
    }

    public function presentDice(){
        $string1 = (string)$this->game->getDice1();
        $string2 = (string)$this->game->getDice2();
        $html = <<<HTML
        <p id="dice"><img src="images/dice$string1.png" width="32" height="33" alt=""> <img src="images/dice$string2.png" width="32"
          height="33" alt=""></p>  
HTML;

        return $html;
    }

    public function presentDone(){
        $html = <<<HTML
<p class="information">Who done it?</p>
<p class="radio"><input type="radio" name="suspect" value="owen"
HTML;
        if (!$this->myTurn) {
            $html .= ' disabled = "disabled"';
        }
        $html .= <<<HTML
>Prof.Owen</input></p>
<p class="radio"><input type="radio" name="suspect" value="mccullen"
HTML;
        if (!$this->myTurn) {
            $html .= ' disabled = "disabled"';
        }
        $html .= <<<HTML
>Prof.McCullen</input></p>
<p class="radio"><input type="radio" name="suspect" value="onsay"
HTML;
        if (!$this->myTurn) {
            $html .= ' disabled = "disabled"';
        }
        $html .= <<<HTML
>Prof.Onsay</input></p>
<p class="radio"><input type="radio" name="suspect" value="enbody"
HTML;
        if (!$this->myTurn) {
            $html .= ' disabled = "disabled"';
        }
        $html .= <<<HTML
>Prof.Enbody</input></p>
<p class="radio"><input type="radio" name="suspect" value="plum"
HTML;
        if (!$this->myTurn) {
            $html .= ' disabled = "disabled"';
        }
        $html .= <<<HTML
>Prof.Plum</input></p>
<p class="radio"><input type="radio" name="suspect" value="day"
HTML;
        if (!$this->myTurn) {
            $html .= ' disabled = "disabled"';
        }
        $html .= <<<HTML
>Prof.Day</input></p>
<p class="button"><button type="submit" name="go"
HTML;
        if (!$this->myTurn) {
            $html .= ' disabled = "disabled"';
        }
        $html .= '>Go</button></p>';

        return $html;
    }

    public function presentWeapon(){
        $html = <<<HTML
<p class="information">With what?</p>
<p class="radio"><input type="radio" name="weapon" value="final">Final Exam</input></p>
<p class="radio"><input type="radio" name="weapon" value="midterm">Midterm Exam</input></p>
<p class="radio"><input type="radio" name="weapon" value="programming">Programming Assignment</input>
</p>
<p class="radio"><input type="radio" name="weapon" value="project">Project</input></p>
<p class="radio"><input type="radio" name="weapon" value="written">Written Assignment</input></p>
<p class="radio"><input type="radio" name="weapon" value="quiz">Quiz</input></p>
<p class="button"><button type="submit" name="go">Go</button></p>
HTML;
        return $html;
    }

    public function presentWon(){
        $html = <<<HTML
<p class="information">You Have Won the Game</p>
<p class="new_game"> Please click New Game on Bottom to restart</p>
HTML;
        return $html;

    }

    public function presentLost()
    {
        $html = <<<HTML
<p class="information">You Have Lost the Game</p>
<p class="new_game"> You can only make suggestions now, go help your teammate win</p>
<p class="new_game"> Press Go to go to the next player</p>
<p class="button"><button type="submit" name="go">Go</button></p>
HTML;
        return $html;
    }

    public function presentHint()
    {
        $html = '<p class="information">Word on the street is: </p>';

        $html .= '<p class="keyword">';
        if ($this->myTurn) {
            $html .= $this->game->hint();
        }
        else {
            $html .= "<b>REDACTED</b>";
        }
        $html .= '</p>';
        $html .= '<p class="button"><button type="submit" name="go"';
        if (!$this->myTurn) {
            $html .= ' disabled = "disabled"';
        }
        $html .= '>Go</button></p>';

        return $html;
    }

    public function  presentChoices() {
        $node = $this->game->showlocation();
        //<pre>print_r($node)
        $html = <<<HTML

<p class="information">What do you wish to do? </pre></p>
<p class="radio"><input type="radio" name="choice" value="pass"
HTML;
        if (!$this->myTurn) {
            $html .= ' disabled = "disabled"';
        }
        $html .= <<<HTML
>Pass</input></p>
<p class="radio"><input type="radio" name="choice" value="suggest"
HTML;
        if (!$this->myTurn) {
            $html .= ' disabled = "disabled"';
        }
        $html .= <<<HTML
>Suggest</input></p>
HTML;
        if ($this->game->getPlayerStatus()){
            $html .= "<p>Can't Accuse Anymore</p>";
        }
        else{
            $html.= '<p class="radio"><input type="radio" name="choice" value="accuse"';
            if (!$this->myTurn) {
                $html .= ' disabled = "disabled"';
            }
            $html .= '>Accuse</input></p>';
        }

        $html .= '<p class="button"><button type="submit" name="go"';
        if (!$this->myTurn) {
            $html .= ' disabled = "disabled"';
        }
        $html .= '>Go</button></p>';

        return $html;
    }

    public function showCards(){
        $curPlayer = $this->game->getPlayers()[$this->game->getCurrentPlayerIdx()];
        $hand = $curPlayer->getCards();
        $other = $curPlayer->getOther();
        $codes = $curPlayer->getSecret();
        $html = <<<HTML
        <form class="expand">
<p>
<input type="button" id="expand" onclick="showCards()" value="Show Cards"
HTML;
        if (!$this->myTurn) {
            $html.= ' disabled = "disabled"';
        }
        $html .= <<<HTML
>
</p> 

<script type ="text/javascript">
function showCards(){
 var showcards = document.getElementById("showcards");
 var button = document.getElementById("expand");
        if (showcards.style.display === "initial")
        {
            showcards.style.display = "none";
            button.value = "Show Cards"
        }
        else{
            showcards.style.display = "initial";
            button.value = "Hide Cards"
        }
}
</script>

</form>
        <div class="showcards" id="showcards" style="display: none">
        Held Cards
        <div class="cards">
            <div class="cards">
                <div class ="card"><figure><img src="images/$hand[0].jpg" width="70" height="110" alt=""/></figure></div>
                <div class ="card"><figure><img src="images/$hand[1].jpg" width="70" height="110" alt=""/></figure></div>
                <div class ="card"><figure><img src="images/$hand[2].jpg" width="70" height="110" alt=""/></figure></div>
                <div class ="card"><figure><img src="images/$hand[3].jpg" width="70" height="110" alt=""/></figure></div>
                <div class ="card"><figure><img src="images/$hand[4].jpg" width="70" height="110" alt=""/></figure></div>
                <div class ="card"><figure><img src="images/$hand[5].jpg" width="70" height="110" alt=""/></figure></div>   
            </div>
        </div>
            <br><br>
        Other Cards
        <div class="cards">
            <div class="cards">
                <div class ="card"><figure><img src="images/$other[0].jpg" width="70" height="110" alt=""/></figure><p>$codes[0]</p></div>
                <div class ="card"><figure><img src="images/$other[1].jpg" width="70" height="110" alt=""/></figure><p>$codes[1]</p></div>
                <div class ="card"><figure><img src="images/$other[2].jpg" width="70" height="110" alt=""/></figure><p>$codes[2]</p></div>
                <div class ="card"><figure><img src="images/$other[3].jpg" width="70" height="110" alt=""/></figure><p>$codes[3]</p></div>
                <div class ="card"><figure><img src="images/$other[4].jpg" width="70" height="110" alt=""/></figure><p>$codes[4]</p></div>
                <div class ="card"><figure><img src="images/$other[5].jpg" width="70" height="110" alt=""/></figure><p>$codes[5]</p></div>
                <div class ="card"><figure><img src="images/$other[6].jpg" width="70" height="110" alt=""/></figure><p>$codes[6]</p></div>
                <div class ="card"><figure><img src="images/$other[7].jpg" width="70" height="110" alt=""/></figure><p>$codes[7]</p></div>
                <div class ="card"><figure><img src="images/$other[8].jpg" width="70" height="110" alt=""/></figure><p>$codes[8]</p></div>
                <div class ="card"><figure><img src="images/$other[9].jpg" width="70" height="110" alt=""/></figure><p>$codes[9]</p></div>
                <div class ="card"><figure><img src="images/$other[10].jpg" width="70" height="110" alt=""/></figure><p>$codes[10]</p></div>
                <div class ="card"><figure><img src="images/$other[11].jpg" width="70" height="110" alt=""/></figure><p>$codes[11]</p></div>
                <div class ="card"><figure><img src="images/$other[12].jpg" width="70" height="110" alt=""/></figure><p>$codes[12]</p></div>
                <div class ="card"><figure><img src="images/$other[13].jpg" width="70" height="110" alt=""/></figure><p>$codes[13]</p></div>
                <div class ="card"><figure><img src="images/$other[14].jpg" width="70" height="110" alt=""/></figure><p>$codes[14]</p></div>  
            </div>
        </div>
        </div>
HTML;

        return $html;
    }

    public function pushScript() {
        $gameId = $this->game->getId();
        $html = <<<HTML
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

        pushInit("Trinity-game$gameId");
    </script>
HTML;
        return $html;
    }
}