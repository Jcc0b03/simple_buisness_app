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

    <title>Modyfikuj</title>
</head>
<body>
    <div class="content-container">
        <div class="back-button" onclick="document.location='projekty.php'"><i class="fas fa-arrow-left"></i></div>
        <div class="header"><p>Zmodyfikuj dane projektu</p></div>
        <form action="#" method="POST">
            <div class="input-container"><label>Zespół: <input type="checkbox" class="input-checkbox" name="zespol"><select class="input-select" name="zespol">
                <?php
                    $sql_zespoly = "SELECT * FROM zespoly";
                    $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                    if(mysqli_connect_errno()==0){
                        $query = mysqli_query($db, $sql_zespoly);
                        while($wiersz=mysqli_fetch_array($query)){
                            $id = $wiersz['ID_zespolu'];
                            echo "<option value='$id'>$id</option>";
                        }
                        mysqli_close($db);
                    }
                ?>
            </select></label></div>
            <div class="input-container"><label>Klient: <input type="checkbox" class="input-checkbox" name="klient"><select class="input-select" name="klient">
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
            <div class="input-container"><label>Nazwa projektu: <input type="checkbox" class="input-checkbox" name="nazwa-checkbox"><input type="text" class="input-text" name="nazwa"></label></div>
            <div class="input-container"><label><input type="checkbox" class="input-checkbox" name="graficzny-checkbox">Czy graficzny: <input type="checkbox" class="input-checkbox" name="graficzny"></label></div>
            <div class="input-container"><label>Ilość podstron: <input type="checkbox" class="input-checkbox" name="podstrony-checkbox"><input type="number" class="input-text" name="podstrony"></label></div>
            <div class="input-container"><label><input type="checkbox" class="input-checkbox" name="nazwa-checkbox">Czy CMS:<input type="checkbox" class="input-checkbox" name="CMS"></label></div>
            <div class="input-container"><label><input type="checkbox" class="input-checkbox" name="ekspres-checkbox">Czy ekspresowy: <input type="checkbox" class="input-checkbox" name="ekspres"></label></div>
            <div class="input-container"><label><input type="checkbox" class="input-checkbox" name="SEO-checkbox">Czy optymalizacja SEO: <input type="checkbox" class="input-checkbox" name="SEO"></label></div>
            <div class="input-container"><label>Termin: <input type="checkbox" class="input-checkbox" name="termin-checkbox"><input type="date" class="input-text" name="termin"></label></div>
            <div class="input-container"><label><input type="checkbox" class="input-checkbox" name="zakonczony-checkbox">Czy zakończony: <input type="checkbox" class="input-checkbox" name="zakonczony"></label></div>
            <div class="input-container"><input type="submit" value="Modyfikuj" class="input-button" name="submit"></div>
        </form>
    </div>

    <?php
        if(isset($_POST["submit"])){
            $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
            
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
            $zakonczony = mysqli_real_escape_string($db, $_POST['zakonczony']);
            if($zakonczony){$zakonczony=1;}else{$zakonczony=0;}

            $id=$_GET['id'];

            error_reporting(E_ALL ^ E_WARNING);

            if(mysqli_connect_errno()==0){
                $sql = "UPDATE projekty SET";
                if($_POST['zespol-checkbox']){$sql=$sql." ID_zespolu='$zespol'";if($_POST['klient-checkbox']||$_POST['nazwa-checkbox']||$_POST['graficzny-checkbox']||$_POST['podstrony-checkbox']||$_POST['CMS-checkbox']||$_POST['ekspres-checkbox']||$_POST['SEO-checkbox']||$_POST['termin-checkbox']){$sql=$sql.",";}}
                if($_POST['klient-checkbox']){$sql=$sql." ID_klienta='$klient'";if($_POST['nazwa-checkbox']||$_POST['graficzny-checkbox']||$_POST['podstrony-checkbox']||$_POST['CMS-checkbox']||$_POST['ekspres-checkbox']||$_POST['SEO-checkbox']||$_POST['termin-checkbox']){$sql=$sql.",";}}
                if($_POST['nazwa-checkbox']){$sql=$sql." nazwa_projektu='$nazwa'";if($_POST['graficzny-checkbox']||$_POST['podstrony-checkbox']||$_POST['CMS-checkbox']||$_POST['ekspres-checkbox']||$_POST['SEO-checkbox']||$_POST['termin-checkbox']){$sql=$sql.",";}}
                if($_POST['graficzny-checkbox']){$sql=$sql." graficzny='$graficzny'";if($_POST['podstrony-checkbox']||$_POST['CMS-checkbox']||$_POST['ekspres-checkbox']||$_POST['SEO-checkbox']||$_POST['termin-checkbox']){$sql=$sql.",";}}
                if($_POST['podstrony-checkbox']){$sql=$sql." ilosc_podstron='$podstrony'";if($_POST['CMS-checkbox']||$_POST['ekspres-checkbox']||$_POST['SEO-checkbox']||$_POST['termin-checkbox']){$sql=$sql.",";}}
                if($_POST['CMS-checkbox']){$sql=$sql." CMS='$CMS'";if($_POST['ekspres-checkbox']||$_POST['SEO-checkbox']||$_POST['termin-checkbox']){$sql=$sql.",";}}
                if($_POST['ekspres-checkbox']){$sql=$sql." ekspres='$ekspres'";if($_POST['SEO-checkbox']||$_POST['termin-checkbox']){$sql=$sql.",";}}
                if($_POST['SEO-checkbox']){$sql=$sql." opt_SEO='$SEO'";if($_POST['termin-checkbox']||$_POST['zakonczony-checkbox']){$sql=$sql.",";}}
                if($_POST['termin-checkbox']){$sql=$sql." termin='$termin'";if($_POST['zakonczony-checkbox']){$sql=$sql.",";}}
                if($_POST['zakonczony-checkbox']){$sql=$sql." zakonczony='$zakonczony' ";}

                $sql=$sql."WHERE ID_projektu=$id";
                $db->query($sql);
            }
        }
    ?>
</body>
</html>