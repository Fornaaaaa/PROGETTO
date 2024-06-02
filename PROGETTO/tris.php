<?php
    include("functions/func.inc");
    //COLLEGAMENTO DATABASE
    $servername="localhost";
    $username="root";
    $password="admin";
    $dbname="tris";
    //CREO CONNESSIONE
    $conn=new mysqli($servername, $username, $password, $dbname);
    $win="";
    $_SESSION["contatore"]=0;
    $_SESSION["vincitore"]="";
    setSession();
    session_start();
    $croce="croce";
    $cerchio="cerchio";
    if (!isset($_SESSION["contatore"])){
        $_SESSION["contatore"]=0;
    }
    //INSERIMENTO IMMAGINI
    setImg($croce, $cerchio);
    //RESET PARTITA
    if (isset($_POST["reset"])){
        resetGame();
        if($_SESSION["contatore"]%2==0){
            echo "<script type='text/javascript'>alert('COMINCIA IL GIOCATORE 1 (CROCE)');</script>";
            $_SESSION["contatore"]=0;
        }else{
            echo "<script type='text/javascript'>alert('COMINCIA IL GIOCATORE 2 (CERCHIO)');</script>";
            $_SESSION["contatore"]=1;
        }
    }
    //CONTROLLO VITTORIA
    if ($_SESSION["contatore"]>=4){
        if ($_SESSION["contatore"]%2!=0){
            $win=winCheck(1, "CROCE");
            if ($win!=""){
                $sql1="DELETE FROM partite WHERE id=1";
                $sql2="UPDATE partite SET id=1 WHERE id=2";
                $sql3="UPDATE partite SET id=2 WHERE id=3";
                $sql4="UPDATE partite SET id=3 WHERE id=4";
                $sql5="UPDATE partite SET id=4 WHERE id=5";
                $str=implode(", ", $_SESSION["mosse"]);
                if (strpos($win, "PAREGGIO")!=0){
                    $sql6="INSERT INTO partite VALUES (5, 'pareggio', '$str')";
                }else{
                    $sql6="INSERT INTO partite VALUES (5, '$croce', '$str')";
                }
                $conn->query($sql1);
                $conn->query($sql2);
                $conn->query($sql3);
                $conn->query($sql4);
                $conn->query($sql5);
                $conn->query($sql6);
                $_SESSION["contatore"]=1;
            }
        }else{
            $win=winCheck(2, "CERCHIO");
            if ($win!=""){
                $sql1="DELETE FROM partite WHERE id=1";
                $sql2="UPDATE partite SET id=1 WHERE id=2";
                $sql3="UPDATE partite SET id=2 WHERE id=3";
                $sql4="UPDATE partite SET id=3 WHERE id=4";
                $sql5="UPDATE partite SET id=4 WHERE id=5";
                $str=implode(", ", $_SESSION["mosse"]);
                if (strpos($win, "PAREGGIO")!=0){
                    $sql6="INSERT INTO partite VALUES (5, 'pareggio', '$str')";
                }else{
                    $sql6="INSERT INTO partite VALUES (5, '$cerchio', '$str')";
                }
                $conn->query($sql1);
                $conn->query($sql2);
                $conn->query($sql3);
                $conn->query($sql4);
                $conn->query($sql5);
                $conn->query($sql6);
                $_SESSION["contatore"]=2;
            }
        }
    }
    //BLOCCO PULSANTI DOPO LA VITTORIA
    if($win!=""){
        blockAfterWin();
    }
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>TRIS</title>
        <link rel="stylesheet" href="css/tris_css.css">
    </head>
    <body>
        <embed src="audio/button.mp3" name="musica" autostart="false" loop="0" hidden="true"></embed>
        <script type="text/javascript">
            function Music(){
                document.musica.play;
            }
        </script>
        <h1><img src="images/scritta.jpg" id="scritta"></h1>
        <div>
                <?php 
                    if ($_SESSION["contatore"]!=0){
                        echo $win;
                    } 
                ?> 
        </div>
        <form name="form01" action="tris.php" method="post">
            <?php
                setMsgPosSubmit();
            ?>
            <label for="croce" id="l_croce">GIOCATORE 1</label>
            <img src="images/croce.png" name="croce" id="croce">
            <table border=1 frame="void">
                <tr>
                    <td><?php echo $_SESSION["inizio"][1], $_SESSION["msg"][1]?></td>
                    <td><?php echo $_SESSION["inizio"][2], $_SESSION["msg"][2]?></td>
                    <td><?php echo $_SESSION["inizio"][3], $_SESSION["msg"][3]?></td>
                </tr>
                <tr>
                    <td><?php echo $_SESSION["inizio"][4], $_SESSION["msg"][4]?></td>
                    <td><?php echo $_SESSION["inizio"][5], $_SESSION["msg"][5]?></td>
                    <td><?php echo $_SESSION["inizio"][6], $_SESSION["msg"][6]?></td>
                </tr>
                <tr>
                    <td><?php echo $_SESSION["inizio"][7], $_SESSION["msg"][7]?></td>
                    <td><?php echo $_SESSION["inizio"][8], $_SESSION["msg"][8]?></td>
                    <td><?php echo $_SESSION["inizio"][9], $_SESSION["msg"][9]?></td>
                </tr>
            </table>
            <label for="cerchio" id="l_cerchio">GIOCATORE 2</label>
            <img src="images/cerchio.png" name="cerchio" id="cerchio">
            <div id="newgame">
                <input type="submit" name="reset" value="NUOVA PARTITA" id="reset">
                <input type="button" name="rep" value="CRONOLOGIA PARTITE" id="reset" 
                onclick=" window.location.href='cronologia.php'">
            </div>
        </form>
    </body>
</html>