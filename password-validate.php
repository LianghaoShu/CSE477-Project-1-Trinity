<?php
$open = true;
require 'lib/game.inc.php';
$view = new Game\PasswordValidateView($site, $_GET);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php echo $view->head(); ?>
</head>

<body>
<div class="password">

<?php
echo $view->header();
echo $view->present();
echo $view->footer();
?>


</div>

</body>
</html>