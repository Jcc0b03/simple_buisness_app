<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/form_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Logowanie</title>
</head>
<body>
    <form method="post" action="#" class="login-form">
        <div class="back-button"><i class="fas fa-arrow-left"></i></div>
        <div class="login-form-header"><p>Zaloguj się na swoje konto</p></div>
        
        <div class="login-form-content">
            <div class="input-container">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Login" name="login" class="login-form-input" required>
            </div>
            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Hasło" name="password" class="login-form-input" required>
            </div>
            <input type="submit" value="Zaloguj się" class="login-form-button" name="submit">
        </div>
    </form>
    <?php
        if(isset($_POST["submit"])){
            $login = $_POST["login"];
            $password = $_POST["password"];

            $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");

            if(mysqli_connect_errno()==0){
                $login = mysqli_real_escape_string($db, $login);
                $password = mysqli_real_escape_string($db, $password);
                $password = sha1($password);

                $uprawnienia = 0;
                $ID_pracownika = 0;
                $imie = "";
                $id=null;

                $sql = "SELECT * FROM uzytkownicy WHERE login='$login' AND haslo='$password'";
                $query = mysqli_query($db, $sql);

                while($wiersz=mysqli_fetch_array($query)){
                    $uprawnienia = $wiersz["uprawnienia"];
                    $ID_pracownika = $wiersz["ID_pracownika"];
                    $user_id = $wiersz['ID_uzytkownika'];
                }

                $sql="SELECT * FROM pracownicy WHERE ID_pracownika='$ID_pracownika'";
                $query = mysqli_query($db, $sql);
                while($wiersz=mysqli_fetch_array($query)){
                    $imie = $wiersz["imie"];
                    $id = $wiersz["ID_pracownika"];
                }

                mysqli_close($db);

                switch($uprawnienia){
                    case 1:
                        $_SESSION["uprawnienia"]=1;
                        $_SESSION["imie"]=$imie;
                        $_SESSION["id"] = $id;
                        $_SESSION["user-id"] = $user_id;
                        header("Location: admin_panel.php");
                        break;
                    case 2:
                        $_SESSION["uprawnienia"]=2;
                        $_SESSION["imie"]=$imie;
                        $_SESSION["id"]=$id;
                        $_SESSION["user-id"] = $user_id;
                        header("Location: user_panel.php");
                        break;
                    default:
                        echo "<div id='zle-dane'>Błędne dane!</div>";
                        break;
                }
            }else{
                echo "<div id='zle-dane'>Błąd mysql</div>";
            }
        }
    ?>
</body>
</html>