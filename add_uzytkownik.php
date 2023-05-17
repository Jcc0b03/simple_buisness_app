<?php
    session_start();
    if($_SESSION["uprawnienia"]==2){
        header("Location: user_panel.php");
    }elseif($_SESSION["uprawnienia"]!=1){
        header("location: logowanie.php");
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
        <div class="back-button" onclick="document.location='uzytkownicy.php'"><i class="fas fa-arrow-left"></i></div>
        <div class="header"><p>Dodaj dane użytkownika do bazy danych</p></div>
        <form action="#" method="POST">
            <div class="input-container"><label>Pracownik: <select class="input-select" name="pracownik">
                <?php
                    $sql_pracownicy = "SELECT * FROM pracownicy";
                    $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                    if(mysqli_connect_errno()==0){
                        $query = mysqli_query($db, $sql_pracownicy);
                        echo "<option value='null'>-</option>";
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
            <div class="input-container"><label>Login: <input type="text" class="input-text" name="login" require></label></div>
            <div class="input-container"><label>Hasło: <input type="password" class="input-text" name="password" require></label></div>
            <div class="input-container"><label>Uprawnienia: <select class="input-select" name="uprawnienia" require>
                <option value="2">Użytkownik</option>
                <option value="1">Administrator</option>
            </select></label></div>
            <div class="input-container"><input type="submit" value="Dodaj" class="input-button" name="submit"></div>
        </form>
    </div>

    <?php
        if(isset($_POST["submit"])){
            
            $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
            if(mysqli_connect_errno()==0){
                $pracownik = mysqli_real_escape_string($db, $_POST['pracownik']);
                $login = mysqli_real_escape_string($db, $_POST['login']);
                $password = mysqli_real_escape_string($db, $_POST['password']);
                $password = sha1($password);
                $uprawnienia=mysqli_real_escape_string($db, $_POST['uprawnienia']);

                $sql = "INSERT INTO `uzytkownicy`(`ID_uzytkownika`, `ID_pracownika`, `login`, `haslo`, `uprawnienia`) VALUES (null,'$pracownik','$login','$password','$uprawnienia')";
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