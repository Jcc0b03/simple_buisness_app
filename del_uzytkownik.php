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
    <link rel="stylesheet", type="text/css", href="static/form_add_del.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Usuń</title>
</head>
<body>
    <div class="content-container">
        <div class="back-button" onclick="document.location='uzytkownicy.php'"><i class="fas fa-arrow-left"></i></div>
        <div class="header"><p>Usuń dane użytkownika z bazy danych</p></div>
        <form action="#" method="POST">
            <div class="input-container"><label>Użytkownik: <select class="input-select" name="ID_uzytkownika">
                <?php
                    $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                    $sql = "SELECT * from uzytkownicy";
                    if(mysqli_connect_errno()==0){
                        $query = mysqli_query($db, $sql);
                        while($wiersz=mysqli_fetch_array($query)){
                            $id = $wiersz['ID_uzytkownika'];
                            $login = $wiersz['login'];
                            $message = $id." - ".$login;
                            if($login!='admin'){
                                echo "<option value='$id'>$message</option>";
                            }
                        }
                        mysqli_close($db);
                    }
                    ?></div>
            </select></label>
            <div class="input-container"><input type="submit" value="Usuń" class="input-button" name="submit"></div>
        </form>
        <?php
            if(isset($_POST["submit"])){
                $id = $_POST["ID_uzytkownika"];

                $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                if(mysqli_connect_errno()==0){
                    $sql = "DELETE FROM uzytkownicy WHERE ID_uzytkownika='$id'";
                    $db->query($sql);
                }
                mysqli_close($db);
            }
        ?>
    </div>
</body>
</html>