<?php
/**
 * Created by PhpStorm.
 * User: Ze Liu
 * Date: 3/30/2019
 * Time: 20:12
 */

namespace Game;


class UsersController
{

    public function __construct(Site $site, $user, array $post)
    {
        $root = $site->getRoot();
        $this->redirect ="$root/user.php";

        if(isset($post['user']) and isset($post['edit'])){
            $this->redirect = "$root/user.php?i=".$post['user'];
            return;
        }

        if(isset($post['user'] ) and isset($post['delete'])){
            $users = new Users($site);
            $users->delete($post['user']);
            $this->redirect = "$root/users.php";
            return;

        }
    }


    private $redirect;

    /**
     * @return mixed
     */
    public function getRedirect( )
    {
        return $this->redirect;
    }
}