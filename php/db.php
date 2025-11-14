<?php 
    $host = 'localhost';
    $banco = 'Altiplano';
    $user = 'root';
    $senha ='';

    $conn = new mysqli($host, $user, $senha, $banco);

    if (!$conn){
        exit;
    }else{
        //echo "Conexão realizada com sucesso!";
    }
?>