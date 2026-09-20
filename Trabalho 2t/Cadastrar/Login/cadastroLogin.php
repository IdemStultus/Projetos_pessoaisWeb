<?php
require_once("../conexao.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$erro = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnCadastrar'])) {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $confirmarSenha = $_POST['confirmarSenha'] ?? '';

if ($email === '' || $senha === '' || $confirmarSenha === '') {
    $erro[] = "Preencha todos os campos.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erro[] = "Informe um e-mail válido.";
} elseif ($senha !== $confirmarSenha) {
    $erro[] = "As senhas não são iguais.";
} elseif (
    strlen($senha) < 8 ||
    !preg_match('/[A-Z]/', $senha) ||
    !preg_match('/[a-z]/', $senha) ||
    !preg_match('/[0-9]/', $senha) ||
    !preg_match('/[\W_]/', $senha)
) {

    $erro[] = "A senha deve ter no mínimo 8 caracteres, uma letra maiúscula, uma letra minúscula, um número e um caractere especial.";
} else {
        $email = mysqli_real_escape_string($conexao, $email);
        $verifica = mysqli_query($conexao, "SELECT id FROM usuario WHERE email = '$email' LIMIT 1") or die(mysqli_error($conexao));

        if (mysqli_num_rows($verifica) > 0) {
            $erro[] = "Este e-mail já está cadastrado.";
        } else {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuario (email, senha) VALUES ('$email', '$senhaHash')";
            mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

            $idUsuario = mysqli_insert_id($conexao);
            $_SESSION['usuario'] = $idUsuario;
            $_SESSION['email'] = $email;

            header("Location: ../Cliente/cliente-cadastrar.php");
            exit;
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

<div class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="container" style="max-width: 500px;">
        <div class="card mb-3">
            <div class="card-body text-center">
                <h5 class="card-title">Cadastrar Login</h5>
            </div>
        </div>

        <?php if (!empty($erro)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php foreach ($erro as $mensagemErro) : ?>
                    <div><?php echo htmlspecialchars($mensagemErro); ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input name="email" type="email" class="form-control" id="email" required>
        </div>
        <label for="senha" class="form-label">Senha</label>
        <div class="input-group mb-3">
            <input name="senha" type="password" class="form-control" id="senha" required>
            <button type="button" class="btn btn-outline-secondary"
            onclick="mostrarSenha('senha', 'iconeSenha')">
            <i class="bi bi-eye" id="iconeSenha"></i>
            </button>
        </div>
        <div class="mb-3">
<label for="confirmarSenha" class="form-label">Confirmar senha</label>

    <div class="input-group">
        <input name="confirmarSenha" type="password" class="form-control" id="confirmarSenha" 
            required>
        <button type="button" class="btn btn-outline-secondary"
            onclick="mostrarSenha('confirmarSenha', 'iconeConfirmarSenha')">
            <i class="bi bi-eye" id="iconeConfirmarSenha"></i>
        </button>
    </div>
</div>
            <div class="d-flex gap-2 mt-3">
                <button name="btnCadastrar" type="submit" class="btn btn-primary flex-grow-1">Cadastrar</button>
                <a href="login.php" class="btn btn-secondary">Já tenho cadastro</a>
            </div>
        </form>
    </div>
</div>

<?php require_once("../rodape.php"); ?>
</body>
</html>