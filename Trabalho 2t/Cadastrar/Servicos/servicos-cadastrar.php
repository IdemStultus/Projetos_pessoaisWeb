<?php
    require_once("../Login/requisitos.php");
    if (isset($_POST['btnCadastrar'])) {
        require_once("../conexao.php");

        $nome = $_POST['nome'];
        $descricao=$_POST['descricao'];
        $sql = "insert into servico (nome, descricao) values ('$nome', '$descricao')";

        mysqli_query($conexao, $sql);
        $mensagem="Inserido com Sucesso.";
    }

?>
<?php require_once("../cabecalho.php"); ?>

<div class="container mb-3">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Cadastro de Serviços</h5>
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
        
        <button name="btnCadastrar" type="submit" class="btn btn-primary">Cadastrar</button>
        <a href="../principal.php" class="btn btn-secondary">Voltar</a>
        
    </form>
<?php require_once("../rodape.php"); ?>