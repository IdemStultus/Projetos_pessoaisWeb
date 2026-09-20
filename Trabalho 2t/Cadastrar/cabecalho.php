<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: /Trabalho%202t/Cadastrar/Login/login.php");
    exit;
}

if(isset($_GET['mensagem']))
    {
        $mensagem=$_GET['mensagem'];
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <!-- Icones link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/Trabalho%202t/Cadastrar/principal.php"><i class="bi bi-arrow-down-right-square"></i>Sistema</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/Trabalho%202t/Cadastrar/principal.php">Principal</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Cadastros
            </a>
            <ul class="dropdown-menu">
                <!-- Desce para a pasta Cliente -->
                <li><a class="dropdown-item" href="/Trabalho%202t/Cadastrar/Cliente/cliente-cadastrar.php">Cliente</a></li>
                <li><a class="dropdown-item" href="/Trabalho%202t/Cadastrar/Produto/catProduto-cadastrar.php">Categoria de produto</a></li>
                <li><a class="dropdown-item" href="/Trabalho%202t/Cadastrar/Produto/produto-cadastrar.php">Produto</a></li>
                <li><a class="dropdown-item" href="/Trabalho%202t/Cadastrar/Servicos/servicos-cadastrar.php">Serviços</a></li>
            </ul>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Listagem
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/Trabalho%202t/Cadastrar/Cliente/cliente-listar.php">Listagem de Clientes</a></li>
                <li><a class="dropdown-item" href="/Trabalho%202t/Cadastrar/Produto/catProduto-listar.php">Listagem de Categoria de produto</a></li>
                <li><a class="dropdown-item" href="/Trabalho%202t/Cadastrar/Produto/produto-listar.php">Listagem de Produto</a></li>
                <li><a class="dropdown-item" href="/Trabalho%202t/Cadastrar/Servicos/servicos-listar.php">Listagem de Serviços</a></li>
            </ul>
            </li>
        </ul>
        <form class="d-flex" role="search" method="post">
            <?php if (isset($_SESSION['usuario'])): ?>
                <button class="btn btn-outline-danger" type="submit" name="logout"><i class="bi bi-box-arrow-right"></i> Sair</button>
            <?php else: ?>
                <a href="/Trabalho%202t/Cadastrar/Login/login.php">
                    <button class="btn btn-outline-success" type="button"><i class="bi bi-person-fill-down"></i>Logar</button>
                </a>
            <?php endif; ?>
        </form>
        </div>
    </div>
</nav>

<div class="container mt-3">
<?php if(isset($mensagem)) { ?>
<div class="alert alert-success" role="alert">
    <i class="bi bi-check-circle-fill"></i>
    <?= htmlspecialchars($mensagem) ?>
</div>
<?php } ?>
</div> <!-- Fechamento da div container -->

</body>
</html>
