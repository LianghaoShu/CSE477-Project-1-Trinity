<?php
/**
 * Created by PhpStorm.
 * User: NickJones
 * Date: 4/4/2019
 * Time: 12:25 PM
 */

namespace Game;


/**
 * Email adapter class
 */
class Email {
    public function mail($to, $subject, $message, $headers) {
        mail($to, $subject, $message, $headers);
    }

}
