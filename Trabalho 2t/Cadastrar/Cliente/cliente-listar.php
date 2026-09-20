<?php
    require_once("../Login/requisitos.php");
    require_once("../conexao.php");
    $sql = "select * from clientes where 1 = 1 ";

if(!empty($_POST['nome'])) {

    $sql .= "and nome like '%".$_POST['nome']."%'";

}
if(!empty($_POST['email'])) {

    $sql .= "and email like '%".$_POST['email']."%'";

}
$sql .= " order by nome";
$resultado = mysqli_query($conexao, $sql); ?>

<?php require_once("../cabecalho.php"); ?>
<div class="container">
<form method="post">
    <div class="card mb-3" >
        <div class="card-body">
            <h5 class="card-title mb-3">Pesquisar</h5>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input name="nome" type="text" class="form-control" id="nome" aria-describedby="nome">   
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
                </div>
            <p class="card-text"><button name="pesquisar" type="submit" class="btn btn-primary">Pesquisar</button>
        </div>
    </div>
</form>
</div>
<div class="container mb-3">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title"><i class="bi bi-card-list"></i> Listagem de Clientes
        <a href="cliente-cadastrar.php"><i class="bi bi-plus-square"></i></a>
        </div>
    </div>
</div>

<div class="container">
<table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">CPF</th>
        <th scope="col">Telefone</th>
        <th scope="col">Endereço</th>
        <th scope="col">Cidade</th>
        <th scope="col">Estado</th>
        <th scope="col">Status</th>
        <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($linha = mysqli_fetch_array($resultado)) { 
            
            ?>
        <tr>
            <td><?php echo $linha['id'] ?></td>
            <td><?= $linha['nome'] ?></td>
            <td><?= $linha['email'] ?></td>
            <td><?= $linha['cpf'] ?></td>
            <td><?= $linha['telefone'] ?></td>
            <td><?= $linha['endereco'] ?></td>
            <td><?= $linha['cidade'] ?></td>
            <td><?= $linha['estado'] ?></td>
            <td><?= $linha['status'] ?></td>
            
            <td>
                <a href="cliente-alterar.php?id=<?=$linha['id'] ?>" class="btn btn-warning"><i class="bi bi-file-earmark-text"></i></a>
                <a href="cliente-excluir.php?id=<?=$linha['id'] ?>" class="btn btn-danger" onclick="return confirm('Deseja excluir este registro?')"><i class="bi bi-trash"></i></a>
            </td>
            
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>