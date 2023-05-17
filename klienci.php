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
    <title>Klienci</title>
</head>
<body>
    <a href="admin_panel.php"><div class="back-button"><i class="fas fa-arrow-left"></i></div></a>
    <div class="header"><div class="header-text">Klienci</div></div>
    <div class="nav"><button onclick="document.location='add_klient.php'">Dodaj</button><button onclick="document.location='del_klient.php'">Usuń</button></div>
    <div class="table-container">
        <table>
            <tr class="table-header"><td>ID</td><td>Imię</td><td>Nazwisko</td><td>Miejscowość</td><td>Kod pocztowy</td><td>Ulica</td><td>Numer domu</td><td>Numer telefonu</td></tr>
            <?php
                $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                $sql = "SELECT * FROM klienci";
                if(mysqli_connect_errno()==0){
                    $query = mysqli_query($db, $sql);
                    while($wiersz = mysqli_fetch_array($query)){
                        $id_klienta = $wiersz['ID_klienta'];
                        $nazwisko = $wiersz['nazwisko'];
                        $imie = $wiersz['imie'];
                        $miejscowosc = $wiersz['miejscowosc'];
                        $kod_pocztowy = $wiersz['kod_pocztowy'];
                        $ulica = $wiersz['ulica'];
                        $nr_domu = $wiersz['nr_domu'];
                        $nr_telefonu = $wiersz['nr_telefonu'];
                        echo "<tr class='table-row', id='$id_klienta' onClick='redirect_mod(this.id)'><td>$id_klienta</td><td>$imie</td><td>$nazwisko</td><td>$miejscowosc</td><td>$kod_pocztowy</td><td>$ulica</td><td>$nr_domu</td><td>$nr_telefonu</td></tr>";
                    }
                }
                mysqli_close($db);
            ?>
        </table>
    </div>
    <script>
        function redirect_mod(id){
            document.location = "mod_klient.php?id="+id;
        }
    </script>
</body>
</html>