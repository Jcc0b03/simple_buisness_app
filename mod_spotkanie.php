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
        <div class="back-button" onclick="document.location='spotkania.php'"><i class="fas fa-arrow-left"></i></div>
        <div class="header"><p>Zmodyfikuj dane spotkania</p></div>
        <form action="#" method="POST">
            <div class="input-container"><label>Pracownik: <input type="checkbox" class="input-checkbox" name="pracownik-checkbox"><select class="input-select" name="pracownik">
                <?php
                    $sql_zespoly = "SELECT * FROM pracownicy";
                    $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                    if(mysqli_connect_errno()==0){
                        $query = mysqli_query($db, $sql_zespoly);
                        while($wiersz=mysqli_fetch_array($query)){
                            $id = $wiersz['ID_pracownika'];
                            $imie = $wiersz['imie'];
                            $nazwisko = $wiersz['nazwisko'];
                            $message = $id.' - '.$imie.' '.$nazwisko;
                            echo "<option value='$id'>$message</option>";
                        }
                        mysqli_close($db);
                    }
                ?>
            </select></label></div>
            <div class="input-container"><label>Klient: <input type="checkbox" class="input-checkbox" name="klient-checkbox"><select class="input-select" name="klient">
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
            <div class="input-container"><label>Termin: <input type="checkbox" class="input-checkbox" name="termin-checkbox"><input type="datetime-local" class="input-text" name="termin"></label></div>
            <div class="input-container"><input type="submit" value="Modyfikuj" class="input-button" name="submit"></div>
        </form>
    </div>

    <?php
        $id=$_GET['id'];
        if($id!=null){
            if(isset($_POST["submit"])){
                $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                
                $pracownik = mysqli_real_escape_string($db, $_POST['pracownik']);
                $klient = mysqli_real_escape_string($db, $_POST['klient']);
                $termin = mysqli_real_escape_string($db, $_POST['termin']);

                error_reporting(E_ALL ^ E_WARNING);

                if(mysqli_connect_errno()==0){
                    $sql = "UPDATE spotkania SET";
                    
                    if($_POST['klient-checkbox']){$sql=$sql." ID_klienta='$klient'";if($_POST['pracownik-checkbox']||$_POST['termin-checkbox']){$sql=$sql.',';}}
                    if($_POST['pracownik-checkbox']){$sql=$sql." ID_pracownika='$pracownik'";if($_POST['termin-checkbox']){$sql=$sql.',';}}
                    if($_POST['termin-checkbox']){$sql=$sql." data_godzina='$termin'";}

                    $sql=$sql."WHERE ID_spotkania=$id";
                    $db->query($sql);
                    $db->close();
                }
            }
        }else{
            header("location: spotkania.php");
        }
    ?>
</body>
</html>