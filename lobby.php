<?php
/**
 * Created by PhpStorm.
 * User: NickJones
 * Date: 4/7/2019
 * Time: 12:58 PM
 */
require __DIR__ . '/lib/game.inc.php';
$view = new Game\LobbyView($site, $user);
echo '<pre>';
    print_r($game->getId());
    //var_dump($_SESSION);
echo '</pre>';
if ($view->isRedirect()){
    header("location: " . $view->getRedirect());
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
<?php echo $view->head()?>
</head>
<?php echo $view->pushScript() ?>
<body>
<?php
echo $view->header();
echo $view->present();
?>
</body>
</html>