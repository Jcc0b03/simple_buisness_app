<?php
    session_start();
    if($_SESSION['uprawnienia']!=1&&$_SESSION['uprawnienia']!=2){
        header("location: logowanie.php");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/form_add_del.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Zmień hasło</title>
</head>
<body>
<div class="content-container">
        <div class='back-button' onclick="document.location='admin_panel.php'"><i class='fas fa-arrow-left'></i></div>
        <div class="header"><p>Zmień hasło do swojego konta</p></div>
        <form action="#" method="POST">
            <div class="input-container"><label>Stare hasło: <input type="password" class="input-text" name="stare-haslo"></label></div>
            <div class="input-container"><label>Nowe hasło: <input type="password" class="input-text" name="nowe-haslo"></label></div>
            <div class="input-container"><input type="submit" value="Zmień hasło" class="input-button" name="submit"></div>
        </form>
    </div>
    <?php
        if(isset($_POST['submit'])){
            if($_SESSION['user-id']!=null){
                $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                if(mysqli_connect_errno()==0){
                    $stare_haslo = mysqli_real_escape_string($db, $_POST['stare-haslo']);
                    $stare_haslo = sha1($stare_haslo);
                    $nowe_haslo = mysqli_real_escape_string($db, $_POST['nowe-haslo']);

                    $user_id = $_SESSION['user-id'];

                    if(strlen($nowe_haslo)>=8){
                        $nowe_haslo = sha1($nowe_haslo);
                        $sql_stare_haslo = "SELECT haslo FROM uzytkownicy WHERE ID_uzytkownika='$user_id'";
                        $prawdziwe_stare_haslo = '';
                        $query = mysqli_query($db, $sql_stare_haslo);
                        while($wiersz=mysqli_fetch_array($query)){
                            $prawdziwe_stare_haslo = $wiersz['haslo'];
                        }

                        $sql_zmien_haslo = "UPDATE uzytkownicy SET haslo='$nowe_haslo' WHERE ID_uzytkownika='$user_id'";
                        if($prawdziwe_stare_haslo==$stare_haslo){
                            if($db->query($sql_zmien_haslo)){
                                echo "Hasło zmienione prawidłowo";
                            }else{
                                echo "Wystąpił błąd ".$db->error;
                            }
                        }else{
                            echo "Hasła są niezgodne";
                        }
                    }else{echo "Nowe hasło jest za krótkie!";}
                    $db->close();
                }else{
                    echo "Błąd połączenia z bazą danych";
                }
            }
        }
    ?>
</body>
</html>