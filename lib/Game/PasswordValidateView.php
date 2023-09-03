<?php
/**
 * Created by PhpStorm.
 * User: NickJones
 * Date: 3/30/2019
 * Time: 6:01 PM
 */

namespace Game;


class PasswordValidateView extends View
{
    static $EMAIL_DID_NOT_MATCH = 'Email address does not match validator';
    static $INVALID_VALIDATOR = 'Invalid or unavailable validator';
    static $NOT_VALID_USER = 'Email address is not for a valid user';
    static $PASSWORD_TOO_SHORT = 'Password too short';
    static $PASSWORD_DID_NOT_MATCH = 'Passwords did not match';
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct(Site $site, array $get) {
        $this->site = $site;
        $this->validator = strip_tags($get['v']);
        if(isset($get['e'])){
            $this->message = strip_tags($get['e']);
        }
        $this->setTitle("Password Validate");
    }

    public function present() {
        $html = <<<HTML
<form action="post/validate.php" method="post">
<input type="hidden" name="validator" value="$this->validator">
	<fieldset>
		<legend>Set Password</legend>
		<p>
			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" placeholder="Email">
		</p>
		<p>
			<label for="password">Password</label><br>
			<input type="password" id="password" name="password" placeholder="Password">
		</p>
		<p>
			<label for="password">Password Again</label><br>
			<input type="password" id="password" name="password2" placeholder="Password">
		</p>
		<p>
			<input type="submit" value="Log in"> <a href="">Lost Password</a>
		</p>
		<p><a href="./">Who Murdered My Grade II?</a></p>
		
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


    private $validator;
    private $site;	///< The Site object
    private $message;

}