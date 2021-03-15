<?php

session_start();

if (!isset($_SESSION['udanarejestracja']))
{
    header('Location: index.php');
    exit();
}else
{
    unset($_SESSION['udanarejestracja']);
}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Osadnicy - gra przeglądarkowa</title>
</head>
<body>
    Dziękujemy za rejestrację w serwisie! Mozesz się zalogować na swoje konto.

<a href="index.php.php">Zaloguj się na swoje konto!</a>
<br /><br />


<?php
if (isset($_SESSION['blad'])) {
    echo $_SESSION['blad'];
}

?>

</body>
</html>