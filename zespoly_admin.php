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
    <div class="header"><div class="header-text">Zespoły</div></div>
    <div class="nav"><button onclick="document.location='add_zespol.php'">Dodaj</button><button onclick="document.location='del_zespol.php'">Usuń</button></div>
    <div class="table-container">
        <table>
            <tr class="table-header"><td>ID</td></tr>
            <?php
                $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                $sql = "SELECT * FROM zespoly";
                if(mysqli_connect_errno()==0){
                    $query = mysqli_query($db, $sql);
                    while($wiersz = mysqli_fetch_array($query)){
                        $id_zespolu = $wiersz['ID_zespolu'];
                        echo "<tr class='table-row', id='$id_zespolu' onClick='redirect_mod(this.id)'><td>$id_zespolu</td></tr>";
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