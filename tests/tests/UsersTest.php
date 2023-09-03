<?php
/**
 * Created by PhpStorm.
 * User: Ze Liu
 * Date: 3/31/2019
 * Time: 13:55
 */

class UsersTest extends \PHPUnit\Framework\TestCase
{
    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Game\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

    public function test_pdo() {
        $users = new Game\Users(self::$site);
        $this->assertInstanceOf('\PDO', $users->pdo());
    }

    public function test_construct() {
        $row = array('id' => 12,
            'email' => 'dude@ranch.com',
            'name' => 'Dude, The',
            'phone' => '123-456-7890',
            'address' => 'Some Address',
            'notes' => 'Some Notes',
            'password' => '12345678',
            'joined' => '2015-01-15 23:50:26',
            'role' => 'S'
        );
        $user = new Game\User($row);
        $this->assertEquals(12, $user->getId());
        $this->assertEquals('Dude, The', $user->getName());
        $this->assertEquals('dude@ranch.com', $user->getEmail());
        $this->assertEquals(strtotime('2015-01-15 23:50:26'),
            $user->getJoined());
    }
    protected function setUp() {
        $users = new Game\Users(self::$site);
        $tableName = $users->getTableName();

        $sql = <<<SQL
delete from $tableName;
insert into $tableName(id, email, name, password, joined,salt)
values (7, "dudess@dude.com", "Dudess, The", 
        "49506d29656ad62805497b221a6bedacc304ad6496997f17fb39431dd462cf48", 
        "2015-01-22 23:50:26","Nohp6^v\$m(`qm#\$o"),
        (8, "cbowen@cse.msu.edu", "Owen, Charles",
        "14831e3f21b423a557a0aa99a391a57a2400ef0fdade328890c9048ad3a8ab6a", 
        "2015-01-01 23:50:26","aeLWK6k`jzPpgZMi"),
        (9, "bart@bartman.com", "Simpson, Bart",
        "a747a49bf74523c1760f649707bf3d2b4a858f088520fd98b35def1e6929ca26", 
        "2015-02-01 01:50:26","7xNhdV-8P#\$p)1c9"),
        (10, "marge@bartman.com", "Simpson, Marge", 
        "edfc83ceca3a49aef204cee0e51eeb1728f728c56b2ea9037017230cc39ae938", 
        "2015-02-01 01:50:26", '!yhLrEo3d8vD_LNV')
SQL;

        self::$site->pdo()->query($sql);
    }


    public function test_login() {
        $users = new Game\Users(self::$site);

        // Test a valid login based on email address
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertInstanceOf('Game\User', $user);
        $this->assertEquals("dudess@dude.com", $user->getEmail());
        $this->assertEquals("Dudess, The", $user->getName());
        $this->assertEquals(strtotime('2015-01-22 23:50:26'), $user->getJoined());


        // Test a valid login based on email address
        $user = $users->login("cbowen@cse.msu.edu", "super477");
        $this->assertInstanceOf('Game\User', $user);
        $this->assertEquals("cbowen@cse.msu.edu", $user->getEmail());
        $this->assertEquals("Owen, Charles", $user->getName());
        $this->assertEquals(strtotime('2015-01-01 23:50:26'), $user->getJoined());


        // Test a failed login
        $user = $users->login("dudess@dude.com", "wrongpw");
        $this->assertNull($user);


    }

    public function test_get(){
        $users = new Game\Users(self::$site);
        $user = $users->get(7);
        $this->assertInstanceOf('Game\User', $user);
        $this->assertEquals("dudess@dude.com", $user->getEmail());
        $this->assertEquals("Dudess, The", $user->getName());
        $this->assertEquals(strtotime('2015-01-22 23:50:26'), $user->getJoined());

        $user = $users->get(8);
        $this->assertInstanceOf('Game\User', $user);
        $this->assertEquals("cbowen@cse.msu.edu", $user->getEmail());
        $this->assertEquals("Owen, Charles", $user->getName());
        $this->assertEquals(strtotime('2015-01-01 23:50:26'), $user->getJoined());


        $user = $users->get(11);
        $this->assertNull($user);
    }
}