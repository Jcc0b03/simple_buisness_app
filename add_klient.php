<?php
    session_start();
    if($_SESSION["uprawnienia"]!=1&&$_SESSION["uprawnienia"]!=2){
        header("Location: logowanie.php");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="static/form_add_del.css" rel="stylesheet">

    <title>Dodaj</title>
</head>
<body>
    <div class="content-container">
        <div class="back-button" onclick="document.location='klienci.php'"><i class="fas fa-arrow-left"></i></div>
        <div class="header"><p>Dodaj dane klienta do bazy danych</p></div>
        <form action="#" method="POST">
            <div class="input-container"><label>Imię: <input type="text" class="input-text" name="imie" require></label></div>
            <div class="input-container"><label>Nazwisko: <input type="text" class="input-text" name="nazwisko" require></label></div>
            <div class="input-container"><label>Miejscowość: <input type="text" class="input-text" name="miejscowosc" require></label></div>
            <div class="input-container"><label>Kod pocztowy: <input type="text" class="input-text" name="kod_pocztowy" require></label></div>
            <div class="input-container"><label>Ulica: <input type="text" class="input-text" name="ulica" require></label></div>
            <div class="input-container"><label>Nr domu: <input type="text" class="input-text" name="nr_domu" require></label></div>
            <div class="input-container"><label>Nr telefonu: <input type="text" class="input-text" name="nr_telefonu" require></label></div>
            <div class="input-container"><input type="submit" value="Dodaj" class="input-button" name="submit" require></div>
        </form>
    </div>

    <?php
        if(isset($_POST["submit"])){
            $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");

            if(mysqli_connect_errno()==0){
                $imie = mysqli_real_escape_string($db, $_POST['imie']);
                $nazwisko = mysqli_real_escape_string($db, $_POST['nazwisko']);
                $miejscowosc = mysqli_real_escape_string($db, $_POST['miejscowosc']);
                $kod_pocztowy = mysqli_real_escape_string($db, $_POST['kod_pocztowy']);
                $ulica = mysqli_real_escape_string($db, $_POST['ulica']);
                $nr_domu = mysqli_real_escape_string($db, $_POST['nr_domu']);
                $nr_telefonu = mysqli_real_escape_string($db, $_POST['nr_telefonu']);
                $sql = "INSERT INTO `klienci`(`ID_klienta`, `nazwisko`, `imie`, `miejscowosc`, `kod_pocztowy`, `ulica`, `nr_domu`, `nr_telefonu`) VALUES (NULL,'$nazwisko','$imie','$miejscowosc','$kod_pocztowy','$ulica','$nr_domu','$nr_telefonu')";
                if($db->query($sql)){
                    echo "Dane wprowadzone prawidłowo";
                }else{
                    echo "Wystąpił błąd ".$db->error;
                }
            }else{
                echo "Błąd połączenia z bazą danych";
            }
            mysqli_close($db);
        }
    ?>
</body>
</html>