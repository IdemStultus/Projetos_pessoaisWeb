<?php
    require_once("../Login/requisitos.php");
    if (isset($_POST['btnCadastrar'])) {
        require_once("../conexao.php");
        
        $nome = $_POST['nome'];
        $email= $_POST['email'];
        $cpf= $_POST['cpf'];
        $telefone= $_POST['telefone'];
        $endereco= $_POST['endereco'];
        $cidade= $_POST['cidade'];
        $estado= $_POST['estado'];
        $status=$_POST['status'];
        
        $erro = [];
        //Validacao nome
        if ($nome === '') { 
            $erro[] = "Preencha o nome."; 
        } elseif (!preg_match('/^[\p{L}]+(?: [\p{L}]+)*$/u', $nome)) {
            $erro[] = "O nome deve conter apenas letras e espaços."; 
        }
        //Validacao email
        if ($email === '') { 
            $erro[] = "Preencha o e-mail."; 
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
            $erro[] = "Informe um e-mail válido."; 
        }
        //Validacao cpf
        if ($cpf === '') { 
            $erro[] = "Preencha o CPF."; 
        } elseif (!preg_match('/^[0-9]+$/', $cpf)) { 
            $erro[] = "O CPF deve conter apenas números."; 
        }

        // Validação do telefone 
        if ($telefone === '') { 
            $erro[] = "Preencha o telefone."; 
        } elseif (!preg_match('/^[0-9]+$/', $telefone)) { 
            $erro[] = "O telefone deve conter apenas números."; 
        }
        // Validação do endereço 
        if ($endereco === '') { 
            $erro[] = "Preencha o endereço."; 
        } elseif (!preg_match('/^[\p{L}\p{N}\s.,ºª\-\/]+$/u', $endereco)) { 
            $erro[] = "O endereço contém caracteres inválidos."; 
        }
        // Validação da cidade 
        if ($cidade === '') { 
            $erro[] = "Preencha a cidade."; 
        } elseif (!preg_match('/^[\p{L}]+(?: [\p{L}]+)*$/u', $cidade)) { 
            $erro[] = "A cidade deve conter apenas letras e espaços."; 
        }
        // Validação do estado 
        if ($estado === '') { 
            $erro[] = "Preencha o estado."; 
        } elseif (!preg_match('/^[\p{L}]+(?: [\p{L}]+)*$/u', $estado)) { 
            $erro[] = "O estado deve conter apenas letras e espaços."; 
        }
        // Se não houver erros, cadastra 
        if (empty($erro)) { 
            $nome = mysqli_real_escape_string($conexao, $nome); 
            $email = mysqli_real_escape_string($conexao, $email); 
            $cpf = mysqli_real_escape_string($conexao, $cpf); 
            $telefone = mysqli_real_escape_string($conexao, $telefone); 
            $endereco = mysqli_real_escape_string($conexao, $endereco); 
            $cidade = mysqli_real_escape_string($conexao, $cidade); 
            $estado = mysqli_real_escape_string($conexao, $estado); 
            $status = mysqli_real_escape_string($conexao, $status);
        
        $sql = "insert into clientes 
        (nome, email, cpf, telefone, endereco, cidade, estado, status) values 
        ('$nome', '$email','$cpf','$telefone','$endereco','$cidade','$estado','$status')";
        }
        mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
        $mensagem="Inserido com Sucesso.";
    }

?>
<?php require_once("../cabecalho.php"); ?>

<div class="container mb-3">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Cadastro de Cliente</h5>
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
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="email">
        </div>
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input name="cpf" type="number" class="form-control" id="cpf">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input name="telefone" type="number" class="form-control" id="telefone">
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input name="endereco" type="text" class="form-control" id="endereco">
        </div>
        <div class="mb-3">
            <label for="cidade" class="form-label">Cidade</label>
            <input name="cidade" type="text" class="form-control" id="cidade">
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <input name="estado" type="text" class="form-control" id="estado">
        </div>
            <div class="form-check mb-3">
                <input type="hidden" name="status" value="0">
            <input class="form-check-input" type="checkbox" name="status" value="1" id="status">
            <label class="form-check-label" for="checkDefault">
            Cliente ativo
            </label>
        </div>
        <button name="btnCadastrar" type="submit" class="btn btn-primary">Cadastrar</button>
        <a href="cliente-listar.php" class="btn btn-secondary">Voltar</a>
        
    </form>
<?php require_once("../rodape.php"); ?>