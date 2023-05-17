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
        <div class="back-button" onclick="document.location='projekty.php'"><i class="fas fa-arrow-left"></i></div>
        <div class="header"><p>Dodaj dane klienta do bazy danych</p></div>
        <form action="#" method="POST">
            <div class="input-container"><label>Zespół: <select class="input-select" name="zespol">
                <?php
                    $sql_zespoly = "SELECT * FROM zespoly";
                    $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                    if(mysqli_connect_errno()==0){
                        $query = mysqli_query($db, $sql_zespoly);
                        while($wiersz=mysqli_fetch_array($query)){
                            $id = $wiersz['ID_zespolu'];
                            echo "<option value='$id'>$id</option>";
                        }
                    }
                ?>
            </select></label></div>
            <div class="input-container"><label>Klient: <select class="input-select" name="klient">
                <?php
                    $sql_klienci = "SELECT * FROM klienci";
                    $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                    if(mysqli_connect_errno()==0){
                        $query = mysqli_query($db, $sql_klienci);
                        while($wiersz=mysqli_fetch_array($query)){
                            $id = $wiersz['ID_klienta'];
                            $message = $id." - ".$wiersz['imie']." ".$wiersz['nazwisko'];
                            echo "<option value='$id'>$message</option>";
                        }
                        mysqli_close($db);
                    }
                ?>
            </select></label></div>
            <div class="input-container"><label>Nazwa projektu: <input type="text" class="input-text" name="nazwa" require></label></div>
            <div class="input-container"><label>Czy graficzny: <input type="checkbox" class="input-checkbox" name="graficzny" require></label></div>
            <div class="input-container"><label>Ilość podstron: <input type="number" class="input-text" name="podstrony" require></label></div>
            <div class="input-container"><label>Czy CMS: <input type="checkbox" class="input-checkbox" name="CMS" require></label></div>
            <div class="input-container"><label>Czy ekspresowy: <input type="checkbox" class="input-checkbox" name="ekspres" require></label></div>
            <div class="input-container"><label>Czy optymalizacja SEO: <input type="checkbox" class="input-checkbox" name="SEO"require></label></div>
            <div class="input-container"><label>Termin: <input type="date" class="input-text" name="termin" require></label></div>
            <div class="input-container"><input type="submit" value="Dodaj" class="input-button" name="submit" require></div>
        </form>
    </div>

    <?php
        if(isset($_POST["submit"])){
            
            $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
            if(mysqli_connect_errno()==0){
                $zespol = mysqli_real_escape_string($db, $_POST['zespol']);
                $klient = mysqli_real_escape_string($db, $_POST['klient']);
                $nazwa = mysqli_real_escape_string($db, $_POST['nazwa']);
                $graficzny = mysqli_real_escape_string($db, $_POST['graficzny']);
                if($graficzny){$graficzny=1;}else{$graficzny=0;}
                $podstrony = mysqli_real_escape_string($db, $_POST['podstrony']);
                $CMS = mysqli_real_escape_string($db, $_POST['CMS']);
                if($CMS){$CMS=1;}else{$CMS=0;}
                $ekspres = mysqli_real_escape_string($db, $_POST['ekspres']);
                if($ekspres){$ekspres=1;}else{$ekspres=0;}
                $SEO = mysqli_real_escape_string($db, $_POST['SEO']);
                if($SEO){$SEO=1;}else{$SEO=0;}
                $termin = mysqli_real_escape_string($db, $_POST['termin']);

                $sql = "INSERT INTO `projekty`(`ID_projektu`, `ID_zespolu`, `ID_klienta`, `nazwa_projektu`, `graficzny`, `ilosc_podstron`, `CMS`, `ekspres`, `opt_SEO`, `termin`, `zakonczony`) VALUES (null,$zespol,$klient,'$nazwa',$graficzny,'$podstrony',$CMS,$ekspres,$SEO,'$termin', 0)";
                if($db->query($sql)){
                    echo "Dane wprowadzone prawidłowo";
                }else{
                    echo "Wystąpił błąd";
                }
            }else{
                echo "Błąd połączenia z bazą danych";
            }
            mysqli_close($db);
        }
    ?>
</body>
</html>