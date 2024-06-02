<?php
    function setSession(){
        for($i=1; $i<=9; $i++){
            $_SESSION["inizio"][$i]="<input type='submit' name='invia$i' value='' class='submit' onClick='Music();'>";
        }
    }
    function setMsgPosSubmit(){
        for($i=1; $i<=9; $i++){
            if(!isset($_SESSION["msg"][$i])){
                $_SESSION["msg"][$i]="";
                $_SESSION["pos"][$i]=0;
            }
            if (!isset($_SESSION["inizio"][$i])){
                $_SESSION["inizio"][$i]="<input type='submit' name='invia$i' value='' class='submit' onClick='Music();'>";
            }
        }
    }
    function setImg($croce, $cerchio){
        for($i=1; $i<=9; $i++){
            if(isset($_POST["invia$i"])){
                $_SESSION["msg"][$i]=get_msg($_SESSION["contatore"], $_SESSION["msg"][$i], $croce, $cerchio, $i);
                $_SESSION["pos"][$i]=get_pos($_SESSION["contatore"], $_SESSION["msg"][$i], $_SESSION["pos"][$i], $croce, $cerchio);
                $_SESSION["contatore"]++;
                $_SESSION["inizio"][$i]="";
            }
        }
    }
    function get_msg($contatore, $msg, $croce, $cerchio, $i){
        if ($contatore%2==0){
            $msg="<img src='images/croce.png' id='i'>";
            $_SESSION["mosse"][]="x$i";
        }else{
            $msg="<img src='images/cerchio.png' id='i'>";
            $_SESSION["mosse"][]="o$i";
        }
        return $msg;
    }
    function get_pos($contatore, $msg, $pos, $croce, $cerchio){
        if ($contatore%2==0){
            $pos=strpos($msg,$croce);
        }else{
            $pos=strpos($msg,$cerchio);
            $pos++;
        }
        return $pos;
    }
    function winCheck($n, $string){
        if($_SESSION["pos"][1]==$_SESSION["pos"][2] && $_SESSION["pos"][2]==$_SESSION["pos"][3] && strlen($_SESSION["msg"][1])!==0 && strlen($_SESSION["msg"][2])!==0 && strlen($_SESSION["msg"][3])!==0){
            return "<div id='output'>HA VINTO IL GIOCATORE $n ($string)</div>";//orizzontali
        }else if($_SESSION["pos"][4]==$_SESSION["pos"][5] && $_SESSION["pos"][5]==$_SESSION["pos"][6] && strlen($_SESSION["msg"][4])!==0 && strlen($_SESSION["msg"][5])!==0 && strlen($_SESSION["msg"][6])!==0){
            return "<div id='output'>HA VINTO IL GIOCATORE $n ($string)</div>";
        }else if($_SESSION["pos"][7]==$_SESSION["pos"][8] && $_SESSION["pos"][8]==$_SESSION["pos"][9] && strlen($_SESSION["msg"][7])!==0 && strlen($_SESSION["msg"][8])!==0 && strlen($_SESSION["msg"][9])!==0){
            return "<div id='output'>HA VINTO IL GIOCATORE $n ($string)</div>";
        }else if($_SESSION["pos"][1]==$_SESSION["pos"][4] && $_SESSION["pos"][4]==$_SESSION["pos"][7] && strlen($_SESSION["msg"][1])!==0 && strlen($_SESSION["msg"][4])!==0 && strlen($_SESSION["msg"][7])!==0){
            return "<div id='output'>HA VINTO IL GIOCATORE $n ($string)</div>"; //verticali
        }else if($_SESSION["pos"][2]==$_SESSION["pos"][5] && $_SESSION["pos"][5]==$_SESSION["pos"][8] && strlen($_SESSION["msg"][2])!==0 && strlen($_SESSION["msg"][5])!==0 && strlen($_SESSION["msg"][8])!==0){
            return "<div id='output'>HA VINTO IL GIOCATORE $n ($string)</div>";
        }else if($_SESSION["pos"][3]==$_SESSION["pos"][6] && $_SESSION["pos"][6]==$_SESSION["pos"][9] && strlen($_SESSION["msg"][3])!==0 && strlen($_SESSION["msg"][6])!==0 && strlen($_SESSION["msg"][9])!==0){
            return "<div id='output'>HA VINTO IL GIOCATORE $n ($string)</div>";
        }else if($_SESSION["pos"][1]==$_SESSION["pos"][5] && $_SESSION["pos"][5]==$_SESSION["pos"][9] && strlen($_SESSION["msg"][1])!==0 && strlen($_SESSION["msg"][5])!==0 && strlen($_SESSION["msg"][9])!==0){
            return "<div id='output'>HA VINTO IL GIOCATORE $n ($string)</div>"; //oblique
        }else if($_SESSION["pos"][3]==$_SESSION["pos"][5] && $_SESSION["pos"][5]==$_SESSION["pos"][7] && strlen($_SESSION["msg"][3])!==0 && strlen($_SESSION["msg"][5])!==0 && strlen($_SESSION["msg"][7])!==0){
            return "<div id='output'>HA VINTO IL GIOCATORE $n ($string)</div>";           
        }else if($_SESSION["pos"][1]!=0 && $_SESSION["pos"][2]!=0 && $_SESSION["pos"][3]!=0 && $_SESSION["pos"][4]!=0 && $_SESSION["pos"][5]!=0 && $_SESSION["pos"][6]!=0 && $_SESSION["pos"][7]!=0 && $_SESSION["pos"][8]!=0 && $_SESSION["pos"][9]!=0){
            return "<div id='output'>PAREGGIO</div>"; //pareggio
        }else{
            return "";
        }
    }
    function blockAfterWin(){
        for ($i=0; $i<=9; $i++){
            $_SESSION["inizio"][$i]="";
        }
    }
    function resetGame(){
        for($i=1; $i<=9; $i++){
            $_SESSION["msg"][$i]="";
            $_SESSION["pos"][$i]=0;
            $_SESSION["inizio"][$i]="<input type='submit' name='invia$i' value='' class='submit' onClick='Music();'>";
            unset($_SESSION["mosse"]);
        }
    }
    function checkImg(){ 
        for($j=0; $j<9; $j++){
            for($h=0; $h<=9; $h++){
                if(!isset($_SESSION["salvamosse"][$h])){
                    $_SESSION["salvamosse"][$h]="";
                }
            }
            for($i=1; $i<=9; $i++){
                if(strpos($_SESSION["salvamosse"][$j], "$i")==1){
                    if($_SESSION["salvamosse"][$j]=="x$i"){
                        $_SESSION["stampamosse"][$i]="<img src='images/croce.png' id='i'>";
                    }
                    if($_SESSION["salvamosse"][$j]=="o$i"){
                        $_SESSION["stampamosse"][$i]="<img src='images/cerchio.png' id='i'>";
                    }
                }
            } 
        }
        for($i=1; $i<=9; $i++){
            if(!isset($_SESSION["stampamosse"][$i])){
                $_SESSION["stampamosse"][$i]="";
            }
        }
    }
?>