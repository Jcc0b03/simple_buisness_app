<?php
    session_start();
    if($_SESSION['uprawnienia'==2]){
        header("location: user-panel.php");
    }elseif($_SESSION['uprawnienia']!=1){
        header("location: logowanie.php");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/form_add_del.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Członkowie zespołu</title>
</head>
<body>
    <div class="content-container">
    <div class="back-button" onclick="document.location='zespoly_admin.php'"><i class="fas fa-arrow-left"></i></div>
        <div class="header"><p>Członkowie zespołu <?php echo $_GET['id']; ?></p></div>
        <div class="input-container"><ul>
            <?php 
                $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
                if(mysqli_connect_errno()==0){
                    $id = $_GET['id'];
                    $sql="SELECT ID_pracownika, imie, nazwisko FROM pracownicy WHERE ID_zespolu=$id";
                    $query = mysqli_query($db, $sql);
                    while($wiersz = mysqli_fetch_array($query)){
                        $ID_pracownika = $wiersz['ID_pracownika'];
                        $imie = $wiersz['imie'];
                        $nazwisko = $wiersz['nazwisko'];
                        echo "<li><a href='mod_pracownik_zespol.php?id=$ID_pracownika'>".$ID_pracownika." ".$imie." ".$nazwisko."</li>";
                    }
                }
            ?>
        </ul></div>
    </div>
</body>
</html>