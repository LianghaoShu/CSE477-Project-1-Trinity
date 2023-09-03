<?php
require __DIR__ . '/lib/game.inc.php';
$view = new Game\NewGameView($site, $_GET, $user);
if (!$view->protect($site, $user)){
    print_r("error");
    print_r($view->getProtectRedirect());
    header("location: " . $view->getProtectRedirect());
    exit;
}
$root = $site->getRoot();
print_r($view->isRedirect());
if ($view->isRedirect()){
    print_r($view->isRedirect());
    header("location: " . $view->getRedirect());
    exit;

}


?>
<!doctype html>
<html lang="en">
<head>
    <title>New Game</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link href="lib/murder.css" type="text/css" rel="stylesheet" />
</head>
<?php
    echo $view->push_support("Trinity-1-lobby");
?>

<body>
<?php
    echo $view->present();
?>



</body>



</html>
