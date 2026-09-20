<?php
require_once("../Login/requisitos.php");
if(isset($_GET['id']))
    {
       require_once("../conexao.php");
        $id=$_GET['id'];

        $sql = "delete from servico where id = $id";
        $mensagem="Deletado com sucesso";
        mysqli_query($conexao, $sql);

        //redirecionamento
        header("Location: servicos-listar.php?mensagem=$mensagem");
        exit;
    }
