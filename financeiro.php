<?php include "verifica.php" ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
 
 <title>SGINFO - Sistema de Gestao de Servicos em Informatica</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <meta name="author" content="Adriano Nogueira - Desenvolvedor">
   <meta content= "SGOFIC - SISTEMA DE GESTÃO DE OFICINAS" name="description">
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

  <table width="100%" class="table responsive">
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
                    CLIENTE
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="consulta-clientes.php">CONSULTAR</a>
                  <a class="dropdown-item" href="cadastro-clientes.php">CADASTRO</a>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    CONTRATO
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="listagem-cm.php">CONSULTAR</a>
                  <a class="dropdown-item" href="cadastro-cm.php">CADASTRO</a>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">FINANCEIRO</a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="consulta-clientes.php">RECEBER ADIANTAMENTO</a>
                    <a class="dropdown-item" href="listagem-os-receber.php">RECEBER ORDEM DE SERVIÇO</a>
                    <a class="dropdown-item" href="consulta-titulo-receber.php">CONSULTA DE TITULOS</a>
                    <a class="dropdown-item" href="consulta-recibo.php">CONSULTA DE RECIBOS</a>
                    <a class="dropdown-item" href="calcular-juros-multa.php">APLICAR JUROS E MULTAS</a>
                  </div>
                </li>
                
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    RELATORIOS
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="consulta-relatorio.php">RECEBIMENTOS</a>
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