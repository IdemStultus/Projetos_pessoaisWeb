<?php
require_once("../Login/requisitos.php");
if(isset($_GET['id']))
    {
       require_once("../conexao.php");
        $id=$_GET['id'];

        $sql = "delete from produtocategoria where id = $id";
        $mensagem="Registro excluído";
        mysqli_query($conexao, $sql);

        //redirecionamento
        header("Location: catProduto-listar.php?mensagem=$mensagem");
        exit;
    }
