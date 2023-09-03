<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-02-14
 * Time: 17:41
 */

class CardsTest extends \PHPUnit\Framework\TestCase
{
    public function test_construct()
    {
        $card1 = new Game\Card("Dr. Owen", Game\Card::SUSPECT);
        $card2 = new Game\Card("Engineering", Game\Card::ROOM);
        $card3 = new Game\Card("Project", Game\Card::WEAPON);
        $card = array(($card1), ($card2), ($card3));
        $cards = new Game\Cards($card);
        $this->assertInstanceOf('Game\Cards', $cards);
        $this->assertEquals($card, $cards->getCards());
    }


}