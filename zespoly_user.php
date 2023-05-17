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
    <title>Zespoły</title>
</head>
<body>
    <a href="admin_panel.php"><div class="back-button"><i class="fas fa-arrow-left"></i></div></a>
    <div class="header"><div class="header-text">Członkowie twojego zespołu</div></div>
    <div class="table-container" style="top: 120px;">
        <table>
            <tr class="table-header"><td>ID</td><td>Imie</td><td>Nazwisko</td></tr>
            <?php
                $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                if(mysqli_connect_errno()==0){
                    $id_pracownika = $_SESSION['id'];
                    $sql_id_zespolu = "SELECT ID_zespolu FROM pracownicy WHERE ID_pracownika=$id_pracownika";
                    $query = mysqli_query($db, $sql_id_zespolu);

                    $id_zespolu = null;
                    while($wiersz = mysqli_fetch_array($query)){
                        $id_zespolu = $wiersz['ID_zespolu'];
                    }

                    $sql_czlonkowie = "SELECT ID_pracownika, imie, nazwisko FROM pracownicy WHERE ID_zespolu=$id_zespolu";
                    $query = mysqli_query($db, $sql_czlonkowie);
                    while($wiersz = mysqli_fetch_array($query)){
                        $id_pracownika = $wiersz['ID_pracownika'];
                        $imie = $wiersz['imie'];
                        $nazwisko = $wiersz['nazwisko'];
                        echo "<tr class='table-row'><td>$id_pracownika</td><td>$imie</td><td>$nazwisko</td></tr>";
                    }
                }
                mysqli_close($db);
            ?>
        </table>
    </div>
    <script>
        function redirect_mod(id){
            document.location = "list_zespol.php?id="+id;
        }
    </script>
</body>
</html>