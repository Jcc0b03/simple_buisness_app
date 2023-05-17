<?php
    session_start();
    if($_SESSION["uprawnienia"]==2){
        header("Location: user_panel.php");
    }elseif($_SESSION["uprawnienia"]!=1){
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

    <title>Modyfikuj</title>
</head>
<body>
    <div class="content-container">
        <div class="back-button" onclick="document.location='zespoly_admin.php'"><i class="fas fa-arrow-left"></i></div>
        <div class="header"><p>Zmodyfikuj dane pracownika</p></div>
        <form action="#" method="POST">
            <div class="input-container"><label>Imię: <input type="checkbox" class="input-checkbox" name="chk-imie"><input type="text" class="input-text" name="imie"></label></div>
            <div class="input-container"><label>Nazwisko: <input type="checkbox" class="input-checkbox" name="chk-nazwisko"><input type="text" class="input-text" name="nazwisko"></label></div>
            <div class="input-container"><label>Numer PESEL: <input type="checkbox" class="input-checkbox" name="chk-PESEL"><input type="text" class="input-text" name="PESEL"></label></div>
            <div class="input-container"><label>Miejscowość: <input type="checkbox" class="input-checkbox" name="chk-miejscowosc"><input type="text" class="input-text" name="miejscowosc"></label></div>
            <div class="input-container"><label>Kod pocztowy: <input type="checkbox" class="input-checkbox" name="chk-kod_pocztowy"><input type="text" class="input-text" name="kod_pocztowy"></label></div>
            <div class="input-container"><label>Ulica: <input type="checkbox" class="input-checkbox" name="chk-ulica"><input type="text" class="input-text" name="ulica"></label></div>
            <div class="input-container"><label>Nr domu: <input type="checkbox" class="input-checkbox" name="chk-nr_domu"><input type="text" class="input-text" name="nr_domu"></label></div>
            <div class="input-container"><label>Nr telefonu: <input type="checkbox" class="input-checkbox" name="chk-nr_telefonu"><input type="text" class="input-text" name="nr_telefonu"></label></div>
            <div class="input-container"><label>Zespół: <input type="checkbox" class="input-checkbox" name="chk-ID_zespolu"><select class="input-select" name="ID_zespolu">
                <?php
                    $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                    $sql = "SELECT * from zespoly";
                    if(mysqli_connect_errno()==0){
                        $query = mysqli_query($db, $sql);
                        while($wiersz=mysqli_fetch_array($query)){
                            $id = $wiersz['ID_zespolu'];
                            echo "<option value='$id'>$id</option>";
                        }

                        mysqli_close($db);
                    }
                ?>
            </select></label></div>
            <div class="input-container"><input type="submit" value="Zmodyfikuj" class="input-button" name="submit"></div>
        </form>
    </div>

    <?php
        if($_GET["id"]!=null){
            if(isset($_POST["submit"])){
                $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");

                $imie = mysqli_real_escape_string($db, $_POST['imie']);
                $nazwisko = mysqli_real_escape_string($db, $_POST['nazwisko']);
                $PESEL = mysqli_real_escape_string($db, $_POST['PESEL']);
                $miejscowosc = mysqli_real_escape_string($db, $_POST['miejscowosc']);
                $kod_pocztowy = mysqli_real_escape_string($db, $_POST['kod_pocztowy']);
                $ulica = mysqli_real_escape_string($db, $_POST['ulica']);
                $nr_domu = mysqli_real_escape_string($db, $_POST['nr_domu']);
                $nr_telefonu = mysqli_real_escape_string($db, $_POST['nr_telefonu']);
                $zespol = mysqli_real_escape_string($db, $_POST['ID_zespolu']);

                $id = $_GET["id"];

                error_reporting(E_ALL ^ E_WARNING);

                $sql="UPDATE pracownicy SET";
                if($_POST["chk-imie"]){$sql=$sql." imie='$imie'"; if($_POST['chk-nazwisko']||$_POST['chk-PESEL']||$_POST['chk-miejscowosc']||$_POST['chk-kod_pocztowy']||$_POST['chk-ulica']||$_POST['chk-nr_domu']||$_POST['chk-nr_telefonu']||$_POST['chk-ID_zespolu']){$sql=$sql.",";}}
                if($_POST["chk-nazwisko"]){$sql=$sql." nazwisko='$nazwisko'"; if($_POST['chk-PESEL']||$_POST['chk-miejscowosc']||$_POST['chk-kod_pocztowy']||$_POST['chk-ulica']||$_POST['chk-nr_domu']||$_POST['chk-nr_telefonu']||$_POST['chk-ID_zespolu']){$sql=$sql.",";}}
                if($_POST["chk-PESEL"]){$sql=$sql." PESEL='$PESEL'"; if($_POST['chk-miejscowosc']||$_POST['chk-kod_pocztowy']||$_POST['chk-ulica']||$_POST['chk-nr_domu']||$_POST['chk-nr_telefonu']||$_POST['chk-ID_zespolu']){$sql=$sql.",";}}
                if($_POST["chk-miejscowosc"]){$sql=$sql." miejscowosc='$miejscowosc'"; if($_POST['chk-kod_pocztowy']||$_POST['chk-ulica']||$_POST['chk-nr_domu']||$_POST['chk-nr_telefonu']||$_POST['chk-ID_zespolu']){$sql=$sql.",";}}
                if($_POST["chk-kod_pocztowy"]){$sql=$sql." kod_pocztowy='$kod_pocztowy'"; if($_POST['chk-ulica']||$_POST['chk-nr_domu']||$_POST['chk-nr_telefonu']||$_POST['chk-ID_zespolu']){$sql=$sql.",";}}
                if($_POST["chk-ulica"]){$sql=$sql." ulica='$ulica'"; if($_POST['chk-nr_domu']||$_POST['chk-nr_telefonu']||$_POST['chk-ID_zespolu']){$sql=$sql.",";}}
                if($_POST["chk-nr_domu"]){$sql=$sql." nr_domu='$nr_domu'"; if($_POST['chk-nr_telefonu']||$_POST['chk-ID_zespolu']){$sql=$sql.",";}}
                if($_POST["chk-nr_telefonu"]){$sql=$sql." nr_telefonu='$nr_telefonu'"; if($_POST['chk-ID_zespolu']){$sql=$sql.",";}}
                if($_POST["chk-ID_zespolu"]){$sql=$sql." ID_zespolu='$zespol'";}

                $sql=$sql." WHERE ID_pracownika='$id'";

                $db->query($sql);
                mysqli_close($db);
            }
        }else{
            header("location: pracownicy.php");
        }
    ?>
</body>
</html>