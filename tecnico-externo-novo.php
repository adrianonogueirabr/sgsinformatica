<?php include "verifica.php" ?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
 
    <title>Menu</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Adriano Nogueira - Desenvolvedor">
    <meta content= "SGADM - SISTEMA DE GESTÃO ADMINFOR SOLUCOES EM TI" name="description">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </head>

  <body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="#">
    <img src="imagens/logo techfy.png" width="30" height="30" class="d-inline-block align-top" alt="">
    <?php echo ucfirst($login_usuario) ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          CLIENTES
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="consulta-clientes.php">CONSULTAR CLIENTES</a>
          <a class="dropdown-item" href="cadastro-clientes.php">CADASTRO CLIENTES</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="consulta-equipamentos.php">EQUIPAMENTOS</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ORDEM DE SERVICOS
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="consulta-os.php">CONSULTAR OS</a>
          <a class="dropdown-item" href="consulta-apontamento.php">APONTAR OS</a>
          <a class="dropdown-item" href="corrigir-apontamento.php">CORRIGIR APONTAMENTO OS</a>
          <a class="dropdown-item" href="fechamento-os.php">FATURAR OS</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">SAIR</a>
      </li>
    </ul>
    
  </div>
</nav>

</body>
</html>