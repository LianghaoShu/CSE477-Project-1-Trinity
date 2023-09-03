<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-02-20
 * Time: 00:20
 */


use Game\ShowCardsController as Controller;
use Game\Game as Game;

class ShowCardsControllerTest extends \PHPUnit\Framework\TestCase
{
    public function testConstruct(){
        $Game = new Game();
        $Controller = new Controller($Game, []);
        $this->assertInstanceOf('Game\ShowCardsController', $Controller);
    }

    public function test_IsEnd()
    {
        $game = new Game();
        $controller = new Controller($game, []);
        $this->assertFalse($controller->IsEnd());
    }


}