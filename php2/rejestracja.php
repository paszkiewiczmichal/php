<?php

session_start();

if (isset($_POST['email']))
{
    //udana walidacja? załóżmy że tak
    $wszystko_OK = true;

    //Sprawdź poprawność nickname
    $nick = $_POST['nick'];

    // Sprawdzenei długości nicka
    if (strlen($nick)<3 || (strlen($nick)>20))
    {
        $wszystko_OK = false;
        $_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków";
    }

    if ($wszystko_OK==true)
    {
        //testy zaliczone, dodajemy gracza
        echo "Udana walidacja";
        exit();
    }

}

?>

    <!DOCTYPE HTML>
    <html lang="pl">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Osadnicy - załóż darmowe konto</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        .error
        {
            color: red;
            margin-top: 10px;
            margin-bottom: 10px;
        }


    </style>

</head>
<body>

    <form method="post">

        Nickname: <br /><input type="text" name="nick" /><br />

        <?php

        if (isset($_SESSION['e_nick']))
        {
            echo '<div class="error">'.$_SESSION['e_nick'.'</div>';
            unset($_SESSION['e_nick']);
        }

        ?>

        E-mail: <br /><input type="text" name="email" /><br />
        Hasło: <br /><input type="password" name="password1" /><br />
        Powtórz hasło: <br /><input type="password" name="password2" /><br />
        <label>
          <input type="checkbox" name="regulamin" /> Akceptuje regulamin
        </label>

        <div class="g-recaptcha" data-sitekey="6LeLPn8aAAAAALDjpvDB117Q44XHskvhH2ih0MJ2"></div>
        <br />
        <input type="submit" value="Zarejestruj się">


    </form>

</body>
    </html>
