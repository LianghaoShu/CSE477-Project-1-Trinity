<?php
/**
 * Created by PhpStorm.
 * User: Nicholas
 * Date: 2/15/2019
 * Time: 10:29 AM
 */

class PlayerTest extends \PHPUnit\Framework\TestCase
{
    private $name = array("Owen","McCullen","Onsay","Enbody","Plum","Day");
    private $cards = array("final", "international", "library", "beaumont", "museum", "owen");
    private $other = array("wharton", "stadium", "breslin", "enbody", "plum", "day",
"programming", "written", "project", "union", "engineering", "onsay",
"quiz", "mccullen", "midterm");
    private $secret = array("eyeball", "maraca", "violin",
"rum", "coconut", "kitchen", "flamingo", "robin",
"duck", "menagerie", "lounge", "earlobe", "radio",
"tomato", "couscous");

    public function test_construct(){
        $name = array("Owen","McCullen","Onsay","Enbody","Plum","Day");
        $cards = array("final", "international", "library", "beaumont", "museum", "owen");
        $other = array("wharton", "stadium", "breslin", "enbody", "plum", "day",
            "programming", "written", "project", "union", "engineering", "onsay",
            "quiz", "mccullen", "midterm");
        $secret = array("eyeball", "maraca", "violin",
            "rum", "coconut", "kitchen", "flamingo", "robin",
            "duck", "menagerie", "lounge", "earlobe", "radio",
            "tomato", "couscous");

        $player = new Game\Player($name, $cards, $other, $secret);

        $this->assertInstanceOf('Game\Player', $player);

        $this->assertEquals($cards, $player->getCards());
        $this->assertEquals($other, $player->getOther());
        $this->assertEquals($secret, $player->getSecret());
    }

    public function test_getName(){
        foreach ($this->name as $item){
            $player = new Game\Player($item, $this->cards, $this->other, $this->secret);
            $this->assertEquals($item,$player->getName());
        }

    }

    public function test_getLowerCaseName(){
        foreach ($this->name as $item){
            $player = new Game\Player($item,$this->cards, $this->other, $this->secret);
            $string = strtolower($item);
            $this->assertEquals($string,$player->getLowerCaseName());
        }

    }

    public function test_getLocation(){
        $array = array(0,0);

        $player = new Game\Player($this->name,$this->cards, $this->other, $this->secret);

        $this->assertEquals($array,$player->getLocation());
    }

    public function test_getPosition(){
        $player = new Game\Player("Owen",$this->cards, $this->other, $this->secret);
        $array = array(0,14);
        $this->assertEquals($array,$player->getPosition());
        $player = new Game\Player("McCullen",$this->cards, $this->other, $this->secret);
        $array = array(0,9);
        $this->assertEquals($array,$player->getPosition());
        $player = new Game\Player("Onsay",$this->cards, $this->other, $this->secret);
        $array = array(17,0);
        $this->assertEquals($array,$player->getPosition());
        $player = new Game\Player("Enbody",$this->cards, $this->other, $this->secret);
        $array = array(24,7);
        $this->assertEquals($array,$player->getPosition());
        $player = new Game\Player("Plum",$this->cards, $this->other, $this->secret);
        $array = array(19,23);
        $this->assertEquals($array,$player->getPosition());
        $player = new Game\Player("Day",$this->cards, $this->other, $this->secret);
        $array = array(7,23);
        $this->assertEquals($array,$player->getPosition());
    }

    public function test_isGuilty(){
        $player = new Game\Player($this->name,$this->cards, $this->other, $this->secret);
        $this->assertFalse($player->isGuilty());
    }

    public function test_getCards(){
        $player = new Game\Player($this->name,$this->cards, $this->other, $this->secret);
        $this->assertEquals($this->cards,$player->getCards());
    }

    public function test_getOther(){
        $player = new Game\Player($this->name,$this->cards, $this->other, $this->secret);
        $this->assertEquals($this->other,$player->getOther());
    }

    public function test_getSecret(){
        $player = new Game\Player($this->name,$this->cards, $this->other, $this->secret);
        $this->assertEquals($this->secret,$player->getSecret());
    }

    public function test_setCards(){
        $player = new Game\Player($this->name,$this->cards, $this->other, $this->secret);
        $player->setCards("final");
        $this->assertEquals("final",$player->getCards());
    }

    public function test_setOther(){
        $player = new Game\Player($this->name,$this->cards, $this->other, $this->secret);
        $player->setOther("wharton");
        $this->assertEquals("wharton",$player->getOther());
    }

    public function test_setSecret(){
        $player = new Game\Player($this->name,$this->cards, $this->other, $this->secret);
        $player->setSecret("eyeball");
        $this->assertEquals("eyeball",$player->getSecret());
    }

    public function test_setLocation(){
        $player = new Game\Player($this->name,$this->cards, $this->other, $this->secret);
        $player->setLocation(0);
        $this->assertEquals("0",$player->getLocation());
    }

    public function test_setPosition(){
        $player = new Game\Player("Owen",$this->cards, $this->other, $this->secret);
        $player->setPosition([0,14]);
        $this->assertEquals([0,14],$player->getPosition());

    }

    public function test_haslost(){
        $player = new Game\Player($this->name,$this->cards, $this->other, $this->secret);
        $this->assertFalse($player->isLost());
    }

    public function test_isLost(){
        $player = new Game\Player($this->name,$this->cards, $this->other, $this->secret);
        $this->assertFalse($player->isLost());
    }

    public function test_contain(){
        $other = array("wharton", "stadium", "breslin", "enbody", "plum", "day",
            "programming", "written", "project", "union", "engineering", "onsay",
            "quiz", "mccullen", "midterm");
        foreach ($other as $item){
            $this->assertContains($item,$this->other);
        }
    }

    public function test_secret(){
        $player = new \Game\Player($this->name,$this->cards, $this->other, $this->secret);
        $this->assertContains($player->secret($this->secret),$this->secret);
    }
}