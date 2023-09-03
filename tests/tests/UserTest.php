<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/18/2019
 * Time: 1:40 PM
 */

class UserTest extends \PHPUnit\Framework\TestCase
{
    public function test_construct() {
        $row = array('id' => 12,
            'email' => 'dude@ranch.com',
            'name' => 'Dude, The',
            'password' => '12345678',
            'joined' => '2015-01-15 23:50:26',
        );
        $user = new Game\User($row);
        $this->assertEquals(12, $user->getId());
        $this->assertEquals('dude@ranch.com', $user->getEmail());
        $this->assertEquals(strtotime('2015-01-15 23:50:26'),
            $user->getJoined());
    }
}