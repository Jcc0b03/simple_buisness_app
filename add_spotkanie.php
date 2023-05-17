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
        <div class="back-button" onclick="document.location='spotkania.php'"><i class="fas fa-arrow-left"></i></div>
        <div class="header"><p>Dodaj dane spotkania do bazy danych</p></div>
        <form action="#" method="POST">
            <div class="input-container"><label>Pracownik: <select class="input-select" name="pracownik">
                <?php
                    $sql_pracownicy = "SELECT * FROM pracownicy";
                    $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                    if(mysqli_connect_errno()==0){
                        $query = mysqli_query($db, $sql_pracownicy);
                        while($wiersz=mysqli_fetch_array($query)){
                            $id = $wiersz['ID_pracownika'];
                            $imie = $wiersz['imie'];
                            $nazwisko = $wiersz['nazwisko'];
                            $message = $id." - ".$imie." ".$nazwisko;
                            echo "<option value='$id'>$message</option>";
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
            <div class="input-container"><label>Data i godzina: <input type="datetime-local" class="input-text" name="data-godzina" require></label></div>
            <div class="input-container"><input type="submit" value="Dodaj" class="input-button" name="submit"></div>
        </form>
    </div>

    <?php
        if(isset($_POST["submit"])){
            
            $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
            if(mysqli_connect_errno()==0){
                $pracownik = mysqli_real_escape_string($db, $_POST['pracownik']);
                $klient = mysqli_real_escape_string($db, $_POST['klient']);
                $data_godzina = mysqli_real_escape_string($db, $_POST['data-godzina']);

                $sql = "INSERT INTO `spotkania`(`ID_spotkania`, `ID_klienta`, `ID_pracownika`, `data_godzina`) VALUES (null,'$klient','$pracownik','$data_godzina')";
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