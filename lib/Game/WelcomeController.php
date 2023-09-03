<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-02-17
 * Time: 22:00
 */

namespace Game;


class WelcomeController
{
    public function __construct(Game $game, $post, $cheat = False)
    {
        $this->game = $game;
        $this->playerCount = 0;
        $this->cheat = $cheat;
        $playernames = [];
        if(isset($post['Owen'])){
            $playernames[$this->playerCount] = "Owen";
            $this->playerCount += 1;
        }
        if(isset($post['McCullen'])){
            $playernames[$this->playerCount] = "McCullen";
            $this->playerCount += 1;
        }
        if(isset($post['Onsay'])){
            $playernames[$this->playerCount] = "Onsay";
            $this->playerCount += 1;
        }
        if(isset($post['Enbody'])){
            $playernames[$this->playerCount] = "Enbody";
            $this->playerCount += 1;
        }
        if(isset($post['Plum'])){
            $playernames[$this->playerCount] = "Plum";
            $this->playerCount += 1;
        }
        if(isset($post['Day'])){
            $playernames[$this->playerCount] = "Day";
            $this->playerCount += 1;
        }
        if ($this->playerCount < 2){
            $this->restart = true;
        }
        $this->players = $this->dealHands($playernames);

        $unused = array();
        if(!isset($post['Owen'])){
            $unused[] = "Owen";
        }
        if(!isset($post['McCullen'])){
            $unused[] = "McCullen";
        }
        if(!isset($post['Onsay'])){
            $unused[] = "Onsay";
        }
        if(!isset($post['Enbody'])){
            $unused[] = "Enbody";
        }
        if(!isset($post['Plum'])){
            $unused[] = "Plum";
        }
        if(!isset($post['Day'])){
            $unused[] = "Day";
        }

        foreach($unused as $p){
            array_push($this->players, new Player($p,array(),array(),array(),True));
        }
        $this->setPlayers();
    }

    private function setPlayers(){
        $this->game->setPlayers($this->players);
    }
    public function getPlayerCount(){
        return $this->playerCount;
    }
    public function getPlayers(){
        return $this->players;
    }

    //get it to work correctly
    private function shuffleDeck(){
        $suspects = array("owen", "mccullen", "onsay",
            "enbody", "plum", "day");

        $weapons = array("final", "quiz",
            "programming", "written", "midterm", "project");

        $locations = array("international", "library", "beaumont", "museum",
            "engineering", "union", "breslin", "stadium", "wharton");

        if (!$this->cheat){
            shuffle($locations);
            shuffle($suspects);
            shuffle($weapons);
        }
        $this->game->setMurderLocation($locations[0]);
        unset($locations[0]);
        $locations = array_values($locations);

        $this->game->setMurderer($suspects[0]);
        unset($suspects[0]);
        $suspects = array_values($suspects);

        $this->game->setMurderWeapon($weapons[0]);
        unset($weapons[0]);
        $weapons = array_values($weapons);

        $deck = array_merge($locations, $suspects, $weapons);
        if (!$this->cheat){
            shuffle($deck);
        }

        return $deck;
    }

    //get it to work correctly
    private function dealHands($names){
        $secretwords = array("eyeball", "maraca", "violin", "exuberant", "greedy", "tick",
            "rum", "coconut", "kitchen", "flamingo", "robin", "yummy", "giants", "fling",
            "duck", "menagerie", "lounge", "earlobe", "radio", "dear", "watch", "glib",
            "tomato", "couscous", "direful", "questionable", "own", "walk", "penitent",
            "trees", "finicky", "actor", "hustle", "bread", "things", "remake", "flawless",
            "giants", "hop", "office", "impel", "dispensable", "import", "hypnotic", "soar",
            "servant", "toothbrush", "lead", "clumsy", "slim", "pet", "needless", "chicken",
            "hop", "hateful", "wrench", "different", "idea", "unequaled", "innocent", "farm",
            "aspiring", "earsplitting", "stage", "forgive", "actually", "drawer", "touch",
            "royal", "shade", "hum", "work", "egg", "vein", "puffy", "attempt", "grouchy", "dolls",
            "stream", "argument", "jealous", "limit", "tank", "saturate", "five", "bleed",
            "signal", "soda", "cut", "retch");

        if (!$this->cheat){
            shuffle($secretwords);
        }

        $deck = $this->shuffleDeck();
        $hand = [];
        $other = [];
        $count = 0;
        $players = [];
        $offset = 30;
        while($count < $this->playerCount) {
            if($count == 0){
                array_push($hand, $deck[0], $deck[1], $deck[2], $deck[3], $deck[4], $deck[5]);
                array_push($other, $deck[6], $deck[7], $deck[8], $deck[9], $deck[10], $deck[11], $deck[12],
                $deck[13], $deck[14], $deck[15], $deck[16], $deck[17], $this->game->getMurderer(), $this->game->getMurderLocation(), $this->game->getMurderWeapon());
                shuffle($other);
                $hiddenwords = array_slice($secretwords, 0, 15);
                array_push($players, new Player($names[$count], $hand, $other, $hiddenwords));
            }

            if($count == 1){
                array_push($hand, $deck[6], $deck[7], $deck[8], $deck[9], $deck[10], $deck[11]);
                array_push($other, $deck[0], $deck[1], $deck[2], $deck[3], $deck[4], $deck[5], $deck[12],
                    $deck[13], $deck[14], $deck[15], $deck[16], $deck[17], $this->game->getMurderer(), $this->game->getMurderLocation(), $this->game->getMurderWeapon());
                shuffle($other);
                $hiddenwords = array_slice($secretwords, 15, 15);
                array_push($players, new Player($names[$count], $hand, $other, $hiddenwords));
            }

            if($count == 2){
                array_push($hand, $deck[12], $deck[13], $deck[14], $deck[15], $deck[16], $deck[17]);
                array_push($other, $deck[6], $deck[7], $deck[8], $deck[9], $deck[10], $deck[11], $deck[0],
                    $deck[1], $deck[2], $deck[3], $deck[4], $deck[5], $this->game->getMurderer(), $this->game->getMurderLocation(), $this->game->getMurderWeapon());
                shuffle($other);
                $hiddenwords = array_slice($secretwords, 30, 15);
                array_push($players, new Player($names[$count], $hand, $other, $hiddenwords));
            }

            if($count > 2){
                shuffle($deck);
                array_push($hand, $deck[0], $deck[1], $deck[2], $deck[3], $deck[4], $deck[5]);
                array_push($other, $deck[6], $deck[7], $deck[8], $deck[9], $deck[10], $deck[11], $deck[12],
                    $deck[13], $deck[14], $deck[15], $deck[16], $deck[17], $this->game->getMurderer(), $this->game->getMurderLocation(), $this->game->getMurderWeapon());
                shuffle($other);
                $hiddenwords = array_slice($secretwords, $offset, 15);
                $offset = $offset + 15;
                array_push($players, new Player($names[$count], $hand, $other, $hiddenwords));
            }
            $hand = [];
            $other = [];
            $count++;
        }

        return $players;
    }

    public function getRestart(){
        return $this->restart;
    }

    public function cheatMode(){
        $this->cheat = True;
    }

    private $game;
    private $players = array();
    private $playerCount = 0;
    private $restart = false;
    private $cheat = false;

}