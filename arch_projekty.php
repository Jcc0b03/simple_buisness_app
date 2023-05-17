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
    <title>Archiwalne projekty</title>
</head>
<body>
    <a href="projekty.php"><div class="back-button"><i class="fas fa-arrow-left"></i></div></a>
    <div class="header"><div class="header-text">Archiwalne projekty</div></div>
    <div class="table-container" style="top: 110px;">
        <table>
            <tr class="table-header"><td>ID</td><td>Zespół</td><td>Klient</td><td>Nazwa</td><td>Termin</td><td>Zakończony</td></tr>
            <?php
                $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                $sql = "SELECT * FROM projekty WHERE zakonczony=1";
                if(mysqli_connect_errno()==0){
                    $query = mysqli_query($db, $sql);
                    while($wiersz = mysqli_fetch_array($query)){
                        $id_projektu = $wiersz['ID_projektu'];
                        $zespol = $wiersz['ID_zespolu'];
                        $id_klienta = $wiersz['ID_klienta'];
                        $nazwa = $wiersz['nazwa_projektu'];
                        $termin = $wiersz['termin'];
                        $zakonczony = $wiersz['zakonczony'];
                        if($zakonczony==1){$zakonczony="Tak";}else{$zakonczony="Nie";}

                        $sql_klient = "SELECT * FROM klienci WHERE ID_klienta='$id_klienta'";
                        $query_klient = mysqli_query($db, $sql_klient);
                        $imie_nazwisko_klienta = '';
                        while($wiersz_klient=mysqli_fetch_array($query_klient)){
                            $imie_nazwisko_klienta = $wiersz_klient['imie']." ".$wiersz_klient['nazwisko'];
                        }

                        echo "<tr class='table-row', id='$id_projektu'><td>$id_projektu</td><td>$zespol</td><td>$imie_nazwisko_klienta</td><td>$nazwa</td><td>$termin</td><td>$zakonczony</td></tr>";
                    }
                }
                mysqli_close($db);
            ?>
        </table>
    </div>
    <script>
        function redirect_mod(id){
            document.location = "mod_projekt.php?id="+id;
        }
    </script>
</body>
</html>