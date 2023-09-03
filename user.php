<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-03-31
 * Time: 09:27
 */

require 'lib/game.inc.php';
$view = new Game\UserView($site, $_GET, $user);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="user">

    <?php
    echo $view->header();
    echo $view->present();
    echo $view->footer();
    ?>


</div>

</body>
</html>