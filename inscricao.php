<?php
    session_start();
    if( $_SESSION['nivel'] != "aluno" ){
        header("Location: logout.php");
    }
    $valor = $_GET['valor'];
    $nome = $_GET['nome'];

    if ($valor == "inscrever"){
        $sql = "INSERT INTO inscricao (username, estado, nome, data_inscricao) 
                VALUES('".$_SESSION['username']."', 'pendente','".$nome."', CURDATE());";
    }
    else if ($valor == "desinscrever"){
        $sql = "DELETE FROM inscricao 
                WHERE username = '".$_SESSION['username']."'
                AND nome = '".$nome."';";
    }
    else{
        header("Location: int_erro.html");
    }

    include './db/basedados.h';
    $retval = mysqli_query($conn , $sql);

    //Se correr bem dá o aviso abaixo
    if (mysqli_affected_rows ($conn) == 1)
        echo "<script>
                if(confirm('Inscrito com sucesso!')){
                    window.location.href = 'gerir_inscricoes.php';
                }
            </script>";
    
    header("Location: dados_formacao.php?nome=".$nome);   
?>