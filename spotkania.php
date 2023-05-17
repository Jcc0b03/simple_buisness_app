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
    <link rel="stylesheet" type="text/css" href="static/pracownicy.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Spotkania</title>
</head>
<body>
    <a href="admin_panel.php"><div class="back-button"><i class="fas fa-arrow-left"></i></div></a>
    <div class="header"><div class="header-text">Spotkania</div></div>
    <div class="nav"><button onclick="document.location='add_spotkanie.php'">Dodaj</button><button onclick="document.location='del_spotkanie.php'">Usuń</button></div>
    <div class="table-container">
        <table>
            <tr class="table-header"><td>ID</td><td>Klient</td><td>Pracownik</td><td>Termin</td></tr>
            <?php
                $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                $sql = "SELECT * FROM spotkania";
                if(mysqli_connect_errno()==0){
                    $query = mysqli_query($db, $sql);
                    while($wiersz=mysqli_fetch_array($query)){
                        $id_spotkania = $wiersz['ID_spotkania'];
                        $id_klienta = $wiersz['ID_klienta'];
                        $id_pracownika = $wiersz['ID_pracownika'];
                        $termin = $wiersz['data_godzina'];

                        $sql_klienci = "SELECT * FROM klienci WHERE ID_klienta='$id_klienta'";
                        $query_klienci = mysqli_query($db, $sql_klienci);
                        $message_klienci = "";
                        while($wiersz_klienci = mysqli_fetch_array($query_klienci)){
                            $imie = $wiersz_klienci['imie'];
                            $nazwisko = $wiersz_klienci['nazwisko'];

                            $message_klienci = $imie." ".$nazwisko;
                        }

                        $sql_pracownicy = "SELECT * FROM pracownicy WHERE ID_pracownika='$id_pracownika'";
                        $query_pracownicy = mysqli_query($db, $sql_pracownicy);
                        $message_pracownicy = "";
                        while($wiersz_pracownicy = mysqli_fetch_array($query_pracownicy)){
                            $imie = $wiersz_pracownicy['imie'];
                            $nazwisko = $wiersz_pracownicy['nazwisko'];

                            $message_pracownicy = $imie." ".$nazwisko;
                        }

                        echo "<tr class='table-row' id='$id_spotkania' onclick='redirect_mod(this.id)'><td>$id_spotkania</td><td>$message_klienci</td><td>$message_pracownicy</td><td>$termin</td></tr>";
                    }
                }
                mysqli_close($db);
            ?>
        </table>
    </div>
    <script>
        function redirect_mod(id){
            document.location = "mod_spotkanie.php?id="+id;
        }
    </script>
</body>
</html>