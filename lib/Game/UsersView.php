<?php
/**
 * Created by PhpStorm.
 * User: Ze Liu
 * Date: 3/30/2019
 * Time: 19:33
 */

namespace Game;


class UsersView extends View
{
    private $site;
    public function __construct(Site $site)
    {
        $this->site = $site;
        $this->addLink("login.php","Log out");
    }

    public function present(){
        $html =<<<HTML
<form class="table" method="post" action="post/users.php">
    <p>
    <input type="submit" name="add" id="add" value="Add">
    <input type="submit" name="edit" id="edit" value="Edit">
    <input type="submit" name="delete" id="delete" value="Delete">
</p>
<table>
        <tr>
            <th>&nbsp</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
HTML;
        $users = new Users($this->site);
        $usersList = $users->getUsers();
        foreach ($usersList as $u) {
            $id = $u->getId();
            $name = $u->getName();
            $email = $u->getEmail();

            $html.= <<<HTML
        <tr>
            <td><input type="radio" name="user" value="$id"></td>
            <td>$name</td>
            <td>$email</td>
        </tr>
HTML;
        }
        $html .= <<<HTML
    </table>
</form>
HTML;
    return $html;
    }
}