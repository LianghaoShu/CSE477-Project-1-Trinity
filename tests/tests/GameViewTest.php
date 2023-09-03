<?php
/**
 * Created by PhpStorm.
 * User: Lianghao Shu
 * Date: 2/19/2019
 * Time: 8:58 PM
 */

class GameViewTest extends \PHPUnit\Framework\TestCase
{
    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new \Game\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

    public function testConsruct(){
        $game = new Game\Game();
        $row = array('id' => 12,
            'email' => 'dude@ranch.com',
            'name' => 'Dude, The',
            'password' => '12345678',
            'joined' => '2015-01-15 23:50:26'
        );
        define("GAME_SESSION",'game');
        $session =[GAME_SESSION =>$game];
        $user = new \Game\User($row);
        $view = new \Game\GameView($user, $_GET,$session, self::$site, 1);
        $this->assertInstanceOf('Game\GameView', $view);
        //$this->assertEquals($game->getMode(), Game::DICE);
    }




    public function test_presentDice(){
        $game = new Game\Game();
        $num1 = $game->Dice1Num();
        $num2 = $game->Dice2Num();
        $array = array(1,2,3,4,5,6);
        $this->assertContains($num1,$array);
        $this->assertContains($num2,$array);
    }

    public function test_presentDone(){
        $game = new Game\Game();
        $row = array('id' => 12,
            'email' => 'dude@ranch.com',
            'name' => 'Dude, The',
            'password' => '12345678',
            'joined' => '2015-01-15 23:50:26'
        );
        $session =[GAME_SESSION =>$game];
        $user = new \Game\User($row);
        $view = new Game\GameView($user, $_GET,$session, self::$site, 1);
        $status = $view->presentDone();
        $this->assertContains("Prof.Owen",$status);
        $this->assertContains("Prof.McCullen",$status);
        $this->assertContains("Prof.Onsay",$status);
        $this->assertContains('Prof.Enbody',$status);
        $this->assertContains('Prof.Plum',$status);
        $this->assertContains('Prof.Day',$status);
    }

    public function test_presentWeapon(){
        $game = new Game\Game();
        $row = array('id' => 12,
            'email' => 'dude@ranch.com',
            'name' => 'Dude, The',
            'password' => '12345678',
            'joined' => '2015-01-15 23:50:26'
        );
        $session =[GAME_SESSION =>$game];
        $user = new \Game\User($row);
        $view = new Game\GameView($user, $_GET,$session, self::$site, 1);
        $status = $view->presentWeapon();
        $this->assertContains('Final Exam',$status);
        $this->assertContains('Midterm Exam',$status);
        $this->assertContains('Programming Assignment',$status);
        $this->assertContains('Project',$status);
        $this->assertContains('Written Assignment',$status);
        $this->assertContains('Quiz',$status);
    }

    public function test_presentWon(){
        $game = new Game\Game();
        $row = array('id' => 12,
            'email' => 'dude@ranch.com',
            'name' => 'Dude, The',
            'password' => '12345678',
            'joined' => '2015-01-15 23:50:26'
        );
        $session =[GAME_SESSION =>$game];
        $user = new \Game\User($row);
        $view = new Game\GameView($user, $_GET,$session, self::$site, 1);
        $status = $view->presentWon();
        $this->assertContains('You Have Won the Game',$status);
        $this->assertContains('Please click New Game on Bottom to restart',$status);
    }

    public function test_presentLost(){
        $game = new Game\Game();
        $row = array('id' => 12,
            'email' => 'dude@ranch.com',
            'name' => 'Dude, The',
            'password' => '12345678',
            'joined' => '2015-01-15 23:50:26'
        );
        $session =[GAME_SESSION =>$game];
        $user = new \Game\User($row);
        $view = new Game\GameView($user, $_GET,$session, self::$site, 1);
        $status = $view->presentLost();
        $this->assertContains('You Have Lost the Game',$status);
        $this->assertContains('You can only make suggestions now, go help your teammate win',$status);
        $this->assertContains('Press Go to go to the next player',$status);
    }


    public function testDisplayPlayer() {
        $game = new Game\Game();
        $row = array('id' => 12,
            'email' => 'dude@ranch.com',
            'name' => 'Dude, The',
            'password' => '12345678',
            'joined' => '2015-01-15 23:50:26'
        );
        $session =[GAME_SESSION =>$game];
        $user = new \Game\User($row);
        $view = new Game\GameView($user, $_GET,$session, self::$site, 1);

        $game->setPlayers([new \Game\Player("Owen", null, null, null)]);

        $player = $view->displayPlayer();

        $this->assertContains("Prof. Owen", $player);
    }

    public function testChoices() {
        $game = new Game\Game();
        $row = array('id' => 12,
            'email' => 'dude@ranch.com',
            'name' => 'Dude, The',
            'password' => '12345678',
            'joined' => '2015-01-15 23:50:26'
        );
        $session =[GAME_SESSION =>$game];
        $user = new \Game\User($row);
        $view = new Game\GameView($user, $_GET,$session, self::$site, 1);

        $game->setPlayers([new \Game\Player("Owen", null, null, null)]);
        $game->setMode(\Game\Game::INROOM);

        $middleArea = $view->buildMiddleArea();

        $this->assertContains("What do you wish to do?", $middleArea);
        $this->assertContains("Pass", $middleArea);
        $this->assertContains("Suggest", $middleArea);
        $this->assertContains("Accuse", $middleArea);
        $this->assertContains("Go", $middleArea);

        $game->getPlayers()[0]->hasLost();

        $middleArea = $view->buildMiddleArea();

        $this->assertContains("What do you wish to do?", $middleArea);
        $this->assertContains("Pass", $middleArea);
        $this->assertContains("Suggest", $middleArea);
        $this->assertContains("Can't Accuse Anymore", $middleArea);
        $this->assertContains("Go", $middleArea);
    }
}