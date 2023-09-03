<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-02-24
 * Time: 20:33
 */

use Game\Game as Game;
use Game\WelcomeController as Controller;
use Game\Board as Board;

class GameTest extends \PHPUnit\Framework\TestCase
{
    public function test_Consruct(){
        $game = new Game();
        $this->assertInstanceOf('Game\Game', $game);
        //$this->assertEquals($game->getMode(), Game::DICE);
    }

    public function test_setgetcountPlayers(){
        $game = new Game();
        $cards = array();
        $othercards = array();
        $secret = array();
        $player1 = new \Game\Player("Owen",$cards,$othercards,$secret);
        $player2 = new \Game\Player("Enbody",$cards,$othercards,$secret);
        $players = array($player1,$player2);
        $game->setPlayers($players);
        $this->assertEquals($players,$game->getPlayers());
        $this->assertEquals(2,$game->getPlayerCount());


    }

    public function test_setgetMurderWeapon(){
        $game = new Game();
        $game->setMurderWeapon("Knife");
        $this->assertEquals("Knife", $game->getMurderWeapon());
    }

    public function test_setgetMurder(){
        $game = new Game();
        $game->setMurderer("Owen");
        $this->assertEquals("Owen", $game->getMurderer());
    }

    public function test_setgetMurdererLocation(){
        $game = new Game();
        $game->setMurderLocation("Main Library");
        $this->assertEquals("Main Library", $game->getMurderLocation());
    }


    public function test_getMode(){
        $game = new Game();
        $this->assertEquals(6, $game->getMode());
    }

    public function test_setgetPlayers(){
        $game = new Game();
        $game->setPlayers(array("Owen", "onSay"));
        $this->assertEquals(array("Owen", "onSay"), $game->getPlayers());
    }


    public function test_setgetCurrentPlayerIndx(){
        $game = new Game();
        $game->setCurrentPlayerIdx(1);
        $this->assertEquals(1,$game->getCurrentPlayerIdx());
    }

    public function test_getCurrentPlayer(){
        $game = new Game();
        $player1 = new \Game\Player("Owen", 0,0,0);
        $player2 = new \Game\Player("Day",0,0,0);
        $game->setPlayers(array($player1,$player2));
        $game->setCurrentPlayerIdx(1);
        $this->assertEquals("Day", $game->getCurrentPlayer());

    }

    public function test_getPlayerStatus(){
        $game = new Game();
        $player1 = new \Game\Player("Owen", 0,0,0);
        $player1->haslost();
        $game->setPlayers(array($player1));
        $this->assertEquals(true, $game->getPlayerStatus());
    }

    public function test_getBoard(){
        $game = new Game();
        $board= new \Game\Board();
        $this->assertEquals($board, $game->getBoard());
    }

    public function test_getsetInx(){
        $game = new \Game\Game();
        $game->setIdx(1);
        $this->assertEquals(1, $game->getIdx());
    }

    public function test_getStartandstart(){
        $game = new Game();
        $this->assertEquals(false, $game->getStart());
        $game->Start();
        $this->assertEquals(true, $game->getStart());
    }

    public function test_nextTurn(){
        $game = new \Game\Game();
        $player1 = new \Game\Player("Owen", 0,0,0);
        $player2 = new \Game\Player("Day",0,0,0);
        $game->setPlayers(array($player1, $player2));
        $game->nextTurn();
        $this->assertEquals(6, $game->getMode());
    }

    public function test_suggest(){
        $game = new \Game\Game();
        $player1 = new \Game\Player("Owen", 0,0,0);
        $player2 = new \Game\Player("Day",0,0,0);
        $game->setPlayers(array($player1, $player2));
        $game->suggest();
        $this->assertEquals(1, $game->getMode());
    }

    public function test_accuse(){
        $game = new \Game\Game();
        $player1 = new \Game\Player("Owen", 0,0,0);
        $player2 = new \Game\Player("Day",0,0,0);
        $game->setPlayers(array($player1, $player2));
        $game->accuse();
        $this->assertEquals(2, $game->getMode());
    }

    public function test_setSuspect(){
        $game = new \Game\Game();
        $game->setSuspect("Owen");
        $this->assertEquals(3, $game->getMode());
    }

    public function test_won(){
        $game = new \Game\Game();
        $this->assertEquals(false, $game->won());
    }

    public function test_hint_accuse (){
        $game = new Game();
        $controller = new Controller($game,['Owen'=> 1,'McCullen'=>2,"Enbody"=>3], $cheat = True);
        $this->assertContains('owen', $game->getMurderer());
        $this->assertEquals(0,$game->getCurrentPlayerIdx());
        $game->suggest();
        $game->movetoRoom(Board::INTERNATIONAL);
        $game->setSuspect('owen');
        $game->setWeapon('final');
        $this->assertContains('I got nothing',  $game->hint());
        $game->accuse();
        $game->setWeapon('midterm');
        $this->assertEquals(Game::LOST, $game->getMode());
        $game->nextTurn();
        $game->movetoRoom(Board::INTERNATIONAL);
        $this->assertEquals(1,$game->getCurrentPlayerIdx());
        $game->accuse();
        $game->setSuspect('owen');
        $game->setWeapon('final');
        $this->assertEquals($game->get_GuessName(), $game->getMurderer());
        $this->assertEquals($game->get_GuessWeapon(), $game->getMurderWeapon());
        $this->assertEquals($game->getPlayerRoom(), Board::INTERNATIONAL);
        $this->assertEquals($game->get_GuesLocation(), Board::INTERNATIONAL);
        $this->assertEquals($game->cord_to_room(Board::INTERNATIONAL), 'international');

        $this->assertEquals($game->getMode(), Game::WON);


    }
}