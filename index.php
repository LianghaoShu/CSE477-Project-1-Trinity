<?php
require __DIR__ . '/lib/game.inc.php';
$view = new Game\LoginView($site,$_SESSION, $_GET);
?>
<!doctype html>
<html lang="en">
<head>
    <!--<title>Welcome</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link href="lib/murder.css" type="text/css" rel="stylesheet" />-->
    <?php echo $view->head();?>
</head>
<body>
<?php
echo $view->presentForm();
?>



</body>



</html>