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
    <link rel="stylesheet" type="text/css" href="static/pracownicy.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Użytkownicy</title>
</head>
<body>
    <a href="admin_panel.php"><div class="back-button"><i class="fas fa-arrow-left"></i></div></a>
    <div class="header"><div class="header-text">Użytkownicy</div></div>
    <div class="nav"><button onclick="document.location='add_uzytkownik.php'">Dodaj</button><button onclick="document.location='del_uzytkownik.php'">Usuń</button></div>
    <div class="table-container">
        <table>
            <tr class="table-header"><td>ID</td><td>Pracownik</td><td>Login</td><td>Uprawnienia</td></tr>
            <?php
                $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                $sql = "SELECT `ID_uzytkownika`, `ID_pracownika`, `login`, `uprawnienia` FROM `uzytkownicy`";
                if(mysqli_connect_errno()==0){
                    $query = mysqli_query($db, $sql);
                    while($wiersz=mysqli_fetch_array($query)){
                        $id_uzytkownika = $wiersz['ID_uzytkownika'];
                        $id_pracownika = $wiersz['ID_pracownika'];
                        $login = $wiersz['login'];
                        $uprawnienia = $wiersz['uprawnienia'];
                        if($uprawnienia==1){$uprawnienia="Administrator";}else{$uprawnienia="Użytkownik";}

                        $sql_pracownicy = "SELECT * FROM pracownicy WHERE ID_pracownika='$id_pracownika'";
                        $query_pracownicy = mysqli_query($db, $sql_pracownicy);
                        $message_pracownicy = "";
                        while($wiersz_pracownicy = mysqli_fetch_array($query_pracownicy)){
                            $imie = $wiersz_pracownicy['imie'];
                            $nazwisko = $wiersz_pracownicy['nazwisko'];

                            $message_pracownicy = $imie." ".$nazwisko;
                        }

                        echo "<tr class='table-row' id='$id_uzytkownika' onclick='redirect_mod(this.id)'><td>$id_uzytkownika</td><td>$message_pracownicy</td><td>$login</td><td>$uprawnienia</td></tr>";
                    }
                }
                mysqli_close($db);
            ?>
        </table>
    </div>
    <script>
        function redirect_mod(id){
            document.location = "mod_uzytkownik.php?id="+id;
        }
    </script>
</body>
</html>