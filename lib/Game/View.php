<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-03-31
 * Time: 09:22
 */

namespace Game;


class View
{
    /**
     * Create the HTML for the page footer
     * @return string HTML for the standard page footer
     */
    public function footer()
    {
        $html =<<<HTML

HTML;

        return $html;
    }


    /**
     * Create the HTML for the contents of the head tag
     * @return string HTML for the page head
     */
    public function head() {
        return <<<HTML
        <meta charset="utf-8">
<title>$this->title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lib/murder.css">

HTML;
    }

    /**
     * Create the HTML for the page header
     * @return string HTML for the standard page header
     */
    public function header() {
        $html = <<<HTML
        
        
HTML;
        return $html;
    }

    public function push_support($key){
        $push_key = $key;
        $html = <<<HTML
<script>
    /**
     * Initialize monitoring for a server push command.
     * @param key Key we will receive.
     */
    function pushInit(key) {
        var conn = new WebSocket('ws://webdev.cse.msu.edu/ws');
        conn.onopen = function (e) {
            console.log("Connection to push established!");
            conn.send(key);
        };

        conn.onmessage = function (e) {
            try {
                var msg = JSON.parse(e.data);
                if (msg.cmd === "reload") {
                    location.reload();
                }
            } catch (e) {
            }
        };
    }
    console.log("$push_key")

    pushInit("$push_key");
</script>
HTML;
        return $html;

    }

    /**
     * Set the page title
     * @param $title New page title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Add a link that will appear on the nav bar
     * @param $href What to link to
     * @param $text
     */
    public function addLink($href, $text) {
        $this->links[] = ["href" => $href, "text" => $text];
    }

    /**
     * Override in derived class to add content to the header.
     * @return string Any additional comment to put in the header
     */
    protected function headerAdditional() {
        return '';
    }

    /**
     * Protect a page for user only access
     *
     * If access is denied, call getProtectRedirect
     * for the redirect page
     * @param $site The Site object
     * @param $user The current User object
     * @return bool true if page is accessible
     */
    public function protect($site, $user) {
        if($user == Null) {
            $this->protectRedirect = $site->getRoot() . "/";
            return False;
        }
        return True;
    }

    /**
     * @return string
     */
    public function getProtectRedirect()
    {
        return $this->protectRedirect;
    }



    private $title = "";	// The page title
    private $links = [];	// Links to add to the nav bar
    private $protectRedirect = "";




}