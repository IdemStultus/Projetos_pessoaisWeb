<?php
    require_once("../Login/requisitos.php");
    if (isset($_POST['btnCadastrar'])) {
        require_once("../conexao.php");
        
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $status=$_POST['status'];
        $sql = "insert into produto 
        (nome, descricao, preco, status) values 
        ('$nome', '$descricao', '$preco', '$status')";

        mysqli_query($conexao, $sql);
        $mensagem="Inserido com Sucesso.";
    }

?>
<?php require_once("../cabecalho.php"); ?>

<div class="container mb-3">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Cadastro de Produto</h5>
        </div>
    </div>
</div>
<div class="container">
    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input name="nome" type="text" class="form-control" id="nome">
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input name="descricao" type="text" class="form-control" id="descricao">
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">preco</label>
            <input name="preco" type="number" step="0.01" class="form-control" id="preco">
        </div>
            <div class="form-check mb-3">
                <input type="hidden" name="status" value="0">
            <input class="form-check-input" type="checkbox" name="status" value="1" id="status">
            <label class="form-check-label" for="checkDefault">
            Produto ativo
            </label>
        </div>
        <button name="btnCadastrar" type="submit" class="btn btn-primary">Cadastrar</button>
        <a href="../principal.php" class="btn btn-secondary">Voltar</a>
        
    </form>
<?php require_once("../rodape.php"); ?>