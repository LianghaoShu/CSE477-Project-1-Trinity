<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-03-31
 * Time: 09:22
 */

namespace Game;


class UserView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     * @param Site $site The Site object
     */
    public function __construct(Site $site, Array $get, $user) {
        $this->site = $site;
        $this->current_user = $user;

        $this->addLink("users.php", "Users");
        $this->addLink("login.php", "log out");
        if (isset($get['i'])){
            $users = new Users($this->site);
            $this->user = $users->get($get['i']);
            $this->id = $get['i'];
            $this->edit = True;
        }
    }

    /**
     * Present the users form
     * @return string HTML
     */
    public function present() {
        if ($this->edit){
            $this->email = $this->user->getEmail();

            $this->name =  $this->user->getName();
        }
        $html = <<<HTML
        <form method="post" action="post/user.php">
HTML;


        $html .= <<<HTML
	<fieldset>
		<legend>User</legend>
		<p>
			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" placeholder="Email" value="$this->email">
		</p>
		<p>
			<label for="name">Name</label><br>
			<input type="text" id="name" name="name" placeholder="Name" value="$this->name">
		</p>

		<p>
			<input type="submit" value="OK"> <input type="submit" name= "cancel" value="Cancel">
		</p>

	</fieldset>
HTML;
        if ($this->edit){
            $html.=<<<HTML
 <input type="hidden" name="user" value="$this->id">
HTML;
        }

        $html.=<<<HTML
</form>

	<p>
	Every Login User has access to editing and adding accounts
	</p>

HTML;


        return $html;
    }


    private $site;
    private $user;
    private $email;
    private $name;
    private $id;
    private $edit = False;
    private $current_user;


}