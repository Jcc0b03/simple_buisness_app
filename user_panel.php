<?php
    session_start();
    if($_SESSION["uprawnienia"]==1){
        header("Location: admin_panel.php");
    }elseif($_SESSION["uprawnienia"]!=2){
        header("Location: logowanie.php");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Panel pracownika</title>
</head>
<body>
    <div class="header">
        <div class="header-text">
            <span class="header-text-regular">Witaj w panelu pracownika</span>
            <span class="header-text-bold"><?php echo $_SESSION["imie"];?> </span><br>
            <span id="date-span">Dziś jest: </span>
            <a href="wylogowanie.php"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>
        <div class="kafelki">
            <div class="kafelek-container">
                <div class="kafelek" onclick="window.location='klienci.php';">
                    <img src="static/icons/klienci.png" alt="ikona klienci"/>
                    <p class="kafelek-header">Klienci<p>
                    <div class="icon-license"><a href="https://iconscout.com/icons/purchaser" target="_blank">Purchaser Icon</a> by <a href="https://iconscout.com/contributors/sumit-saengthong" target="_blank">Sumit Saengthong</a></div>
                </div>
                <div class="kafelek" onclick="window.location='projekty.php';">
                    <img src="static/icons/projekty.png" alt="ikona projekty"/>
                    <p class="kafelek-header">Projekty<p>
                    <div class="icon-license"><a href="https://iconscout.com/icons/project-designing" target="_blank">Project Designing Icon</a> by <a href="https://iconscout.com/contributors/komkrit-noenpoempisut" target="_blank">itim2101</a></div>
                </div>
                <div class="kafelek" onclick="window.location='zespoly_user.php';">
                    <img src="static/icons/zespoly.png" alt="ikona zespoly"/>
                    <p class="kafelek-header">Zespoły<p>
                    <div class="icon-license"><a href="https://iconscout.com/icons/business-hierarchy" target="_blank">Business Hierarchy Icon</a> by <a href="https://iconscout.com/contributors/Popcorn-Arts" target="_blank">Popcorn Arts</a></div>
                </div>
                <div class="kafelek" onclick="window.location='spotkania.php';">
                    <img src="static/icons/spotkania.png" alt="ikona spotkania"/>
                    <p class="kafelek-header">Spotkania<p>
                    <div class="icon-license"><a href="https://iconscout.com/icons/meeting" target="_blank">Meeting Icon</a> by <a href="https://iconscout.com/contributors/iconscout" target="_blank">Iconscout Store</a></div>
                </div></a>
                <div class="kafelek" onclick="window.location='chg-password.php';">
                    <img src="static/icons/key.png" alt="ikona klucza"/>
                    <p class="kafelek-header">Zmień hasło<p>
                    <div class="icon-license"><a href="https://iconscout.com/icons/key" target="_blank">Key Icon</a> on <a href="https://iconscout.com">Iconscout</a></div>
                </div></a>
                <div class="kafelek" id="kafelek-wylogowywanie" onclick="window.location='wylogowanie';"><i class="fas fa-sign-out-alt"></i></div>
            </div>
        </div>
    <script src="static/data.js" type="text/javascript"></script>
</body>
</html>