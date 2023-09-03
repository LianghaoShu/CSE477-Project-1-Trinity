<?php
require __DIR__ . '/lib/game.inc.php';
$view = new Game\LoginView($site,$_SESSION, $_GET);
?>
<!doctype html>
<html lang="en">
<head>
<!--    <title>Welcome</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link href="lib/murder.css" type="text/css" rel="stylesheet" />-->
    <?php echo $view->head()?>
</head>
<body>

<!--<form id="login" method="post" action="post/login.php">
    <fieldset >
        <legend>Login</legend>
        <p>
            <label for="email" >Email</label><br>
            <input type="email" id="email" name="email" placeholder="Email">
        </p>
        <p>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" placeholder="Password">
        </p>
        <p>
            <input type="submit" value="Log in"> <a href="">Lost Password</a>
        </p>
    </fieldset>-->
<?php echo $view->presentForm()?>

</body>



</html>