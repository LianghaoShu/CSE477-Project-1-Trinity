<?php
/**
 * Created by PhpStorm.
 * User: NickJones
 * Date: 2/19/2019
 * Time: 6:11 PM
 */

class ShowCardsViewTest extends \PHPUnit\Framework\TestCase
{
    public function test_construct() {
        $cards = array("final", "international", "library", "beaumont", "museum", "owen");
        $other = array("wharton", "stadium", "breslin", "enbody", "plum", "day",
            "programming", "written", "project", "union", "engineering", "onsay",
            "quiz", "mccullen", "midterm");
        $secret = array("eyeball", "maraca", "violin",
            "rum", "coconut", "kitchen", "flamingo", "robin",
            "duck", "menagerie", "lounge", "earlobe", "radio",
            "tomato", "couscous");

        $player = new Game\Player("Prof. Owen", $cards, $other, $secret);
        $view = new Game\ShowCardsView($player, $_POST);

        $this->assertInstanceOf('Game\ShowCardsView', $view);
    }

    public function test_presentHand(){
        $cards = array("final", "international", "library", "beaumont", "museum", "owen");
        $other = array("wharton", "stadium", "breslin", "enbody", "plum", "day",
            "programming", "written", "project", "union", "engineering", "onsay",
            "quiz", "mccullen", "midterm");
        $secret = array("eyeball", "maraca", "violin",
            "rum", "coconut", "kitchen", "flamingo", "robin",
            "duck", "menagerie", "lounge", "earlobe", "radio",
            "tomato", "couscous");

        $player = new Game\Player("Prof. Owen", $cards, $other, $secret);
        $view = new Game\ShowCardsView($player, $_POST);

        $status = $view->presentHand();
        $this->assertContains("final", $status);
        $this->assertContains("international", $status);
        $this->assertContains("library", $status);
        $this->assertContains("beaumont", $status);
        $this->assertContains("museum", $status);
        $this->assertContains("owen", $status);

        $this->assertNotContains("wharton", $status);
        $this->assertNotContains("stadium", $status);
        $this->assertNotContains("breslin", $status);
        $this->assertNotContains("enbody", $status);
        $this->assertNotContains("plum", $status);
        $this->assertNotContains("day", $status);
        $this->assertNotContains("programming", $status);
        $this->assertNotContains("written", $status);
        $this->assertNotContains("project", $status);
        $this->assertNotContains("union", $status);
        $this->assertNotContains("engineering", $status);
        $this->assertNotContains("onsay", $status);
        $this->assertNotContains("quiz", $status);
        $this->assertNotContains("mccullen", $status);
        $this->assertNotContains("midterm", $status);
    }

    public function test_presentOther(){
        $cards = array("final", "international", "library", "beaumont", "museum", "owen");
        $other = array("wharton", "stadium", "breslin", "enbody", "plum", "day",
            "programming", "written", "project", "union", "engineering", "onsay",
            "quiz", "mccullen", "midterm");
        $secret = array("eyeball", "maraca", "violin",
            "rum", "coconut", "kitchen", "flamingo", "robin",
            "duck", "menagerie", "lounge", "earlobe", "radio",
            "tomato", "couscous");

        $player = new Game\Player("Prof. Owen", $cards, $other, $secret);
        $view = new Game\ShowCardsView($player, $_POST);

        $status = $view->presentOther();

        $this->assertContains("wharton", $status);
        $this->assertContains("stadium", $status);
        $this->assertContains("breslin", $status);
        $this->assertContains("enbody", $status);
        $this->assertContains("plum", $status);
        $this->assertContains("day", $status);
        $this->assertContains("programming", $status);
        $this->assertContains("written", $status);
        $this->assertContains("project", $status);
        $this->assertContains("union", $status);
        $this->assertContains("engineering", $status);
        $this->assertContains("onsay", $status);
        $this->assertContains("quiz", $status);
        $this->assertContains("mccullen", $status);
        $this->assertContains("midterm", $status);

        $this->assertNotContains("final", $status);
        $this->assertNotContains("international", $status);
        $this->assertNotContains("library", $status);
        $this->assertNotContains("beaumont", $status);
        $this->assertNotContains("museum", $status);
        $this->assertNotContains("owen", $status);


        $this->assertContains("eyeball", $status);
        $this->assertContains("maraca", $status);
        $this->assertContains("violin", $status);
        $this->assertContains("rum", $status);
        $this->assertContains("coconut", $status);
        $this->assertContains("kitchen", $status);
        $this->assertContains("flamingo", $status);
        $this->assertContains("robin", $status);
        $this->assertContains("duck", $status);
        $this->assertContains("menagerie", $status);
        $this->assertContains("lounge", $status);
        $this->assertContains("radio", $status);
        $this->assertContains("earlobe", $status);
        $this->assertContains("tomato", $status);
        $this->assertContains("couscous", $status);
    }

    public function test_nextPlayer(){
        $game = new Game\Game();
        $game->setPlayers(array(new Game\Player("Owen", array(), array(), array()), new Game\Player("McCullen", array(), array(), array())));
        $this->assertEquals(0,$game->getCurrentPlayerIdx());
        $game->nextTurn();
        $this->assertEquals(1,$game->getCurrentPlayerIdx());

    }

    public function test_presentPlayer(){
        $game = new Game\Game();
        $game->setPlayers("Owen");
        $this->assertEquals("Owen",$game->getPlayers());
        $game->setPlayers("McCullen");
        $this->assertEquals("McCullen",$game->getPlayers());
    }
}