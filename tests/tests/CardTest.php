<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-02-14
 * Time: 17:30
 */

class CardTest extends \PHPUnit\Framework\TestCase
{
    public function test_construct(){
        $card = new Game\Card("Dr. Owen", Game\Card::SUSPECT);
        $this->assertInstanceOf('Game\Card', $card);
    }

    public function test_getter(){
        $card = new Game\Card("Dr. Owen", Game\Card::SUSPECT);
        $this->assertContains("Dr. Owen", $card->getName());
        $this->assertEquals(Game\Card::SUSPECT, $card->getType());
    }

}