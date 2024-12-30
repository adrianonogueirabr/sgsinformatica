<?php include "verifica.php" ?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
 
  <title>SGINFO - Sistema de Gestao de Servicos em Informatica</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <meta name="author" content="Adriano Nogueira - Desenvolvedor">
   <meta content= "SGinfo - Sistema de Gestao de Informatica" name="description">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/bootstrap-icons.css">
    
    <script src="bootstrap/jquery-3.3.1.slim.min.js"></script>
    <script src="bootstrap/popper.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>
    
  </head>

<body>
<table class="table">
  <tr>
      <td>
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
                    USUÁRIOS
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="cadastro-usuarios.php">CADASTRO DE USUARIO</a>
                    <a class="dropdown-item" href="consulta-usuarios.php">CONSULTA DE USUARIO</a>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    LOJAS
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="cadastro-filial.php">CADASTRO DE LOJAS</a>
                    <a class="dropdown-item" href="consulta-filial.php">CONSULTA DE LOJAS</a>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    SERVICOS
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="cadastro-servicos.php">CADASTRO DE SERVIÇO</a>
                    <a class="dropdown-item" href="consulta-servicos.php">CONSULTA DE SERVIÇO</a>
                  </div>
                </li>  
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    PECAS
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="cadastro-pecas.php">CADASTRO DE PECAS</a>
                    <a class="dropdown-item" href="consulta-pecas.php">CONSULTA DE PECAS</a>
                  </div>
                </li>         
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    ORDEM DE SERVICOS
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="consulta-os.php">CONSULTAR OS</a>
                    <a class="dropdown-item" href="fechamento-os.php">FATURAR OS INTERNA</a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="logout.php">SAIR</a>
                </li>
              </ul>
              
            </div>
          </nav>
          </td>
    <tr>
</table>

</body>
</html>