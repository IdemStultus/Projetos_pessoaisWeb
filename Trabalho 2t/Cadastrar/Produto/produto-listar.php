<?php
    require_once("../conexao.php");
    require_once("../Login/requisitos.php");
    $sql="select * from produto order by nome";
    $resultado=mysqli_query($conexao, $sql);
?>
<?php require_once("../cabecalho.php"); ?>
<div class="container mb-3">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title"><i class="bi bi-card-list"></i> Listagem de Produtos
        <a href="produto-cadastrar.php"><i class="bi bi-plus-square"></i></a>
        </div>
    </div>
</div>
<div class="container mb-3">
<table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Descrição</th>
        <th scope="col">Preço</th>
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
            <td><?= $linha['descricao'] ?></td>
            <td><?= $linha['preco'] ?></td>
            <td><?= $linha['status'] ?></td>
            <td>
                <a href="produto-alterar.php?id=<?=$linha['id'] ?>" class="btn btn-warning"><i class="bi bi-file-earmark-text"></i></a>
                <a href="produto-excluir.php?id=<?=$linha['id'] ?>" class="btn btn-danger" onclick="return confirm('Deseja excluir este registro?')"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>
<?php require_once("../rodape.php"); ?>
