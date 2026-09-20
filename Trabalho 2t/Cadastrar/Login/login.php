<?php
require_once("../conexao.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['usuario'])) {
    header("Location: ../Cliente/cliente-cadastrar.php");
    exit;
}

$mensagemSucesso = isset($_GET['mensagem']) ? htmlspecialchars($_GET['mensagem']) : '';
$erro = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnEntrar'])) {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($email === '' || $senha === '') {
        $erro[] = "Preencha o e-mail e a senha.";
    } else {
        $email = mysqli_real_escape_string($conexao, $email);
        $sql_code = "SELECT id, senha FROM usuario WHERE email = '$email' LIMIT 1";
        $sql_query = mysqli_query($conexao, $sql_code) or die(mysqli_error($conexao));
        $dado = $sql_query->fetch_assoc();

        if (!$dado) {
            $erro[] = "Este e-mail não está cadastrado.";
        } elseif (password_verify($senha, $dado['senha'])) {
            $_SESSION['usuario'] = $dado['id'];
            $_SESSION['email'] = $email;
            header("Location: ../Cliente/cliente-listar.php");
            exit;
        } else {
            $erro[] = "Senha incorreta.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/Trabalho%202t/outro/estilos.css">
</head>
<script>
function mostrarSenha(idCampo, idIcone) {

    const campo = document.getElementById(idCampo);
    const icone = document.getElementById(idIcone);

    if (campo.type === "password") {

        campo.type = "text";

        icone.classList.remove("bi-eye");
        icone.classList.add("bi-eye-slash");

    } else {

        campo.type = "password";

        icone.classList.remove("bi-eye-slash");
        icone.classList.add("bi-eye");
    }
}
</script>
<body>

<main class="login-page d-flex align-items-center justify-content-center">
    <div class="card login-card">
        <header class="login-header">
            <div class="logo-mark" aria-hidden="true">
                <i class="bi bi-arrow-down-right-square"></i>
            </div>
            <h1>Sistema</h1>
        </header>

        <div class="login-body">
    <?php if ($mensagemSucesso !== '') : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $mensagemSucesso; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($erro)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach ($erro as $mensagemErro) : ?>
                <div><?php echo htmlspecialchars($mensagemErro); ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <label for="email" class="form-label">E-mail</label>
        <div class="mb-3">
            <input name="email" type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
        </div>

        <label for="senha" class="form-label">Senha</label>
        <div class="input-group">
            <input name="senha" type="password" class="form-control" id="senha" required>
            <button type="button" class="btn btn-outline-secondary"
            onclick="mostrarSenha('senha', 'iconeSenha')">
            <i class="bi bi-eye" id="iconeSenha"></i>
            </button>
        </div>
        <div class="login-links mt-3">
            <a href="cadastroLogin.php">Ainda não possuo cadastro.</a>
            <br>
            <a href="#">Esqueci minha senha</a>
        </div>
        <div class="login-actions d-flex gap-2 mt-4">
            <button name="btnEntrar" type="submit" class="btn btn-primary flex-grow-1">Entrar</button>
            <a href="../principal.php" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
        </div>
    </div>
</main>

<?php require_once("../rodape.php"); ?>
</body>
</html>