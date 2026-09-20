<?php
    require_once("../Login/requisitos.php");
    require_once("../conexao.php");
    //Atualiza o produto
    if (isset($_POST['salvar'])) {
        $id=$_POST['id'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $status = isset($_POST['status']) ? 1 : 0;

        $sql = "update produto set
        nome = '$nome',
        descricao = '$descricao',
        preco = '$preco',
        status = '$status'
        where id = $id";

        mysqli_query($conexao, $sql);
        $mensagem= "Registro alterado";
    }
//Busca o produto
if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "select * from produto where id=$id";

        $resultado= mysqli_query($conexao, $sql);
        $registro = mysqli_fetch_array($resultado);
    }

?>
<?php require_once("../cabecalho.php"); ?>

<div class="container mb-3">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Edição de Produto</h5>
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
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input name="descricao" type="text" class="form-control" id="descricao" value="<?= $registro['descricao']?>">
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label" >Preço</label>
            <input name="preco" type="number" step="0.01" class="form-control" id="preco" value="<?= $registro['preco']?>">
        </div>
        <div class="form-check mb-3">
            <input type="hidden" name="status" value="0">
            <input class="form-check-input" type="checkbox" name="status" value="1" id="status" <?= ($registro['status']==1)?'checked':'' ?> >
            <label class="form-check-label" for="checkDefault">Produto ativo</label>
        </div>
        <button name="salvar" type="submit" class="btn btn-primary">Salvar</button>
        <a href="produto-listar.php" class="btn btn-secondary">Voltar</a>
    </form>
<?php require_once("../rodape.php"); ?>
