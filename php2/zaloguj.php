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
        $password = htmlentities($password, ENT_QUOTES, "UTF-8");

        if ($result = @$connection->query(sprintf("SELECT * FROM uzytkownicy WHERE user='%s' AND pass='%s'",
            mysqli_real_escape_string($connection,$login), mysqli_real_escape_string($connection,$password))))
        {
            $how_many_users = $result->num_rows;
            if ($how_many_users>0)
            {
                $_SESSION['zalogowany'] = true;

                $wiersz = $result->fetch_assoc();
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

            } else {

                $_SESSION['blad'] = '<span style="color:red">Nieprasidłowy login lub hasło!</span>';
                header('Location: index.php');

            }
        }

        $connection->close();

    }


?>