<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-02-19
 * Time: 23:43
 */


use Game\WelcomeController as Controller;
use Game\Game as Game;

class WelcomeControllerTest extends \PHPUnit\Framework\TestCase
{

    public function testConstruct(){
        $Game = new Game();
        $Controller = new Controller($Game, []);
        $this->assertInstanceOf('Game\WelcomeController', $Controller);
    }
    public function testPlayers(){
        $Game = new Game();
        $Controller = new Controller($Game, ['Owen'=> 1]);
        $this->assertEquals(1, $Controller->getPlayerCount());
        $this->assertContains("Owen", $Controller->getPlayers()[0]->getName());

        $Controller = new Controller($Game,['McCullen'=>1]);
        $this->assertEquals(1,$Controller->getPlayerCount());
        $this->assertContains("McCullen",$Controller->getPlayers()[0]->getName());


        $Controller = new Controller($Game,['Onsay'=>1]);
        $this->assertEquals(1,$Controller->getPlayerCount());
        $this->assertContains("Onsay",$Controller->getPlayers()[0]->getName());

        $Controller = new Controller($Game,['Enbody'=>1]);
        $this->assertEquals(1,$Controller->getPlayerCount());
        $this->assertContains("Enbody",$Controller->getPlayers()[0]->getName());

        $Controller = new Controller($Game,['Plum'=>1]);
        $this->assertEquals(1,$Controller->getPlayerCount());
        $this->assertContains("Plum",$Controller->getPlayers()[0]->getName());

        $Controller = new Controller($Game,['Day'=>1]);
        $this->assertEquals(1,$Controller->getPlayerCount());
        $this->assertContains("Day",$Controller->getPlayers()[0]->getName());

        $Controller = new Controller($Game,['Owen'=> 1,'McCullen'=>2,"Enbody"=>3]);
        $this->assertEquals(3,$Controller->getPlayerCount());
        $this->assertContains("Owen",$Controller->getPlayers()[0]->getName());
        $this->assertContains("McCullen",$Controller->getPlayers()[1]->getName());
        $this->assertContains("Enbody",$Controller->getPlayers()[2]->getName());

    }

    public function test_new(){
        $Game = new Game();
        $Controller = new Controller($Game,[]);
        $this->assertInstanceOf('Game\WelcomeController',$Controller);
        $this->assertTrue($Controller->getRestart());
    }

    public function test_numplayer(){
        $Game = new Game();
        $Controller = new Controller($Game,['Owen']);
        $this->assertTrue($Controller->getRestart());
    }


    public function test_dealHands(){
        $game = new Game();
        $Controller = new Controller($game,['Owen'=> 1, 'McCullen' => 1, 'Onsay' =>1], True);
        $this->assertContains($game->getMurderLocation(), "international");
        $this->assertContains($game->getMurderer(), "owen");
        $this->assertContains($game->getMurderWeapon(), "final");

        $this->assertEquals(3, $Controller->getPlayerCount());
        $this->assertContains("Owen", $Controller->getPlayers()[0]->getName());

        $count = 0;

        $owen = array("library", "beaumont", "museum",
            "engineering", "union", "breslin");
        $McCullen = array("stadium", "wharton","mccullen", "onsay", "enbody","plum");
        $Onsay = array("day", "quiz", "programming", "written", "midterm", "project");
        $expect = array($owen,$McCullen,$Onsay);

        $players = $Controller->getPlayers();
        $this->assertNotEmpty($players);

        for ($i = 0; $i < 3; $i++){
            $hand = $players[$i]->getCards();
            $this->assertEquals($hand, $expect[$i]);

        }



    }
}