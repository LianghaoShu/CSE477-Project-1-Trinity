<?php
/**
 * Created by PhpStorm.
 * User: NickJones
 * Date: 2/19/2019
 * Time: 4:35 PM
 */

namespace Game;


class ShowCardsView
{
    public function __construct(Player $player,$get){
        $this->player = $player;
        if(isset($post['uid'])){
            $id = strip_tags($this->$get(['uid']));
        }

    }

    public function presentForm(){
        $html = <<<HTML
<form class="no-print" method="post" action="ShowCards-post.php" id="nextplayercards">
<p>
<input type="button" onclick="window.print()"  value="Print">
<input type="submit" value="Next">
</p>
</form>
        <script>document.getElementById("nextplayercards").submit();</script>

HTML;

        return $html;
    }

    public function presentHand(){
        $hand = $this->player->getCards();
        $html = <<<HTML
        <div class="print-only">
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
HTML;
        return $html;
    }

    public function presentOther(){
        $other = $this->player->getOther();
        $codes = $this->player->getSecret();
        $html = <<<HTML
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

    public function nextPlayer(Game $game){
        $idx = $game->getIdx();
        if ($idx + 1 < count($game->getPlayers())){
            if ($game->getPlayers()[$idx+1]->isBot()){
                $game->setIdx($idx+1);
                $this->nextPlayer($game);
            }
            else{
                $game->setIdx($idx + 1);
            }
        }
        else{
            $game->Start();
        }
    }

    public function presentPlayer(Game $game){
        while($game->getPlayers()[$game->getIdx()]->isBot()){
            $game->setIdx($game->getIdx() + 1);
        }
        echo "Cards for ";
        echo $game->getPlayers()[$game->getIdx()]->getName();
    }

    private $player;

}