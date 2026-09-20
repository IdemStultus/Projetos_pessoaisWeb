<?php
    require_once("../conexao.php");
    require_once("../Login/requisitos.php");
    //Atualiza a categoria
    if (isset($_POST['salvar'])) {
        $id=$_POST['id'];
        $nome = $_POST['nome'];

        $sql = "update produtocategoria set nome = '$nome' where id = $id";

        mysqli_query($conexao, $sql);
        $mensagem= "Registro alterado";
    }
//Busca a categoria
if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "select * from produtocategoria where id=$id";

        $resultado= mysqli_query($conexao, $sql);
        $registro = mysqli_fetch_array($resultado);
    }

?>
<?php require_once("../cabecalho.php"); ?>

<div class="container mb-3">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Edição de Categoria de Produto</h5>
        </div>
    </div>
</div>
<div class="container">
    <form method="post">
        <input type="hidden" name="id" value="<?= $registro['id'] ?>"/>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input name="nome" type="text" class="form-control" id="nome" value="<?= $registro['nome']?>">
        </div>
        
        <button name="salvar" type="submit" class="btn btn-primary">Salvar</button>
        <a href="catProduto-listar.php" class="btn btn-secondary">Voltar</a>
    </form>
<?php require_once("../rodape.php"); ?>
