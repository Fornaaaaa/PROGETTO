<?php
    //COLLEGAMENTO DATABASE
    $servername="localhost";
    $username="root";
    $password="admin";
    $dbname="tris";
    //CREO CONNESSIONE
    
    $conn=new mysqli($servername, $username, $password, $dbname);







    $sql1 = "SELECT vincitore FROM partite WHERE id=1";
    $result1 = $conn->query($sql1);
    $row1= $result1->fetch_assoc();
    $r1=$row1["vincitore"];

    $sql2 = "SELECT vincitore FROM partite WHERE id=2";
    $result2 = $conn->query($sql2);
    $row2= $result2->fetch_assoc();
    $r2=$row2["vincitore"];

    $sql3 = "SELECT vincitore FROM partite WHERE id=3";
    $result3 = $conn->query($sql3);
    $row3= $result3->fetch_assoc();
    $r3=$row3["vincitore"];

    $sql4 = "SELECT vincitore FROM partite WHERE id=4";
    $result4 = $conn->query($sql4);
    $row4= $result4->fetch_assoc();
    $r4=$row4["vincitore"];

    $sql5 = "SELECT vincitore FROM partite WHERE id=5";
    $result5 = $conn->query($sql5);
    $row5= $result5->fetch_assoc();
    $r5=$row5["vincitore"];
?>





<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>..::CRONOLOGIA PARTITE::..</title>
        <link rel="stylesheet" href="css/cronologia_css.css">
    </head>
    <body>
        <div>
            <h1>CRONOLOGIA PARTITE</h1>
        </div>
        <div>
            <table>
                <tr>
                    <td><h1>NUMERO PARTITA</h1></td>
                    <td><h1>VINCITORE</h1></td>
                </tr>
                <tr>
                    <td><h1>1</h1> <p>partita più recente</p></td>
                    <td onclick=" window.location.href='replay.php?partita=5'"><?php echo  "<h1>".$r5."</h1>"?></td>
                </tr>
                <tr>
                    <td><h1>2</h1></td>
                    <td onclick=" window.location.href='replay.php?partita=4'"><?php echo  "<h1>".$r4."</h1>"?></td>
                </tr>
                <tr>
                    <td><h1>3</h1></td>
                    <td onclick=" window.location.href='replay.php?partita=3'"><?php echo  "<h1>".$r3."</h1>"?></td>
                </tr>
                <tr>
                    <td><h1>4</h1></td>
                    <td onclick=" window.location.href='replay.php?partita=2'"><?php echo  "<h1>".$r2."</h1>"?></td>
                </tr>
                <tr>
                    <td><h1>5</h1> <p>partita meno recente</p></td>
                    <td onclick=" window.location.href='replay.php?partita=1'"> <?php echo  "<h1>".$r1."</h1>"?></td>
                </tr>
            </table>  
        </div>
        
        <div id="newgame">
            <input type="button" name="rep" value="TORNA AL GIUOCO" id="reset" onclick=" window.location.href='tris.php'">
        </div>
        
    </body>
</html>
