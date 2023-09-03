<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/31/2019
 * Time: 1:16 PM
 */

namespace Game;


class LoginView extends View
{
    public function __construct($site ,$session, $get)
    {
        $this->setTitle("Welcome");
        if(isset($get['e'])){
            $this->message = $session['CredentialError'];
        }
    }

    public function presentForm() {
        $html = <<<HTML
<form id="login" method="post" action="post/login.php">
    <fieldset >
        <legend>Login</legend>
        <p>
            <label for="email" >Email</label><br>
            <input type="email" id="email" name="email" placeholder="Email">
        </p>
        <p>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" placeholder="Password">
        </p>
        <p>
            <input type="submit" value="Log in"> <a href="">Lost Password</a>
            <a href="user.php">New User</a>
        </p>
    </fieldset>
HTML;

        if($this->message){
            $html.=<<<HTML
            <p class="msg">$this->message</p>
HTML;
        }

        $html.=<<<HTML
    </fieldset>
</form>
HTML;

        return $html;
    }

    private $message; //Error message
}