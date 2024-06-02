<?php
    include("functions/func.inc");
    $_SESSION["id"]=$_GET["partita"];
    $id=$_SESSION["id"];
    $servername="localhost";
    $username="root";
    $password="admin";
    $dbname="tris";
    $conn=new mysqli($servername, $username, $password, $dbname);
    $query="SELECT mosse FROM partite WHERE id=$id";
    $risultato=$conn->query($query);
    $r= $risultato->fetch_assoc();
    $m=$r["mosse"];
    for($i=0; $i<=9; $i++){
        $stampamosse[$i]="";
        $_SESSION["salvamosse"][$i]="";
    }
    $_SESSION["salvamosse"]=explode(", ", $m);
    
    checkImg();
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>..::REPLAY::..</title>
        <link rel="stylesheet" href="css/replay_css.css">
    </head>
    <body>
        <div>
            <h1>REPLAY</h1> 
        </div>
        <div>
            <table border=1 frame="void">
                <tr>
                    <td><?php echo $_SESSION["stampamosse"][1]?></td>
                    <td><?php echo $_SESSION["stampamosse"][2]?></td>
                    <td><?php echo $_SESSION["stampamosse"][3]?></td>
                </tr>
                <tr>
                    <td><?php echo $_SESSION["stampamosse"][4]?></td>
                    <td><?php echo $_SESSION["stampamosse"][5]?></td>
                    <td><?php echo $_SESSION["stampamosse"][6]?></td>
                </tr>
                <tr>
                    <td><?php echo $_SESSION["stampamosse"][7]?></td>
                    <td><?php echo $_SESSION["stampamosse"][8]?></td>
                    <td><?php echo $_SESSION["stampamosse"][9]?></td>
                </tr>
            </table> 
                <div id="newgame">
                    <input type="text" name="elenco_mosse" value="<?php echo $m ?>" id="elenco_mosse" readonly>
                </div> 
        </div>
        
        <div id="newgame">
            <input type="button" name="rep" value="TORNA AL GIUOCO" id="reset" onclick=" window.location.href='tris.php'">
            <input type="button" name="cro" value="TORNA ALLA CRONOLOGIA" id="reset" onclick=" window.location.href='cronologia.php'">
        </div>
        
    </body>
</html>