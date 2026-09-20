<?php
    require_once("../conexao.php");
    require_once("../Login/requisitos.php");
    //Atualiza o cadastro
    if (isset($_POST['salvar'])) {
        $id=$_POST['id'];
        $nome = $_POST['nome'];
        $email= $_POST['email'];
        $cpf= $_POST['cpf'];
        $telefone= $_POST['telefone'];
        $endereco= $_POST['endereco'];
        $cidade= $_POST['cidade'];
        $estado= $_POST['estado'];
        $status=$_POST['status'];

        $sql = "update clientes set
        nome = '$nome',
        email = '$email',
        cpf = '$cpf',
        telefone = '$telefone',
        endereco = '$endereco',
        cidade = '$cidade',
        estado = '$estado',
        status = '$status'
        where id = $id";

        mysqli_query($conexao, $sql);
        $mensagem= "Registro alterado";
    }
//Busca o onjeto usuario
if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "select * from clientes where id=$id";

        $resultado= mysqli_query($conexao, $sql);
        $registro = mysqli_fetch_array($resultado);
    }

?>
<?php require_once("../cabecalho.php"); ?>

<div class="container mb-3">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Edição de Clientes</h5>
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
            <label for="email" class="form-label" >Email</label>
            <input name="email" type="email" class="form-control" id="email" value="<?= $registro['email']?>">
        </div>
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input name="cpf" type="number" class="form-control" id="cpf" value="<?= $registro['cpf']?>">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input name="telefone" type="number" class="form-control" id="telefone" value="<?= $registro['telefone']?>">
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input name="endereco" type="text" class="form-control" id="endereco" value="<?= $registro['endereco']?>">
        </div>
        <div class="mb-3">
            <label for="cidade" class="form-label">Cidade</label>
            <input name="cidade" type="text" class="form-control" id="cidade" value="<?= $registro['cidade']?>">
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <input name="estado" type="text" class="form-control" id="estado" value="<?= $registro['estado']?>">
        </div>
            <div class="form-check mb-3">
                <input type="hidden" name="status" value="0">
            <input class="form-check-input" type="checkbox" name="status" value="1" id="status">
            <label class="form-check-label" for="checkDefault">
            Cliente ativo
            </label>
        </div>
        <button name="salvar" type="submit" class="btn btn-primary">Salvar</button>
        <a href="cliente-listar.php" class="btn btn-secondary">Voltar</a>
    </form>
<?php require_once("../rodape.php"); ?>