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
        <div class="back-button" onclick="document.location='uzytkownicy.php'"><i class="fas fa-arrow-left"></i></div>
        <div class="header"><p>Zmodyfikuj dane użytkownika</p></div>
        <form action="#" method="POST">
        <div class="input-container"><label>Pracownik: <input type="checkbox" class="input-checkbox" name="chk-pracownik"><select class="input-select" name="pracownik">
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
            <div class="input-container"><label>Login: <input type="checkbox" class="input-checkbox" name="chk-login"><input type="text" class="input-text" name="login"></label></div>
            <div class="input-container"><label>Uprawnienia: <input type="checkbox" class="input-checkbox" name="chk-uprawnienia"><select class="input-select" name="uprawnienia">
                <option value="2">Użytkownik</option>
                <option value="1">Administrator</option>
            </select></label></div>
            <div class="input-container"><input type="submit" value="Zresetuj hasło" class="input-button" name="reset-password"></div>
            <div class="input-container"><input type="submit" value="Zmodyfikuj" class="input-button" name="submit"></div>
        </form>
    </div>

    <?php
        $id = $_GET["id"];
        if($id!=null){
            if(isset($_POST["submit"])){
                $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");

                $pracownik = mysqli_real_escape_string($db, $_POST['pracownik']);
                $login = mysqli_real_escape_string($db, $_POST['login']);
                $uprawnienia = mysqli_real_escape_string($db, $_POST['uprawnienia']);

                error_reporting(E_ALL ^ E_WARNING);


                $sql="UPDATE uzytkownicy SET";
                if($_POST["chk-pracownik"]){$sql=$sql." ID_pracownika='$pracownik'"; if($_POST['chk-login']||$_POST['chk-uprawnienia']){$sql=$sql.",";}}
                if($_POST["chk-login"]){$sql=$sql." login='$login'"; if($_POST['chk-uprawnienia']){$sql=$sql.",";}}
                if($_POST["chk-uprawnienia"]){$sql=$sql." uprawnienia='$uprawnienia'";}

                $sql=$sql." WHERE ID_uzytkownika='$id'";
                $db->query($sql);
                mysqli_close($db);
            }elseif(isset($_POST['reset-password'])){
                $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                $sql = "UPDATE uzytkownicy SET haslo='21bd12dc183f740ee76f27b78eb39c8ad972a757' WHERE ID_uzytkownika='$id'";
                if($db->query($sql)){
                    echo "Hasło zresetowanie prawidłowo";
                }else{
                    echo "Wystąpił błąd";
                }
            }
        }else{
            header("location: uzytkownicy.php");
        }
    ?>
</body>
</html>