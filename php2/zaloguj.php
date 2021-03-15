<?php

    session_start();

    if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
{
    header('Location: index.php');
    exit();
}

    require_once "connect.php";

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);
    if($connection->connect_errno!=0)
    {
        echo "Error: ".$connection->connect_errno;
    }
    else
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");

        if ($result = @$connection->query(
            sprintf("SELECT * FROM uzytkownicy WHERE user='%s'",
            mysqli_real_escape_string($connection,$login))))
        {
            $how_many_users = $result->num_rows;
            if ($how_many_users>0)
            {
                $wiersz = $result->fetch_assoc();

                if (password_verify($password, $wiersz['pass']))
                {
                    $_SESSION['zalogowany'] = true;
                    $_SESSION['id'] = $wiersz['id'];
                    $_SESSION['user'] = $wiersz['user'];
                    $_SESSION['drewno'] = $wiersz['drewno'];
                    $_SESSION['kamien'] = $wiersz['kamien'];
                    $_SESSION['zboze'] = $wiersz['zboze'];
                    $_SESSION['email'] = $wiersz['email'];
                    $_SESSION['dnipremium'] = $wiersz['dnipremium'];

                    unset($_SESSION['blad']);
                    $result->free_result();
                    header('location: gra.php');
                } else
                {
                    $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                    echo $wiersz['pass'];
                    header('Location: index.php');
                }

            } else {
                $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                header('Location: index.php');
            }
        }

        $connection->close();

    }


?>