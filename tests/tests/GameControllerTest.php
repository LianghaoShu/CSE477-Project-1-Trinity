<?php
/**
 * Created by PhpStorm.
 * User: Ze Liu
 * Date: 2/25/2019
 * Time: 19:52
 */
use Game\GameController as Controller;
use Game\Game as Game;

class GameControllerTest extends \PHPUnit\Framework\TestCase
{
    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new \Game\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

    public function test_contruct(){
        $Game = new Game();
        $controller = new \Game\GameController($Game,self::$site,[] );
        $this->assertInstanceOf('Game\GameController',$controller);
    }

    public function test_checkChoice(){
        $game = new Game();
        $player1 = new \Game\Player("Owen",0,0,0);
        $player2 = new \Game\Player("MeCullen",0,0,0);
        $game->setPlayers([$player1,$player2]);
        $controller = new Controller($game,self::$site,[]);
        $this->assertEquals(0,$game->getCurrentPlayerIdx());
        $controller->check_choices(['choice'=>'pass']);
        $this->assertEquals(1,$game->getCurrentPlayerIdx());


    }
}