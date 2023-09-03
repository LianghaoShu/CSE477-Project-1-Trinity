<?php
require 'lib/game.inc.php';
$view = new Game\UsersView($site);
if (!$view->protect($site, $user)){
    print_r("error");
    print_r($view->getProtectRedirect());
    header("location: " . $view->getProtectRedirect());
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head();?>
</head>

<body>
<div class="users">
    <?php
    echo $view->header();
    echo $view->present();
    echo $view->footer();
    ?>
</div>
</body>
</html>
