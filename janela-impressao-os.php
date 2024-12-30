<?php include "verifica.php"; 

include "conexao.php";

$id = $_GET['id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/bootstrap.css" rel="stylesheet" />
<script type="text/javascript" src="javascript/cadastro_usuario.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>janela de Impressao</title>
</head>

<body>
<form name="usuario" >
  <table width="100%" class="table-condensed" align="left" >
    <tr>
	 <tr>
     <td><legend><h3>Impressao de Documentos da Ordem de Servico <?php echo base64_decode($id) ?></h3></legend></td>
  </tr>
  <tr>
      <td height="30" align="center">
          <a class="btn btn-primary" href="http://localhost/helpdesk-novo/relatorio-os-entrada.php?id=<?php echo $id ?>" role="button" target="_blank">Imprimir Comprovante de Entrada</a>
      </td>
  </tr>
   <tr>
      <td height="30" align="center">
          <a class="btn btn-primary" href="http://localhost/helpdesk-novo/relatorio-os-externa.php?id=<?php echo $id ?>" role="button" target="_blank">Imprimir Relatorio de OS Externa</a>
      </td>          
  </tr>
  <tr>
      <td height="30" align="center">
          <input class="btn btn-primary" type="submit" value="Fechar Janela" onclick="window.close()" />
      </td>          
  </tr>

</table>

</form>
</body>
</html>