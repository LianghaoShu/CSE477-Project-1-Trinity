<?php
/**
 * Created by PhpStorm.
 * User: NickJones
 * Date: 3/30/2019
 * Time: 6:05 PM
 */

namespace Game;


class PasswordValidateController
{
    /**
     * PasswordValidateController constructor.
     * @param Site $site The Site object
     * @param array $post $_POST
     */
    public function __construct(Site $site, array $post) {
        $root = $site->getRoot();
        $this->redirect = "$root/";

        if (isset($post['confirm'])){
            if ($post['confirm'] === 'Cancel'){
                return;
            }
        }


        //
        // 1. Ensure the validator is correct! Use it to get the user ID.
        //
        $validators = new Validators($site);
        $validator = strip_tags($post['validator']);
        $userid = $validators->get($validator);
        if($userid === null) {
            $error = PasswordValidateView::$INVALID_VALIDATOR;
            $this->redirect = "$root/password-validate.php?v=$validator&e=$error";
            return;
        }

        //
        // 2. Ensure the email matches the user.
        //
        $users = new Users($site);
        $editUser = $users->get($userid);
        if($editUser === null) {
            // User does not exist!
            $error = PasswordValidateView::$NOT_VALID_USER;
            $this->redirect = "$root/password-validate.php?v=$validator&e=$error";
            return;
        }
        $email = trim(strip_tags($post['email']));
        if($email !== $editUser->getEmail()) {
            // Email entered is invalid
            $error = PasswordValidateView::$EMAIL_DID_NOT_MATCH;
            $this->redirect = "$root/password-validate.php?v=$validator&e=$error";
            return;
        }

        //
        // 3. Ensure the passwords match each other
        //
        $password1 = trim(strip_tags($post['password']));
        $password2 = trim(strip_tags($post['password2']));
        if($password1 !== $password2) {
            $error = PasswordValidateView::$PASSWORD_DID_NOT_MATCH;
            // Passwords do not match
            $this->redirect = "$root/password-validate.php?v=$validator&e=$error";
            return;
        }

        if(strlen($password1) < 8) {
            $error = PasswordValidateView::$PASSWORD_TOO_SHORT;
            // Password too short
            $this->redirect = "$root/password-validate.php?v=$validator&e=$error";
            return;
        }

        //
        // 4. Create a salted password and save it for the user.
        //
        $users->setPassword($userid, $password1);

        //
        // 5. Destroy the validator record so it can't be used again!
        //
        $validators->remove($userid);



    }

    private $redirect;

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }
}