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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="static/form_add_del.css" rel="stylesheet">

    <title>Dodaj</title>
</head>
<body>
    <div class="content-container">
        <div class="back-button" onclick="document.location='zespoly_admin.php'"><i class="fas fa-arrow-left"></i></div>
        <div class="header"><p>Dodaj dane zespołu do bazy danych</p></div>
        <form action="#" method="POST">
            <div class="input-container"><label>ID zespołu: <input type="number" min="0" class="input-text" name="id_zespolu" require></label></div>
            <div class="input-container"><input type="submit" value="Dodaj" class="input-button" name="submit"></div>
        </form>
    </div>

    <?php
        if(isset($_POST["submit"])){
            $db = mysqli_connect("localhost", "root", "", "projekt_praktyki");
            
            $id = mysqli_real_escape_string($db, $_POST['id_zespolu']);

            if(mysqli_connect_errno()==0){
                $sql_check="SELECT * FROM zespoly WHERE ID_zespolu=$id";
                $query_check = mysqli_query($db, $sql_check);
                if(mysqli_num_rows($query_check)==0){
                    $sql = "INSERT INTO zespoly VALUES ($id)";
                    if($db->query($sql)){
                        echo "Dane wprowadzone prawidłowo";
                    }else{
                        echo "Wystąpił błąd";
                    }
                }else{
                    echo "ID jest używane przez inny zespół";
                }
            }else{
                echo "Błąd połączenia z bazą danych";
            }
            mysqli_close($db);
        }
    ?>
</body>
</html>