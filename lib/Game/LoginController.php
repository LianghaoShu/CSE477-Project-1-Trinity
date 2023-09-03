<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/31/2019
 * Time: 1:17 PM
 */

namespace Game;


class LoginController
{
    /**
     * LoginController constructor.
     * @param Site $site The Site object
     * @param array $session $_SESSION
     * @param array $post $_POST
     */
    public function __construct(Site $site, array &$session, array $post) {
        // Create a Users object to access the table
        $root = $site->getRoot();

        $users = new Users($site);

        $email = strip_tags($post['email']);
        $password = strip_tags($post['password']);
        $user = $users->login($email, $password);
        $session[User::SESSION_NAME] = $user;
       // $session['username'] = $user->getName();


        if($user === null) {
            // Login failed
            $this->redirect = "$root?e";
            $session["CredentialError"] = "Invalid login credentials";
        } else {
                $id = $user->getId();
                $this->redirect = "$root/newgame.php?uid=$id";
        }
    }

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }	// Page we will redirect the user to.


    private $redirect;

}